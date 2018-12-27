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

    // Constructeur de la classe
    public function Role($groupe, $etudiant)
    {
        $this->groupe = $groupe;
        $this->etudiant = $etudiant;
    }

    /* Getter et Setter GROUPE */
    public function getGroupe(){ return $this->groupe; }

    public function setGroupe($groupe){ $this->groupe = $groupe; }

    /* Getter et Setter ETUDIANT */
    public function getEtudiant(){ return $this->etudiant; }

    public function setEtudiant($etudiant){ $this->etudiant = $etudiant; }
}

?>
