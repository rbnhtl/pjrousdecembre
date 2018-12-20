<?php

/**
 * @author robin.hortala
 *
 */

 /**
  * @Entity @Table(name="etudiant")
  **/
class Etudiant
{
	/** @Id @Column(type="string", length=13) **/
    private $ine;

	/** @Column(type="string") **/
    private $nom;

	/** @Column(type="string") **/
    private $prenom;

    // Constructeur de la classe
    public function Etudiant($ine,$nom,$prenom)
    {
        $this->ine = $ine;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

    /* Getter et Setter INE */
    public function getIne(){ return $this->ine; }

    public function setIne($ine){ $this->ine = $ine; }

    /* Getter et Setter NOM */
    public function getNom(){ return $this->nom; }

    public function setNom($nom){ $this->nom = $nom; }

    /* Getter et Setter PRENOM */
    public function getPrenom() { return $this->prenom; }

    public function setPrenom($prenom){ $this->prenom = $prenom; }
}

?>
