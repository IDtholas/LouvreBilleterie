$(document).ready(function() {
    var $container = $('div#commande_tickets');

    var index = $container.find(':input').length;

    $('#add_ticket').click(function(e) {
        addTicket($container);

        e.preventDefault();
        return false;
    });
    if (index == 0) {
        addTicket($container);
    } else {
        $container.children('div').each(function() {
            addDeleteLink($(this));
        });
    }

    function addTicket($container) {
        var template = $container.attr('data-prototype')
            .replace(/__name__label__/g, 'Ticket n°' + (index+1))
            .replace(/__name__/g,        index)
        ;

        var $prototype = $(template);

        addDeleteLink($prototype);

        $container.append($prototype);

        index++;
    }

    function addDeleteLink($prototype) {
        var $deleteLink = $('<a href="#" class="btn btn-danger">Supprimer</a>');

        // Ajout du lien
        $prototype.append($deleteLink);

        $deleteLink.click(function(e) {
            $prototype.remove();

            e.preventDefault();
            return false;
        });
    }
});