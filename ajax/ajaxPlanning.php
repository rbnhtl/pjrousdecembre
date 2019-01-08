<?php
    //Inclusion des DAO nécessaires
    include "../DAO/departementDAO.php";
    include "../DAO/filiereDAO.php";
    include "../DAO/groupeDAO.php";
    include "../DAO/etudiantDAO.php";
    include "../DAO/coursDAO.php";
    include "../DAO/matiereDAO.php";
    include "../DAO/occupeDAO.php";

    // Retourne pour une année et un numéro de semaine donné, les date de début et de fin de celle-ci
    function getWeekDates($year, $week) {
        $ret['dateDeb'] = (new DateTime())->setISODate($year, $week);    // Date de début
        $ret['dateFin'] = (new DateTime())->setISODate($year, $week, 7); // et de fin de semaine
        return $ret;
    }

    // Retourne une heure sous forme de réel
    function timeDouble($value) {
        $heure = explode(':', $value);
        return $heure[0] + ($heure[1] / 60);
    }

    // Récupération des données envoyées
    $week = $_POST['week']; // Le numero de la semaine sélectionnée
    $grp = $_POST['grp'];   // L'id du groupe séléctionné

    /* Récupération des données nécessaires pour l'affichage de l'emploi du temps */

    $dateCourante = new DateTime(); // La date courante

    // Calcul des dates de début et de fin de semaine
    if ((int)$week >= 36) {
        $year = ($dateCourante->format('Y')) - 1;
    } else {
        $year = $dateCourante->format('Y');
    }
    $dates = getWeekDates($year, (int)$week);

    // Récupération de la liste des objets cours pour le groupes et les dates sélectionnées
    $res = findCoursOfGroupeInPeriode($grp, $dates['dateDeb'], $dates['dateFin']);

    $donnees = array(); // Création du tableau résultat

    foreach ($res as $cours) {
        $cr = findCours($cours[1]);   // Récupération de l'objet cours
        $debut = $cr->getDateDebut(); // Objet date de début
        $fin = $cr->getDateFin();     // Objet date de fin
        $salle = findSallesOfCours($cr->getId()); // Objet sal(l)e
        $donnees[] = array('debut' => timeDouble($debut->format("H:i")), // Horaire de début sous forme de réel
                           'fin' => timeDouble($fin->format("H:i")),     // Horaire de fin sous forme de réel
                           'jour' => $debut->format("w"),                // Valeur numérique du jour de la semaine de 0 à 6
                           'id' => $cr->getId(),                         // L'id du cours pour gérer les abscences
                           'matiere' => $cr->getMatiere()->getLibelle(), // Le nom de la matière qui y est enseignée
                           'salle' => $salle[0][1]);                     // Libelle de la salle où il prend place
    }

    // Encodage en JSON et renvoi des informations
    echo json_encode($donnees);
?>
