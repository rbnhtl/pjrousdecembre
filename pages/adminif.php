<?php session_start();
	
    // On récupère l'entity manager de l'orm doctrine
	require_once "../bootstrap.php";

	require_once "../DAO/departementDAO.php";
	require_once "../DAO/roleDAO.php";
	require_once "../utils/import_etudiant.php";

	// Redirection vers l'index s'il n'y a pas eu connexion ou si les droits ne sont pas corrects
	if ($_SESSION['role']!="administratif" && $_SESSION['role']!="administrateur") {
			header('Location: ../index.php');
			exit();
	}

	if(isset($_POST["formCreerDep"])){
		creerDepartement($_POST["nomDep"]);
	}
	if(isset($_POST["formCreerFiliere"])){
		creerFiliere($_POST["nomFiliere"], $_POST["choixDepartement"]);
	}
	if(isset($_POST["formCreerProf"])){
		creerProfesseur($_POST["nomProf"], $_POST["prenomProf"], $_POST["loginProf"], $_POST["mdpProf"]);
	}
	if(isset($_POST["formImportCSV"])){
		importEtudiant("fichierCSV");
	}

?>

<html>
<head>
	<meta charset="utf-8" />
	<title>Administratif</title>
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
									
			<div class="col-xs-11"><h1>Gestion des Filières</h1></div>
			
			<div class="dropdown col-xs-1"><h1>
				<button class="btn btn-default boutonMenu dropdown-toggle" type="button" data-toggle="dropdown"><i class="fas fa-bars"></i></button>
				<ul class="dropdown-menu dropdown-menu-right">
				<li><a href="liste.php">Listes</a></li>
				<li><a href="planning.php">Planning</a></li>
				<?php
					if($_SESSION["role"]=="administrateur"){
						echo '<li><a href="admin.php">Administrateur</a></li>';
					}
				?>	
				<li><a href="../index.php">Deconnexion</a></li>
				</ul></h1>
			</div>
		</div>

		<div class="col-xs-12">
			<!-- Ligne des créations -->
			<div class="row">

				<!-- Création d'un département -->
				<div class="col-xs-4 cadreFormulaire">
					<div class="row">
						<h3>Créer un département</h3>
					</div>
					<form class="form" action="adminif.php" method="post">
						<!-- Nom du département -->
						<label for="nomDep">Nom du département :</label><br>
						<input type="text" class="form-control" id="nomDep" name="nomDep" minlength="3" placeholder="Entrez un nom" required><br>
						<button type="submit" class="btn btn-default bouton" name="formCreerDep">Valider</button>
					</form>
				</div>

				<!-- Création d'une filière -->
				<div class="col-xs-4 cadreFormulaire">
					<div class="row">
						<h3>Créer une filière</h3>
					</div>
					<form class="form" action="adminif.php" method="post">
						<!-- Choix du département -->
						<label for="choixDepartement">Département :</label><br>
						<select class="form-control" name="choixDepartement" required>
							<?php
								$departements = findAllDepartement();

								echo("<option value='defaut'></option>");
								foreach($departements as $dep){
									$idDep = $dep->getId();
									$libelleDep = $dep->getLibelle();
									echo("<option value='$idDep'>$libelleDep</option>");
								}
							?>
						</select>
						<!-- Nom de la filière -->
						<label for="nomFiliere">Nom de la filière :</label><br>
						<input type="text" class="form-control" id="nomFiliere" name="nomFiliere" minlength="3" placeholder="Entrez un nom" required><br>

						<button type="submit" class="btn btn-default bouton" name="formCreerFiliere">Valider</button>
					</form>
				</div>

				<!-- Création d'un prof -->
				<div class="col-xs-4 cadreFormulaire">
					<div class="row">
						<h3>Créer un professeur</h3>
					</div>
					<form class="form" action="adminif.php" method="post">
						<!-- Nom du prof -->
						<label for="nomProf">Nom :</label><br>
						<input type="text" class="form-control" id="nomProf" name="nomProf" minlength="2" placeholder="Entrez un nom" required>

						<!-- Prenom du prof -->
						<label for="prenomProf">Prénom :</label><br>
						<input type="text" class="form-control" id="prenomProf" name="prenomProf" minlength="2" placeholder="Entrez un prenom" required>

						<!-- Login du prof -->
						<label for="loginProf">Login du professeur :</label><br>
						<input type="text" class="form-control" id="loginProf" name="loginProf" minlength="2" placeholder="Entrez un login" required>

						<!-- Mdp du prof -->
						<label for="mdpProf">Mot de passe du professeur (8 caractères minimum) :</label><br>
						<div class="input-group">
      				<input type="password" class="form-control" id="mdpProf" name="mdpProf" minlength="8" placeholder="Entrez un mot de passe" required>
      				<span class="input-group-btn">
        			<button class="btn btn-default form-control afficheMdp" type="button"><i class="far fa-eye"></i></button>
      				</span>
    				</div><br>

						<button type="submit" class="btn btn-default bouton" name="formCreerProf">Valider</button>
					</form>
				</div>
			</div>


			<!-- Ligne des imports/suppressions -->
			<div class="row">
				<!-- Import des CSV -->
				<div class="col-xs-4 cadreFormulaireRow2">
					<div class="row">
						<h3>Importer les élèves (fichier CSV)</h3>
					</div>
					<form class="form" action="adminif.php" method="post" enctype="multipart/form-data">

						<!-- Choix du fichier à importer -->
						<label for="fichierCSV">Fichier CSV :</label><br>
						<div class="upload-btn-wrapper">
							<button class="btn btn-default form-control bouton">Choisir un fichier</button>
							<input type="file" id="fichierCSV" name="fichierCSV" accept=".csv" required />
						</div><br><br>

						<button type="submit" class="btn btn-default bouton" name="formImportCSV">Valider</button>
					</form>
				</div>

				<!-- Import des ICS -->
				<div class="col-xs-4 cadreFormulaireRow2">
					<div class="row">
						<h3>Importer les plannings (fichier ICS)</h3>
					</div>
					<form class="form" action="importICS.php" method="post" enctype="multipart/form-data">
						<!-- Choix du fichier à importer -->
						<label for="fichierICS">Fichier ICS :</label><br>
						<div class="upload-btn-wrapper">
							<button class="btn btn-default form-control bouton">Choisir un fichier</button>
							<input type="file" id="fichierICS" name="fichierICS" accept=".ics" required />
						</div><br><br>

						<button type="submit" class="btn btn-default bouton" name="formImportICS">Valider</button>
					</form>
				</div>

				<!-- Suppression d'un planning -->
				<div class="col-xs-4 cadreFormulaireRow2">
					<div class="row">
						<h3>Supprimer un planning</h3>
					</div>
					<form class="form" action="adminif.php" method="post" enctype="multipart/form-data">
						<!-- Choix du département -->
						<label for="choixDepartement">Département :</label><br>
						<select class="form-control" name="choixDepartement" required>
							<?php
								$departements = findAllDepartement();

								echo("<option value='defaut'></option>");
								foreach($departements as $dep){
									$idDep = $dep->getId();
									$libelleDep = $dep->getLibelle();
									echo("<option value='$idDep'>$libelleDep</option>");
								}
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

						<!-- Date de début -->
						<label for="datemin">Date de début :</label><br>
						<input type="date" class="form-control" id="datemin" required>

						<!-- Date de fin -->
						<label for="datemax">Date de fin :</label><br>
						<input type="date" class="form-control" id="datemax" required><br>

						<button type="submit" class="btn btn-default bouton">Valider</button>
					</form>

				</div>
			</div>
		</div>
	</div>

	<script src="../jquery/jquery-3.3.1.min.js"></script>
	<script src="../jquery/javascript.js"></script>
