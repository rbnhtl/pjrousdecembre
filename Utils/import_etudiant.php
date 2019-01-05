<?php

    // On récupère l'entity manager de l'orm doctrine
	require_once "../bootstrap.php";
	
	include "../src/Etudiant.php";
	include "../src/Appartient.php";
	include "../DAO/groupeDAO.php";

	$fichier = $_FILES["userfile"]["name"];
	if($fichier) {
		importEtudiant("userfile");
	}
	function importEtudiant($fichier) {
		global $em;

		$db = new PDO("mysql:host=localhost;dbname=gestioneleve;charset=utf8","root","root");
		$fp = file_get_contents($_FILES[$fichier]["tmp_name"]);

		$liste = explode(" ",$fp);
		foreach($liste as $etudiant) {
			$champs = explode("|",$etudiant);
			try {

				// Création d'un nouvel étudiant
				$newEtudiant = new Etudiant($champs[0], $champs[1], $champs[2]);
				$groupe = findGroupe($champs[3]);
				$em->persist($newEtudiant);
				$em->flush();

				// Création de la relation appartient liée à l'étudiant
				$newAppartient = new Appartient();
				$newAppartient->setGroupe($groupe);
				$newAppartient->setEtud($newEtudiant);
				$em->persist($newAppartient);
			} catch(PDOException $Exception) {
				echo $Exception->getMessage( );
				throw new MyDatabaseException( $Exception->getMessage( ), (int)$Exception->getCode( ) );
			}

		}
		$em->flush();

		echo("Etudiants ajoutés en BD<br>");
	}
?>
