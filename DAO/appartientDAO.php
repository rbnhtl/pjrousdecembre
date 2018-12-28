<?php
    /**
     * @author robin.hortala
     *
     */

    include "../src/Appartient.php";

    // On récupère l'entity manager de l'orm doctrine
    require_once "../bootstrap.php";

    /*
    * @return un tableau contenant l'etudiant et le groupe de l'objet appartient
    */
    function createAppartient($groupe, $etudiant){
        global $em;

        $appartient = new Appartient($groupe, $etudiant);

        $em->persist($appartient);
        $em->flush();
        return array($appartient->getGroupe(), $appartient->getEtud());
    }

    /*
    * @param etudiant etudiant appartenant au groupe
    * @param groupe groupe auquel appartient l'étudiant
    */
    function findAppartient($groupe, $etudiant){
        global $em;

        $appartient = $em->getRepository("Appartient")->find(array("groupe" => $groupe, "etudiant" => $etudiant));

        return $appartient;
    }

    /*
    * @return la liste de toutes les Appartient de la base de données
    */
    function findAllAppartient(){
        global $em;

        $allAppartient = $em->getRepository("Appartient")->findAll();

        return $allAppartient;
    }

    /*
    * @param etudiant etudiant appartenant au groupe à supprimer
    * @param groupe groupe auquel appartient l'étudiant à supprimer
    */
    function removeAppartient($groupe, $etudiant){
        global $em;

        $appartient = $em->getReference("Appartient", array("groupe" => $groupe->getId(), "etudiant" => $etudiant->getIne()));

        $em->remove($appartient);
        $em->flush();
    }
?>