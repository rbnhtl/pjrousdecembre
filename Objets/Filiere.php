<?php

/**
 * @author guilhem.mateo
 *
 */
class Filiere
{

    private $id_filiere;

    private $id_dep; 

    private $libelle;
    
    // Constructeur de la classe
    public function Filiere($pid_filiere,$pid_dep,$plibelle)
    {
        $this->id_filiere = $pid_filiere;
        $this->id_dep = $pid_dep;
        $this->libelle = $plibelle;
    }
    
    /* Getter et Setter */

    /**
     *
     * @return mixed
     */
    public function getIdFiliere()
    {
        return $this->id_filiere;
    }

    /**
     *
     * @param mixed $id filiere
     */
    public function setIdFiliere($idFiliere)
    {
        $this->id_filiere = $idFiliere;
    }

    /**
     *
     * @return mixed
     */
    public function getIdDepartement()
    {
        return $this->id_dep;
    }
 
    /**
     *
     * @param mixed $id filiere
     */
    public function setIdDepartement($idDepartement)
    {
        $this->id_dep = $idDepartement;
    }

    /**
     *
     * @return mixed
     */
    public function getIdLibelle()
    {
        return $this->libelle;
    }
 
     /**
      *
      * @param mixed $id filiere
      */
    public function setIdLibelle($lib)
    {
        $this->libelle = $lib;
    }

}

?>