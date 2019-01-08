$(document).ready(function(){

    /* ----- Gestion pour la liste des matières ----- */
    // Remplit la liste des filières avec les valeurs adéquates lors de la sélection du département
    $("#departementMatiere").change(function(){
        var leDep = $(this).val(); // Récupération de la valeur sélectionnée

        $.ajax({
            url: '../ajax/ajaxFiliere.php',
            type: 'post',
            data: {dep : leDep},
            dataType: 'json',
            success:function(response){

                var len = response.length;

                $("#filiereMatiere").empty(); // On vide le select des options actuelles
                $("#filiereMatiere").append('<option value="defaut"></option>');

                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var lib = response[i]['libelle'];

                    // Et on remplit avec les nouvelles
                    $("#filiereMatiere").append('<option value="'+id+'">'+lib+'</option>');

                }
            }
        });
    });

    /* ----- Gestion pour la liste des étudiants ----- */
    // Remplit la liste des filières avec les valeurs adéquates lors de la sélection du département
    $("#departementEtudiant").change(function(){
        var leDep = $(this).val(); // Récupération de la valeur sélectionnée

        $.ajax({
            url: '../ajax/ajaxFiliere.php',
            type: 'post',
            data: {dep : leDep},
            dataType: 'json',
            success:function(response){

                var len = response.length;

                $("#filiereEtudiant").empty(); // On vide le select des options actuelles
                $("#filiereEtudiant").append('<option value="defaut"></option>');
                $("#groupeEtudiant").empty();
                $("#groupeEtudiant").append('<option value="defaut"></option>');

                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var lib = response[i]['libelle'];

                    // Et on remplit avec les nouvelles
                    $("#filiereEtudiant").append('<option value="'+id+'">'+lib+'</option>');

                }
            }
        });
    });
    // Remplit la liste des groupes avec les valeurs adéquates lors de la sélection de la filière
    $("#filiereEtudiant").change(function(){
        var laFil = $(this).val(); // Récupération de la valeur sélectionnée

        $.ajax({
            url: '../ajax/ajaxGroupe.php',
            type: 'post',
            data: {fil : laFil},
            dataType: 'json',
            success:function(response){

                var len = response.length;

                $("#groupeEtudiant").empty(); // On vide le select des options actuelles
                $("#groupeEtudiant").append('<option value="defaut"></option>');

                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var lib = response[i]['libelle'];

                    // Et on remplit avec les nouvelles
                    $("#groupeEtudiant").append('<option value="'+id+'">'+lib+'</option>');

                }
            }
        });
    });

    /* ----- Gestion pour la liste des absences ----- */
    // Remplit la liste des filières avec les valeurs adéquates lors de la sélection du département
    $("#departementAbsence").change(function(){
        var leDep = $(this).val(); // Récupération de la valeur sélectionnée

        $.ajax({
            url: '../ajax/ajaxFiliere.php',
            type: 'post',
            data: {dep : leDep},
            dataType: 'json',
            success:function(response){

                var len = response.length;

                $("#filiereAbsence").empty(); // On vide le select des options actuelles
                $("#filiereAbsence").append('<option value="defaut"></option>');
                $("#groupeAbsence").empty();
                $("#groupeAbsence").append('<option value="defaut"></option>');
                $("#matiereAbsence").empty();
                $("#matiereAbsence").append('<option value="defaut"></option>');

                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var lib = response[i]['libelle'];

                    // Et on remplit avec les nouvelles
                    $("#filiereAbsence").append('<option value="'+id+'">'+lib+'</option>');

                }
            }
        });
    });
    // Remplit la liste des groupes avec les valeurs adéquates lors de la sélection de la filière
    $("#filiereAbsence").change(function(){
        var laFil = $(this).val(); // Récupération de la valeur sélectionnée

        $.ajax({
            url: '../ajax/ajaxGroupe.php',
            type: 'post',
            data: {fil : laFil},
            dataType: 'json',
            success:function(response){

                var len = response.length;

                $("#groupeAbsence").empty(); // On vide le select des options actuelles
                $("#groupeAbsence").append('<option value="defaut"></option>');

                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var lib = response[i]['libelle'];

                    // Et on remplit avec les nouvelles
                    $("#groupeAbsence").append('<option value="'+id+'">'+lib+'</option>');

                }
            }
        });
    });
    // Remplit la liste des matières avec les valeurs adéquates lors de la sélection de la filière
    $("#filiereAbsence").change(function(){
        var laFil = $(this).val(); // Récupération de la valeur sélectionnée

            console.log('ça marche');
        $.ajax({
            url: '../ajax/ajaxMatiere.php',
            type: 'post',
            data: {fil : laFil},
            dataType: 'json',
            success:function(response){
                var len = response.length;

                $("#matiereAbsence").empty(); // On vide le select des options actuelles
                $("#matiereAbsence").append('<option value="defaut"></option>');

                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var lib = response[i]['libelle'];

                    // Et on remplit avec les nouvelles
                    $("#matiereAbsence").append('<option value="'+id+'">'+lib+'</option>');

                }
            }
        });
    });
});
