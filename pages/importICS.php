<?php

    /**
     * @author robin.hortala
     * Cette page sert seulement à afficher les résultats d'un import d'ics
     */
    require_once "../utils/ICSExtractor.php";
    
	if(isset($_POST["formImportICS"])){
		icsExtractor($_FILES["fichierICS"]["tmp_name"]);
	} else {
        echo("Pas d'ics sélectionné");
    }

?>