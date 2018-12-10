<?php

/**
 * @author guilhem.mateo
 *
 */
class Abscence
{

    private $id_abscence;

    private $ine;

    private $id_cours;
    
    // Constructeur de la classe
    public function Abscence($pid_abscence,$pine,$pid_cours)
    {
        $this->ine = $pine;
        $this->id_abscence = $pid_abscence;
        $this->id_cours = $pid_cours;
    }
    
    /* Getter et Setter */

    /**
     *
     * @return mixed
     */
    public function getIdAbscence()
    {
        return $this->id_abscence;
    }

    /**
     *
     * @param mixed $id_abscence
     */
    public function setIdAbscence($id_abscence)
    {
        $this->id_abscence = $id_abscence;
    }  
    
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
    public function getIdCours()
    {
        return $this->id_cours;
    }
    
    /**
     *
     * @param mixed $ine
     */
    public function setINE($id_cours)
    {
        $this->id_cours = $id_cours;
    } 
}

?>