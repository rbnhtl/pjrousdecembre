<?php

/**
 * @author bastien.ranc
 *
 */
class DataManagement
{

	private $user = "root";
	private $pass = "root";
	private $dbName = "gestioneleve";

    private $tableCours = "cours";
    private $db = null;

    public function DataManagement() {
    	$this->db = new PDO('mysql:host=127.0.0.1;dbname=gestioneleve;charset=utf8', $this->user, $this->pass);
    }

	public function insertCours($cours) {

		// Remplis les tables
		$reqCours = $this->db->prepare("INSERT INTO cours (id_matiere, numero_salle, id_groupe, horaire_debut, horaire_fin) VALUES (:idMatiere, :idSalle, :idGroup, :hDebut, :hFin)");
		$reqCours->bindValue(':idMatiere', $idMatiere);
		$reqCours->bindValue(':idSalle', $idSalle);
		$reqCours->bindValue(':idGroup', $idGroup);
		$reqCours->bindValue(':prof', $idProf);
		$reqCours->bindValue(':hDebut', $cours->getDateDebut());
		$reqCours->bindValue(':hFin', $cours->getDateFin());
		$reqProf->execute();
	}

	public function insertArrayOfCours($cours) {
		foreach ($cours as $value) {
			$this->insertCours($value);
		}
	}


}

?>
