<?php
    //Inclusion des DAO nécessaires
    include "../DAO/GroupeDAO.php";
    include "../DAO/EtudiantDAO.php";

    // Récupération des données envoyées
    $grp = $_POST['grp'];   // L'id du groupe séléctionné

    if ($grp != 'defaut') { // Selon la valeur on va chercher toute les filières
        $etudiants = getEtudiantsFromGroupe($grp);
    } else { // Ou seulement celle qui correspondent au département
        $etudiants = findAllEtudiant();
    }

    $etuArray = array(); // Création du tableau résultat

    foreach ($etudiants as $value) {
        $ine = $value[1];            // L'INE de l'étudiant
        $etu = findEtudiant($ine);   // Récupération de l'objet étudiant à partir de son INE
        $nom = $etu->getNom();       // Le nom de l'étudiant
        $prenom = $etu->getPrenom(); // Le prenom de l'étudiant
        $etuArray[] = array("ine" => $ine, "nom" => $nom, "prenom" => $prenom); // Ajout au tableau
    }

    // Encodage en JSON et renvoi des informations
    echo json_encode($etuArray);

?>