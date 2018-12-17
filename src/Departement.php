<?php

/**
 * @author robin.hortala
 *
 */

 /**
  * @Entity @Table(name="departement")
  **/
class Departement
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    private $id;

    /** @Column(type="string") **/
    private $libelle;

    /**
     * @ManyToOne(targetEntity="Personnel")
     * @JoinColumn(name="idAdministratif", referencedColumnName="id")
     **/
    private $idAdministratif;

    // Constructeur de la classe
    public function Departement($id,$libelle, $idAdministratif)
    {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->idAdministratif = $idAdministratif;
    }

    /* Getter ID */
    public function getId(){ return $this->id; }

    /* Getter et Setter LIBELLE */
    public function getLibelle(){ return $this->libelle; }

    public function setLibelle($libelle){ $this->libelle = $libelle; }

    /* Getter et Setter ID_ADMINISTRATIF */
    public function getIdAdministratif(){ return $this->idAdministratif; }

    public function setIdAdministratif($idAdministratif){ $this->idAdministratif = $idAdministratif; }
}

?>
