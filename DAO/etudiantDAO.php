<?php
    /**
     * @author robin.hortala
     *
     */

    include "../src/Etudiant.php";

    // On récupère l'entity manager de l'orm doctrine
    require_once "../bootstrap.php";

    /*
    * @param ine l'INE de l'étudiant à créer
    * @param nom le nom de l'étudiant à créer
    * @param prenom le prénom de l'étudiant à créer
    * @return l'id du nouvel etudiant
    */
    function createEtudiant($ine, $nom, $prenom){
        global $em;

        $etudiant = new Etudiant($ine, $nom, $prenom);

        $em->persist($etudiant);
        $em->flush();
        return $etudiant->getIne();
    }

    /*
    * @param ine l'ine de l'étudiant à chercher
    * @return un objet etudiant correspondant à l'ine ou null si l'objet avec cet ine n'existe pas
    */
    function findEtudiant($ine){
        global $em;

        $etudiant = $em->getRepository("Etudiant")->find($ine);

        return $etudiant;
    }

    /*
    * @return la liste de tous les etudiant de la base de données
    */
    function findAllEtudiant(){
        global $em;

        $allEtudiant = $em->getRepository("Etudiant")->findAll();

        return $allEtudiant;
    }

    /*
    * @param l'ine du etudiant à supprimer
    */
    function removeEtudiant($ine){
        global $em;

        $etudiant = $em->getReference("Etudiant", $ine);

        $em->remove($etudiant);
        $em->flush();
    }

    /*
     * @param $groupe duquel on veut récupérer la liste des etudiants
     * @return la liste des étudiants du groupe passé en paramètre
     */
    function getEtudiantsFromGroupe($groupe){
        global $em;

        $qb = $em->createQueryBuilder();
        $qb->select("IDENTITY(ap.etudiant)");
        $qb->from("Appartient", "ap");
        $qb->join("Groupe", "grp", 'WITH', "ap.groupe = grp.id");
        $qb->join("Etudiant", "etu", 'WITH', "ap.etudiant = etu.ine");
        $qb->where("grp.id = ?1");
        $qb->orderBy('etu.nom', 'ASC');
        $qb->setParameter(1, $groupe);

        return $qb->getQuery()->getResult();
    }

    /*
     * @param filiere de laquelle on veut récupérer la liste des étudiants
     * @return la liste des étudiants de la filière passée en paramètre
     */
    function getEtudiantsFromFiliere($filiere){
        global $em;

        $qb = $em->createQueryBuilder();
        $qb->select("IDENTITY(ap.etudiant)");
        $qb->from("Appartient", "ap");
        $qb->join("Etudiant", "etu", 'WITH', "ap.etudiant = etu.ine");
        $qb->join("Groupe", "grp", 'WITH', "ap.groupe = grp.id");
        $qb->join("Filiere", "fil", 'WITH', "grp.filiere = fil.id");
        $qb->where("fil.id = ?1");
        $qb->orderBy('etu.nom', 'ASC');
        $qb->setParameter(1, $filiere);

        return $qb->getQuery()->getResult();
    }

    /*
     * @param département duquel on veut récupérer la liste des étudiants
     * @return la liste des étudiants du département passé en paramètre
     */
    function getEtudiantsFromDepartement($departement){
        global $em;

        $qb = $em->createQueryBuilder();
        $qb->select("IDENTITY(ap.etudiant)");
        $qb->from("Appartient", "ap");
        $qb->join("Etudiant", "etu", 'WITH', "ap.etudiant = etu.ine");
        $qb->join("Groupe", "grp", 'WITH', "ap.groupe = grp.id");
        $qb->join("Filiere", "fil", 'WITH', "grp.filiere = fil.id");
        $qb->join("Departement", "dep", 'WITH', "fil.departement = dep.id");
        $qb->where("dep.id = ?1");
        $qb->orderBy('etu.nom', 'ASC');
        $qb->setParameter(1, $departement);

        return $qb->getQuery()->getResult();
    }
    
?>
