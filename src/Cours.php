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
     * @JoinColumn(name="idMatiere", referencedColumnName="id")
     **/
    private $idMatiere;

    /**
     * @ManyToOne(targetEntity="Groupe")
     * @JoinColumn(name="idGroupe", referencedColumnName="id")
     **/
    private $idGroupe;

    /** @Column(type="datetime") **/
    private $dateDebut;

    /** @Column(type="datetime") **/
    private $dateFin;

    // Constructeur de la classe
    public function Cours($idMatiere, $idGroupe, $dateDebut, $dateFin)
    {
        $this->idMatiere = $idMatiere;
        $this->idGroupe = $idGroupe;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
    }

    /* Getter ID */
    public function getId(){ return $this->id; }

    /* Getter et Setter ID_MATIERE */
    public function getIdMatiere(){ return $this->idMatiere; }

    public function setIdMatiere($idMatiere){ $this->idMatiere = $idMatiere; }

    /* Getter et Setter ID_GROUPE */
    public function getIdGroupe(){ return $this->idGroupe; }

    public function setIdGroupe($idGroupe){ $this->idGroupe = $idGroupe; }

    /* Getter et Setter DATE_DEBUT */
    public function getDateDebut(){ return $this->dateDebut; }

    public function setDateDebut($dateDebut){ $this->dateDebut = $dateDebut; }

    /* Getter et Setter DATE_FIN */
    public function getDateFin(){ return $this->dateFin; }

    public function setDateFin($dateFin){ $this->dateFin = $dateFin; }
}

?>
