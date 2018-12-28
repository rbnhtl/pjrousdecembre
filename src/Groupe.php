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
     * @JoinColumn(name="filiere", referencedColumnName="id")
     **/
    private $filiere;

    /** @Column(type="string") **/
    private $libelle;

    // Constructeur de la classe
    public function Groupe($filiere,$libelle)
    {
        $this->filiere = $filiere;
        $this->libelle = $libelle;
    }

    /* Getter ID */
    public function getId(){ return $this->id; }

    /* Getter et Setter LIBELLE */
    public function getLibelle(){ return $this->libelle; }

    public function setLibelle($libelle){ $this->libelle = $libelle; }

    /* Getter et Setter ID_FILIERE */
    public function getFiliere(){ return $this->filiere; }

    public function setFiliere($filiere){ $this->filiere = $filiere; }
}

?>
