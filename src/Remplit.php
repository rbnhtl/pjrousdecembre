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
     * @JoinColumn(name="personnel", referencedColumnName="id")
     **/
    private $personnel;

    /**
     * @Id
     * @ManyToOne(targetEntity="Role")
     * @JoinColumn(name="role", referencedColumnName="id")
     **/
    private $role;

    /* Getter et Setter ID_PERSONNEL */
    public function getPersonnel(){ return $this->personnel; }

    public function setPersonnel($personnel){ $this->personnel = $personnel; }

    /* Getter et Setter ID_ROLE */
    public function getRole(){ return $this->role; }

    public function setRole($role){ $this->role = $role; }
}

?>
