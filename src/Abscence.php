<?php

/**
 * @author robin.hortala
 *
 */

 /**
  * @Entity @Table(name="absence")
  **/
class Abscence
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

    // Constructeur de la classe
    public function Abscence($etudiant,$cours)
    {
        $this->etudiant = $etudiant;
        $this->cours = $cours;
    }

    /* Getter et Setter INE_ETUD */
    public function getEtud(){ return $this->etudiant; }

    public function setEtud($etudiant){ $this->etudiant = $etudiant; }

        /* Getter et Setter ID_COURS */
    public function getCours(){ return $this->cours; }

    public function setCours($cours){ $this->cours = $cours; }
}

?>
