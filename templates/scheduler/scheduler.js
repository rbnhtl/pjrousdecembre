(function ($) {
    var defaultSettings = {
        // Data attributes
        headers: [],  // String[] - Array of column headers
        tasks: [],    // Task[] - Array of tasks. Required fields:
        // id: number, startTime: number, duration: number, column: number

        // Card template - Inner content of task card.
        // You're able to use ${key} inside template, where key is any property from task.
        cardTemplate: '<div>${id}</div>',

        // OnClick event handler
        onClick: function (e, task) { },

        // Css classes
        containerCssClass: 'scheduler-container',
        headerContainerCssClass: 'scheduler-headers',
        schedulerContainerCssClass: 'scheduler-main',
        taskPlaceholderCssClass: 'scheduler-task-placeholder',
        cellCssClass: 'scheduler-cell',

        lineHeight: 30,      // height of one half-hour line in grid
        borderWidth: 1,      // width of board of grid cell

        debug: false
    };

    var settings = {};

    /* Convert double value of hours to zero-preposited string with 15, 30, 45 or 00 value of minutes */
    function toTimeString(value) {
        minute = value - parseInt(value);
        minSting = '';
        if (minute >= 0.75) {
            minSting = ':45';
        } else if (minute >= 0.5) {
            minSting = ':30';
        } else if (minute >= 0.25) {
            minSting = ':15';
        } else {
            minSting = ':00';
        }
        return (value < 10 ? '0' : '') + Math.floor(value) + minSting;
    }

    /* Return height of task card based on duration of the task duration - in hours */
    function getCardHeight(duration) {
        return (settings.lineHeight + settings.borderWidth) * (duration * 2) - 1;
    }

    /* Return top offset of task card based on start time of the task startTime - in hours */
    function getCardTopPosition(startTime) {
        /* On retire 16 demi-heure pour que le 0 corresponde à 8h */
        return (settings.lineHeight + settings.borderWidth) * ((startTime * 2) - 16);
    }

    /* Render card template */
    function renderInnerCardContent(task) {
    var result = settings.cardTemplate;
        for (var key in task) {
            if (task.hasOwnProperty(key)) {
            // TODO: replace all
                result = result.replace('${' + key + '}', task[key]);
            }
        }
        return $(result);
    }

    /* Generate task cards */
    function appendTasks(placeholder, tasks) {

        // Calucle les coefficients de chevauchement de chaque tâche
        // 0 si aucun chevauchement, sinon le nombre de tâches qui se chevauchent avec la tâche courante
        var findCoefficients = function () {
            var coefficients = [];
            // Pour chaque tâche à afficher
            for (var i = 0; i < tasks.length - 1; i++) {
                var k = 0;    // Le coeficient de la tâche en cours de traitement
                var j = i + 1;
                /* Tant que : - j est une tâche (pas d'overflow)
                              - et que la tâche i commence avant la tâche j
                              - et qu'il y a chevauchement de i sur j        */
                while (j < tasks.length && tasks[i].startTime < tasks[j].startTime
                    && tasks[i].startTime + tasks[i].duration > tasks[j].startTime) {
                    k++;
                    j++;
                }
                coefficients.push(k);
            }
            // Ajout d'un zéro à la fin pour ?
            coefficients.push(0);
            return coefficients;
        };

        var normalize = function (args) {
            var indexes = {};
            // Pour chaque argument, c'est à dire pour le coeficient de chaque tâche
            for (var i = 0; i < args.length; i++) {
                var start = i;  // Indice du coeficient courant avant traitement
                var count = 0;  // Nombre de coeficients passé
                // Tant que le coeficient est different de 0, on passe au suivant
                while (args[i] != 0) {
                    i++;
                    count++;
                }
                var end = i;   // Indice du coeficient couant après traitement
                // Si le coeficient courant valait déjà 0, et donc que count n'a pas été incrémenté
                if (count) {
                    count++;
                }
                var index = 0;
                // Tous les coeficients de l'intervalle start - end prennent la valeur de count
                for (var j = start; j <= end; j++) {
                    args[j] = count;
                    // l'index correspondant au coeficient courant est incrémenté
                    indexes[j] = index++;
                }
            }
            return {args: args, indexes: indexes};
        };

        var args =  normalize( findCoefficients() );

        for (var i = 0; i < args.args.length; i++) {
            var width = 194 / (args.args[i] || 1);
            tasks[i].width = width;
            tasks[i].left = (args.indexes[i] * width) || 4;
        }

        tasks.forEach(function (task) {
            // Mise en forme de l'affichage de chaque tâche
            var innerContent = renderInnerCardContent(task);
            var top = getCardTopPosition(task.startTime);
            var height = getCardHeight(task.duration);
            var width = task.width || 194;
            var left = task.left || 4;
            var card = $('<div></div>').attr({
                style: 'top: ' + top + 'px; height: ' + (height - 4) + 'px; ' + 'width: ' + (width - 2) + 'px; left: ' + left + 'px',
                title: task.title + ' : ' + toTimeString(task.startTime) + ' - ' + toTimeString(task.startTime + task.duration),
                class: 'popup-button'
            });
            card.on('click', function (e) { settings.onClick && settings.onClick(e, task) });
            card.append(innerContent).appendTo(placeholder);
        }, this);
    }

    /**
    * Generate scheduler grid with task cards
    * options:
    * - headers: string[] - array of headers
    * - tasks: Task[] - array of tasks
    * - containerCssClass: string - css class of main container
    * - headerContainerCssClass: string - css class of header container
    * - schedulerContainerCssClass: string - css class of scheduler
    * - lineHeight - height of one half-hour cell in grid
    * - borderWidth - width of border of cell in grid
    */
    $.fn.scheduler = function (options) {

        // On merge aux settings par defaut les options
        settings = $.extend(defaultSettings, options);

        if (settings.debug) {
            console.time('scheduler');
        }

        var schedulerEl = $(this);

        // On vide l'élément d'emploi du temps et on lui donne la bonne classe
        schedulerEl.empty();
        schedulerEl.addClass(settings.containerCssClass);

        // Initialisation d'une div vide pour pouvoir la cloner au besoin
        var div = $('<div></div>');

        /* Add headers */
        // Clonage de la div qui va servir de ligne d'entêtes
        var headerContainer = div.clone().addClass(settings.headerContainerCssClass);
        // Puis ajout des div d'entêtes de colonne à l'intérieur de celle-ci
        settings.headers.forEach(function (element) {
            div.clone().text(element).appendTo(headerContainer);
        }, this);
        // Enfin on ajouter la ligne des header à l'emploi du temps
        schedulerEl.append(headerContainer);

        /* Add schedule */
        // On créé la partie inférieure qui va contenir les tâches
        var scheduleEl = div.clone().addClass(settings.schedulerContainerCssClass);
        // La div de la colonne qui va contenir la timeline
        var scheduleTimelineEl = div.clone().addClass(settings.schedulerContainerCssClass + '-timeline');
        // Et celle qui contiendra les autres colonnes
        var scheduleBodyEl = div.clone().addClass(settings.schedulerContainerCssClass + '-body');
        // Création d'une div colonne qui servira à remplir les 2 précédentes
        var gridColumnElement = div.clone();

        /* Populate timeline */
        // Pour une plage d'horaires scolaires 8h -> 18h
        for (var i = 8; i < 19; i++) {
            // Pour chaque heure, ajout à la timeline d'une div contenant le libelle de l'heure
            div.clone().text(toTimeString(i)).appendTo(scheduleTimelineEl);
            // Et d'une div vide pour marquer la 1/2 heure qui suit
            div.clone().appendTo(scheduleTimelineEl);
            // On ajoute aussi par consequent 2 div à la colonne pour que la longueur de celle-ci corresponde à celle de la timeline
            gridColumnElement.append(div.clone().addClass(settings.cellCssClass));
            gridColumnElement.append(div.clone().addClass(settings.cellCssClass));
        }

        /* Populate grid */
        // Création d'une colonne pour chaque élément d'entête
        for (var j = 0; j < settings.headers.length; j++) {
            var el = gridColumnElement.clone();
            // Création d'une div placeholder qui contiendra les tâches à afficher
            var placeholder = div.clone().addClass(settings.taskPlaceholderCssClass);
            // Appel à la fonction appendTasks avec toutes les tâches correspondant à la colonne en cour de traitement
            appendTasks(placeholder, settings.tasks.filter(function (t) { return t.column == j }));

            // On ajoute au début de la colonne le placeholder qui permet l'affichage des tâches sur la colonne
            el.prepend(placeholder);
            // Ajout de la colonne créée à la liste des autres colonnes
            el.appendTo(scheduleBodyEl);
        }

        // Ajout à la partie inférieure de la timeline et de la liste des colonnes
        scheduleEl.append(scheduleTimelineEl);
        scheduleEl.append(scheduleBodyEl);
        // Et enfin, ajout de la partie inférieure à l'emploi du temps
        schedulerEl.append(scheduleEl);

        if (settings.debug) {
            console.timeEnd('scheduler');
        }

        return schedulerEl;
    };
}(jQuery));
