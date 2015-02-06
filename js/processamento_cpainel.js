Turma = {
    // Função para excluir uma turma
    excluir_turma: function () {
        var turma = $('#turma_excluir').val();
        var parametro = "turma=" + turma;
        var pg = Config.base_url('cpainel/turma/excluir');

        $.ajax({
            type: "post",
            url: pg,
            data: parametro,
            success: function (retorno) {
                if (retorno === '1') {

                    $("#modelExcluirTurma").modal("hide");
                    $('#linha_' + turma).hide("slow");

                } else {
                    $("#mensagem_retorno").html(retorno);
                }
            }
        });
    },
    // Função para ativar ou desativar a turma.
    ativar_desativar_turma: function (id) {
        var btnAtivarTurma = '#btnAtivarTurma_' + id;
        var btnEditarTurma = '#btnEditarTurma_' + id;
        var btnExcluirTurma = '#btnExcluirTurma_' + id;
        var btnAbrirTurma = '#btnAbrirTurma_' + id;
        var btnArquivaTurma = '#btnArquivaTurma_' + id;

        var parametro = "turma=" + id;
        var pg = Config.base_url('cpainel/turma/ativar_desativar_turma');
        $.ajax({
            type: "post",
            url: pg,
            data: parametro,
            success: function (retorno) {
                var linkAtivarTurma;
                var linkEditarTurma;
                var linkExcluirTurma;
                var linkAbrirTurma;
                var linkArquivaTurma;
                if (retorno === '1') {
                    linkAtivarTurma = '<a href="javascript:void(0)" onclick="Turma.ativar_desativar_turma(\'' + id + '\')"> <span class="glyphicon glyphicon-check" aria-hidden="true"></span> </a>';
                    linkEditarTurma = '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> ';
                    linkExcluirTurma = '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </span>';
                    linkAbrirTurma = '<a href="' + Config.base_url("cpainel/turma/alunos/" + id) + '" ><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </a>';
                    linkArquivaTurma = '<a href="javascript:void(0)" onclick="Turma.arquivar_turma(\'' + id + '\')"><span class="glyphicon glyphicon-folder-open"></span></a>';

                } else if (retorno === '0') {
                    linkAtivarTurma = '<a href="javascript:void(0)" onclick="Turma.ativar_desativar_turma(\'' + id + '\')"> <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> </a>';
                    linkEditarTurma = '<a href="' + Config.base_url('cpainel/turma/alterar/' + id) + '"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </a>';
                    linkExcluirTurma = '<a href="javascript:void(0)" data-toggle="modal" data-target="#modelExcluirTurma" data-turma="' + id + '"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </a>';
                    linkAbrirTurma = '<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </span>';
                    linkArquivaTurma = '<span class="glyphicon glyphicon-folder-open"></span>';

                }

                $(btnAtivarTurma).html(linkAtivarTurma);
                $(btnEditarTurma).html(linkEditarTurma);
                $(btnExcluirTurma).html(linkExcluirTurma);
                $(btnAbrirTurma).html(linkAbrirTurma);
                $(btnArquivaTurma).html(linkArquivaTurma);

            }
        });

    },
    // Função para arquivar uma turma
    arquivar_turma: function (id) {
        var turma = id;
        var parametro = "turma=" + turma;
        var pg = Config.base_url('cpainel/turma/arquivar');

        $.ajax({
            type: "post",
            url: pg,
            data: parametro,
            success: function (retorno) {
                if (retorno === '1') {

//                    $("#modelExcluirTurma").modal("hide");
                    $('#linha_' + turma).hide("slow");

                } else {
                    alert(retorno);
                    // $("#modelExcluirDisciplina").modal("hide");
                }
            }
        });
    },
    // Função para desarquivar uma turma
    desarquivar_turma: function (id) {
        var turma = id;
        var parametro = "turma=" + turma;
        var pg = Config.base_url('cpainel/turma/desarquivar');

        $.ajax({
            type: "post",
            url: pg,
            data: parametro,
            success: function (retorno) {
                if (retorno === '1') {

//                    $("#modelExcluirTurma").modal("hide");
                    $('#linha_' + turma).hide("slow");

                } else {
                    alert(retorno);
                    // $("#modelExcluirDisciplina").modal("hide");
                }
            }
        });
    }
};


