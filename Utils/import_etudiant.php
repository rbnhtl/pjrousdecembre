<?php

	$fichier = $_FILES["userfile"]["name"];
	if($fichier) {
		importEtudiant("userfile");
	}
	function importEtudiant($fichier) {
		$db = new PDO("mysql:host=localhost;dbname=gestioneleve;charset=utf8","root","root");
		$fp = file_get_contents($_FILES[$fichier]["tmp_name"]);
		//remplis la table etudiant avec les le fichier csv
		$reqEtudiant = $db->prepare("INSERT INTO etudiant (ine,nom,prenom,idGroupe) VALUES (:ine, :nom, :prenom, :groupe)");
		$liste = explode(" ",$fp);
		foreach($liste as $etudiant) {
			$champs = explode("|",$etudiant);
			// $reqEtudiant->bindParam(":ine",$champs[0]);
			// $reqEtudiant->bindParam(":nom",$champs[1]);
			// $reqEtudiant->bindParam(":prenom",$champs[2]);
			// $reqEtudiant->bindParam(":groupe",$champs[3]); 
			try {
				$reqEtudiant->execute(array(':ine' => $champs[0], ':nom' => $champs[1], ':prenom' => $champs[2], ':groupe' => intval($champs[3])));
				echo("Etudiant ajouté en BD<br>");
			} catch(PDOException $Exception) {
				echo $Exception->getMessage( );
				throw new MyDatabaseException( $Exception->getMessage( ), (int)$Exception->getCode( ) );
			}

		}
	}
?>
