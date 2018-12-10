<?php

/**
 * @author guilhem.mateo
 *
 */
class Departement
{
    private $id_groupe;

    private $id_filiere;

    private $libelle;

    // Constructeur de la classe
    public function Departement($plibelle,$pid_groupe,$pid_filiere)
    {
        $this->libelle = $plibelle;
        $this->id_groupe = $pid_groupe;
        $this->id_filiere = $pid_filiere;
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
    public function getIdGroupe()
    {
        return $this->id_groupe;
    }
     
    /**
     *
     * @param mixed id_departement
     */
    public function setIdGroupe($pid_groupe)
    {
        $this->id_groupe = $pid_groupe;
    }

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
    
}

?>