Noticia = {
    // Função para ativar ou desativar a notícia.
    ativar_desativar_noticia: function (id) {


        var btnAtivarNoticia = '#btnAtivarNoticia_' + id;
        var btnEditarNoticia = '#btnEditarNoticia_' + id;
        var btnExcluirNoticia = '#btnExcluirNoticia_' + id;
        var btnImagemMini = '#btnImagemMini_' + id;

        var parametro = "noticia=" + id;
        var pg = Config.base_url('cpainel/noticia/ativar_desativar_noticia');
        $.ajax({
            type: "post",
            url: pg,
            data: parametro,
            success: function (retorno) {
                var linkAtivarNoticia;
                var linkEditarNoticia;
                var linkExcluirNoticia;
                var linkArquivaTurma;
                var linkImagemMini;
                if (retorno === '1') {
                    linkAtivarNoticia = '<a href="javascript:void(0)" onclick="Noticia.ativar_desativar_noticia(\'' + id + '\')"> <span class="glyphicon glyphicon-check" aria-hidden="true"></span> </a>';
                    linkEditarNoticia = '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> ';
                    linkExcluirNoticia = '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </span>';
                    linkImagemMini = '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';

                } else if (retorno === '0') {
                    linkAtivarNoticia = '<a href="javascript:void(0)" onclick="Noticia.ativar_desativar_noticia(\'' + id + '\')"> <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> </a>';
                    linkEditarNoticia = '<a href="' + Config.base_url('cpainel/noticia/alterar/' + id) + '"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </a>';
                    linkExcluirNoticia = '<a href="javascript:void(0)" data-toggle="modal" data-target="#modelExcluirNoticia" data-noticia="' + id + '"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </a>';
                    linkImagemMini = '<a href="' + Config.base_url("cpainel/noticia/alterar_imagem_mini/" + id) + ' "><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> <a href="javascript:void(0)" onclick="Noticia.excluir_imagem_mini(\'' + id + '\')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>';
                }

                $(btnAtivarNoticia).html(linkAtivarNoticia);
                $(btnEditarNoticia).html(linkEditarNoticia);
                $(btnExcluirNoticia).html(linkExcluirNoticia);
                $(btnImagemMini).html(linkImagemMini);

            }
        });
    },
    excluir_noticia: function () {
        var noticia = $('#noticia_excluir').val();
        var parametro = "noticia=" + noticia;
        var pg = Config.base_url('cpainel/noticia/excluir_noticia');

        $.ajax({
            type: "post",
            url: pg,
            data: parametro,
            success: function (retorno) {
                if (retorno === "1") {
                    window.location.href = Config.base_url("cpainel/noticia");
                } else {
                    alert(retorno);
                    $("#modelExcluirNoticia").modal("hide");
                }
            }
        });
    },
    excluir_imagem_mini: function (noticia) {
//        var noticia = $('#noticia_excluir').val();
        var parametro = "noticia=" + noticia;
        var pg = Config.base_url('cpainel/noticia/excluir_imagem_mini_noticia');

        $.ajax({
            type: "post",
            url: pg,
            data: parametro,
            success: function (retorno) {
                if (retorno === "1") {
                    window.location.href = Config.base_url("cpainel/noticia");
                } else {
                    alert(retorno);
                    $("#modelExcluirNoticia").modal("hide");
                }
            }
        });
    }
};


