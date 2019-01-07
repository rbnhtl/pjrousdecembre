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
     * @JoinColumn(name="prof", referencedColumnName="id")
     **/
    private $prof;

    /**
     * @Id
     * @ManyToOne(targetEntity="Cours")
     * @JoinColumn(name="cours", referencedColumnName="id")
     **/
    private $cours;

    /* Getter et Setter ID_PROF */
    public function getProf(){ return $this->prof; }

    public function setProf($prof){ $this->prof = $prof; }

    /* Getter et Setter ID_COURS */
    public function getCours(){ return $this->cours; }

    public function setCours($cours){ $this->cours = $cours; }
}

?>
