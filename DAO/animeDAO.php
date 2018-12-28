<?php
    /**
     * @author robin.hortala
     *
     */

    include "../src/Anime.php";

    // On récupère l'entity manager de l'orm doctrine
    require_once "../bootstrap.php";

    /*
    * @return un tableau contenant l'etudiant et le cours de l'objet absence
    */
    function createAnime($prof, $cours){
        global $em;

        $anime = new Anime($prof, $cours);

        $em->persist($anime);
        $em->flush();
        return array($anime->getProf(), $anime->getCours());
    }

    /*
    * @param prof le prof qui anime le cours
    * @param cours le cours animé par le prof
    */
    function findAnime($prof, $cours){
        global $em;

        $anime = $em->getRepository("Anime")->find(array("prof" => $prof, "cours" => $cours));

        return $anime;
    }

    /*
    * @return la liste de toutes les anime de la base de données
    */
    function findAllAnime(){
        global $em;

        $allAnime = $em->getRepository("Anime")->findAll();

        return $allAnime;
    }

    /*
    * @param prof le prof qui anime le cours
    * @param cours le cours de l'anime à supprimer
    */
    function removeAnime($prof, $cours){
        global $em;

        $anime = $em->getReference("Anime", array("prof" => $prof->getId(), "cours" => $cours->getId()));

        $em->remove($anime);
        $em->flush();
    }
?>