<?php session_start();
	
    // On récupère l'entity manager de l'orm doctrine
	require_once "../bootstrap.php";

	require_once "../DAO/departementDAO.php";

	// On vérifie qu'un utilisateur est bien connecté, sinon retour à la page de connexion
    if ( !isset($_SESSION["role"]) ) {
        header('Location: ../index.php');
    }
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
									<option value="fil1">INFO1</option>
									<option value="fil2">INFO2</option>
									<option value="fil3">MMS</option>
									<option value="fil4">MIAGE</option>
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
									<option value="fil4">MIAGE</option>
							</select>

							<!-- Choix du groupe -->
							<label for="choixGroupe">Groupe :</label><br>
							<select class="form-control" name="choixGroupe" required>
									<option value="defaut"></option>
									<option value="grp1">INFO1TD01</option>
									<option value="grp2">INFO1TD02</option>
									<option value="grp3">INFO1CM01</option>
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
									<option value="grp3">INFO1CM01</option>
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
				<thead>
					<tr>
						<th>Firstname</th>
						<th>Lastname</th>
						<th>Email</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>John</td>
						<td>Doe</td>
						<td>john@example.com</td>
					</tr>
					<tr>
						<td>Mary</td>
						<td>Moe</td>
						<td>mary@example.com</td>
					</tr>
					<tr>
						<td>July</td>
						<td>Dooley</td>
						<td>july@example.com</td>
					</tr>
				</tbody>
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
