<?php

/**
 * @author guilhem.mateo
 *
 */
class Departement
{
    private $id_departement;

    private $libelle;

    // Constructeur de la classe
    public function Departement($plibelle,$pid_departement)
    {
        $this->libelle = $plibelle;
        $this->id_departement = $pid_departement;
    }
    
    /* Getter et Setter */

    /**
     *
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }
    
    /**
     *
     * @param mixed $libelle
     */
    public function setLibelle($plibelle)
    {
        $this->libelle = $plibelle;
    }

    /**
     *
     * @return mixed
     */
    public function getIdDepartement()
    {
        return $this->id_departement;
    }
     
    /**
     *
     * @param mixed id_departement
     */
    public function setIdDepartement($pid_departement)
    {
        $this->id_departement = $pid_departement;
    }
}

?>