</body>
</html>

<?php

	/**
	 * Permet d'ajouter un nouveau département à la base de données
	 * @param libelle libelle du département à créer
	 */
	function creerDepartement($libelle){
		global $em;

		$newDepartement = new Departement($libelle);
		$em->persist($newDepartement);
		$em->flush();
	}

	/**
	 * Permet de créer une nouvelle filière
	 * @param libelle libelle de la nouvelle filière
	 * @param departement departement auquel appartient la nouvelle filiere
	 */
	function creerFiliere($libelle, $idDep){
		global $em;

		$departement = findDepartement($idDep);
		$newFiliere = new Filiere($departement, $libelle, null);
		$em->persist($newFiliere);
		$em->flush();
	}

	/**
		 * Ajoute un professeur à la base de données
		 * @param nom nom du professeur à ajouter
		 * @param prenom prenom du professeur à ajouter
		 * @param login login du professeur à ajouter
		 * @param mdp mdp du professeur à ajouter
		 */
		function creerProfesseur($nom, $prenom, $login, $mdp){

			// On créé le prof
			global $em;
			$newPersonnel = new Personnel($login, $mdp, $nom, $prenom);
			$em->persist($newPersonnel);
			$em->flush();

			// On lie le prof au rôle professeur grâce à la relation remplit
			$role = findRoleByLibelle("professeur");
			$newRemplit = new Remplit();
			$newRemplit->setPersonnel($newPersonnel);
			$newRemplit->setRole($role);
			$em->persist($newRemplit);
			$em->flush();
		}
?>
