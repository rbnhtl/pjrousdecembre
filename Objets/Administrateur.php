<?php

/**
 * @author guilhem.mateo
 *
 */
class Administrateur extends Personnel
{
    
    // Constructeur de la classe
    public function Administrateur($pIdAdministrateur)
    {
        $this->setIdPersonnel($pIdAdministrateur);
    }
    
    /* Getter et Setter */

    /**
     *
     * @return mixed
     */
    public function getIdAdministrateur()
    {
        return $this->getIdPersonnel();
    }
    
    /**
     *
     * @param mixed $id administrateur
     */
    public function setIdAdministrateur($pIdAdministrateur)
    {
        $this->setIdPersonnel($pIdAdministrateur);
    }

}

?>