<?php
	// Démarrage des sessions

	session_start();
	
	require_once "bootstrap.php";

	require_once "src/Remplit.php";
	require_once "src/Personnel.php";
	require_once "DAO/personnelDAO.php";
	require_once "DAO/remplitDAO.php";

	global $em;

	// Détruit la session si elle est déjà ouverte
	if (isset($_POST["deco"])) {
		session_unset();
		session_destroy();
		unset($_POST["user"]);
		unset($_POST["passwd"]);
	}

	// Si le formulaire a été validé, on enregistre les données dans la session
    if ( isset($_POST["formConnexion"])) {

		$_SESSION["user"] = $_POST["user"];
		$_SESSION["mdp"] = $_POST["passwd"];

		$personnel = findPersonnelByLoginMdp($_POST["user"], $_POST["passwd"]);
		if ($personnel !== null) {
			// Personnel trouvé dans la base de données
			$remplit = findRemplit($personnel);
			$role = $remplit->getRole();
			$nomRole = $role->getLibelle();
			var_dump($_SESSION[$remplit]);

			$_SESSION["nom"] = $personnel->getNom();
			$_SESSION["prenom"] = $personnel->getPrenom();
			$_SESSION["role"] = $role->getLibelle();

			if($_SESSION["role"] == "administrateur"){
				// Et on redirige vers la page admin
				header('Location: http://localhost:8081/pjrousdecembre/pages/admin.php');
				exit();
			} elseif($_SESSION["role"] == "administratif"){
				// Et on redirige vers la page adminif
				header('Location: http://localhost:8081/pjrousdecembre/pages/adminif.php');
				exit();
			} elseif($_SESSION["role"] == "professeur"){
				// Et on redirige vers la page du Planning
				header('Location: http://localhost:8081/pjrousdecembre/pages/planning.php');
				exit();
			} else {
				$_SESSION["role"] == "erreur";
				echo "Identifiant ou Mot de passe incorrect";
			}
		}
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
					<button type="submit" class="btn bouton" name="formConnexion">Connexion  <span class="fas fa-sign-in-alt"></span></button>
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
