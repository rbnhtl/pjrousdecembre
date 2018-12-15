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
    /** @Id @Column(type="integer") @GeneratedValue **/
    private $id;

    /**
     * @ManyToOne(targetEntity="Etudiant")
     * @JoinColumn(name="ineEtud", referencedColumnName="ine")
     **/
    private $ineEtud;

    /**
     * @ManyToOne(targetEntity="Cours")
     * @JoinColumn(name="idCours", referencedColumnName="id")
     **/
    private $idCours;

    // Constructeur de la classe
    public function Abscence($ineEtud,$idCours)
    {
        $this->ineEtud = $ineEtud;
        $this->idCours = $idCours;
    }

    /* Getter ID */
    public function getId(){ return $this->id; }

    /* Getter et Setter INE_ETUD */
    public function getIneEtud(){ return $this->ineEtud; }

    public function setINE($ineEtud){ $this->ineEtud = $ineEtud; }

        /* Getter et Setter ID_COURS */
    public function getIdCours(){ return $this->idCours; }

    public function setIdCours($idCours){ $this->idCours = $idCours; }
}

?>
