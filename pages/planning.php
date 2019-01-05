<?php
	// Démarrage des sessions
 	session_start();

	// On vérifie qu'un utilisateur est bien connecté, sinon retour à la page de connexion
    if ( !isset($_SESSION["user"]) ) {
        header('Location: ../index.php');
    }

	// Initialisation des variables
	$dep = $grp = $week = 0;

	// Si le formulaire de sélection des étudiants est validé, on les enregistres
    if ( isset($_POST["valide"]) ) {

		$dep = $_POST["departement"];
		$grp = $_POST["groupe"];
		$week = $_POST["semaine"];

		if (!empty($_POST["absents"])) {
			echo 'Les étudiants absents sont :<br />';
			foreach($_POST['absents'] as $val) {
				echo $val,'<br />';
			}

			unset($_POST["valide"]);
		}
	}
?>

	//Redirection vers l'index s'il n'y a pas eu connexion ou si les droits ne sont pas corrects
	if ($_SESSION['droit']!=1 || $_SESSION['droit']!=2 || $_SESSION['droit']!=3) {
			header('Location: ../index.php');
			exit();
	}
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
	                    <div>Norbert <input type="checkbox" name="absents[]" value="Norbert"/><br/></div>
	                    <div>Roger <input type="checkbox" name="absents[]" value="Roger"/><br/></div>
	                    <div>Jean-Pierre <input type="checkbox" name="absents[]" value="Jean-Pierre"/><br/></div>
	                    <div>Louis <input type="checkbox" name="absents[]" value="Louis"/><br/></div>
	                    <div>André <input type="checkbox" name="absents[]" value="André"/><br/></div>
	                    <div>Paul <input type="checkbox" name="absents[]" value="Paul"/><br/></div>
	                    <div>Claude <input type="checkbox" name="absents[]" value="Claude"/><br/></div>
	                    <div>Michel <input type="checkbox" name="absents[]" value="Michel"/><br/></div>
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
					<div class="col-md-4 col-sm-12">
						Département :
	                    <select class="liste" name="departement">
	                        <option <?php if($dep == "defaut") echo "selected"; ?> value="defaut"></option>
	                        <option <?php if($dep == "dep1") echo "selected"; ?> value="dep1">Informatique</option>
	                        <option <?php if($dep == "dep2") echo "selected"; ?> value="dep2">QLIO</option>
	                        <option <?php if($dep == "dep3") echo "selected"; ?> value="dep3">Info-com</option>
	                        <option <?php if($dep == "dep4") echo "selected"; ?> value="dep4">GEA</option>
	                        <option <?php if($dep == "dep5") echo "selected"; ?> value="dep5">Carrière juridique</option>
	                    </select>
					</div>

					<div class="col-md-4 col-sm-12">
						Groupe :
	                    <select class="liste" name="groupe">
	                        <option <?php if($grp == "defaut") echo "selected"; ?> value="defaut"></option>
	                        <option <?php if($grp == "gr1") echo "selected"; ?> value="gr1">DUT 1</option>
	                        <option <?php if($grp == "gr2") echo "selected"; ?> value="gr2">DUT 2</option>
	                        <option <?php if($grp == "gr3") echo "selected"; ?> value="gr3">LP MMS</option>
	                    </select>
					</div>

					<div class="col-md-4 col-sm-12">
						Semaine :
	                    <select class="liste" name="semaine">
							<option <?php if($week == "defaut") echo "selected"; ?> value="defaut"></option>
							<?php
								for ($i = 0; $i <= 52; $i++) {
									echo "<option ";
									if($week == "sem".$i) echo "selected";
									echo " value='sem".$i."'>Semaine ".$i."</option>";
								}
							?>
	                    </select>
					</div>
	            </div>
			</form><!-- Fin formulaire -->

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
    <script src="../jQuery/jQuery-3.3.1.min.js"></script>
    <!-- Les scripts qui gèrent l'emploi du temps -->
    <script src="../templates/scheduler/scheduler.js"></script>
    <script src="../jQuery/planning.js"></script>
    <!-- Le script qui permet l'affichage de la popup -->
    <script src="../templates/popup/popup.js"></script>

</html>
