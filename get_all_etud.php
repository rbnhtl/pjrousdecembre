<?php
	require_once "bootstrap.php";
	
	$etudiantRepository = $entityManager->getRepository('Etudiant');
	$etudiants = $etudiantRepository->findAll();
	
	foreach ($etudiants as $etudiant) {
		echo($etudiant->getIne()."<br/>");
	}
?>