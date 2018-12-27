<?php
    /**
	 * @author robin.hortala
	 *
	 */

    include '../src/Cours.php';

    // On récupère l'entity manager de l'orm doctrine
    require_once "../bootstrap.php";
    
    /*
     * @param id l'id du cours à rechercher
     * @return un objet cours correspondant à l'id ou null si le cours avec
     * cet id n'existe pas
     */
    function findCours($id){
        global $entityManager;

        $cours = $entityManager->getRepository('Cours')->find($id);

        return $cours;
    }

    /*
     * @return la liste de tous les cours de la base de données
     */
    function findAllCours(){
        global $entityManager;

        $allCours = $entityManager->getRepository('Cours')->findAll();

        return $allCours;
    }
?>