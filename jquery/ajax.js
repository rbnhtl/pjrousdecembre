$(document).ready(function(){

    // Re-remplit la liste des filières avec les valeurs adéquate lors de la sélection du département
    $("#dep").change(function(){
        var leDep = $(this).val(); // Récupération de la valeur sélectionnée

        $.ajax({
            url: '../pages/ajaxPlanning.php',
            type: 'post',
            data: {dep : leDep},
            dataType: 'json',
            success:function(response){

                var len = response.length;

                $("#fil").empty(); // On vide le select des options actuelle
                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var lib = response[i]['libelle'];

                    // Et on remplit avec les nouvelles
                    $("#fil").append('<option value="'+id+'">'+lib+'</option>');

                }
            }
        });
    });

});
