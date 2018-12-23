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
     * @JoinColumn(name="salle", referencedColumnName="num")
     **/
    private $salle;

    /**
     * @Id
     * @ManyToOne(targetEntity="Cours")
     * @JoinColumn(name="cours", referencedColumnName="id")
     **/
    private $cours;

    /* Getter et Setter SALLE */
    public function getSalle(){ return $this->salle; }

    public function setSalle($salle){ $this->salle = $salle; }

    /* Getter et Setter COURS */
    public function getCours(){ return $this->cours; }

    public function setCours($cours){ $this->cours = $cours; }
}

?>
