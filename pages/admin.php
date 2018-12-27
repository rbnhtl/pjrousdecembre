<?php session_start() ?>
<?php

	//Redirection vers l'index s'il n'y a pas eu connexion ou si les droits ne sont pas corrects
	if ($_SESSION['connexion']!=1 && $_SESSION['admin']!=1) {
  		header('Location: ../index.php');
  		exit();
	}

?>

<html>
<head>
	<meta charset="utf-8" />
	<title>Administrateur</title>
	<link href="../style/bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
	<link href="../style/fontawesome-5.6.1/css/all.css" rel="stylesheet"/>
	<link href="../style/style.css" rel="stylesheet"/>
</head>
<body>
	<!-- Début du contenu de la page -->
	<div class="container blocScroll">

		<!-- Ligne d'entête -->
		<div class="row enteteRubrique">
			<h1>Administrateur</h1>
		</div>

		<div class="col-xs-12">
			<!-- Ligne des créations -->
			<div class="row">

				<div class="col-xs-4"></div>

				<!-- Création d'un Administratif -->
				<div class="col-xs-4 cadreFormulaire">
					<div class="row">
						<h3>Créer un administratif</h3>
					</div>
					<form class="form" action="adminif.php" method="post">
						<!-- Nom du prof -->
						<label for="nomAdminif">Nom :</label><br>
						<input type="text" class="form-control" id="nomAdminif" name="nomAdminif" minlength="2" placeholder="Entrez un nom" required>

						<!-- Prenom du prof -->
						<label for="prenomAdminif">Prénom :</label><br>
						<input type="text" class="form-control" id="prenomAdminif" name="prenomAdminif" minlength="2" placeholder="Entrez un prenom" required>

						<!-- Login du prof -->
						<label for="loginAdminif">Login de l'administratif :</label><br>
						<input type="text" class="form-control" id="loginAdminif" name="loginAdminif" minlength="2" placeholder="Entrez un login" required>

						<!-- Mdp du prof -->
						<label for="mdpAdminif">Mot de passe de l'administratif (8 caractères minimum) :</label><br>
						<div class="input-group">
      				<input type="password" class="form-control" id="mdpAdminif" name="mdpAdminif" minlength="8" placeholder="Entrez un mot de passe" required>
      				<span class="input-group-btn">
        			<button class="btn btn-default form-control afficheMdp" type="button"><i class="far fa-eye"></i></button>
      				</span>
    				</div><br>

						<button type="submit" class="btn btn-default bouton">Valider</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script src="../jquery/JQuery.js"></script>
	<script src="../jquery/javascript.js"></script>
</body>
</html>
