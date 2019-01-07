<?php
    //Inclusion des DAO nécessaires
    include "../DAO/filiereDAO.php";
    include "../DAO/GroupeDAO.php";

    // Récupération des données envoyées
    $fil = $_POST['fil'];   // L'id du département séléctionné

    if ($fil != 'defaut') { // Selon la valeur on va chercher toute les filières
        $groupes = getGroupesFromFiliere($fil);
    } else { // Ou seulement celle qui correspondent au département
        $groupes = findAllGroupe();
    }

    $grpArray = array(); // Création du tableau résultat

    foreach ($groupes as $value) {
        $lib = $value->getLibelle(); // Le libelle de la filière
        $id = $value->getId();       // L'id de la filière
        $grpArray[] = array("id" => $id, "libelle" => $lib); // Ajout au tableau
    }

    // Encodage de JSON et renvoi des information
    echo json_encode($grpArray);

?>
