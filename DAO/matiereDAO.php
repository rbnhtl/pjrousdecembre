<?php
    /**
     * @author robin.hortala
     *
     */

    include "../src/Matiere.php";

    // On récupère l'entity manager de l'orm doctrine
    require_once "../bootstrap.php";

    /*
    * @param libelle le libelle de la nouvelle matière
    * @return l'id de la nouvelle matiere
    */
    function createMatiere($libelle){
        global $em;

        $matiere = new Matiere($libelle);

        $em->persist($matiere);
        $em->flush();
        return $matiere->getId();
    }

    /*
    * @param id l'id de la matière à chercher
    * @return un objet matiere correspondant à l'id ou null si l'objet avec cet id n'existe pas
    */
    function findMatiere($id){
        global $em;

        $matiere = $em->getRepository("Matiere")->find($id);

        return $matiere;
    }

    /*
    * @return la liste de toutes les matiere de la base de données
    */
    function findAllMatiere(){
        global $em;

        $allMatiere = $em->getRepository("Matiere")->findAll();

        return $allMatiere;
    }

    /*
    * @param l'id de la matiere à supprimer
    */
    function removeMatiere($id){
        global $em;

        $matiere = $em->getReference("Matiere", $id);

        $em->remove($matiere);
        $em->flush();
    }
?>