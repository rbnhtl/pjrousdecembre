<html>
<head>
	<meta charset="utf-8" />
	<title>Planning</title>
	<link href="../style/bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
	<link href="../style/fontawesome-5.6.1/css/all.css" rel="stylesheet"/>
	<link href="../style/style.css" rel="stylesheet"/>
</head>
<body>
	<!-- Début du contenu de la page -->
	<div class="container bloc">

		<!-- Ligne d'entête -->
		<div class="row enteteRubrique">
			<h1>Le planning de la semaine</h1>
		</div>

		<!-- Ligne d'affichage du planning -->
		<div class="row">

            <!-- Menu de sélection du groupe d'étudiants -->
			<div class="col-xs-3 menuPlanning">

                <!-- Menu de sélection du groupe -->
                <div class="col-xs-12 sousMenuPlanning">
                    <br/>
                    Dépatement<br/>
                    <select class="" name="departement">
                        <option value="defaut"></option>
                        <option value="dep1">Informatique</option>
                        <option value="dep2">QLIO</option>
                        <option value="dep3">Info-com</option>
                        <option value="dep4">GEA</option>
                        <option value="dep5">Carrière juridique</option>
                    </select><br/><br/>
                    Groupe<br/>
                    <select class="" name="groupe">
                        <option value="defaut"></option>
                        <option value="gr1">DUT 1</option>
                        <option value="gr2">DUT 2</option>
                        <option value="gr3">LP MMS</option>
                    </select><br/><br/>
                </div>

                <!-- Menu de sélection de la semaine -->
                <div class="col-xs-12 sousMenuPlanning">
                    <br/>
                    Semaine<br/>
                    <select class="" name="departement">
                        <option value="defaut"></option>
                        <option value="dep1">Informatique</option>
                        <option value="dep2">QLIO</option>
                        <option value="dep3">Info-com</option>
                        <option value="dep4">GEA</option>
                        <option value="dep5">Carrière juridique</option>
                    </select><br/><br/>
                </div>

            </div>

            <!-- Affichage du planning d'une semaine -->
            <div class="col-xs-9">
                <br/>
                <table class="table table-striped planning">
                    <tr><td></td><td>Lundi</td><td>Mardi</td><td>Mercredi</td><td>Jeudi</td><td>Vendredi</td></tr>
                    <tr><td>08h00</td><td></td><td></td><td></td><td></td><td></td></tr>
                    <tr><td>09h00</td><td></td><td></td><td></td><td></td><td></td></tr>
                    <tr><td>10h00</td><td></td><td></td><td></td><td></td><td></td></tr>
                    <tr><td>11h00</td><td></td><td></td><td></td><td></td><td></td></tr>
                    <tr><td>12h00</td><td></td><td></td><td></td><td></td><td></td></tr>
                    <tr><td>13h00</td><td></td><td></td><td></td><td></td><td></td></tr>
                    <tr><td>14h00</td><td></td><td></td><td></td><td></td><td></td></tr>
                    <tr><td>15h00</td><td></td><td></td><td></td><td></td><td></td></tr>
                    <tr><td>16h00</td><td></td><td></td><td></td><td></td><td></td></tr>
                    <tr><td>17h00</td><td></td><td></td><td></td><td></td><td></td></tr>
                    <tr><td>18h00</td><td></td><td></td><td></td><td></td><td></td></tr>
                    <tr><td>19h00</td><td></td><td></td><td></td><td></td><td></td></tr>
                </table>
                <br/>
            </div>
		</div>

	</div>
</body>
</html>
