<?php
    /**
	 * @author robin.hortala
	 *
	 */

    include '../src/Cours.php';

    // On récupère l'entity manager de l'orm doctrine
    require_once "../bootstrap.php";

    /*
     * @param matiere l'id de la matiere du cours à créer
     * @param dateDebut un objet DateTime correspondant à la date de début du cours
     * @param dateFin un objet DateTime correspondant à la date de fin du cours
     * @return l'id du nouveau cours
     */
    function createCours($matiere, $dateDebut, $dateFin){
        global $em;

        $cours = new Cours($matiere, $dateDebut, $dateFin);

        $em->persist($cours);
        $em->flush();
        return $cours->getId();
    }
    
    /*
     * @param id l'id du cours à rechercher
     * @return un objet cours correspondant à l'id ou null si le cours avec cet id n'existe pas
     */
    function findCours($id){
        global $em;

        $cours = $em->getRepository('Cours')->find($id);

        return $cours;
    }

    /*
     * @return la liste de tous les cours de la base de données
     */
    function findAllCours(){
        global $em;

        $allCours = $em->getRepository('Cours')->findAll();

        return $allCours;
    }
    /*
     * @param id l'id du cours à supprimer
     */
    function removeCours($id){
        global $em;

        $cours = $em->getReference('Cours', $id);

        $em->remove($cours);
        $em->flush();
    }

    function findCoursOfGroupeInPeriode($groupe, $dateDeb, $dateFin){
        global $em;

        $qb = $em->createQueryBuilder();
        $qb->select("IDENTITY(par.cours)");
        $qb->from("Participe", "par");
        $qb->join("Groupe", "grp", 'WITH', "par.groupe = grp.id");
        $qb->join("Cours", "cours", 'WITH', "par.cours = cours.id");
        $qb->where("grp.id = ?1 AND cours.dateDebut < ?2 AND cours.dateFin > ?3");
        $qb->setParameters(array(1 => $groupe, 2 => $dateDeb, 3 => $dateFin));

        return $qb->getQuery()->getResult();
    }
?>