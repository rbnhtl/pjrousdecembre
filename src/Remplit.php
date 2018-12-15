<?php

/**
 * @author robin.hortala
 *
 */

 /**
  * @Entity @Table(name="remplit")
  **/
class Remplit
{
    /**
     * @Id
     * @ManyToOne(targetEntity="Personnel")
     * @JoinColumn(name="idPersonnel", referencedColumnName="id")
     **/
    private $idPersonnel;

    /**
     * @Id
     * @ManyToOne(targetEntity="Role")
     * @JoinColumn(name="idRole", referencedColumnName="id")
     **/
    private $idRole;

    // Constructeur de la classe
    public function Role($idPersonnel, $idRole)
    {
        $this->idPersonnel = $idPersonnel;
        $this->idRole = $idRole;
    }

    /* Getter et Setter ID_PERSONNEL */
    public function getIdPersonnel(){ return $this->idPersonnel; }

    public function setIdPersonnel($idPersonnel){ $this->idPersonnel = $idPersonnel; }

    /* Getter et Setter ID_ROLE */
    public function getIdRole(){ return $this->idRole; }

    public function setIdRole($idRole){ $this->idRole = $idRole; }
}

?>
