<?php
    /**
     * @author robin.hortala
     *
     */

    include "../src/Personnel.php";

    // On récupère l'entity manager de l'orm doctrine
    require_once "../bootstrap.php";

    /*
    * @param login login du nouveau personnel
    * @param mdp mot de passe du nouveau personnel
    * @param nom nom du nouveau personnel
    * @param prenom prenom du nouveau personnel
    * @return l'id du nouveau personnel
    */
    function createPersonnel($login, $mdp, $nom, $prenom){
        global $em;

        $personnel = new Personnel($login, $mdp, $nom, $prenom);

        $em->persist($personnel);
        $em->flush();
        return $personnel->getId();
    }

    /*
    * @param id du personnel à rechercher
    * @return un objet personnel correspondant à l'id ou null si l'objet avec cet id n'existe pas
    */
    function findPersonnel($id){
        global $em;

        $personnel = $em->getRepository("Personnel")->find($id);

        return $personnel;
    }

    /*
    * @return la liste de tous les personnel de la base de données
    */
    function findAllPersonnel(){
        global $em;

        $allPersonnel = $em->getRepository("Personnel")->findAll();

        return $allPersonnel;
    }

    /*
    * @param l'id du personnel à supprimer
    */
    function removePersonnel($id){
        global $em;

        $personnel = $em->getReference("Personnel", $id);

        $em->remove($personnel);
        $em->flush();
    }
?>