Config = {
    base_url: function (url) {
        var url_base = 'http://localhost/andre/';
        return url_base + url;
    }
};

Turma = {
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
                    alert(retorno);
                    // $("#modelExcluirDisciplina").modal("hide");
                }
            }
        });
    },
    ativar_desativar_turma: function (id) {
        var btnAtivarTurma = '#btnAtivarTurma_' + id;
        var btnEditarTurma = '#btnEditarTurma_' + id;
        var btnExcluirTurma = '#btnExcluirTurma_' + id;
//        var btnAddTurma = '#btnAddTurma_' + id;

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
//                var linkAddTurma;
                if (retorno === '1') {
                    linkAtivarTurma = '<a href="javascript:void(0)" onclick="Turma.ativar_desativar_turma(\'' + id + '\')"> <span class="glyphicon glyphicon-collapse-up" aria-hidden="true"></span> </a>';
                    linkEditarTurma = '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> ';
                    linkExcluirTurma = '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </span>';
//                    linkAddTurma = '<a href="http://localhost/siteservico/cpainel/categoria/subcategoria/' + id + '" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </a>';
//

                } else if (retorno === '0') {
                    linkAtivarTurma = '<a href="javascript:void(0)" onclick="Turma.ativar_desativar_turma(\'' + id + '\')"> <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> </a>';
                    linkEditarTurma = '<a href="' + Config.base_url('cpainel/turma/alterar/' + id) + '"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </a>';
                    linkExcluirTurma = '<a href="javascript:void(0)" data-toggle="modal" data-target="#modelExcluirTurma" data-turma="' + id + '"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </a>';
//                    linkAddTurma = '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </span>';


                }

                $(btnAtivarTurma).html(linkAtivarTurma);
                $(btnEditarTurma).html(linkEditarTurma);
                $(btnExcluirTurma).html(linkExcluirTurma);
//                $(btnAddTurma).html(linkAddTurma);

            }
        });

    },
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
                    linkAtivarDisciplina = '<a href="javascript:void(0)" onclick="Disciplina.ativar_desativar_disciplina(\'' + id + '\')"> <span class="glyphicon glyphicon-collapse-up" aria-hidden="true"></span> </a>';
                    linkEditarDisciplina = '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> ';
                    linkExcluirDisciplina = '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </span>';
                    linkAddTurma = '<a href="http://localhost/siteservico/cpainel/categoria/subcategoria/' + id + '" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </a>';


                } else if (retorno === '0') {
                    linkAtivarDisciplina = '<a href="javascript:void(0)" onclick="Disciplina.ativar_desativar_disciplina(\'' + id + '\')"> <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> </a>';
                    linkEditarDisciplina = '<a href="' + Config.base_url('cpainel/disciplina/alterar_disciplina/' + id) + '"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </a>';
                    linkExcluirDisciplina = '<a href="javascript:void(0)" data-toggle="modal" data-target="#modelExcluirDisciplina" data-disciplina="' + id + '"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </a>';
                    linkAddTurma = '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </span>';


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
                    //$(".bs-example-modal-sm").modal("hide");
                    window.location.href = Config.base_url("cpainel/disciplina");
                } else {
                    alert(retorno);
                    $("#modelExcluirDisciplina").modal("hide");
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