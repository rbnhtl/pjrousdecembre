<?php

/**
 * @author robin.hortala
 *
 */

 /**
  * @Entity @Table(name="absence")
  **/
class Absence
{
    /**
     * @Id
     * @ManyToOne(targetEntity="Etudiant")
     * @JoinColumn(name="etudiant", referencedColumnName="ine")
     **/
    private $etudiant;

    /**
     * @Id
     * @ManyToOne(targetEntity="Cours")
     * @JoinColumn(name="cours", referencedColumnName="id")
     **/
    private $cours;

    /**
     * @Column(type="integer")
     */
    private $justifiee = 0;

    /* Getter et Setter INE_ETUD */
    public function getEtud(){ return $this->etudiant; }

    public function setEtud($etudiant){ $this->etudiant = $etudiant; }

    /* Getter et Setter ID_COURS */
    public function getCours(){ return $this->cours; }

    public function setCours($cours){ $this->cours = $cours; }

    /* Getter et Setter Justifiée */
    public function getJustifiee(){ return $this->justifiee; }

    public function setJustifee($justifiee){ $this->justifiee = $justifiee; }
}

?>
