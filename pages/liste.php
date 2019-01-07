<?php session_start();
	
    // On récupère l'entity manager de l'orm doctrine
	require_once "../bootstrap.php";

	require_once "../DAO/departementDAO.php";
	require_once "../DAO/matiereDAO.php";
	require_once "../DAO/etudiantDAO.php";

	// On vérifie qu'un utilisateur est bien connecté, sinon retour à la page de connexion
    // if ( !isset($_SESSION["role"]) ) {
    //     header('Location: ../index.php');
    // }
?>

<html>
<head>
	<meta charset="utf-8" />
	<title>Listes</title>
	<link href="../style/bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
	<link href="../style/fontawesome-5.6.1/css/all.css" rel="stylesheet"/>
	<link href="../style/style.css" rel="stylesheet"/>
	<script src="../jquery/jquery-3.3.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<!-- Début du contenu de la page -->
	<div class="container blocScroll">

		<!-- Ligne d'entête -->
		<div class="row enteteRubrique">
									
			<div class="col-xs-11"><h1>Listes</h1></div>
			
			<div class="dropdown col-xs-1"><h1>
				<button class="btn btn-default boutonMenu dropdown-toggle" type="button" data-toggle="dropdown"><i class="fas fa-bars"></i></button>
				<ul class="dropdown-menu dropdown-menu-right">
				<li><a href="planning.php">Planning</a></li>
				<?php
					if($_SESSION["role"]=="administrateur" || $_SESSION["role"]=="administratif"){
						echo '<li><a href="adminif.php">Administratif</a></li>';
					}
					if($_SESSION["role"]=="administrateur"){
						echo '<li><a href="admin.php">Administrateur</a></li>';
					}
				?>					
				<li><a href="../index.php">Deconnexion</a></li>
				</ul></h1>
			</div>
		</div>

		<div class="col-xs-12">

			<!-- Colonne du menu -->
			<div class="col-xs-4">

				<!-- Liste des Matières -->
				<div class="col-xs-12 cadre" onclick="clicMatiere()" id="listeMatiereHover">
					<div class="row">
						<h3>Liste des Matières</h3>
					</div>
					<div id="listeMatiere">
						<form class="form" action="liste.php" method="post">
							<!-- Choix du département -->
							<label for="choixDepartement">Département :</label><br>
							<select class="form-control" name="choixDepartement" required>
								<?php
									afficheDepartements();
								?>
							</select>

							<!-- Choix de la filière -->
							<label for="choixFiliere">Filière :</label><br>
							<select class="form-control" name="choixFiliere" required>
									<option value="defaut"></option>
									<option value="15">INFO1</option>
									<option value="16">INFO2</option>
									<option value="18">MMS</option>
									<option value="17">MIAGE</option>
							</select><br>

							<button type="submit" class="btn btn-default bouton" name="formListMatiere">Valider</button>
						</form>
					</div>
				</div>

				<!-- Liste des Etudiant -->
				<div class="col-xs-12 cadre" onclick="clicEtudiant()" id="listeEtudiantHover">
					<div class="row">
						<h3>Liste des Etudiants</h3>
					</div>
					<div id="listeEtudiant">
						<form class="form" action="liste.php" method="post">
							<!-- Choix du département -->
							<label for="choixDepartement">Département :</label><br>
							<select class="form-control" name="choixDepartement" required>
								<?php
									afficheDepartements();
								?>
							</select>

							<!-- Choix de la filière -->
							<label for="choixFiliere">Filière :</label><br>
							<select class="form-control" name="choixFiliere" required>
									<option value="defaut"></option>
									<option value="fil1">INFO1</option>
									<option value="fil2">INFO2</option>
									<option value="fil3">MMS</option>
									<option value="1">DUT-1A-Carrières juridiques</option>
							</select>

							<!-- Choix du groupe -->
							<label for="choixGroupe">Groupe :</label><br>
							<select class="form-control" name="choixGroupe" required>
									<option value="defaut"></option>
									<option value="grp1">INFO1TD01</option>
									<option value="grp2">INFO1TD02</option>
									<option value="1">CJ1CM01</option>
							</select><br>

							<button type="submit" class="btn btn-default bouton" name="formListEtudiant">Valider</button>
						</form>
					</div>
				</div>

				<!-- Liste des absences -->
				<div class="col-xs-12 cadre"  onclick="clicAbsence()" id="listeAbsenceHover">
					<div class="row">
						<h3>Liste des Absences</h3>
					</div>
					<div id="listeAbsence">
						<form class="form" action="liste.php" method="post">
							<!-- Choix du département -->
							<label for="choixDepartement">Département :</label><br>
							<select class="form-control" name="choixDepartement" required>
								<?php
									afficheDepartements();
								?>
							</select>

							<!-- Choix de la filière -->
							<label for="choixFiliere">Filière :</label><br>
							<select class="form-control" name="choixFiliere" required>
									<option value="defaut"></option>
									<option value="fil1">INFO1</option>
									<option value="fil2">INFO2</option>
									<option value="fil3">MMS</option>
									<option value="fil4">MIAGE</option>
							</select>

							<!-- Choix du groupe -->
							<label for="choixGroupe">Groupe :</label><br>
							<select class="form-control" name="choixGroupe" required>
									<option value="defaut"></option>
									<option value="grp1">INFO1TD01</option>
									<option value="grp2">INFO1TD02</option>
									<option value="grp3">CJ1CM01</option>
							</select>

							<!-- Date de début -->
							<label for="datemin">Date de début :</label><br>
							<input type="date" class="form-control" id="datemin">

							<!-- Date de fin -->
							<label for="datemax">Date de fin :</label><br>
							<input type="date" class="form-control" id="datemax">

							<!-- Choix d'une matière -->
							<label for="choixMatiere">Matière :</label><br>
							<select class="form-control" name="choixMatiere" required>
									<option value="defaut"></option>
									<option value="mtr1">POO</option>
									<option value="mtr2">Communication</option>
									<option value="mtr3">Bases de données</option>
							</select>

							<!-- Nom d'un étudiant -->
							<label for="nomEtudiant">Nom de l'étudiant :</label><br>
							<input type="text" class="form-control" id="nomEtudiant" name="nomEtudiant" minlength="3" placeholder="Entrez un nom"><br>

							<button type="submit" class="btn btn-default bouton" name="formListAbsence">Valider</button>
						</form>
					</div>
				</div>

			</div>

			<div class="col-xs-8 cadre" id="zoneAffichListe">
			<table class="table table-striped">
				<?php
					// Si on effectue une recherche de matières par filière
					if (isset($_POST["formListMatiere"])) {
						// Par filière
						if($_POST["choixFiliere"] != "defaut"){
							$matieres = findMatieresOfFiliere($_POST["choixFiliere"]);
							echo("<thead><tr><th>Libelle de la matière</th></tr></thead>");
							foreach($matieres as $matiere){
								echo("<tbody><tr><th>".$matiere[1]."</th></tr></tbody>");
							}
						}
						// Par département
						elseif($_POST["choixDepartement"] != "defaut"){
							$matieres = findMatieresOfDepartement($_POST["choixDepartement"]);
							echo("<thead><tr><th>Libelle de la matière</th></tr></thead>");
							foreach($matieres as $matiere){
								echo("<tbody><tr><th>".$matiere[1]."</th></tr></tbody>");
							}
						}
					// Si on effectue une recherche détudiant
					} elseif (isset($_POST["formListEtudiant"])) {
						// Sans paramètres
						if($_POST["choixDepartement"] == "defaut" && $_POST["choixFiliere"] == "defaut" && $_POST["choixGroupe"] == "defaut"){
							$etudiants = findAllEtudiant();
							echo("<thead><tr><th>INE</th><th>Nom</th><th>Prénom</th></tr></thead>");
							foreach($etudiants as $etudiant){
								echo("<tbody><tr><th>".$etudiant->getIne()."</th><th>".$etudiant->getNom()."</th><th>".$etudiant->getPrenom()."</th></tr></tbody>");
							}
						// Par groupe
						} elseif($_POST["choixGroupe"] != "defaut") {
							$ineEtudiants = getEtudiantsFromGroupe($_POST["choixGroupe"]);
							echo("<thead><tr><th>INE</th><th>Nom</th><th>Prénom</th></tr></thead>");
							foreach($ineEtudiants as $ineEtudiant){
								$etudiant = findEtudiant($ineEtudiant[1]);
								echo("<tbody><tr><th>".$etudiant->getIne()."</th><th>".$etudiant->getNom()."</th><th>".$etudiant->getPrenom()."</th></tr></tbody>");
							}
						// Par filière
						} elseif($_POST["choixFiliere"] != "defaut") {
							$ineEtudiants = getEtudiantsFromFiliere($_POST["choixFiliere"]);
							echo("<thead><tr><th>INE</th><th>Nom</th><th>Prénom</th></tr></thead>");
							foreach($ineEtudiants as $ineEtudiant){
								$etudiant = findEtudiant($ineEtudiant[1]);
								echo("<tbody><tr><th>".$etudiant->getIne()."</th><th>".$etudiant->getNom()."</th><th>".$etudiant->getPrenom()."</th></tr></tbody>");
							}
						// Par département
						} else {
							$ineEtudiants = getEtudiantsFromDepartement($_POST["choixDepartement"]);
							echo("<thead><tr><th>INE</th><th>Nom</th><th>Prénom</th></tr></thead>");
							foreach($ineEtudiants as $ineEtudiant){
								$etudiant = findEtudiant($ineEtudiant[1]);
								echo("<tbody><tr><th>".$etudiant->getIne()."</th><th>".$etudiant->getNom()."</th><th>".$etudiant->getPrenom()."</th></tr></tbody>");
							}
						}
					}
				?>
			</table>
			</div>
		</div>
	</div>

	<script src="../jquery/liste.js"></script>
</body>
</html>

<?php
	function afficheDepartements(){
		
		$departements = findAllDepartement();

		echo("<option value='defaut'></option>");
		foreach($departements as $dep){
			$idDep = $dep->getId();
			$libelleDep = $dep->getLibelle();
			echo("<option value='$idDep'>$libelleDep</option>");
		}
	}
?>
