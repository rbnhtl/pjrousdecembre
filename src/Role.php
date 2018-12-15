<?php

/**
 * @author robin.hortala
 *
 */

 /**
  * @Entity @Table(name="role")
  **/
class Role
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    private $id;

    /** @Column(type="string") **/
    private $libelle;

    // Constructeur de la classe
    public function Role($libelle)
    {
        $this->libelle = $libelle;
    }

    /* Getter et Setter ID */
    public function getId(){ return $this->id; }

    /* Getter et Setter LIBELLE */
    public function getLibelle(){ return $this->libelle; }

    public function setLibelle($libelle){ $this->libelle = $libelle; }
}

?>
