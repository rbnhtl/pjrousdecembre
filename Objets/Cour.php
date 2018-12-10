<?php

/**
 * @author bastien.ranc
 *
 */
class Cours
{

    private $titre;

    private $numeroSalle;

    private $descSalle;

    private $profs = array();

    private $promo;

    private $dateDebut;

    private $dateFin;
    
    // Constructeur de la classe
    public function Cours($pTitre, $pNumSalle, $pDescSalle, $pProf, $pPromo, $pDateDebut, $pDateFin)
    {
        $this->titre = $pTitre;
        $this->numeroSalle = $pNumSalle;
        $this->descSalle = $pDescSalle;
        $this->profs = $pProf;
        $this->promo = $pPromo;
        $this->dateDebut = $pDateDebut;
        $this->dateFin = $pDateFin;
    }
    
    /* Getter et Setter */

    /**
     *
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     *
     * @return mixed
     */
    public function getNumeroSalle()
    {
        return $this->numeroSalle;
    }

    /**
     *
     * @return mixed
     */
    public function getDescSalle()
    {
        return $this->descSalle;
    }

    /**
     *
     * @return mixed
     */
    public function getProfs()
    {
        return $this->profs;
    }

    /**
     *
     * @return mixed
     */
    public function getPromo()
    {
        return $this->promo;
    }

    /**
     *
     * @return mixed
     */
    public function getDateDebut()
    {
        return $this->dateDebut->format('Y-m-d H:i:s');
    }

    /**
     *
     * @return mixed
     */
    public function getDateFin()
    {
        return $this->dateFin->format('Y-m-d H:i:s');
    }

    /**
     *
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     *
     * @param mixed $numeroSalle
     */
    public function setNumeroSalle($numeroSalle)
    {
        $this->numeroSalle = $numeroSalle;
    }

    /**
     *
     * @param mixed $descSalle
     */
    public function setDescSalle($descSalle)
    {
        $this->descSalle = $descSalle;
    }

    /**
     *
     * @param mixed $prof
     */
    public function setProfs($profs)
    {
        $this->profs = $profs;
    }

    /**
     *
     * @param mixed $promo
     */
    public function setPromo($promo)
    {
        $this->promo = $promo;
    }

    /**
     *
     * @param mixed $dateDebut
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     *
     * @param mixed $dateFin
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }
}

?>