/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// checa se o documento foi carregado
$(document).ready(function () {
    // define o que acontece quando #link_abre é clicado
    $("#btnNovaCategoria").click(function () {

        $("#iptNovaCategoria").animate({
                width: "100px",
                opacity: 0.4,
                marginLeft: "0",
                borderWidth : "1px",
//                borderWidth: "10px"
            }, 1500);


//            $(this).css({
//                "width": "100px",
//                "border": "1px solid #666"
//            }).focus();
        });
    });
//});

