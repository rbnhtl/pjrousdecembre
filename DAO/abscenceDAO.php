<?php
    /**
     * @author robin.hortala
     *
     */

    include "../src/Abscence.php";

    // On récupère l'entity manager de l'orm doctrine
    require_once "../bootstrap.php";

    /*
    * @return un tableau contenant l'etudiant et le cours de l'objet absence
    */
    function createAbscence($etudiant, $cours){
        global $em;

        $abscence = new Abscence($etudiant, $cours);

        $em->persist($abscence);
        $em->flush();
        return array($abscence->getEtud(), $abscence->getCours());
    }

    /*
    * @param etudiant etudiant absent
    * @param cours cours auquel l'etudiant a été absent
    */
    function findAbscence($etudiant, $cours){
        global $em;

        $abscence = $em->getRepository("Abscence")->find(array("etudiant" => $etudiant, "cours" => $cours));

        return $abscence;
    }

    /*
    * @return la liste de toutes les abscence de la base de données
    */
    function findAllAbscence(){
        global $em;

        $allAbscence = $em->getRepository("Abscence")->findAll();

        return $allAbscence;
    }

    /*
    * @param etudiant l'etudiant de l'absence à supprimer
    * @param cours le cours de l'absence à supprimer
    */
    function removeAbscence($etudiant, $cours){
        global $em;

        $abscence = $em->getReference("Abscence", array("etudiant" => $etudiant->getIne(), "cours" => $cours->getId()));

        $em->remove($abscence);
        $em->flush();
    }
?>