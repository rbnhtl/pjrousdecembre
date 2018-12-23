<?php

/**
 * @author robin.hortala
 *
 */

 /**
  * @Entity @Table(name="participe")
  **/
class Participe
{
    /**
     * @Id
     * @ManyToOne(targetEntity="Groupe")
     * @JoinColumn(name="groupe", referencedColumnName="id")
     **/
    private $groupe;

    /**
     * @Id
     * @ManyToOne(targetEntity="Cours")
     * @JoinColumn(name="cours", referencedColumnName="id")
     **/
    private $cours;

    /* Getter et Setter GROUPE */
    public function getGroupe(){ return $this->groupe; }

    public function setGroupe($groupe){ $this->groupe = $groupe; }

    /* Getter et Setter COURS */
    public function getCours(){ return $this->cours; }

    public function setCours($cours){ $this->cours = $cours; }
}

?>
