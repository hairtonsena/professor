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






// Trabalhando com upload dos trabalhos dos alunos
//    $("#btn_enviar").on('click', function (event) {
//
//        var trabalho = $(this).data('enviar_trabalho');
//
//        var mensagem = $("#mensagem_" + trabalho);
//        var div_porcentagem = $("#porcentagem_" + trabalho);
//        var barra = $("#barra_" + trabalho);
//        var campoImgame = $("#arquivo_" + trabalho);
//        var textoCampoUp = $("#textoCampoUp");
//        var formulario = $("#form_upload_" + trabalho);
//
//        barra.width('0%');
//        barra.html('0%');
//
//        event.preventDefault();
//
//        if (campoImgame.val() == "") {
//            mensagem.html("<div class='alert alert-danger'>Por favor, selecione uma imagem!<div>");
//        } else {
//            $(formulario).ajaxForm({
//                url: Config.base_url('aluno/salvar_trabalho_aluno'),
//                uploadProgress: function (event, position, total, percentComplete) {
//
//                    div_porcentagem.css('display', 'block');
//                    barra.width(percentComplete + '%');
//                    barra.html(percentComplete + '%');
//                },
//                success: function (data) {
//
//                    if (data == "sucesso") {
//                        barra.width('100%');
//                        console.log(data);
//                        mensagem.html("<div class='alert alert-success'>Imagem enviada com sucesso!");
//                        campoImgame.val("");
//                        $('#anexo_trabalho').html("Carregando...");
//
//                        // iniciando ajax para recaregar os anexos
//                        $.ajax({
////                            url: Config.base_url("aluno/obter_anexos_trabalho_json"),
//                            dataType: "json",
//                            data: {
//                                trabalho: $('#iptTrabalho').val(),
//                            },
//                            success: function (data) {
//                                $('#anexo_trabalho').html("");
//                                //$('tbody tr').remove();
//                                // $('#imag_carrgando').html('');
//                                if (data.length == 0) {
//                                    $('#imag_carrgando').html('<div class="alert alert-danger" role="alert">Aluno não encontrado!</div>');
//                                } else {
//                                    var linhasanexo;
//                                    for (var n = 0; n <= data.length; n++) {
//                                        var objeto = data[n];
//
//                                        linhasanexo = '<li class="list-group-item" id="linha_anexo_' + objeto.id_anexo_trabalho + '">' +
//                                                '<a target="blank" href = "' + Config.base_url("trabalho/" + objeto.pasta_upload_trabalho + "/" + objeto.arquivo_anexo_trabalho) + '" > ' + objeto.nome_anexo_trabalho + '</a>' +
//                                                '<a href="javascript:void(0)" title = "Remover anexo" class="link pull-right" data-toggle="modal" data-target="#modelExcluirAnexoTrabalho" data-anexo_trabalho="' + objeto.id_anexo_trabalho + '">' +
//                                                '<span class="glyphicon glyphicon-remove" > </span>' +
//                                                '</a>' +
//                                                '</li>';
//
//                                        $("#anexo_trabalho").append(linhasanexo);
//                                    }
//                                }
//                            }
//                        });
//
//                    } else {
//
//                        barra.width('100%');
//                        console.log(data);
//                        mensagem.html(data);
//                        campoImgame.val("");
//                        textoCampoUp.html('<i class="glyphicon glyphicon-camera"></i> Selecione uma imagem </span>');
//                    }
//                },
//                error: function () {
//                    mensagem.html('Erro ao tentar acessar o arquivo!');
//                },
//                //  datatype: 'post',
//                //  data: 'id_mural=agora',
//                resetFrom: true
//            }).submit();
//        }
//    });

//
//    $("#arquivo").change(function () {
//        $(this).prev().html($(this).val());
//    });
    // fim upload de anexo.


});

function enviar_arquivo_aluno(trabalho) {

//        alert(trabalho);
//        var trabalho = $(this).data('enviar_trabalho');

    var mensagem = $("#mensagem_" + trabalho);
    var div_porcentagem = $("#porcentagem_" + trabalho);
    var barra = $("#barra_" + trabalho);
    var campoImgame = $("#arquivo_" + trabalho);
    var textoCampoUp = $("#textoCampoUp");
    var formulario = $("#form_upload_" + trabalho);

    barra.width('0%');
    barra.html('0%');

    event.preventDefault();

    if (campoImgame.val() == "") {
        mensagem.html("<div class='alert alert-danger'>Por favor, selecione uma imagem!<div>");
    } else {
        $(formulario).ajaxForm({
            url: Config.base_url('aluno/salvar_trabalho_aluno'),
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
//                    $('#anexo_trabalho').html("Carregando...");

                    // iniciando ajax para recaregar os anexos
                    $.ajax({
                        url: Config.base_url("aluno/obter_trabalho_aluno_json"),
                        dataType: "json",
                        data: {
                            trabalho: trabalho,
                        },
                        success: function (data) {
                            var meu_trabalho = '#meu_trabalho_' + trabalho;
                            $(meu_trabalho).html("");
                            //$('tbody tr').remove();
                            // $('#imag_carrgando').html('');
                            if (data.length == 0) {
//                                    $('#imag_carrgando').html('<div class="alert alert-danger" role="alert">Aluno não encontrado!</div>');
                            } else {
                                var conteudo_trabalho_aluno;
                                for (var n = 0; n <= data.length; n++) {
                                    var objeto = data[n];

                                    conteudo_trabalho_aluno = '<div style="background-color: #F3F3F3; padding-bottom: 10px; border: 1px solid #dcdcdc;" class="col-md-4 text-center">' +
                                            '<a target="blank" href="' + Config.base_url("trabalho/" + objeto.pasta_upload_trabalho + "/" + objeto.nome_arquivo_trabalho_aluno) + '">' +
                                            '<span class="glyphicon glyphicon-file"></span><br/>' +
                                            objeto.nome_arquivo_trabalho_aluno +
                                            '</a>' +
                                            '</div>';
                                    $(meu_trabalho).html(conteudo_trabalho_aluno);
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

//        return false;
}