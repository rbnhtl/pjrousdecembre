<?php

/**
 * @author robin.hortala
 *
 */

 /**
  * @Entity @Table(name="groupe")
  **/
class Groupe
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    private $id;

    /**
     * @ManyToOne(targetEntity="Filiere")
     * @JoinColumn(name="idFiliere", referencedColumnName="id")
     **/
    private $idFiliere;

    /** @Column(type="string") **/
    private $libelle;

    // Constructeur de la classe
    public function Groupe($idFiliere,$libelle)
    {
        $this->idFiliere = $idFiliere;
        $this->libelle = $libelle;
    }

    /* Getter ID */
    public function getId(){ return $this->id; }

    /* Getter et Setter LIBELLE */
    public function getLibelle(){ return $this->libelle; }

    public function setLibelle($libelle){ $this->libelle = $libelle; }

    /* Getter et Setter ID_FILIERE */
    public function getIdFiliere(){ return $this->idFiliere; }

    public function setIdFiliere($idFiliere){ $this->idFiliere = $idFiliere; }
}

?>
