<?php
    /**
     * @author robin.hortala
     *
     */

    include "../src/Matiere.php";

    // On récupère l'entity manager de l'orm doctrine
    require_once "../bootstrap.php";

    /*
    * @param libelle le libelle de la nouvelle matière
    * @return l'id de la nouvelle matiere
    */
    function createMatiere($libelle){
        global $em;

        $matiere = new Matiere($libelle);

        $em->persist($matiere);
        $em->flush();
        return $matiere->getId();
    }

    /*
    * @param id l'id de la matière à chercher
    * @return un objet matiere correspondant à l'id ou null si l'objet avec cet id n'existe pas
    */
    function findMatiere($id){
        global $em;

        $matiere = $em->getRepository("Matiere")->find($id);

        return $matiere;
    }

    /*
    * @return la liste de toutes les matiere de la base de données
    */
    function findAllMatiere(){
        global $em;

        $allMatiere = $em->getRepository("Matiere")->findAll();

        return $allMatiere;
    }

    /*
    * @param l'id de la matiere à supprimer
    */
    function removeMatiere($id){
        global $em;

        $matiere = $em->getReference("Matiere", $id);

        $em->remove($matiere);
        $em->flush();
    }

    /*
     * @param filiere id de la filière dont on veut obtenir les matières
     */
    function findMatieresOfFiliere($filiere){
        global $em;

        $qb = $em->createQueryBuilder();
        $qb->select("DISTINCT(mat.libelle)");
        $qb->from("Matiere", "mat");
        $qb->join("Cours", "crs", 'WITH', "crs.matiere = mat.id");
        $qb->join("Participe", "par", 'WITH', "par.cours = crs.id");
        $qb->join("Groupe", "grp", 'WITH', "par.groupe = grp.id");
        $qb->join("Filiere", "fil", 'WITH', "grp.filiere = fil.id");
        $qb->where("fil.id = ?1");

        $qb->setParameters(array(1 => $filiere));

        return $qb->getQuery()->getResult();
    }

    /*
     * @param filiere id de la filière dont on veut obtenir les matières
     */
    function findMatieresOfFiliereId($filiere){
        global $em;

        $qb = $em->createQueryBuilder();
        $qb->select("DISTINCT(mat.id)");
        $qb->from("Matiere", "mat");
        $qb->join("Cours", "crs", 'WITH', "crs.matiere = mat.id");
        $qb->join("Participe", "par", 'WITH', "par.cours = crs.id");
        $qb->join("Groupe", "grp", 'WITH', "par.groupe = grp.id");
        $qb->join("Filiere", "fil", 'WITH', "grp.filiere = fil.id");
        $qb->where("fil.id = ?1");

        $qb->setParameters(array(1 => $filiere));

        return $qb->getQuery()->getResult();
    }

    /*
     * @param departement id du departement dont on veut obtenir les matières
     */
    function findMatieresOfDepartement($departement){
        global $em;

        $qb = $em->createQueryBuilder();
        $qb->select("DISTINCT(mat.libelle)");
        $qb->from("Matiere", "mat");
        $qb->join("Cours", "crs", 'WITH', "crs.matiere = mat.id");
        $qb->join("Participe", "par", 'WITH', "par.cours = crs.id");
        $qb->join("Groupe", "grp", 'WITH', "par.groupe = grp.id");
        $qb->join("Filiere", "fil", 'WITH', "grp.filiere = fil.id");
        $qb->join("Departement", "dep", 'WITH', "fil.departement = dep.id");
        $qb->where("dep.id = ?1");

        $qb->setParameters(array(1 => $departement));

        return $qb->getQuery()->getResult();
    }
?>
