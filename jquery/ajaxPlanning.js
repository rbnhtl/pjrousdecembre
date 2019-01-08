$(document).ready(function(){

    // Re-remplit la liste des filières avec les valeurs adéquates lors de la sélection du département
    $("#dep").change(function(){
        var leDep = $(this).val(); // Récupération de la valeur sélectionnée

        $.ajax({
            url: '../ajax/ajaxFiliere.php',
            type: 'post',
            data: {dep : leDep},
            dataType: 'json',
            success:function(response){

                var len = response.length;

                $("#fil").empty(); // On vide le select des options actuelles
                $("#fil").append('<option value="defaut"> -- Select -- </option>');

                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var lib = response[i]['libelle'];

                    // Et on remplit avec les nouvelles
                    $("#fil").append('<option value="'+id+'">'+lib+'</option>');

                }
            }
        });
    });

    // Re-remplit la liste des groupes avec les valeurs adéquates lors de la sélection de la filière
    $("#fil").change(function(){
        var laFil = $(this).val(); // Récupération de la valeur sélectionnée

        $.ajax({
            url: '../ajax/ajaxGroupe.php',
            type: 'post',
            data: {fil : laFil},
            dataType: 'json',
            success:function(response){

                var len = response.length;

                $("#grp").empty(); // On vide le select des options actuelles
                $("#grp").append('<option value="defaut"> -- Select -- </option>');

                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var lib = response[i]['libelle'];

                    // Et on remplit avec les nouvelles
                    $("#grp").append('<option value="'+id+'">'+lib+'</option>');

                }
            }
        });
    });

    // Re-remplit la liste des élèves avec les valeurs adéquates lors de la sélection du groupe
    $("#grp").change(function(){
        var leGrp = $(this).val(); // Récupération de la valeur sélectionnée

        $.ajax({
            url: '../ajax/ajaxEtudiant.php',
            type: 'post',
            data: {grp : leGrp},
            dataType: 'json',
            success:function(response){

                var len = response.length;

                $("#etu").empty(); // On vide la div des etudiants actulels

                for( var i = 0; i<len; i++){
                    var ine = response[i]['ine'];
                    var nom = response[i]['nom'];
                    var prenom = response[i]['prenom'];

                    // Et on remplit avec les nouveaux
                    $("#etu").append("<div>"+nom+" "+prenom+" <input type='checkbox' name='absents[]' value='"+ine+"'/><br/></div>");

                }
            }
        });
    });

});
