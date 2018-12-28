<?php
    /**
     * @author robin.hortala
     *
     */

    include "../src/Participe.php";

    // On récupère l'entity manager de l'orm doctrine
    require_once "../bootstrap.php";

    /*
    * @return un tableau contenant la groupe et le cours de l'objet participe
    */
    function createParticipe($groupe, $cours){
        global $em;

        $participe = new Participe($groupe, $cours);

        $em->persist($participe);
        $em->flush();
        return array($participe->getGroupe(), $participe->getCours());
    }

    /*
    * @param groupe groupe qui a cours
    * @param cours cours auquel participe le groupe
    */
    function findParticipe($groupe, $cours){
        global $em;

        $participe = $em->getRepository("Participe")->find(array("groupe" => $groupe, "cours" => $cours));

        return $participe;
    }

    /*
    * @return la liste de tous les objets participe de la base de données
    */
    function findAllParticipe(){
        global $em;

        $allParticipe = $em->getRepository("Participe")->findAll();

        return $allParticipe;
    }

    /*
    * @param groupe le groupe de participe à supprimer
    * @param cours le cours de participe à supprimer
    */
    function removeParticipe($groupe, $cours){
        global $em;

        $participe = $em->getReference("Participe", array("groupe" => $groupe->getId(), "cours" => $cours->getId()));

        $em->remove($participe);
        $em->flush();
    }
?>