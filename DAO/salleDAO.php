<?php
    /**
     * @author robin.hortala
     *
     */

    include "../src/Salle.php";

    // On récupère l'entity manager de l'orm doctrine
    require_once "../bootstrap.php";

    /*
     * @param num numero de la nouvelle salle
     * @param description description de la nouvelle salle
     * @return le numero de la nouvelle salle
     */
    function createSalle($num, $description){
        global $em;

        $salle = new Salle($num, $description);

        $em->persist($salle);
        $em->flush();
        return $salle->getNum();
    }

    /*
     * @param num le numéro de la salle à rechercher
     * @return un objet salle correspondant au numéro ou null si l'objet avec ce numéro n'existe pas
     */
    function findSalle($num){
        global $em;

        $salle = $em->getRepository("Salle")->find($num);

        return $salle;
    }

    /*
     * @return la liste de tous les salle de la base de données
     */
    function findAllSalle(){
        global $em;

        $allSalle = $em->getRepository("Salle")->findAll();

        return $allSalle;
    }

    /*
     * @param l'id du salle à supprimer
     */
    function removeSalle($num){
        global $em;

        $salle = $em->getReference("Salle", $num);

        $em->remove($salle);
        $em->flush();
    }
?>