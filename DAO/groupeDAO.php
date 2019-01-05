<?php
    /**
     * @author robin.hortala
     *
     */

    include "../src/Groupe.php";

    // On récupère l'entity manager de l'orm doctrine
    require_once "../bootstrap.php";

    /*
    * @param filiere filiere à laquelle appartient le nouveau groupe
    * @param libelle libelle du nouveau gorupe
    * @return l'id du nouveau groupe
    */
    function createGroupe($filiere, $libelle){
        global $em;

        $groupe = new Groupe($filiere, $libelle);

        $em->persist($groupe);
        $em->flush();
        return $groupe->getId();
    }

    /*
    * @param id l'id du groupe à rechercher
    * @return un objet groupe correspondant à l'id ou null si l'objet avec cet id n'existe pas
    */
    function findGroupe($id){
        global $em;

        $groupe = $em->getRepository("Groupe")->find($id);

        return $groupe;
    }

    /*
    * @return la liste de tous les groupe de la base de données
    */
    function findAllGroupe(){
        global $em;

        $allGroupe = $em->getRepository("Groupe")->findAll();

        return $allGroupe;
    }

    /*
    * @param l'id du groupe à supprimer
    */
    function removeGroupe($id){
        global $em;

        $groupe = $em->getReference("Groupe", $id);

        $em->remove($groupe);
        $em->flush();
    }

    /*
     * @param $filiere de laquelle on veut récupérer la liste des groupes
     * @return la liste des groupes de la filière passée en paramètre
     */
    function getGroupesFromFiliere($filiere){
        global $em;

        $groupes = $em->getRepository("Groupe")->findBy(array("filiere" => $filiere));

        return $groupes;
    }
?>