<?php
    /**
     * @author robin.hortala
     *
     */

    require_once(dirname(__FILE__)."/../src/Remplit.php");

    // On récupère l'entity manager de l'orm doctrine
    require_once(dirname(__FILE__)."/../bootstrap.php");

    /*
    * @return un tableau contenant le personnel et le role de l'objet remplit
    */
    function createRemplit($personnel, $role){
        global $em;

        $remplit = new Remplit($personnel, $role);

        $em->persist($remplit);
        $em->flush();
        return array($remplit->getPersonnel(), $remplit->getRole());
    }

    /*
    * @param personnel personnel qui remplit le role
    */
    function findRemplit($personnel){
        global $em;

        $remplit = $em->getRepository("Remplit")->findOneBy(array("personnel" => $personnel));

        return $remplit;
    }

    /*
    * @return la liste de tous les remplit de la base de données
    */
    function findAllRemplit(){
        global $em;

        $allRemplit = $em->getRepository("Remplit")->findAll();

        return $allRemplit;
    }

    /*
    * @param personnel le personnel de l'objet remplit à supprimer
    * @param role le role de l'objet remplit à supprimer
    */
    function removeRemplit($personnel, $role){
        global $em;

        $remplit = $em->getReference("Remplit", array("personnel" => $personnel->getId(), "role" => $role->getId()));

        $em->remove($remplit);
        $em->flush();
    }
?>