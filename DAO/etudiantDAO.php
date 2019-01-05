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
     * @param $filiere de laquelle on veut récupérer la liste des groupes
     * @return la liste des groupes de la filière passée en paramètre
     */
    function getEtudiantsFromGroupe($groupe){
        global $em;

        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select("IDENTITY(ap.etudiant)");
        $qb->from("Appartient", "ap");
        $qb->join("Groupe", "grp", \Doctrine\ORM\Query\Expr\Join::WITH, "ap.groupe = grp.id");
        $qb->where("grp.id = ?1");
        $qb->setParameter(1, $groupe);

        return $qb->getQuery()->getResult();
    }
?>