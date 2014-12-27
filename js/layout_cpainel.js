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


    // Confirmação da exclusão da disciplina
    $('#modelExcluirDisciplina').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('disciplina') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        //modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('#disciplina_excluir').val(recipient)
    });
    // Visualização da descrição da diciplina.
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
    // Confirmação de exclusão de turma
    $('#modelExcluirTurma').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('turma') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        //modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('#turma_excluir').val(recipient)
    });


    //    Autocomplete pesquisa aluno para cadastra novo aluno 
    $("#ipt_aluno").autocomplete({
        minLength: 2,
        source: function (request, response) {
            var turma = $("#turma").val();
            $('#imag_carrgando').html('Carregando...');
            $.ajax({
                url: Config.base_url("cpainel/aluno/obter_alunos_cadastrados"),
                dataType: "json",
                data: {
                    q: request.term,
                    turma: turma
                },
                success: function (data) {
                    $('tbody tr').remove();
                    $('#imag_carrgando').html('');
                    if (data.length == 0) {
                        $('#imag_carrgando').html('<div class="alert alert-danger" role="alert">Aluno não encontrado!</div>');
                    } else {
                        var linhasTabela;


                        for (var n = 0; n <= data.length; n++) {

                            var objeto = data[n];

                            linhasTabela =
                                    '<tr id="linha_aluno_' + objeto.id_aluno + '">' +
                                    '<td>' + objeto.nome_aluno + '</td>' +
                                    '<td>' + objeto.matricula_aluno + '</td>' +
                                    '<td>' + objeto.cpf_aluno + '</td>' +
                                    '<td><button type="button" onclick="Aluno.incluir_aluno_existente_turma(' + objeto.id_aluno + ',' + turma + ') " class="btn btn-large btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></td>' +
                                    '</tr>';

                            $("#tbl_resultado").append(linhasTabela);
                        }
                    }
                }
            });
        }
    });
    //    Fim do autocomplenta

    // Confirmação de exclusão de aluno na turma
    $('#modelExcluirAlunoTurma').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var aluno = button.data('aluno') // Extract info from data-* attributes
        var turma = button.data('turma') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        //modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('#aluno_excluir').val(aluno)
        modal.find('#turma_excluir').val(turma)
    });


});

