var open=1;

//Fonction de démarrage de la page
$(function() {

    $('#listeAbsence').css("visibility", "visible");
    $('#listeAbsence').css("height", "520px");
    $('#listeEtudiant').css("visibility", "hidden");
    $('#listeEtudiant').css("height", "0px");
    $('#listeMatiere').css("visibility", "hidden");
    $('#listeMatiere').css("height", "0px");
    $('#zoneAffichListe').css("height", "743px");

    $('#dpmin').attr({format: "dd/mm/yyyy"});
    $('#dpmax').attr({format: "dd/mm/yyyy"});

    $('#listeAbsenceHover').mouseover(
        function() {
            if(open!=1){
                $('#listeAbsenceHover').css("background-color","#7B9BA6");
            }
        }).mouseout(
        function() {
            $('#listeAbsenceHover').css("background-color","#EEF4F2");
        }
    );

    $('#listeEtudiantHover').mouseover(
        function() {
            if(open!=2){
                $('#listeEtudiantHover').css("background-color","#7B9BA6");
            }
        }).mouseout(
        function() {
            $('#listeEtudiantHover').css("background-color","#EEF4F2");
        }
    );

    $('#listeMatiereHover').mouseover(
        function() {
            if(open!=3){
                $('#listeMatiereHover').css("background-color","#7B9BA6");
            }
        }).mouseout(
        function() {
            $('#listeMatiereHover').css("background-color","#EEF4F2");
        }
    );

});

function clicAbsence(){
    open=1;
    $('#listeAbsence').css("visibility", "visible");
    $('#listeAbsence').css("height", "520px");
    $('#listeEtudiant').css("visibility", "hidden");
    $('#listeEtudiant').css("height", "0px");
    $('#listeMatiere').css("visibility", "hidden");
    $('#listeMatiere').css("height", "0px");

    $('#zoneAffichListe').css("height", "743px");

    $('.blocScroll').css("overflow", "scroll");
}

function clicEtudiant(){
    open=2;
    $('#listeAbsence').css("visibility", "hidden");
    $('#listeAbsence').css("height", "0px");
    $('#listeEtudiant').css("visibility", "visible");
    $('#listeEtudiant').css("height", "315px");
    $('#listeMatiere').css("visibility", "hidden");
    $('#listeMatiere').css("height", "0px");

    $('#zoneAffichListe').css("height", "538px");

    $('.blocScroll').css("overflow", "hidden");
}

function clicMatiere(){
    open=3;
    $('#listeAbsence').css("visibility", "hidden");
    $('#listeAbsence').css("height", "0px");
    $('#listeEtudiant').css("visibility", "hidden");
    $('#listeEtudiant').css("height", "0px");
    $('#listeMatiere').css("visibility", "visible");
    $('#listeMatiere').css("height", "240px");

    $('#zoneAffichListe').css("height", "464px");

    $('.blocScroll').css("overflow", "hidden");
}
