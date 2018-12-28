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
    private $login;

    /** @Column(type="string") **/
    private $mdp;

    /** @Column(type="string") **/
    private $nom;

    /** @Column(type="string") **/
    private $prenom;

    // Constructeur de la classe
    public function Personnel($login,$mdp,$nom,$prenom)
    {
        $this->login = $login;
        $this->mdp = $mdp;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

    /* Getter ID */
    public function getId(){ return $this->id; }

    /* Getter et Setter NOM */
    public function getNom(){ return $this->nom; }

    public function setNom($nom){ $this->nom = $nom; }

    /* Getter et Setter PRENOM */
    public function getPrenom(){ return $this->prenom; }

    public function setPrenom($prenom){ $this->prenom = $prenom; }

    /* Getter et Setter LOGIN */
    public function getLogin(){ return $this->login; }

    public function setLogin($login){ $this->login = $login; }

    /* Getter et Setter MDP */
    public function getMdp(){ return $this->mdp; }

    public function setMdp($mdp){ $this->mdp = $mdp; }
}

?>
