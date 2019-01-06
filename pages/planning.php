<?php
	// Démarrage des sessions
 	session_start();

    //Inclusion des DAO nécessaires
    include "../DAO/departementDAO.php";
    include "../DAO/filiereDAO.php";
    include "../DAO/groupeDAO.php";
    include "../DAO/etudiantDAO.php";
    include "../DAO/coursDAO.php";

    // Retourne pour une année et un numéro de semaine donné, les date de début et de fin de celle-ci
    function getWeekDates($year, $week) {
        $ret['dateDeb'] = (new DateTime())->setISODate($year, $week);    // Date de début
        $ret['dateFin'] = (new DateTime())->setISODate($year, $week, 7); // et de fin de semaine
        return $ret;
    }

    $test = getWeekDates(2018, 41);
    echo 'De '.$test['dateDeb']->format("d-m-Y").' à '.$test['dateFin']->format("d-m-Y");
    $res = findCoursOfGroupeInPeriode(69, $test['dateDeb'], $test['dateFin']);

	// On vérifie qu'un utilisateur est bien connecté, sinon retour à la page de connexion
    // if ( !isset($_SESSION["user"]) ) {
    //     header('Location: ../index.php');
    // }

	// Si le formulaire de sélection des étudiants est validé, on les enregistres
    if (isset($_POST["valide"])) {

        // Récupération des valeurs séléctionner pour les conserver
		$dep = $_POST["departement"];
        $fil = $_POST["filiere"];
		$grp = $_POST["groupe"];
		$week = $_POST["semaine"];

		if (!empty($_POST["absents"])) {
			echo 'Les étudiants absents sont :<br />';
			foreach($_POST['absents'] as $val) {
				echo $val,'<br />';
			}
		}
        unset($_POST["valide"]);
	}
?>

