<?php
    /**
     * @author robin.hortala
     *
     */

    include "../src/Departement.php";

    // On récupère l'entity manager de l'orm doctrine
    require_once "../bootstrap.php";

    /*
     * @param id l'id du nouveau departement
     * @param libelle le libelle du nouveau departement
     * @return l'id du nouveau departement
     */
    function createDepartement($id, $libelle){
        global $em;

        $departement = new Departement($id, $libelle);

        $em->persist($departement);
        $em->flush();
        return $departement->getId();
    }

    /*
     * @param id l'id du departement à chercher
     * @return un objet departement correspondant à l'id ou null si l'objet avec cet id n'existe pas
     */
    function findDepartement($id){
        global $em;

        $departement = $em->getRepository("Departement")->find($id);

        return $departement;
    }

    /*
     * @return la liste de tous les departement de la base de données
     */
    function findAllDepartement(){
        global $em;

        $allDepartement = $em->getRepository("Departement")->findAll();

        return $allDepartement;
    }

    /*
     * @param l'id du departement à supprimer
     */
    function removeDepartement($id){
        global $em;

        $departement = $em->getReference("Departement", $id);

        $em->remove($departement);
        $em->flush();
    }
?>