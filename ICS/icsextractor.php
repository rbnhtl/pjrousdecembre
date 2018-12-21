<?php
	include '../src/Cours.php';
	include '../src/Matiere.php';
	include '../src/Groupe.php';
	include '../src/Salle.php';
	include '../src/Occupe.php';
	include '../src/Participe.php';

	// On récupère l'entity manager de l'orm doctrine
	require_once "../bootstrap.php";

	// On initialise la timezone
	// On utilise une commande pour donner la timezone par défault, pour utiliser les DATETIME par la suite
	// On récupère la liste des timeZone UTC et prend la première etant donné que l'on est en UTC + 0
	date_default_timezone_set(DateTimeZone::listIdentifiers(DateTimeZone::UTC)[0]);

    /*
	 * Recupère un fichier .ics, le parse et en ressort un objet php
	 * Cet objet contient toutes les infos permettant de devenir un cours
     */
	function icsExtractor($file) {
		global $entityManager;
		//Tableau qui contient toutes les lignes du fichier ics lu
		$calendar = file($file);

		//Préparation des recherches dans le fichier ics
		$intituleCours = "SUMMARY:";
		$dateCours = "DTSTART:";
		$dateCoursFin = "DTEND:";
		$descCours = "DESCRIPTION:";
		$location = "LOCATION:";

		// Nombre d'objets cours
		$n = 0;

		//Tableaux pour stocker les lignes de chaque cours
		$coursTab = array();
		$dateTab = array();
		$dateTabEnd = array();
		$descTab = array();
		$salleTab = array();

		// Parcours le fichier et range toutes les lignes dans des tableaux spécifiques
		foreach($calendar as $ligne){
			// Compte le nombre total d'objets dans le fichier
			// Chaque ligne contenant la chaine "SUMMARY:" est ajoutée au tableau coursTab
			if(strpos($ligne, $intituleCours) !== FALSE){
				array_push($coursTab, $ligne);
				$n++;
			// Chaque ligne contenant la chaine "DTSTART:" est ajoutée au tableau dateTab
			} else if (strpos($ligne, $dateCours) !== FALSE) {
				array_push($dateTab, $ligne);
			// Chaque ligne contenant la chaine "DTEND:" est ajoutée au tableau dateTabEnd
			} else if (strpos($ligne, $dateCoursFin) !== FALSE) {
				array_push($dateTabEnd, $ligne);
			// Chaque ligne contenant la chaine "DESCRIPTION:" est ajoutée au tableau descTab
			} else if (strpos($ligne, $descCours) !== FALSE) {
				array_push($descTab, $ligne);
			// Chaque ligne contenant la chaine "LOCATION:" est ajoutée au tableau salleTab
			} else if (strpos($ligne, $location) !== FALSE) {
				array_push($salleTab, $ligne);
			}
		}

		// Parcours de tout les tableaux en fonction du nombre de cours trouvés
		for ($j=0 ; $j < $n ; ++$j) {

			// Découpe la date de début
			$anneeD = substr($dateTab[$j], 8, 4);
			$moisD = substr($dateTab[$j], 12, 2);
			$jourD = substr($dateTab[$j], 14, 2);
			$heureD = substr($dateTab[$j], 17, 2);
			$minD = substr($dateTab[$j], 19, 2);

			// Découpe la date de fin
			$anneeF = substr($dateTabEnd[$j], 6, 4);
			$moisF = substr($dateTabEnd[$j], 10, 2);
			$jourF = substr($dateTabEnd[$j], 12, 2);
			$heureF = substr($dateTabEnd[$j], 15, 2);
			$minF = substr($dateTabEnd[$j], 17, 2);

			//Gestion des données du cours
			$matiere = substr($coursTab[$j], 8);
			$descCours = explode("\\n",substr($descTab[$j], 12));

			// Retire le premier element du tableau, qui est une chaine vide
			array_splice($descCours, 0, 1);
			// retire le dernier element du tableau qui est la date de l'export
			array_splice($descCours, sizeof($descCours)-1, 1);


			//Intialisation des chaines de caractère pour catégoriser les cours
			$groupes = "";
			$prof = array();
			// Si il manque des infos alors on rajoutera les informations qui en découlent
			for ($i = 0; $i < sizeof($descCours); $i++) {

				// Si il n'y a pas de chiffre  alors c'est bien un prof
				if(stripos($descCours[$i], " ") and preg_match('~[0-9]~', $descCours[$i]) === 0) {
					$prof[] = $descCours[$i];
				} else {
					$allGroupes = $descCours[$i]."\\n";
				}
			}

			// Si le prof n'est pas indiqué -->
			if(sizeof($prof) == 0) {
				$prof[] = "non déterminé";
			}

			// format des dates
			$dateD = $anneeD."-".$moisD."-".$jourD;
			$dateTimeD = new DateTime($dateD);
			$dateTimeD->setTime($heureD, $minD);

			$dateF = $anneeF."-".$moisF."-".$jourF;
			$dateTimeF = new DateTime($dateF);
			$dateTimeF->setTime($heureF, $minF);

			// Recherche de la matiere
			$newMatiere = $entityManager->getRepository('Matiere')->findOneBy(array('libelle' => "$matiere"));

			//On vérifie si la matière existe, sinon on la créée
			if(!$newMatiere){
				$newMatiere = new Matiere($matiere);
				$entityManager->persist($newMatiere);
				$entityManager->flush();

				print_r("<h1>Nouvelle Matière :</h1>".$newMatiere->getId()."<br>".$newMatiere->getLibelle()."<br><br>");
			}

			// créer le nouvel objet de cours
			$newCours = new Cours($newMatiere, $dateTimeD, $dateTimeF);
			$entityManager->persist($newCours);
			$entityManager->flush();

			print_r("<h1>Nouveau cours :</h1>".$newCours->getId()."<br>".$newCours->getMatiere()->getLibelle()."<br><br>");

			//******************************************//
			// Gestion des salles et de la table Occupe //
			//******************************************//

			// Recupère le nom de la salle et sa description, en le détachant de LOCATION
			$nomDescSalle = explode(":", $salleTab[$j]);

			// Recupération de l'ensemble des salles et suppression de 'LOCATION:'
			$nomDescSalle = explode("\,", $nomDescSalle[1]);

			// Sépare le numéro de salle et sa description
			$salle = explode(" ",$nomDescSalle[0]);
			
			//Recupère le num de la salle
			$numSalle = $salle[0];
			$numSalle = trim($numSalle);
			
			//Initialize la variable $descSalle a une chaine prédéfini si non de description
			$descSalle = "";
			// On remplit la description de la salle
			if (sizeof($salle) > 1) {
				for($i = 1; $i < sizeof($salle); $i++){
					$descSalle .= " ";
					$descSalle .= $salle[$i];
				}
			}
			// Recherche de la Salle correspondante au numero de salle
			$newSalle = $entityManager->getRepository('Salle')->find($numSalle);

			//On vérifie si la salle existe, sinon on la créée
			if(!$newSalle){
				$newSalle = new Salle($numSalle, $descSalle);
				$entityManager->persist($newSalle);
				$entityManager->flush();

				print_r("<h1>Nouvelle salle :</h1>".$newSalle->getNum()."<br>".$newSalle->getDescription()."<br><br>");
			}

			// On créé un lien entre la salle et le cours dans la BD
			$occupe = new Occupe($newSalle, $newCours);
			$entityManager->persist($occupe);
			$entityManager->flush();

			//print_r("<h1>Relation occupe :</h1>".$occupe->getSalle()->getNum()."<br>".$occupe->getCours()->getId()."<br><br>");
			unset($salles);

			//**********************************************//
			// Gestion des groupes et de la table Participe //
			//**********************************************//
			$groupes = explode("\\n,", $allGroupes);

			//Recupère le nom du groupe
			$nomGroupe = $groupes[0];

			// Recherche d'un groupe par nom
			$newGroupe = $entityManager->getRepository('Groupe')->findOneBy(array('libelle' => $nomGroupe));

			$participe = new Participe($newGroupe, $newCours);
			$entityManager->persist($participe);
			$entityManager->flush();

			echo("<h1>Relation participe :</h1>".$participe->getGroupe()."<br>".$participe->getCours()."<br><br>");

			unset($groupe);

		}	
	}

	icsExtractor("Informatique.ics");
?>