<html>
	<head>
		<meta charset="utf-8" />
		<title>Emploi du temps</title>
		<!-- Style pour l'affichage de la popup et de l'emploi du temps -->
        <link href="../templates/scheduler/scheduler.css" rel="stylesheet"/>
        <link href="../templates/popup/popup.css" rel="stylesheet"/>
        <!-- Style principal de la page -->
		<link href="../style/bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
		<link href="../style/style.css" rel="stylesheet"/>
	</head>

	<body onload="generate()">

		<!-- DEBUT DU CONTENU DE LA POPUP -->
        <div class="modalWindow blur-effect" id="popup">
			<div class="popup">
    			<h1>Qui sont les absents ?</h1>

                <!-- Menu de sélection des étudiants -->
				<form action="planning.php" method="post"><!-- Le formulaire chevauche sur la popup et la page -->
					<div class="row listeEleves">
                        <?php
                            // Récupération des étudiants en BD pour remplir la liste
                            if (isset($grp) and $grp != 'defaut') {
                                $etudiants = getEtudiantsFromGroupe($grp);
                                foreach ($etudiants as $value) {
                                    $ine = $value[1];            // L'INE de l'étudiant
                                    $etu = findEtudiant($ine);   // Récupération de l'objet étudiant à partir de son INE
                                    $nom = $etu->getNom();       // Le nom de l'étudiant
                                    $prenom = $etu->getPrenom(); // Le prenom de l'étudiant
                                    echo "<div>".$nom." ".$prenom." <input type='checkbox' name='absents[]' value='".$ine."'/><br/></div>";
                                }
                            } else {
                                $etudiants = findAllEtudiant();
                                foreach ($etudiants as $value) {
                                    $nom = $value->getNom();       // Le nom de l'étudiant
                                    $prenom = $value->getPrenom(); // Le prenom de l'étudiant
                                    $ine = $value->getIne();       // L'INE de l'étudiant
                                    echo "<div>".$nom." ".$prenom." <input type='checkbox' name='absents[]' value='".$ine."'/><br/></div>";
                                }
                            }
                        ?>
	                </div>
	                <button type="submit" name='valide' class="btn bouton">Valider</button>

                <!-- Bouton pour fermer la popup -->
				<div class="close"></div>
			</div>
		</div>
		<!-- FIN DE LA POPUP -->


		<!-- DEBUT DU CONTENU DE LA PAGE -->
		<div class="container bloc">

			<!-- Entête -->
			<div class="row enteteRubrique">
				<h1>Rechercher un emploi du temps</h1>
			</div>

			<!-- Menu de sélection du groupe et de la semaine -->
	            <div class="row menu">

                    <!-- Sélection du département -->
					<div class="col-md-3 col-sm-12">
						Département :
	                    <select class="liste" name="departement">
	                        <option <?php if(isset($dep) and $dep == "defaut") echo "selected"; ?> value="defaut"></option>
                            <?php
                                // Récupération des départements en BD pour remplir la liste
                                $departements = findAllDepartement();
                                foreach ($departements as $value) {
                                    $lib = $value->getLibelle(); // Le libelle du département
                                    $id = $value->getId();       // L'id du département
                                    echo "<option ";
									if(isset($dep) and $dep == $id) echo "selected";
									echo " value='".$id."'>".$lib."</option>";
                                }
                            ?>
	                    </select>
					</div><!-- Fin département -->

                    <!-- Sélection de la filière -->
                    <div class="col-md-3 col-sm-12">
                        Filière :
	                    <select class="liste" name="filiere">
							<option <?php if(isset($fil) and $fil == "defaut") echo "selected"; ?> value="defaut"></option>
							<?php
                                // Récupération des filières en BD pour remplir la liste
                                if (isset($dep) and $dep != 'defaut') {
                                    $filieres = getFilieresFromDepartement($dep);
                                } else {
                                    $filieres = findAllFiliere();
                                }
                                foreach ($filieres as $value) {
                                    $lib = $value->getLibelle(); // Le libelle de la filière
                                    $id = $value->getId();       // L'id de la filière
                                    echo "<option ";
                                    if(isset($fil) and $fil == $id) echo "selected";
                                    echo " value='".$id."'>".$lib."</option>";
                                }
							?>
                        </select>
                    </div><!-- Fin filière -->

                    <!-- Sélection du groupe -->
					<div class="col-md-3 col-sm-12">
						Groupe :
	                    <select class="liste" name="groupe">
	                        <option <?php if(isset($grp) and $grp == "defaut") echo "selected"; ?> value="defaut"></option>
                            <?php
                                // Récupération des groupes en BD pour remplir la liste
                                if (isset($fil) and $fil != 'defaut') {
                                    $groupes = getGroupesFromFiliere($fil);
                                } else {
                                    $groupes = findAllGroupe();
                                }
                                foreach ($groupes as $value) {
                                    $lib = $value->getLibelle(); // Le libelle du groupe
                                    $id = $value->getId();       // L'id du groupe
                                    echo "<option ";
									if(isset($grp) and $grp == $id) echo "selected";
									echo " value='".$id."'>".$lib."</option>";
                                }
                            ?>
	                    </select>
					</div><!-- Fin groupe -->

                    <!-- Sélection de la semaine -->
					<div class="col-md-3 col-sm-12">
						Semaine :
	                    <select class="liste" name="semaine">
							<option <?php if(isset($week) and $week == "defaut") echo "selected"; ?> value="defaut"></option>
							<?php
								for ($i = 37; $i <= 52; $i++) {
                                    $wk =  getWeekDates(2018, $i);
									echo "<option ";
									if(isset($week) and $week == "sem".$i) echo "selected";
									echo " value='sem".$i."'>Semaine ".$i."</option>";
								}
							?>
	                    </select>
					</div><!-- Fin semaine -->
	            </div><!-- Fin menu -->
			</form><!-- Fin formulaire -->

            <!-- Emploi du temps de sélection du cours -->
			<div class="row menu">
                <!-- Div qui contiendra l'emploi du temps généré par le jQuery -->
                <div id="scheduler-container"></div>
			</div>

		</div>
		<!-- FIN DE LA PAGE -->

		<!-- Permet de fermer les pop-ups sans cliquer sur le bouton -->
        <div class="overlay"></div>
	</body>

	<!-- Le script jQuery -->
    <script src="../jquery/jquery-3.3.1.min.js"></script>
    <!-- Les scripts qui gèrent l'emploi du temps -->
    <script src="../templates/scheduler/scheduler.js"></script>
    <script src="../jquery/planning.js"></script>
    <!-- Le script qui permet l'affichage de la popup -->
    <script src="../templates/popup/popup.js"></script>

</html>
