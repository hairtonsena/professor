$(function () {
    $("#tabelaCategoria tbody tr td.editavel").dblclick(function () {
        var conteudoOriginal = $(this).text();
        var campo = $(this).attr('title');
        var id = $(this).parent().attr('id');
        $(this).html("<input type='text' class='form-control has-error' value='" + conteudoOriginal + "' />");
        $(this).children().first().focus();
        $(this).children().first().keypress(function (e) {
            if (e.which == 13) {
                var novoConteudo = $(this).val();
                var obj = $(this);
                $.ajax({
                    type: "post",
                    url: "http://localhost/siteservico/cpainel/categoria/alterar_nome_categoria",
                    data: {
                        id_c: id,
                        campo_c: campo,
                        nome_c: novoConteudo
                    },
                    success: function (retorno) {
                        if (retorno === '1') {
                            $(obj).parent().text(novoConteudo);
                        } else {
                            alert(retorno);
                        }
                    }
                });
            }
        });
        $(this).children().first().blur(function () {
            $(this).parent().text(conteudoOriginal);
        });
    });

    $("#editar").click(function () {
        
        var editar = $(this).parent().parent().parent().children().first();
        var conteudoOriginal = editar.text();
        
       // alert(conteudoOriginal);
        var campo = editar.attr('title');
        var id = editar.parent().attr('id');
        editar.html("<input type='text' class='form-control has-error' value='" + conteudoOriginal + "' />");
        editar.children().first().focus();
        editar.children().first().keypress(function (e) {
            if (e.which == 13) {
                var novoConteudo = $(this).val();
                var obj = $(this);
                $.ajax({
                    type: "post",
                    url: "http://localhost/siteservico/cpainel/categoria/alterar_nome_categoria",
                    data: {
                        id_c: id,
                        campo_c: campo,
                        nome_c: novoConteudo
                    },
                    success: function (retorno) {
                        if (retorno === '1') {
                            $(obj).parent().text(novoConteudo);
                        } else {
                            alert(retorno);
                        }
                    }
                });
            }
        });
        editar.children().first().blur(function () {
            $(this).parent().text(conteudoOriginal);
        });
    });
});