Disciplina = {
    ativar_desativar_disciplina: function (id) {
        var btnAtivarDisciplina = '#btnAtivarDisciplina_' + id;
        var btnEditarDisciplina = '#btnEditarDisciplina_' + id;
        var btnExcluirDisciplina = '#btnExcluirDisciplina_' + id;
        var btnAddTurma = '#btnAddTurma_' + id;

        var parametro = "disciplina=" + id;
        var pg = Config.base_url('cpainel/disciplina/ativar_desativar_disciplina');
        $.ajax({
            type: "post",
            url: pg,
            data: parametro,
            success: function (retorno) {
                var linkAtivarDisciplina;
                var linkEditarDisciplina;
                var linkExcluirDisciplina;
                var linkAddTurma;
                if (retorno === '1') {
                    linkAtivarDisciplina = '<a href="javascript:void(0)" onclick="Disciplina.ativar_desativar_disciplina(\'' + id + '\')"> <span class="glyphicon glyphicon-check" aria-hidden="true"></span> </a>';
                    linkEditarDisciplina = '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> ';
                    linkExcluirDisciplina = '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </span>';
                    linkAddTurma = '<a href="' + Config.base_url("cpainel/turma?disciplina=" + id) + '"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </a>';


                } else if (retorno === '0') {
                    linkAtivarDisciplina = '<a href="javascript:void(0)" onclick="Disciplina.ativar_desativar_disciplina(\'' + id + '\')"> <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> </a>';
                    linkEditarDisciplina = '<a href="' + Config.base_url('cpainel/disciplina/alterar_disciplina/' + id) + '"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </a>';
                    linkExcluirDisciplina = '<a href="javascript:void(0)" data-toggle="modal" data-target="#modelExcluirDisciplina" data-disciplina="' + id + '"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </a>';
                    linkAddTurma = '<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </span>';


                } else {
                    //linkAtivarEstado = 'Falha';
                }

                $(btnAtivarDisciplina).html(linkAtivarDisciplina);
                $(btnEditarDisciplina).html(linkEditarDisciplina);
                $(btnExcluirDisciplina).html(linkExcluirDisciplina);
                $(btnAddTurma).html(linkAddTurma);

            }
        });

    },
    excluir_disciplina: function () {
        var disciplina = $('#disciplina_excluir').val();
        var parametro = "disciplina=" + disciplina;
        var pg = Config.base_url('cpainel/disciplina/excluir_disciplina');

        $.ajax({
            type: "post",
            url: pg,
            data: parametro,
            success: function (retorno) {
                if (retorno === '1') {
                    window.location.href = Config.base_url("cpainel/disciplina");
                } else {
                    $("#mensagem_retorno").html(retorno);
                }
            }
        });
    }

};

