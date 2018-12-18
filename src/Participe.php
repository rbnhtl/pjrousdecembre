<?php

/**
 * @author robin.hortala
 *
 */

 /**
  * @Entity @Table(name="participe")
  **/
class Participe
{
    /**
     * @Id
     * @ManyToOne(targetEntity="Groupe")
     * @JoinColumn(name="idGroupe", referencedColumnName="id")
     **/
    private $idGroupe;

    /**
     * @Id
     * @ManyToOne(targetEntity="Cours")
     * @JoinColumn(name="idCours", referencedColumnName="id")
     **/
    private $idCours;

    // Constructeur de la classe
    public function Role($idGroupe, $idCours)
    {
        $this->idGroupe = $idGroupe;
        $this->idCours = $idCours;
    }

    /* Getter et Setter ID_GROUPE */
    public function getIdGroupe(){ return $this->idGroupe; }

    public function setIdGroupe($idGroupe){ $this->idGroupe = $idGroupe; }

    /* Getter et Setter ID_COURS */
    public function getIdCours(){ return $this->idCours; }

    public function setIdCours($idCours){ $this->idCours = $idCours; }
}

?>
