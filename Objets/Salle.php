<?php

/**
 * @author guilhem.mateo
 *
 */
class Salle
{

    private $num;
    
    // Constructeur de la classe
    public function Salle($pNum)
    {
        $this->num = $pNum;
    }
    
    /* Getter et Setter */

    /**
     *
     * @return mixed
     */
    public function getNumero()
    {
        return $this->num;
    }

    /**
     *
     * @param mixed $numero de salle
     */
    public function setNumero($pNum)
    {
        $this->num = $pNum;
    }

}

?>