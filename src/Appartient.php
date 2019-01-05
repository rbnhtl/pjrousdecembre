<?php

/**
 * @author robin.hortala
 * 
 */

 /**
  * @Entity @Table(name="appartient")
  **/
class Appartient
{
    /**
     * @Id
     * @ManyToOne(targetEntity="Groupe")
     * @JoinColumn(name="groupe", referencedColumnName="id")
     **/
    private $groupe;

    /**
     * @Id
     * @ManyToOne(targetEntity="Etudiant")
     * @JoinColumn(name="etudiant", referencedColumnName="ine")
     **/
    private $etudiant;

    /* Getter et Setter GROUPE */
    public function getGroupe(){ return $this->groupe; }

    public function setGroupe($groupe){ $this->groupe = $groupe; }

    /* Getter et Setter ETUDIANT */
    public function getEtud(){ return $this->etudiant; }

    public function setEtud($etudiant){ $this->etudiant = $etudiant; }
}

?>
