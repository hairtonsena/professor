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



    $('#modelExcluirDisciplina').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('disciplina') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        //modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('#disciplina_excluir').val(recipient)
    });

    $('#modelVerDescricaDisciplina').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('disciplina') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        // var modal = $(this)
        //modal.find('.modal-title').text('New message to ' + recipient)

        var parametro = "disciplina=" + recipient;
        var pg = Config.base_url('cpainel/disciplina/ver_descricao_disciplina');
        $.ajax({
            type: "post",
            url: pg,
            data: parametro,
            success: function (retorno) {
                $('#textoDescricao_disciplina').html(retorno);
            }
        });
    });

    $('#modelExcluirTurma').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('turma') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        //modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('#turma_excluir').val(recipient)
    });

});

