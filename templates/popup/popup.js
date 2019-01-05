function affichePopup() {

    var overlay = $('.overlay');

    $('.popup-button').each(function(i, el) {
        var modal = $('#popup');
        var close = $('.close');

        // Fonction qui enleve la classe .show de la popup pour la faire disparaitre
        function removeModal() {
            modal.removeClass('show');
        }

        // Au clic sur le bouton on ajoute la classe .show a la div de la popup qui permet au CSS3 de prendre le relai
        $(el).click(function() {
            modal.addClass('show');
            overlay.unbind("click");
            // On ajoute sur l'overlay la fonction qui permet de fermer la popup
            overlay.bind("click", removeModal);
        });

        // En cliquant sur le bouton close on ferme tout et on arrête les fonctions
        close.click(function(event) {
            event.stopPropagation();
            removeModal();
        });
    });

};