Aluno = {
    incluir_aluno_existente_turma: function (aluno, turma) {

        var parametro = "aluno=" + aluno + "&turma=" + turma;
        var pg = Config.base_url('cpainel/aluno/add_aluno_turma');

        $.ajax({
            type: "post",
            url: pg,
            data: parametro,
            success: function (retorno) {
                if (retorno === '1') {
                    alert('Salvo com sucesso!');
                    $('#linha_aluno_' + aluno).hide("slow");
                } else {
                    alert(retorno);

                }
            }
        });
    },
    // Excluir aluno da turma
    excluir_aluno_turma: function () {
        var aluno = $('#aluno_excluir').val();
        var turma = $('#turma_excluir').val();
        var parametro = "aluno=" + aluno + "&turma=" + turma;
        var pg = Config.base_url('cpainel/aluno/excluir_aluno_turma');

        $.ajax({
            type: "post",
            url: pg,
            data: parametro,
            success: function (retorno) {
                if (retorno === '1') {
                    alert("Aluno excluido com sucesso!")
                    $("#modelExcluirAlunoTurma").modal("hide");
                    $('#linha_aluno_turma_' + aluno).hide("slow");
                } else {
                    alert(retorno);
                    $("#modelExcluirAlunoTurma").modal("hide");
                }
            }
        });
    },
    alterar_senha_aluno: function () {
        var aluno = $('#aluno').val();
        var senha = $('#nova_senha').val();
        var parametro = "aluno=" + aluno + "&senha=" + senha;
        var pg = Config.base_url('cpainel/aluno/alterar_senha_aluno');

        $.ajax({
            type: "post",
            url: pg,
            data: parametro,
            success: function (retorno) {
                if (retorno === '1') {
                    $("#modelSenhaAluno").modal("hide");
                    alert("Senha alterada com sucesso!")
                } else {
                    $("#erro_senha").html(retorno);
                }
            }
        });
    },
    // Função para ativar ou desativar o aluno por ajax.
    ativar_destivar_aluno: function (id) {
        var btnAtivarAluno = '#btnAtivarAluno_' + id;
        var btnEditarAluno = '#btnEditarAluno_' + id;
        var btnSenhaAluno = '#btnSenhaAluno_' + id;
        var btnExcluirAluno = '#btnExcluirAluno_' + id;
        var btnVerAluno = '#btnVerAluno_' + id;


        var parametro = "aluno=" + id;
        var pg = Config.base_url('cpainel/aluno/ativar_desativar_aluno');
        $.ajax({
            type: "post",
            url: pg,
            data: parametro,
            success: function (retorno) {
                var linkAtivarAluno;
                var linkEditarAluno;
                var linkSenhaAluno;
                var linkExcluirAluno;
                var linkverAluno;
                if (retorno === '1') {
                    linkAtivarAluno = '<a href="javascript:void(0)" onclick="Aluno.ativar_destivar_aluno(\'' + id + '\')"> <span class="glyphicon glyphicon-check" aria-hidden="true"></span> </a>';
                    linkEditarAluno = '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> ';
                    linkSenhaAluno = '<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>'
                    linkExcluirAluno = '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </span>';
                    linkverAluno = '<a href="' + Config.base_url("cpainel/aluno/") + '"> <span class="glyphicon glyphicon-eye-open"></span> </a>';


                } else if (retorno === '0') {
                    linkAtivarAluno = '<a href="javascript:void(0)" onclick="Aluno.ativar_destivar_aluno(\'' + id + '\')"> <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> </a>';
                    linkEditarAluno = '<a href="' + Config.base_url('cpainel/aluno/alterar/' + id) + '"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </a>';
                    linkSenhaAluno = '<a href="javascript:void(0)" data-toggle="modal" data-target="#modelSenhaAluno" data-aluno="' + id + '"> <span class="glyphicon glyphicon-lock" aria-hidden="true"></span> </a>';
                    linkExcluirAluno = '<a href="javascript:void(0)" data-toggle="modal" data-target="#modelExcluirAluno" data-aluno="' + id + '"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </a>';
                    linkverAluno = '<span class="glyphicon glyphicon-eye-open"></span>';

                } else {
                    //linkAtivarEstado = 'Falha';
                }

                $(btnAtivarAluno).html(linkAtivarAluno);
                $(btnEditarAluno).html(linkEditarAluno);
                $(btnSenhaAluno).html(linkSenhaAluno);
                $(btnExcluirAluno).html(linkExcluirAluno);
                $(btnVerAluno).html(linkverAluno);
            }
        });
    }
}

