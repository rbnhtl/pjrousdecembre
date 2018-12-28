<?php
    /**
     * @author robin.hortala
     *
     */

    include "../src/Occupe.php";

    // On récupère l'entity manager de l'orm doctrine
    require_once "../bootstrap.php";

    /*
    * @return un tableau contenant la salle et le cours de l'objet occupe
    */
    function createOccupe($salle, $cours){
        global $em;

        $occupe = new Occupe($salle, $cours);

        $em->persist($occupe);
        $em->flush();
        return array($occupe->getSalle(), $occupe->getCours());
    }

    /*
    * @param salle salle dans laquelle a lieu le cours
    * @param cours cours qui a eu lieu dans la salle
    */
    function findOccupe($salle, $cours){
        global $em;

        $occupe = $em->getRepository("Occupe")->find(array("salle" => $salle, "cours" => $cours));

        return $occupe;
    }

    /*
    * @return la liste de tous les occupe de la base de données
    */
    function findAllOccupe(){
        global $em;

        $allOccupe = $em->getRepository("Occupe")->findAll();

        return $allOccupe;
    }

    /*
    * @param salle la salle de l'occupe à supprimer
    * @param cours le cours de l'occupe à supprimer
    */
    function removeOccupe($salle, $cours){
        global $em;

        $occupe = $em->getReference("Occupe", array("salle" => $salle->getNum(), "cours" => $cours->getId()));

        $em->remove($occupe);
        $em->flush();
    }
?>