<?php

/**
 * @author robin.hortala
 *
 */

 /**
  * @Entity @Table(name="salle")
  **/
class Salle
{
    /** @Id @Column(type="string",length=5) **/
    private $num;

    /** @Column(type="string") **/
    private $description;

    // Constructeur de la classe
    public function Salle($num)
    {
        $this->num = $num;
        $this->description = $description;
    }

    /* Getter et Setter NUM */
    public function getNum(){ return $this->num; }

    public function setNum($num){ $this->num = $num; }

    /* Getter et Setter DESCRIPTION */
    public function getDescription(){ return $this->description; }

    public function setDescription($description){ $this->description = $description; }
}

?>
