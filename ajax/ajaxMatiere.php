<?php
    //Inclusion des DAO nécessaires
    include "../DAO/FiliereDAO.php";
    include "../DAO/MatiereDAO.php";

    // Récupération des données envoyées
    $fil = $_POST['fil'];   // L'id de la filière séléctionnée

    if ($fil != 'defaut') { // Selon la valeur on va chercher toute les matières
        $matieres = findMatieresOfFiliereId($fil);
    } else { // Ou seulement celle qui correspondent à la filière
        $matieres = findAllMatiere();
    }

    $matArray = array(); // Création du tableau résultat

    foreach ($matieres as $value) {
        $id = $value[1];                       // L'id de la matière
        $lib = findMatiere($id)->getLibelle(); // Le libelle de la matière
        $matArray[] = array("id" => $id, "libelle" => $lib); // Ajout au tableau
    }

    // Encodage en JSON et renvoi des informations
    echo json_encode($matArray);

?>
