<?php

/**
 * @author robin.hortala
 *
 */

 /**
  * @Entity @Table(name="personnel")
  **/
class Personnel
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    private $id;

    /** @Column(type="string") **/
    private $mdp;

    /** @Column(type="string") **/
    private $nom;

    /** @Column(type="string") **/
    private $prenom;

    // Constructeur de la classe
    public function Personnel($mdp,$nom,$prenom)
    {
        $this->mdp = $mdp;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

    /* Getter ID */
    public function getIdPersonnel(){ return $this->id; }

    /* Getter et Setter NOM */
    public function getNom(){ return $this->nom; }

    public function setNom($nom){ $this->nom = $nom; }

    /* Getter et Setter PRENOM */
    public function getPrenom(){ return $this->prenom; }

    public function setPrenom($prenom){ $this->prenom = $prenom; }

    /* Getter et Setter MDP */
    public function getMdp(){ return $this->mdp; }

    public function setMdp($mdp){ $this->mdp = $mdp; }
}

?>
