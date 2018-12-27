<?php
    /**
	 * @author robin.hortala
	 *
	 */

    include 'coursDAO.php';

    $coursExiste = findCours(11);
    print("<h1>Recherche du cours (ID: 11)</h1>");
    print("Cours trouvé avec l'ID : ".$coursExiste->getId()."<br>Matière : ".$coursExiste->getMatiere()->getLibelle());

    $allCours = findAllCours();
    print("<h1>Recherche de tous les cours</h1>");
    print(count($allCours)." cours trouvés");
?>