<?php

/**
 * @author robin.hortala
 * 
 */

 /**
  * @Entity @Table(name="cours")
  **/
class Cours
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    private $id;

    /**
     * @ManyToOne(targetEntity="Matiere")
     * @JoinColumn(name="matiere", referencedColumnName="id")
     **/
    private $matiere;

    /** @Column(type="datetime") **/
    private $dateDebut;

    /** @Column(type="datetime") **/
    private $dateFin;

    // Constructeur de la classe
    public function Cours($matiere, $dateDebut, $dateFin)
    {
        $this->matiere = $matiere;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
    }

    /* Getter ID */
    public function getId(){ return $this->id; }

    /* Getter et Setter ID_matiere */
    public function getMatiere(){ return $this->matiere; }

    public function setMatiere($matiere){ $this->matiere = matiere; }

    /* Getter et Setter DATE_DEBUT */
    public function getDateDebut(){ return $this->dateDebut; }

    public function setDateDebut($dateDebut){ $this->dateDebut = $dateDebut; }

    /* Getter et Setter DATE_FIN */
    public function getDateFin(){ return $this->dateFin; }

    public function setDateFin($dateFin){ $this->dateFin = $dateFin; }
}

?>
