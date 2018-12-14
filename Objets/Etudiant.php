<?php

/**
 * @author guilhem.mateo
 *
 */
class Etudiant
{

    private $ine;

    private $id_groupe; 

    private $nom;

    private $prenom;
    
    // Constructeur de la classe
    public function Etudiant($pine,$pid_groupe,$pnom,$pprenom)
    {
        $this->ine = $pine;
        $this->id_groupe = $pid_groupe;
        $this->nom = $pnom;
        $this->prenom = $pprenom;
    }
    
    /* Getter et Setter */

    /**
     *
     * @return mixed
     */
    public function getINE()
    {
        return $this->ine;
    }

    /**
     *
     * @param mixed $ine
     */
    public function setINE($ine)
    {
        $this->ine = $ine;
    }

    /**
     *
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }
 
    /**
     *
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     *
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom
    }

    /**
     *
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     *
     * @return mixed
     */
    public function getIdGroupe()
    {
        return $this->id_groupe;
    }
 
    /**
     *
     * @param mixed $id filiere
     */
    public function setIdGroupe($id_groupe)
    {
        $this->id_groupe = $id_groupe;
    }
    
}

?>