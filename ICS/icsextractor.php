<?php
	include '../src/Cours.php';
	include '../src/Matiere.php';
	include '../src/Groupe.php';
	include '../src/Salle.php';
	include '../src/Occupe.php';
	include '../src/Participe.php';

	// On initialise la timezone
	// On utilise une commande pour donner la timezone par défault, pour utiliser les DATETIME par la suite
	// On récupère la liste des timeZone UTC et prend la première etant donné que l'on est en UTC + 0
	date_default_timezone_set(DateTimeZone::listIdentifiers(DateTimeZone::UTC)[0]);

  /*
	 * Recupère un fichier .ics, le parse et en ressors un objet php
	 * Cet objet contient toutes les infos permettant de devenir un cours
   */
	function icsExtractor($file) {
		$calendar = $file;

		//Préparation des recherche dans le fichier ics
		$intituleCours = "/SUMMARY:(.*)/";
		$dateCours = "/DTSTART:(.*)/";
		$dateCoursFin = "/DTEND:(.*)/";
		$descCours = "/DESCRIPTION:(.*)/";
		$location = "/LOCATION:(.*)/";

		// n sera le nombre d'élément du fichier ICS
		// recupère dans le tableau $coursTab tout les noms de cours
		$n = preg_match_all($intituleCours, $calendar, $coursTab, PREG_PATTERN_ORDER);

		// récupère dans le tableau dateTab tout les élements composant de la date début
		preg_match_all($dateCours, $calendar, $dateTab, PREG_PATTERN_ORDER);

		// recupère dans le tableau dateTabEnd tout les éléments composant de la date de fin
		preg_match_all($dateCoursFin, $calendar, $dateTabEnd, PREG_PATTERN_ORDER);

		// récupère dans le tableau descTab tout les éléments composant la description des cours (nomProf, promo)
		preg_match_all($descCours, $calendar, $descTab, PREG_PATTERN_ORDER);

		//recupère la salle de cours
		preg_match_all($location, $calendar, $salleTab, PREG_PATTERN_ORDER);

		$returnTab = array();
		// Parcours de tout le tableau
		for ($j=0 ; $j < $n ; ++$j) {
			/*
			* Recupère les données de la fonction en preg_match_all
			*/

			// Découpe la date de début
			$anneeD = substr($dateTab[0][$j], 8, 4);
			$moisD = substr($dateTab[0][$j], 12, 2);
			$jourD = substr($dateTab[0][$j], 14, 2);
			$heureD = substr($dateTab[0][$j], 17, 2);
			$minD = substr($dateTab[0][$j], 19, 2);

			// Découpe la date de fin
			$anneeF = substr($dateTabEnd[0][$j], 6, 4);
			$moisF = substr($dateTabEnd[0][$j], 10, 2);
			$jourF = substr($dateTabEnd[0][$j], 12, 2);
			$heureF = substr($dateTabEnd[0][$j], 15, 2);
			$minF = substr($dateTabEnd[0][$j], 17, 2);

			//Gestion des données du cours
			$matiere = substr($coursTab[0][$j], 8);
			$descCours = explode("\\n",substr($descTab[0][$j], 12));

			// Retire le premier element du tableau, qui est une chaine vide
			array_splice($descCours, 0, 1);
			// retire le dernier element du tableau qui est la date de l'export
			array_splice($descCours, sizeof($descCours)-1, 1);


			//Intialisation des chaines de caractère pour catégoriser les cours
			$groupes = "";
			$prof = array();
			// Si il manque des infos alors on rajoutera les informations qui en découle
			for ($i = 0; $i < sizeof($descCours); $i++) {

				// Si il n'y a pas de chiffre ni de - et qu'il y a un espace alors c'est bien un prof
				if(stripos($descCours[$i], " ") and preg_match('~[0-9]~', $descCours[$i]) === 0 and preg_match('~-~', $descCours[$i]) === 0) {
					$prof[] = $descCours[$i];
				} else {
					$allGroupes .= $descCours[$i]."\\n";
				}
			}

			// Si le prof n'est pas indiqué -->
			if(sizeof($prof) == 0) {
				$prof[] = "non déterminé";
			}

			// format les données entre elles
			$dateD = $anneeD."-".$moisD."-".$jourD;
			$dateTimeD = new DateTime($dateD);
			$dateTimeD->setTime($heureD, $minD);

			$dateF = $anneeF."-".$moisF."-".$jourF;
			$dateTimeF = new DateTime($dateF);
			$dateTimeF->setTime($heureF, $minF);

			//Récupération de l'id de la matière
			$matiereManager = $this->getDoctrine()->getRepository(Matiere::class);
			// Recherche du groupe correspondant au nom
			$matiereDB = $matiereManager->findOneBy(['libelle' => "$matiere"]);

			// créer le nouvel objet de cours
			$cours = new Cours();
			$cours->dateDebut = $dateTimeD;
			$cours->dateFin = $dateTimeF;
			$cours->idMatiere = $matiereDB.id;
			$cours->save();

			//Récupération de l'ID du cours qui vient d'être créé
			$idCours = $cours->getId();


			//******************************************//
			// Gestion des salles et de la table Occupe //
			//******************************************//

			// Recupère le nom de la salle et sa description, en le détachant de LOCATION
			$allSalles = explode(":", $salleTab[0][$j]);

	  	//recup de l'ensemble des salles
      $allsalles = explode("\,", $allSalles[1]);

      foreach ($allSalles as $salles) {
        // Sépare le numéro de salle et sa description
  			$salle = explode(" ",$salles[1]);
  			//Recupère le num de la salle
  			$numSalle = $salle[0];
  			//Initialize la variable $descSalle a une chaine prédéfini si non de description
  			$descSalle = "";
  			if (sizeof($salle) > 1) {
  				$descSalle = $salle[1]." ".$salle[2];
  			}

				$salleManager = $this->getDoctrine()->getRepository(Salle::class);

				// Recherche de la Salle correspondante au numero de salle
				$salleDB = $salleManager->find("$numSalle");

				//On vérifie si la salle éxiste, sinon on l'a créer
				if($salleDB.isNull())){
					$newSalle = new Salle();
					$newSalle->numSalle = $numSalle;
					$newSalle->description = $descSalle;
					$newSalle->save();
				} else {
					$occupe = new Occupe();
					$occupe->numSalle = $numSalle;
					$occupe->idCours = $idCours;
					$occupe->save();
				}
      }
      unset($salles);

			//**********************************************//
			// Gestion des groupes et de la table Participe //
			//**********************************************//
      $groupes = explode("\\n,", $allGroupes);

      foreach ($groupes as $groupe) {
  			//Recupère le nom du groupe
  			$nomGroupe = $groupe[0];

				$participe = new Particpe();

				$groupeManager = $this->getDoctrine()->getRepository(Groupe::class);
				// Recherche du groupe correspondant au nom
				$grpDB = $groupeManager->findOneBy(['libelle' => "$nomGroupe"]);

				$participe->$idGroupe = $grpDB.id;
				$participe->idCours = $idCours;
				$participe->save();
      }
      unset($groupe);

		}
	}