Avaliacao = {
    excluir_avaliacao: function () {
        var avaliacao = $('#avaliacao_excluir').val();
        var parametro = "avaliacao=" + avaliacao;
        var pg = Config.base_url('cpainel/avaliacao/excluir_avaliacao');

        $.ajax({
            type: "post",
            url: pg,
            data: parametro,
            success: function (retorno) {
                if (retorno === '1') {

                    // Codigo para diminuir o total de pontos depois que uma avaliação é excluida.
                    var nota_avaliacao = $("#valor_nota_" + avaliacao).html();
                    var total_pontos_avaliacao = $("#total_pontos_avaliacoes").html();
                    total_pontos_avaliacao -= nota_avaliacao;
                    $("#total_pontos_avaliacoes").html(total_pontos_avaliacao);
                    // Escondendo o medel aberto e excluinda a linha de dados da avaliação que foi excluida.
                    $("#modelExcluirAvaliacao").modal("hide");
                    $("#linha_avaliacao_" + avaliacao).hide("slow");
                } else {
                    alert(retorno);
                    $("#modelExcluirDisciplina").modal("hide");
                }
            }
        });
    },
    alterar_avaliacao_recuperacao: function () {
        var avaliacao_recuperacao = $('#iptAvaliacao_recuperacao').val();
        var descricao = $('#iptDescricao_avaliacao_recuperacao').val();
        var data = $('#iptData_avaliacao_recuperacao').val();
        var parametro = "avaliacao_recuperacao=" + avaliacao_recuperacao + "&descricao=" + descricao + "&data=" + data;
        var pg = Config.base_url('cpainel/avaliacao/salvar_avaliacao_recuperacao_alterarda');

        $.ajax({
            type: "post",
            url: pg,
            data: parametro,
            success: function (retorno) {
                if (retorno === '1') {
                    alert("Avaliacao de recuperacao alterada com sucesso!");
                    Config.redirecionar_pagina(Config.base_url("cpainel/avaliacao/avaliacao_recuperacao/" + avaliacao_recuperacao));
                } else {
                    var texto_erro = "<span class='text-danger'>" + retorno + "</span>";
                    $("#mensagem_retorno").html(texto_erro);
                }
            }
        });
    }
}

Trabalho = {
    excluir_trabalho: function () {

        var trabalho = $('#trabalho_excluir').val();
        var parametro = "trabalho=" + trabalho;
        var pg = Config.base_url('cpainel/trabalho/excluir_trabalho');

        $.ajax({
            type: "post",
            url: pg,
            data: parametro,
            success: function (retorno) {
                if (retorno === '1') {
                    // Codigo para diminuir o total de pontos depois que uma avaliação é excluida.
                    var nota_trabalho = $("#valor_nota_" + trabalho).html();
                    var total_pontos_trabalhos = $("#total_pontos_trabalhos").html();
                    total_pontos_trabalhos -= nota_trabalho;
                    $("#total_pontos_trabalhos").html(total_pontos_trabalhos);
                    // Escondendo o medel aberto e excluinda a linha de dados da avaliação que foi excluida.
                    $("#modelExcluirTrabalho").modal("hide");
                    $("#linha_trabalho_" + trabalho).hide("slow");
                } else {
                    alert(retorno);
                    $("#modelExcluirTrabalho").modal("hide");
                }
            }
        });
    },
    excluir_anexo_trabalho: function () {

        var anexo = $('#anexo_trabalho_excluir').val();
        var parametro = "anexo=" + anexo;
        var pg = Config.base_url('cpainel/trabalho/excluir_anexo_trabalho');

        $.ajax({
            type: "post",
            url: pg,
            data: parametro,
            success: function (retorno) {
                if (retorno === '1') {
                    // Escondendo o medel aberto e excluinda a linha de dados da avaliação que foi excluida.
                    $("#modelExcluirAnexoTrabalho").modal("hide");
                    $("#linha_anexo_" + anexo).hide("slow");
                } else {
                    alert(retorno);
                    $("#modelExcluirAnexoTrabalho").modal("hide");
                }
            }
        });
    }
}

CarregarPagina = {
    carregarConteudo: function (pg, parametro, local) {
        local = "#" + local;
        $(local).html('Carregando...');
        $.ajax({
            type: "post",
            url: pg,
            data: parametro,
            success: function (retorno) {
                $(local).html(retorno);
            }
        });
    },
    ativar_desativar_estado: function (id) {

    }
};