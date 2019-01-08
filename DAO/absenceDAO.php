<?php
    /**
     * @author robin.hortala
     *
     */

    include "../src/Absence.php";

    // On récupère l'entity manager de l'orm doctrine
    require_once "../bootstrap.php";

    /*
    * @return un tableau contenant l'etudiant et le cours de l'objet absence
    */
    function createAbscence($etudiant, $cours){
        global $em;

        $absence = new Absence();
        $absence->setEtud($etudiant);
        $absence->setCours($cours);

        $em->persist($absence);
        $em->flush();
        return array($absence->getEtud(), $absence->getCours());
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

    /*
    * @params les differents parametres saisis lors d'une recherche d'absences
    */
    function findAbscenceWithParams($departement, $filiere, $groupe, $matiere, $datemin, $datemax, $etudiant){
        global $em;

        $parametres = [];

        $qb = $em->createQueryBuilder();
        $qb->select(array("IDENTITY(abs.etudiant)", "IDENTITY(abs.cours)"));
        $qb->from("Absence", "abs");
        $qb->join("Cours", "crs", 'WITH', "abs.cours = crs.id");
        $qb->join("Matiere", "mat", 'WITH', "crs.matiere = mat.id");
        $qb->join("Participe", "par", 'WITH', "par.cours = crs.id");
        $qb->join("Groupe", "grp", 'WITH', "par.groupe = grp.id");
        $qb->join("Filiere", "fil", 'WITH', "grp.filiere = fil.id");
        $qb->join("Departement", "dep", 'WITH', "fil.departement = dep.id");
        $qb->join("Appartient", "app", 'WITH', "app.groupe = grp.id");
        $qb->join("Etudiant", "etu", 'WITH', "app.etudiant = etu.ine");
        if($departement != "defaut"){
            $qb->andWhere("dep.id = ?1");
            $parametres[1] = $departement;
        }
        if($filiere != "defaut"){
            $qb->andWhere("fil.id = ?2");
            $parametres[2] = $filiere;
        }
        if($groupe != "defaut"){
            $qb->andWhere("grp.id = ?3");
            $parametres[3] = $groupe;
        }
        if($matiere != "defaut"){
            $qb->andWhere("mat.id = ?4");
            $parametres[4] = $matiere;
        }
        if($datemin != "" && $datemax != ""){
            $qb->andWhere("crs.dateDebut BETWEEN ?5 AND ?6");
            $parametres[5] = $datemin;
            $parametres[6] = $datemax;
        } elseif($datemin != "") {
            $qb->andWhere("crs.dateDebut > ?7");
            $parametres[7] = $datemin;
        } elseif($datemax != "") {
            $qb->andWhere("crs.dateDebut < ?8");
            $parametres[8] = $datemax;
        }
        if($etudiant != ""){
            $qb->andWhere("etu.nom = ?9");
            $parametres[9] = $etudiant;
        }

        $qb->setParameters($parametres);

        return $qb->getQuery()->getResult();
    }
?>
