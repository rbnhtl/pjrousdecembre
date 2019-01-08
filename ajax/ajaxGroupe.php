<?php
    //Inclusion des DAO nécessaires
    include "../DAO/filiereDAO.php";
    include "../DAO/GroupeDAO.php";

    // Récupération des données envoyées
    $fil = $_POST['fil'];   // L'id de la filière sélectionnée

    if ($fil != 'defaut') { // Selon la valeur on va chercher tout les groupes
        $groupes = getGroupesFromFiliere($fil);
    } else { // Ou seulement ceux qui correspondent à la filière
        $groupes = findAllGroupe();
    }

    $grpArray = array(); // Création du tableau résultat

    foreach ($groupes as $value) {
        $lib = $value->getLibelle(); // Le libelle du groupe
        $id = $value->getId();       // L'id du groupe
        $grpArray[] = array("id" => $id, "libelle" => $lib); // Ajout au tableau
    }

    // Encodage en JSON et renvoi des informations
    echo json_encode($grpArray);

?>
