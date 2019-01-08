<?php
    //Inclusion des DAO nécessaires
    include "../DAO/GroupeDAO.php";
    include "../DAO/EtudiantDAO.php";

    // Récupération des données envoyées
    $grp = $_POST['grp'];   // L'id du groupe séléctionné

    if ($grp != 'defaut') { // Selon la valeur on va chercher tout les étudiants
        $etudiants = getEtudiantsFromGroupe($grp);
    } else { // Ou seulement ceux qui correspondent au groupe
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
