<?php

/**
 * @author guilhem.mateo
 *
 */
class Personnel
{

    private $id_personnel;

    private $mdp;

    private $nom;

    private $prenom;
    
    // Constructeur de la classe
    public function Personnel($pIdPersonnel,$pMdp,$pNom,$pPrenom)
    {
        $this->id_personnel = $pIdPersonnel;
        $this->mdp = $pMdp;
        $this->nom = $pNom;
        $this->prenom = $pPrenom;
    }
    
    /* Getter et Setter */

    /**
     *
     * @return mixed
     */
    public function getIdPersonnel()
    {
        return $this->id_personnel;
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
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     *
     * @return mixed
     */
    public function getMdp()
    {
        return $this->mdp;
    }
    
    /**
     *
     * @param mixed $id personnel
     */
    public function setIdPersonnel($pIdPersonnel)
    {
        $this->id_personnel = $pIdPersonnel;
    }

    /**
     *
     * @param mixed $nom
     */
    public function setNom($pNom)
    {
        $this->nom = $pNom;
    }

    /**
     *
     * @param mixed $prenom
     */
    public function setPrenom($pPrenom)
    {
        $this->prenom = $pPrenom;
    }

    /**
     *
     * @param mixed $mdp
     */
    public function setMdp($pMdp)
    {
        $this->mdp = $pMdp;
    }

}

?>