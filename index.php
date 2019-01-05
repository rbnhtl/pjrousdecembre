<?php
	// Démarrage des sessions
 	session_start();

	global $em;

	// Détruit la session si elle est déjà ouverte
	if (isset($_POST["deco"])) {
		session_unset();
		session_destroy();
	}

	// Si le formulaire a été validé, on enregistre les données dans la session
    if ( isset($_POST["user"]) and $_POST["user"] != "" and
	 	 isset($_POST["passwd"]) and $_POST["passwd"] != "") {

		$_SESSION["user"] = $_POST["user"];
		$_SESSION["mdp"] = $_POST["passwd"];

		$query = $em->createQuery('SELECT p FROM src/Personnel p WHERE p.login = ":login" AND p.mdp = ":passwd"');
		$query->setParameters(array(
			'login' => $_POST["user"],
			'mdp' => $_POST["passwd"]
		));
		$personnel = $query->getResult();

		$query = $em->createQuery('SELECT r FROM src/Remplit r WHERE r.personnel = ":personnel"');
		$query->setParameters('personnel', $personnel);
		$remplit = $query->getResult();

		$_SESSION["nom"] = $personnel->getNom();
		$_SESSION["prenom"] = $personnel->getPrenom();
		$_SESSION["role"] = $remplit->getRole()->getId();

		if($_SESSION["role"] == 1){
			// Et on redirige vers la page admin
			header('Location: http://localhost:8081/github/pjrousdecembre/pages/admin.php');
			exit();
		} elseif($_SESSION["role"] == 2){
			// Et on redirige vers la page adminif
			header('Location: http://localhost:8081/github/pjrousdecembre/pages/adminif.php');
			exit();
		} elseif($_SESSION["role"] == 3){
			// Et on redirige vers la page du Planning
			header('Location: http://localhost:8081/github/pjrousdecembre/pages/planning.php');
			exit();
		} else {
			$_SESSION["role"] == -1;
			echo "Identifiant ou Mot de passe incorrect";
		}
	}

	if ( isset($_SESSION["user"]) and isset($_SESSION["mdp"]) ) {
		echo "User : ".$_SESSION["user"]."<br />
			  Mot de passe : ".$_SESSION["mdp"]."<br />
			  Id : ".session_id();
	}
?>
<html>
<head>
	<meta charset="utf-8" />
	<title>Connexion</title>
	<link href="style/bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
	<link href="style/fontawesome-5.6.1/css/all.css" rel="stylesheet"/>
	<link href="style/style.css" rel="stylesheet"/>
</head>
<body>
	<!-- Début du contenu de la page -->
	<div class="container bloc">

		<!-- Ligne d'entête -->
		<div class="row enteteRubrique">
			<h1>Les élèves égarés</h1>
		</div>

		<!-- Ligne du formulaire de connexion -->
		<div class="row">
			<!-- Espace à gauche -->
			<div class="col-xs-3"></div>
			<div class="col-xs-6">
				<!-- Formulaire de connexion -->
				<form id="form" action="index.php" method="post">
					<br/>
					<h3>Identifiant</h3>
					<input type="text" name="user" class="form-control inputText" placeholder="Votre mail ..."/> <br/>
					<h3>Mot de passe</h3>
					<input type="password" name="passwd" class="form-control inputText" placeholder="Votre mot de passe ..."/> <br/>
					<button type="submit" class="btn bouton">Connexion  <span class="fas fa-sign-in-alt"></span></button>
					<button type="submit" name="deco" class="btn bouton">Déconnexion  <span class="fas fa-sign-out-alt"></span></button>
                    <br/><br/>
				</form>
			</div>
			<!-- Espace à droite -->
			<div class="col-xs-3"></div>
		</div>

	</div>
</body>
</html>
