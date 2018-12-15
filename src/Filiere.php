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

    // Constructeur de la classe
    public function Filiere($idDep,$libelle)
    {
        $this->idDep = $idDep;
        $this->libelle = $libelle;
    }

    /* Getter ID */
    public function getIdFiliere(){ return $this->id; }

    /* Getter et Setter ID_DEPARTEMENT */
    public function getIdDep(){ return $this->idDep; }

    public function setIdDep($idDep) { $this->idDep = $idDep; }

    /* Getter et Setter LIBELLE */
    public function getLibelle() { return $this->libelle; }

    public function setLibelle($libelle){ $this->libelle = $libelle; }

}

?>
