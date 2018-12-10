<?php

/**
 * @author guilhem.mateo
 *
 */
class Matiere
{

    private $id;

    private $libelle;
    
    // Constructeur de la classe
    public function Matiere($pId, $pLibelle)
    {
        $this->id = $pId;
        $this->libelle = $pLibelle;
    }
    
    /* Getter et Setter */

    /**
     *
     * @return mixed
     */
    public function getID()
    {
        return $this->id;
    }

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
     * @param mixed $id
     */
    public function setID($pId)
    {
        $this->id = $pId;
    }

    /**
     *
     * @param mixed $libelle
     */
    public function setLibelle($pLibelle)
    {
        $this->descSalle = $pLibelle;
    }

}

?>