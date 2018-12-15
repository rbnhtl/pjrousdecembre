<?php

/**
 * @author robin.hortala
 *
 */

 /**
  * @Entity @Table(name="anime")
  **/
class Anime
{
    /**
     * @Id
     * @ManyToOne(targetEntity="Personnel")
     * @JoinColumn(name="idProf", referencedColumnName="id")
     **/
    private $idProf;

    /**
     * @Id
     * @ManyToOne(targetEntity="Cours")
     * @JoinColumn(name="idCours", referencedColumnName="id")
     **/
    private $idCours;

    // Constructeur de la classe
    public function Role($idProf, $idCours)
    {
        $this->idProf = $idProf;
        $this->idCours = $idCours;
    }

    /* Getter et Setter ID_PROF */
    public function getIdProf(){ return $this->idProf; }

    public function setIdProf($idProf){ $this->idProf = $idProf; }

    /* Getter et Setter ID_COURS */
    public function getIdCours(){ return $this->idCours; }

    public function setIdCours($idCours){ $this->idCours = $idCours; }
}

?>
