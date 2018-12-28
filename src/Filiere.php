<?php

/**
 * @author robin.hortala
 *
 */

 /**
  * @Entity @Table(name="filiere")
  **/
class Filiere
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    private $id;

    /**
     * @ManyToOne(targetEntity="Departement")
     * @JoinColumn(name="departement", referencedColumnName="id")
     **/
    private $departement;

    /** @Column(type="string") **/
    private $libelle;

    /**
     * @ManyToOne(targetEntity="Personnel")
     * @JoinColumn(name="administratif", referencedColumnName="id")
     **/
    private $administratif;

    // Constructeur de la classe
    public function Filiere($departement,$libelle, $administratif)
    {
        $this->departement = $departement;
        $this->libelle = $libelle;
        $this->administratif = $administratif;
    }

    /* Getter ID */
    public function getId(){ return $this->id; }

    /* Getter et Setter ID_DEPARTEMENT */
    public function getDepartement(){ return $this->departement; }

    public function setDepartement($departement) { $this->departement = $departement; }

    /* Getter et Setter LIBELLE */
    public function getLibelle() { return $this->libelle; }

    public function setLibelle($libelle){ $this->libelle = $libelle; }

    /* Getter et Setter ID_ADMINISTRATIF */
    public function getAdministratif(){ return $this->administratif; }

    public function setAdministratif($administratif){ $this->administratif = $administratif; }

}

?>
