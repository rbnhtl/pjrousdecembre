function generate() {
    var tasks = [];
    // Pour tous les jours de la semaine
    for (var i = 0; i < 5; i++) {
        var startTime = 7.5;
        var duration = 0.5;
        // Pour 5 tâches par jour
        for (var j = 0; j < 5; j++) {
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

            duration = Math.ceil(Math.random() * 2) + (Math.random() * 10 > 5 ? 0 : 0.5);

            duration -= startTime + duration > 24 ? (startTime + duration) - 24 : 0;

            if (startTime + duration > 18.5) {
                break;
            }

            var task = {
                startTime: startTime,
                duration: duration,
                column: i,
                id: '' + i + j,
                title: 'Cours ' + i + '.' + j,
                teacher: 'Mr.LeProf'
            };

            tasks.push(task);
        }
    }

    $("#scheduler-container").scheduler({
        headers: ["Lundi 01/01", "Mardi 02/01", "Mercredi 03/01", "Jeudi 04/01", "Vendredi 05/01"],
        tasks: tasks,
        cardTemplate: '<div>${title}</div><div>${teacher}</div>',
        onClick: function (e, t) { affichePopup(); }
    });
}
