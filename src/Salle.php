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

    // Constructeur de la classe
    public function Salle($num)
    {
        $this->num = $num;
    }

    /* Getter et Setter NUM */
    public function getNum(){ return $this->num; }

    public function setNum($num){ $this->num = $num; }
}

?>
