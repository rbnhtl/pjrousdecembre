<?php
    session_start();

    /**
     * @author robin.hortala
     * Cette page sert seulement à afficher les résultats d'un import d'ics
     */
    require_once "../utils/ICSExtractor.php";

	// Redirection vers l'index s'il n'y a pas eu connexion ou si les droits ne sont pas corrects
	if ($_SESSION['role']!="administratif" && $_SESSION['role']!="administrateur") {
        header('Location: ../index.php');
        exit();
    }
    
	if(isset($_POST["formImportICS"])){
		icsExtractor($_FILES["fichierICS"]["tmp_name"]);
	} else {
        echo("Pas d'ics sélectionné");
    }

?>