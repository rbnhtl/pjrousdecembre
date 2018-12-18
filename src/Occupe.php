<?php

/**
 * @author robin.hortala
 *
 */

 /**
  * @Entity @Table(name="occupe")
  **/
class Occupe
{
    /**
     * @Id
     * @ManyToOne(targetEntity="Salle")
     * @JoinColumn(name="numSalle", referencedColumnName="num")
     **/
    private $numSalle;

    /**
     * @Id
     * @ManyToOne(targetEntity="Cours")
     * @JoinColumn(name="idCours", referencedColumnName="id")
     **/
    private $idCours;

    // Constructeur de la classe
    public function Role($numSalle, $idCours)
    {
        $this->numSalle = $numSalle;
        $this->idCours = $idCours;
    }

    /* Getter et Setter NUM_SALLE */
    public function getNumSalle(){ return $this->numSalle; }

    public function setNumSalle($numSalle){ $this->numSalle = $numSalle; }

    /* Getter et Setter ID_COURS */
    public function getIdCours(){ return $this->idCours; }

    public function setIdCours($idCours){ $this->idCours = $idCours; }
}

?>
