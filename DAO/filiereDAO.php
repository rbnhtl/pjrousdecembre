<?php
    /**
     * @author robin.hortala
     *
     */

    include "../src/Filiere.php";

    // On récupère l'entity manager de l'orm doctrine
    require_once "../bootstrap.php";

    /*
    * @param departement departement de la nouvelle filiere
    * @param libelle libelle de la nouvelle filiere
    * @param administratif personnel administratif en charge de la gestion de la nouvelle filiere
    * @return l'id de la nouvelle filiere
    */
    function createFiliere($departement, $libelle, $administratif){
        global $em;

        $filiere = new Filiere($departement, $libelle, $administratif);

        $em->persist($filiere);
        $em->flush();
        return $filiere->getId();
    }

    /*
    * @param id l'id de la filiere à rechercher
    * @return un objet filiere correspondant à l'id ou null si l'objet avec cet id n'existe pas
    */
    function findFiliere($id){
        global $em;

        $filiere = $em->getRepository("Filiere")->find($id);

        return $filiere;
    }

    /*
    * @return la liste de tous les filiere de la base de données
    */
    function findAllFiliere(){
        global $em;

        $allFiliere = $em->getRepository("Filiere")->findAll();

        return $allFiliere;
    }

    /*
    * @param l'id du filiere à supprimer
    */
    function removeFiliere($id){
        global $em;

        $filiere = $em->getReference("Filiere", $id);

        $em->remove($filiere);
        $em->flush();
    }

    /*
     * @param $departement duquel on veut récupérer la liste des filières
     * @return la liste des filieres du département passé en paramètres
     */
    function getAllFiliereFromDepartement($departement){
        global $em;

        $filieres = $em->getRepository("Filiere")->findBy(array("departement" => $departement));

        return $filieres;
    }
?>