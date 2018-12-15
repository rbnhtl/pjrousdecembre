<?php

/**
 * @author robin.hortala
 *
 */

 /**
  * @Entity @Table(name="matiere")
  **/
class Matiere
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    private $id;

    /** @Column(type="string") **/
    private $libelle;

    // Constructeur de la classe
    public function Matiere($libelle)
    {
        $this->libelle = $libelle;
    }

    /* Getter et Setter ID */
    public function getId(){ return $this->id; }

    /* Getter et Setter LIBELLE */
    public function getLibelle(){ return $this->libelle; }

    public function setLibelle($libelle) { $this->descSalle = $libelle; }

}

?>
