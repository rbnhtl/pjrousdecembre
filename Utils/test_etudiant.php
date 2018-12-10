<!DOCTYPE html>
<HTML lang="fr">
	<HEAD>
		<meta charset="utf-8" />
		<TITLE>Page principal</TITLE>
		<META NAME="Description" CONTENT="Ma page">
		<META NAME="Keywords" CONTENT="IUT, Rodez">
	</HEAD>
	<BODY>
		<!-- Contenu de la page -->
		<p>Veuillez ajoutez votre fichier csv : </p>
		<form method="post" enctype="multipart/form-data" action="import_etudiant.php">
			<p>
				<input name="userfile" type="file" value="table" />
			</p>
			<p>	
				<input name="submit" type="submit" value="Importer" />
			</p>
		</form>
	</BODY>
</HTML>