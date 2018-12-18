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

    // Constructeur de la classe
    public function Departement($id,$libelle)
    {
        $this->id = $id;
        $this->libelle = $libelle;
    }

    /* Getter ID */
    public function getId(){ return $this->id; }

    /* Getter et Setter LIBELLE */
    public function getLibelle(){ return $this->libelle; }

    public function setLibelle($libelle){ $this->libelle = $libelle; }
}

?>
