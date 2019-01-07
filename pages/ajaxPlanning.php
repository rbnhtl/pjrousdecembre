<?php
    //Inclusion des DAO nécessaires
    include "../DAO/departementDAO.php";
    include "../DAO/filiereDAO.php";
    include "../DAO/groupeDAO.php";
    include "../DAO/etudiantDAO.php";
    include "../DAO/coursDAO.php";
    include "../DAO/matiereDAO.php";
    include "../DAO/occupeDAO.php";

    // Récupération des données envoyées
    $dep = $_POST['dep'];   // L'id du département séléctionné

    // Si c'est le département qui est envoyé
    if (isset($dep)) {
        if ($dep != 'defaut') { // Selon la valeur on va chercher toute les filières
            $filieres = getFilieresFromDepartement($dep);
        } else { // Ou seulement celle qui correspondent au département
            $filieres = findAllFiliere();
        }

        $filArray = array(); // Création du tableau résultat

        foreach ($filieres as $value) {
            $lib = $value->getLibelle(); // Le libelle de la filière
            $id = $value->getId();       // L'id de la filière
            $filArray[] = array("id" => $id, "libelle" => $lib); // Ajout au tableau
        }

        // Encodage de JSON et renvoi des information
        echo json_encode($filArray);
    }
?>
