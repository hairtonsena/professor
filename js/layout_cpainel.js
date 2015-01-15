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

    // Confirmação da exclusão da avaliação
    $('#modelExcluirAvaliacao').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var recipient = button.data('avaliacao');
        //var valor_nota = button.data('valor_nota')// Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        //modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('#avaliacao_excluir').val(recipient);
        //  model.find().val(valor_nota);
    });
    // Confirmação da exclusão da trabalho
    $('#modelExcluirTrabalho').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var recipient = button.data('trabalho');
        //var valor_nota = button.data('valor_nota')// Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        //modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('#trabalho_excluir').val(recipient);
        //  model.find().val(valor_nota);
    });

    // Confirmação da exclusão do anexo de trabalho
    $('#modelExcluirAnexoTrabalho').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var recipient = button.data('anexo_trabalho');
        //var valor_nota = button.data('valor_nota')// Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        //modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('#anexo_trabalho_excluir').val(recipient);
        //  model.find().val(valor_nota);
    });

    // Furmulário de alterar senha do aluno
    $('#modelSenhaAluno').on('show.bs.modal', function (event) {
        $("#erro_senha").html('');
        $('#nova_senha').val('');
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('aluno') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        //modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('#aluno').val(recipient)
    });

// Trabalho com upload de anexo
    var mensagem = $("#mensagem");
    var div_porcentagem = $("#porcentagem");
    var barra = $("#barra");
    var campoImgame = $("#arquivo");
    var textoCampoUp = $("#textoCampoUp");


    $("#btn_enviar").on('click', function (event) {
        barra.width('0%');
        barra.html('0%');

        event.preventDefault();

        if (campoImgame.val() == "") {
            mensagem.html("<div class='alert alert-danger'>Por favor, selecione uma imagem!<div>");
        } else {
            $("#form_upload").ajaxForm({
                url: Config.base_url('cpainel/trabalho/salvar_anexo_trabalho'),
                uploadProgress: function (event, position, total, percentComplete) {
                    div_porcentagem.css('display', 'block');
                    barra.width(percentComplete + '%');
                    barra.html(percentComplete + '%');
                },
                success: function (data) {

                    if (data == "sucesso") {
                        barra.width('100%');
                        console.log(data);
                        mensagem.html("<div class='alert alert-success'>Imagem enviada com sucesso!");
                        campoImgame.val("");
                        $('#anexo_trabalho').html("Carregando...");


                        // iniciando ajax para recaregar os anexos
                        $.ajax({
                            url: Config.base_url("cpainel/trabalho/obter_anexos_trabalho_json"),
                            dataType: "json",
                            data: {
                                trabalho: $('#iptTrabalho').val(),
                            },
                            success: function (data) {
                                $('#anexo_trabalho').html("");
                                //$('tbody tr').remove();
                                // $('#imag_carrgando').html('');
                                if (data.length == 0) {
                                    $('#imag_carrgando').html('<div class="alert alert-danger" role="alert">Aluno não encontrado!</div>');
                                } else {
                                    var linhasanexo;
                                    for (var n = 0; n <= data.length; n++) {
                                        var objeto = data[n];

                                        linhasanexo = '<li class="list-group-item" id="linha_anexo_' + objeto.id_anexo_trabalho + '">' +
                                                '<a target="blank" href = "' + Config.base_url("trabalho/" + objeto.pasta_upload_trabalho + "/" + objeto.arquivo_anexo_trabalho) + '" > ' + objeto.nome_anexo_trabalho + '</a>' +
                                                '<a href="javascript:void(0)" title = "Remover anexo" class="link pull-right" data-toggle="modal" data-target="#modelExcluirAnexoTrabalho" data-anexo_trabalho="' + objeto.id_anexo_trabalho + '">' +
                                                '<span class="glyphicon glyphicon-remove" > </span>' +
                                                '</a>' +
                                                '</li>';

                                        $("#anexo_trabalho").append(linhasanexo);
                                    }
                                }
                            }
                        });

                    } else {

                        barra.width('100%');
                        console.log(data);
                        mensagem.html(data);
                        campoImgame.val("");
                        textoCampoUp.html('<i class="glyphicon glyphicon-camera"></i> Selecione uma imagem </span>');
                    }
                },
                error: function () {
                    mensagem.html('Erro ao tentar acessar o arquivo!');
                },
                //  datatype: 'post',
                //  data: 'id_mural=agora',
                resetFrom: true
            }).submit();
        }
    });


    $("#arquivo").change(function () {
        $(this).prev().html($(this).val());
    });
    // fim upload de anexo.
});

