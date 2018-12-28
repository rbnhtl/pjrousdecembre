<?php
    /**
     * @author robin.hortala
     *
     */

    include "../src/Role.php";

    // On récupère l'entity manager de l'orm doctrine
    require_once "../bootstrap.php";

    /*
    * @param libelle le libelle du nouveau role
    * @return l'id du nouveau role
    */
    function createRole($libelle){
        global $em;

        $role = new Role($libelle);

        $em->persist($role);
        $em->flush();
        return $role->getId();
    }

    /*
    * @param id l'id du role à rechercher
    * @return un objet role correspondant à l'id ou null si l'objet avec cet id n'existe pas
    */
    function findRole($id){
        global $em;

        $role = $em->getRepository("Role")->find($id);

        return $role;
    }

    /*
    * @return la liste de tous les role de la base de données
    */
    function findAllRole(){
        global $em;

        $allRole = $em->getRepository("Role")->findAll();

        return $allRole;
    }

    /*
    * @param l'id du role à supprimer
    */
    function removeRole($id){
        global $em;

        $role = $em->getReference("Role", $id);

        $em->remove($role);
        $em->flush();
    }
?>