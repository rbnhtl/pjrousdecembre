<?php
	/**
	 * @author robin.hortala
	 *
	 */

	require_once '../src/Cours.php';
	require_once '../src/Matiere.php';
	require_once '../src/Groupe.php';
	require_once '../src/Salle.php';
	require_once '../src/Occupe.php';
	require_once '../src/Participe.php';
	require_once '../src/Anime.php';

	require_once '../DAO/personnelDAO.php';

	// On récupère l'entity manager de l'orm doctrine
	require_once "../bootstrap.php";

	// On agumente le temps maximal pour effectuer l'import (l'opération peut être longue)
	// Après de nombreux tests, en minimisant les accès à la BD, 1200 résultats peuvent être importés en quelques secondes
	// on définit cependant le délai maximal à 180 secondes dans le cadre ou on essayerait d'importer plusieurs 
	// centaines de milliers de cours
	set_time_limit ( 180 );

	// On initialise la timezone
	// On utilise une commande pour donner la timezone par défault, pour utiliser les DATETIME par la suite
	// On récupère la liste des timeZone UTC et prend la première etant donné que l'on est en UTC + 0
	date_default_timezone_set(DateTimeZone::listIdentifiers(DateTimeZone::UTC)[0]);

	function icsExtractor($file){
		//Tableau qui contient toutes les lignes du fichier ics lu
		$calendar = file($file);

		//Préparation des recherches dans le fichier ics
		$matiereStamp = "SUMMARY:";
		$dateDebutStamp = "DTSTART:";
		$dateFinStamp = "DTEND:";
		$descStamp = "DESCRIPTION:";
		$salleStamp = "LOCATION:";

		// Nombre d'objets cours
		$n = 0;

		//Tableaux pour stocker les lignes de chaque cours
		$matiereTab = array();
		$dateTab = array();
		$dateTabEnd = array();
		$descTab = array();
		$salleTab = array();

		// Parcours le fichier et range toutes les lignes dans des tableaux spécifiques
		foreach($calendar as $ligne){
			// Compte le nombre total d'objets dans le fichier
			// Chaque ligne contenant la chaine "SUMMARY:" est ajoutée au tableau matiereTab
			if(strpos($ligne, $matiereStamp) !== FALSE){
				array_push($matiereTab, $ligne);
				$n++;
			// Chaque ligne contenant la chaine "DTSTART:" est ajoutée au tableau dateTab
			} else if (strpos($ligne, $dateDebutStamp) !== FALSE) {
				array_push($dateTab, $ligne);
			// Chaque ligne contenant la chaine "DTEND:" est ajoutée au tableau dateTabEnd
			} else if (strpos($ligne, $dateFinStamp) !== FALSE) {
				array_push($dateTabEnd, $ligne);
			// Chaque ligne contenant la chaine "DESCRIPTION:" est ajoutée au tableau descTab
			} else if (strpos($ligne, $descStamp) !== FALSE) {
				array_push($descTab, $ligne);
			// Chaque ligne contenant la chaine "LOCATION:" est ajoutée au tableau salleTab
			} else if (strpos($ligne, $salleStamp) !== FALSE) {
				array_push($salleTab, $ligne);
			}
		}

		traiteMatieres($matiereTab);
		traiteSalles($salleTab);
		traiteCours($n, $matiereTab, $salleTab, $descTab, $dateTab, $dateTabEnd);
	}

	/*
	 * Prend en argument un tableau de matieres, traite le contenu en 
	 * ajoutant à la base de données les matières qui n'y sont pas déjà
	 */
	function traiteMatieres($tabMatieres){
		global $em;
		foreach($tabMatieres as $ligneMatiere){
			// Recherche de la matiere
			$matiere = substr($ligneMatiere, 8);
			$newMatiere = $em->getRepository('Matiere')->findOneBy(array('libelle' => $matiere));
	
			//On vérifie si la matière existe, sinon on la créée
			if($newMatiere === null){
				$newMatiere = new Matiere($matiere);
				$em->persist($newMatiere);
				$em->flush();
			}
		}
	}

	/*
	 * Prend en argument un tableau de salles, traite le contenu en 
	 * ajoutant à la base de données les salles qui n'y sont pas déjà
	 */
	function traiteSalles($tabSalles){
		global $em;
		foreach($tabSalles as $ligneSalle){
			// Recupère le nom de la salle et sa description, en le détachant de LOCATION
			$nomDescSalle = explode(":", $ligneSalle);
	
			// Recupération de l'ensemble des salles et suppression de 'LOCATION:'
			$nomDescSalle = explode("\,", $nomDescSalle[1]);
	
			// On enlève les espaces du nom de la salle
			for($i = 0; $i<count($nomDescSalle); $i++){
				$nomDescSalle[$i] = trim($nomDescSalle[$i]);
			}
	
			// On vérifie que le nom de la salle n'est pas vide, si c'est le cas, aucune salle n'a été saisie
			if(strlen($nomDescSalle[0]) > 0){
				// On traite la liste des salles du cours
				foreach($nomDescSalle as $salle){
					// Sépare le numéro de salle et sa description
					$salle = explode(" ",$salle);
	
					//Recupère le num de la salle
					$numSalle = $salle[0];
	
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
					$newSalle = $em->getRepository('Salle')->find($numSalle);
	
					//On vérifie si la salle existe, sinon on la créée
					if($newSalle === null){
						$newSalle = new Salle($numSalle, $descSalle);
						$em->persist($newSalle);
						$em->flush();
					}
				}
			}
		}
	}

    /*
	 * Recupère un fichier .ics, le parcours et en tire plusieurs tableaux
	 * contenant les matieres, les cours, les salles, les dates de début et fin des cours
	 * Appele les fonctions nécessaires pour remplir la base de données grâce
	 * à ces tableaux.
	 * @param $n le nombre de cours à traiter
     */
	function traiteCours($n, $matiereTab, $salleTab, $descTab, $dateTab, $dateTabEnd) {
		global $em;

		// Informations sur le progrès de l'opération affichées au dessus du tableau de résultats
		echo("Cours traités : ");
		echo("<span id='traitement'>0</span>");
		echo(" / ");
		echo("<span id='totalATraiter'>0</span>");
		echo(" --- ");
		echo("<progress id='progres' max='100' value='70'></progress><br>");

		// Affichage des résultats en tableau
		echo("<table border='1px solid black'><tr><td>Matiere</td><td>Date cours</td><td>Professeur</td><td>Salles (S) et Groupes (G)</td>");

		// Définit le nombre total de cours à traiter avant le début du traitement
		?>
			<script type='text/javascript'>
				var n = "<?php echo $n ?>";
				document.getElementById("totalATraiter").innerHTML = n;
				document.getElementById("progres").setAttribute("max", n);
			</script>
		<?php

		// Affichage du temps au début du traitement
		$t = microtime(true);
		$micro = sprintf("%06d",($t - floor($t)) * 1000000);
		$d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
		print("Debut : ".$d->format("H:i:s.u")."<br>");

		// Parcours de tout les tableaux en fonction du nombre de cours trouvés
		for ($j=0 ; $j < $n ; ++$j) {

			// Affiche le progrès du traitement lors de chaque boucle
			?>
				<script type='text/javascript'>
					var j = "<?php echo $j ?>";
					document.getElementById("traitement").innerHTML = (parseInt(j) + 1);
					document.getElementById("progres").setAttribute("value", j);
				</script>
			<?php

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

			// Création d'objets de dates
			$dateD = $anneeD."-".$moisD."-".$jourD;
			$dateTimeD = new DateTime($dateD);
			$dateTimeD->setTime($heureD, $minD);

			$dateF = $anneeF."-".$moisF."-".$jourF;
			$dateTimeF = new DateTime($dateF);
			$dateTimeF->setTime($heureF, $minF);

			//******************************//
			// Gestion des données du cours //
			//******************************//
			$descCours = explode("\\n",substr($descTab[$j], 12));

			// Retire le premier element du tableau, qui est une chaine vide
			array_splice($descCours, 0, 1);
			// retire le dernier element du tableau qui est la date de l'export
			array_splice($descCours, sizeof($descCours)-1, 1);

			//Intialisation des chaines de caractère pour catégoriser les cours
			$profs = array();
			$groupes = array();
			// Si il manque des infos alors on rajoutera les informations qui en découlent
			for ($i = 0; $i < sizeof($descCours); $i++) {
				// Si il y a un espace c'est un prof, il y a toujours un espace entre le nom et le prénom
				// mais jamais dans le nom d'un groupe
				if(strpos($descCours[$i], " ") !== FALSE) {
					array_push($profs, $descCours[$i]);
				} else {
					array_push($groupes, $descCours[$i]);
				}
			}

			// Recherche de la matière dans la base de données
			$matiere = substr($matiereTab[$j], 8);
			$newMatiere = $em->getRepository('Matiere')->findOneBy(array('libelle' => $matiere));

			// créer le nouvel objet de cours
			$newCours = new Cours($newMatiere, $dateTimeD, $dateTimeF);
			$em->persist($newCours);
			
			// On affiche dans le tableau les infos sur le nouveau cours
			echo("</tr><tr><td>".$newCours->getMatiere()->getLibelle()."</td><td>".$newCours->getDateDebut()->format("Y-m-d H:i")."</td>");

			///////////////////////////////
			// GESTION DE LA TABLE ANIME //
			///////////////////////////////

			// Si le prof n'est pas indiqué -->
			if(sizeof($profs) == 0) {
				$afficheProf = "Non déterminé";
			} else {
				// Sinon on cherche le prof dans la base de données
				// Forme de profs : array (size=1)
				//                      0 => string 'BARRIOS FREDERIC' (length=16)
				foreach($profs as $prof){
					$infosProf = explode(" ", $prof);
					$nomProf = $infosProf[0];
					$prenomProf = $infosProf[1];

					$personnel = findPersonnelByNomPrenom($nomProf, $prenomProf);
					// Si le personnel n'a pas été trouvé dans la BD
					if($personnel === NULL){
						$afficheProf = "Non déterminé";
						echo("<td>$afficheProf</td>");
					} else {
						$afficheProf = $prenomProf." ".$nomProf;

						$newAnime = new Anime();
						$newAnime->setProf($personnel);
						$newAnime->setCours($newCours);
						$em->persist($newAnime);
	
						echo("<td>".$newAnime->getProf()->getNom()."</td>");
					}
				}
			}

			//******************************************//
			// Gestion des salles et de la table Occupe //
			//******************************************//

			// Recupère le nom de la salle et sa description, en le détachant de LOCATION
			$nomDescSalle = explode(":", $salleTab[$j]);

			// Recupération de l'ensemble des salles et suppression de 'LOCATION:'
			$nomDescSalle = explode("\,", $nomDescSalle[1]);

			// On enlève les espaces du nom de la salle
			for($i = 0; $i<count($nomDescSalle); $i++){
				$nomDescSalle[$i] = trim($nomDescSalle[$i]);
			}

			// On vérifie que le nom de la salle n'est pas vide, si c'est le cas, aucune salle n'a été saisie
			if(strlen($nomDescSalle[0]) > 0){
				// On traite la liste des salles du cours
				foreach($nomDescSalle as $salle){
					// Sépare le numéro de salle et sa description
					$salle = explode(" ",$salle);
	
					//Recupère le num de la salle
					$numSalle = $salle[0];
	
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
					$newSalle = $em->getRepository('Salle')->find($numSalle);
	
					// On créé un lien entre la salle et le cours dans la BD
					$newOccupe = new Occupe();
					$newOccupe->setSalle($newSalle);
					$newOccupe->setCours($newCours);
					// On ajoute l'objet occupe en BD
					$em->persist($newOccupe);
	
					echo("<td>(S): ".$newOccupe->getSalle()->getNum()." ".$newOccupe->getSalle()->getDescription()."</td>");
				}
			}

			//**********************************************//
			// Gestion des groupes et de la table Participe //
			//**********************************************//

			// Traite chaque groupe un après l'autre

			foreach($groupes as $nomGroupe){
				// Recherche d'un groupe par nom
				$newGroupe = $em->getRepository('Groupe')->findOneBy(array('libelle' => $nomGroupe));
	
				// On créé un lien entre le groupe et le cours dans la BD
				$newParticipe = new Participe();
				$newParticipe->setGroupe($newGroupe);
				$newParticipe->setCours($newCours);
				// // On ajoute l'objet Participe en BD
				$em->persist($newParticipe);
			
				echo("<td>(G): ".$newParticipe->getGroupe()->getLibelle()."</td>");
			}
		}

		$em->flush();

		// Affichage du temps à la fin du traitement
		$t = microtime(true);
		$micro = sprintf("%06d",($t - floor($t)) * 1000000);
		$d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
		print("Fin : ".$d->format("H:i:s.u")."<br>");

		echo("</tr></table>");
	}
?>
