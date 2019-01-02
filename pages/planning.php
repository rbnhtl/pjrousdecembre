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
    			<h1>Qui sont les abscents ?</h1>

                <!-- Menu de sélection des étudiants -->
				<form action="#" method="post">
					<div class="row listeEleves">
	                    <div>Norbert <input type="checkbox"/><br/></div>
	                    <div>Roger <input type="checkbox"/><br/></div>
	                    <div>Jean-Pierre <input type="checkbox"/><br/></div>
	                    <div>Louis <input type="checkbox"/><br/></div>
	                    <div>André <input type="checkbox"/><br/></div>
	                    <div>Paul <input type="checkbox"/><br/></div>
	                    <div>Claude <input type="checkbox"/><br/></div>
	                    <div>Michel <input type="checkbox"/><br/></div>
	                </div>
	                <button type="submit" class="btn bouton">Valider</button>
				</form>

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
			<form action="#" method="post">
	            <div class="row menu">
					<div class="col-md-4 col-sm-12">
						Département :
	                    <select class="liste" name="departement">
	                        <option value="defaut"></option>
	                        <option value="dep1">Informatique</option>
	                        <option value="dep2">QLIO</option>
	                        <option value="dep3">Info-com</option>
	                        <option value="dep4">GEA</option>
	                        <option value="dep5">Carrière juridique</option>
	                    </select>
					</div>

					<div class="col-md-4 col-sm-12">
						Groupe :
	                    <select class="liste" name="groupe">
	                        <option value="defaut"></option>
	                        <option value="gr1">DUT 1</option>
	                        <option value="gr2">DUT 2</option>
	                        <option value="gr3">LP MMS</option>
	                    </select>
					</div>

					<div class="col-md-4 col-sm-12">
						Semaine :
	                    <select class="liste" name="semaine">
	                        <option value="defaut"></option>
	                        <option value="sem1">Semaine 48</option>
	                        <option value="sem2">Semaine 49</option>
	                        <option value="sem3">Semaine 50</option>
	                        <option value="sem4">Semaine 51</option>
	                        <option value="sem5">Semaine 52</option>
	                    </select>
					</div>
	            </div>
			</form><!-- Fin menu -->

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
