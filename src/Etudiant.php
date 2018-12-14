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
	
	/** @Column(type="integer") **/
    private $id_groupe; 

	/** @Column(type="string") **/
    private $nom;

	/** @Column(type="string") **/
    private $prenom;
    
    // Constructeur de la classe
    public function Etudiant($ine,$id_groupe,$nom,$prenom)
    {
        $this->ine = $ine;
        $this->id_groupe = $id_groupe;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }
    
    /* Getters et Setters */

    public function getIne()
    {
        return $this->ine;
    }
	
    public function setIne($ine)
    {
        $this->ine = $ine;
    }

    public function getNom()
    {
        return $this->nom;
    }
 
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function getIdGroupe()
    {
        return $this->id_groupe;
    }
 
    public function setIdGroupe($id_groupe)
    {
        $this->id_groupe = $id_groupe;
    }
    
}

?>