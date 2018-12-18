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
     * @JoinColumn(name="idDep", referencedColumnName="id")
     **/
    private $idDep;

    /** @Column(type="string") **/
    private $libelle;

    /**
     * @ManyToOne(targetEntity="Personnel")
     * @JoinColumn(name="idAdministratif", referencedColumnName="id")
     **/
    private $idAdministratif;

    // Constructeur de la classe
    public function Filiere($idDep,$libelle, $idAdministratif)
    {
        $this->idDep = $idDep;
        $this->libelle = $libelle;
        $this->idAdministratif = $idAdministratif;
    }

    /* Getter ID */
    public function getIdFiliere(){ return $this->id; }

    /* Getter et Setter ID_DEPARTEMENT */
    public function getIdDep(){ return $this->idDep; }

    public function setIdDep($idDep) { $this->idDep = $idDep; }

    /* Getter et Setter LIBELLE */
    public function getLibelle() { return $this->libelle; }

    public function setLibelle($libelle){ $this->libelle = $libelle; }

    /* Getter et Setter ID_ADMINISTRATIF */
    public function getIdAdministratif(){ return $this->idAdministratif; }

    public function setIdAdministratif($idAdministratif){ $this->idAdministratif = $idAdministratif; }

}

?>
