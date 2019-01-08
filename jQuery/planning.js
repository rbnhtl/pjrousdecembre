/* Génère un emploi du temps placeholder au chargement de la page */
function generate() {
    var tasks = []; // Création de la liste des tâches

    // Pour tous les jours de la semaine
    for (var i = 0; i < 5; i++) {
        var startTime = 5.5;
        var duration = 0.5;

        // Pour 5 tâches par jour
        for (var j = 0; j < 5; j++) {

            // Génération de l'horaire de début
            start = Math.random() * 10;
            if (start > 7.5) {
                startTime += 0.75 + duration;
            } else if (start > 0.5) {
                startTime += 0.5 + duration;
            } else if (start > 2.5) {
                startTime += 0.25 + duration;
            } else {
                startTime += duration;
            }

            // Génération de la durée de la tâche
            duration = Math.ceil(Math.random() * 2) + (Math.random() * 10 > 5 ? 0 : 0.5);

            // Gestion débordement : si horaire de fin > à 24h
            duration -= startTime + duration > 24 ? (startTime + duration) - 24 : 0; 

            // S'assure qu'on ne déborde pas de 18h30
            if (startTime + duration > 17.5) {
                break;
            }

            // Création de la tâche
            var task = {
                startTime: startTime,
                duration: duration,
                column: i,
                id: '' + i + j,
                title: 'Cours ' + i + '.' + j,
                teacher: 'Mr.LeProf'
            };

            tasks.push(task); // Et ajout à la liste
        }
    }

    // Remplissage de l'emploi du temps avec les tâches générées
    $("#scheduler-container").scheduler({
        headers: ["Lundi 01/01", "Mardi 02/01", "Mercredi 03/01", "Jeudi 04/01", "Vendredi 05/01"],
        tasks: tasks,
        cardTemplate: '<div>${title}</div><div>${teacher}</div>',
        onClick: function (e, t) { affichePopup(); }
    });
}

// Re-remplit l'emploi du temps avec les cours correspondants à la sélection du groupe et de la semaine
$("#wk").change(function(){
    var laSem = $(this).val();   // Récupération de la semaine sélectionnée
    var leGrp = $('#grp').val(); // Récupération du groupe sélectionné

    $.ajax({
        url: '../ajax/ajaxPlanning.php',
        type: 'post',
        data: {week : laSem,    // Envoi de la semaine
               grp  : leGrp},   // Et du groupe
        dataType: 'json',
        success:function(response){

            $("#scheduler-container").empty(); // On vide l'emploi du temps

            var len = response.length; // On récupère le nombre de cours résultats

            var tasks = []; // Création du tableau des tâches

            for( var i = 0; i < len; i++){
                // Récupération de toutes les données pour chaque cours résultat
                var debut = response[i]['debut'];
                var fin = response[i]['fin'];
                var jour = response[i]['jour'];
                var id = response[i]['id'];
                var matiere = response[i]['matiere'];
                var salle = response[i]['salle'];

                // Création de la tâche correspondant au cours courant
                var task = {
                    startTime: debut,
                    duration: (fin - debut),
                    column: jour - 1,
                    id: id,
                    title: matiere,
                    salle: salle
                };
    
                tasks.push(task); // Ajout de la tâche au tableau
            }

            // Re-remplissage de l'emploi du temps avec le tableau de tâches généré
            $("#scheduler-container").scheduler({
                headers: ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi"],
                tasks: tasks,
                // L'input permet de récupérer l'id du cours pour pouvoir gérer les absences
                cardTemplate: '<div>${title}</div><div>${salle}</div><input type="hidden" value=${id} name="id"/>',
                onClick: function (e, t) { affichePopup(); }
            });
        }
    });
});
