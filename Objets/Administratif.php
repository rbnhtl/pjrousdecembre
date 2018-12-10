<?php

/**
 * @author guilhem.mateo
 *
 */
class Administratif extends Personnel
{
    
    // Constructeur de la classe
    public function Administratif($pIdAdministratif)
    {
        $this->setIdPersonnel($pIdAdministratif);
    }
    
    /* Getter et Setter */

    /**
     *
     * @return mixed
     */
    public function getIdAdministratif()
    {
        return $this->getIdPersonnel();
    }
    
    /**
     *
     * @param mixed $id administrateur
     */
    public function setIdAdministratif($pIdAdministratif)
    {
        $this->setIdPersonnel($pIdAdministratif);
    }

}

?>