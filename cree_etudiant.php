<?php
	require_once "bootstrap.php";
	
	$ine = "ENH6526TU454D";
	$nom = "Toto";
	$prenom = "Tutu";
	$groupe = 1;
	
	$etud = new Etudiant($ine, $groupe, $nom, $prenom);
	
	$entityManager->persist($etud);
	$entityManager->flush();
	
	echo "Etudiant créé avec l'INE: ".$ine;

?>