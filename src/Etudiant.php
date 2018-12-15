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

    /**
     * @ManyToOne(targetEntity="Groupe")
     * @JoinColumn(name="idGroupe", referencedColumnName="id")
     **/
    private $idGroupe;

	/** @Column(type="string") **/
    private $nom;

	/** @Column(type="string") **/
    private $prenom;

    // Constructeur de la classe
    public function Etudiant($ine,$idGroupe,$nom,$prenom)
    {
        $this->ine = $ine;
        $this->id_groupe = $id_groupe;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

    /* Getter et Setter INE */
    public function getIne(){ return $this->ine; }

    public function setIne($ine){ $this->ine = $ine; }

    /* Getter et Setter ID_GROUPE */
    public function getIdGroupe() { return $this->idGroupe; }

    public function setIdGroupe($idGroupe){ $this->idGroupe = $idGroupe; }

    /* Getter et Setter NOM */
    public function getNom(){ return $this->nom; }

    public function setNom($nom){ $this->nom = $nom; }

    /* Getter et Setter PRENOM */
    public function getPrenom() { return $this->prenom; }

    public function setPrenom($prenom){ $this->prenom = $prenom; }
}

?>
