$(function () {
//    Menu responsivo

    var tes = 0;
    $("#icone_reponsivo").on('click', function () {
        if (tes == 0) {
            $('#teste').removeClass('menu_smartphone');
            $('#teste').addClass('menu_smartphone_abrir');

            $('#item_menu').removeClass('esconder');
            $('#item_menu').addClass('menu_smartphone_esconde_menu_ver');
            tes = 1;
        } else {
            $('#teste').addClass('menu_smartphone');
            $('#teste').removeClass('menu_smartphone_abrir');

            $('#item_menu').addClass('esconder');
            $('#item_menu').removeClass('menu_smartphone_esconde_menu_ver');
            tes = 0;
        }
    });



});

