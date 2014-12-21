Config = {
    base_url: function (url) {
        var url_base = 'http://localhost/andre/';
        return url_base + url;
    }
};

Localizacao = {
    obter_ciadade_estado: function (estado) {

        var parametro = "estado=" + estado;
        var pg = 'http://localhost/siteservico/cpainel/localizacao/obter_cidade_estado';
        var local = 'localCidades';

        CarregarPagina.carregarConteudo(pg, parametro, local);

    },
    ativar_desativar_estado: function (id) {

        var btnAtivarEstado = '#btnAtivarEstado_' + id;
        var btnVerCidade = '#btnVerCidadeEstado_' + id;

        var parametro = "estado=" + id;
        var pg = 'http://localhost/siteservico/cpainel/localizacao/ativar_desativar_estado';
        $.ajax({
            type: "post",
            url: pg,
            data: parametro,
            success: function (retorno) {
                var linkAtivarEstado;
                var verCidade;
                if (retorno === '1') {
                    linkAtivarEstado = '<button type="button" onclick="Localizacao.ativar_desativar_estado(\'' + id + '\')" >Desativar</button>';
                    verCidade = '<button type="button" onclick="Localizacao.obter_ciadade_estado(\'' + id + '\')" >>></button>';
                } else if (retorno === '0') {
                    Localizacao.obter_ciadade_estado(-1);
                    linkAtivarEstado = '<button type="button" onclick="Localizacao.ativar_desativar_estado(\'' + id + '\')" >Ativar</button>';
                    verCidade = '>>';
                } else {
                    linkAtivarEstado = 'Falha';
                }
                $(btnVerCidade).html(verCidade);
                $(btnAtivarEstado).html(linkAtivarEstado);

            }
        });

    },
    ativar_desativar_cidade: function (id) {

        var btnAtivarCidade = '#btnAtivarCidade_' + id;

        var parametro = "cidade=" + id;
        var pg = 'http://localhost/siteservico/cpainel/localizacao/ativar_desativar_cidade';
        $.ajax({
            type: "post",
            url: pg,
            data: parametro,
            success: function (retorno) {
                var linkAtivarCidade;
                if (retorno === '1') {
                    linkAtivarCidade = '<button type="button" onclick="Localizacao.ativar_desativar_cidade(\'' + id + '\')">Desativar</button>';

                } else if (retorno === '0') {

                    linkAtivarCidade = '<button type="button" onclick="Localizacao.ativar_desativar_cidade(\'' + id + '\')" >Ativar</button>';

                } else {
                    linkAtivarCidade = 'Falha';
                }
                $(btnAtivarCidade).html(linkAtivarCidade);

            }
        });

    }
};

Empreendimento = {
    opcao_formulario: function () {
        var tipo_empreendimento = $('#tipo_empreendimento').val();
        var parametro = "tipo_empreendimento=" + tipo_empreendimento;
        var pg = 'http://localhost/siteservico/cpainel/empreendimento/fome_opcao_tipo_empreendimento';
        $.ajax({
            type: "post",
            url: pg,
            data: parametro,
            success: function (retorno) {

                $('#form_cadastro_empreendimento').html(retorno);

            }
        });
    },
    obter_select_subcategoria: function () {
        var categoria = $('#categoria').val();
        // alert(categoria);

        $.getJSON("http://localhost/siteservico/cpainel/categoria/ober_subcategoria_json?ttt=ds", {
            'categoria': categoria,
        }, function (json) {
            // alert(json);
            //div.innerHTML = '';
            if (json.length == 0) {
                alert('Errado!');
                // div.innerHTML = '<h4 class="text-center">Nenhuma colaboração encontrada!</h4>';

            } else {
                alert('Certo!');



                //var select_subcategoria = document.getElementById('campo_subcategoria');


                var sele = document.getElementById('subcategoria');

                //var sele = document.createElement('select');

                // sele.a;

                // select_subcategoria.appendChild(sele);


                var opcao_subcategoria;
                for (var n = 0; n <= json.length; n++) {
                    var objeto = json[n];

                    opcao_subcategoria = '<option value="' + objeto.id_sub_categoria + '">' + objeto.nome_sub_categoria + '</option>';

                    alert('oi');
                }
                ;
                alert('opcao_subcategoria');
//                sele.appendChild(opcao_subcategoria);
//                
                //  sele.innerHTML = opcao_subcategoria;
            }
            ;
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
    },
    // Sub categoria
    ativar_desativar_subcategoria: function (id) {
        var btnAtivarSubCategoria = '#btnAtivarSubCategoria_' + id;
        var btnEditarSubCategoria = '#btnEditarSubCategoria_' + id;
        var btnExcluirSubCategoria = '#btnExcluirSubCategoria_' + id;
        //var btnAddSubCategoria = '#btnAddSubcategoria_' + id;

//        var campoNome = '#nome_' + id;
//        var conteudo = $(campoNome).text();

        var parametro = "subcategoria=" + id;
        var pg = 'http://localhost/siteservico/cpainel/categoria/ativar_desativar_subcategoria';
        $.ajax({
            type: "post",
            url: pg,
            data: parametro,
            success: function (retorno) {
                var linkAtivarSubCategoria;
                var linkEditarSubCategoria;
                var linkExcluirSubCategoria;
                // var linkAddSubSubCategoria;
                if (retorno === '1') {
                    linkAtivarSubCategoria = '<a href="javascript:void(0)" onclick="Categoria.ativar_desativar_subcategoria(\'' + id + '\')"> <span class="glyphicon glyphicon-collapse-up" aria-hidden="true"></span> </a>';
                    linkEditarSubCategoria = '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> ';
                    linkExcluirSubCategoria = '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </span>';
                    //   linkAddSubCategoria = '<a href="#" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </a>';

                    //  $(campoNome).parent().parent().html('<span id="nome_' + id + '">' + conteudo + '</span>');

                    // alert('Oi');
                } else if (retorno === '0') {
                    linkAtivarSubCategoria = '<a href="javascript:void(0)" onclick="Categoria.ativar_desativar_subcategoria(\'' + id + '\')"> <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> </a>';
                    linkEditarSubCategoria = '<a href="http://localhost/siteservico/cpainel/categoria/alterar_subcategoria/' + id + '"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </a>';
                    linkExcluirSubCategoria = '<a href="javascript:void(0)" data-toggle="modal" data-target="#modelSubCategoria" data-subcategoria="' + id + '"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </a>';
                    //  linkAddSubCategoria = '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </span>';

                    // $(campoNome).parent().html('<a href="javascript:void(0)" ondblclick="asfasd"><span id="nome_' + id + '">' + conteudo + '</span></a>');

                    // alert('Ola')
                } else {
                    //linkAtivarEstado = 'Falha';
                }
                $(btnEditarSubCategoria).html(linkEditarSubCategoria);
                $(btnAtivarSubCategoria).html(linkAtivarSubCategoria);
                $(btnExcluirSubCategoria).html(linkExcluirSubCategoria);
                // $(btnAddSubCategoria).html(linkAddSubCategoria);

            }
        });

    },
    excluir_subcategoria: function () {
        var subcategoria = $('#subcategoria_excluir').val();
        var parametro = "subcategoria=" + subcategoria;
        var pg = 'http://localhost/siteservico/cpainel/categoria/excluir_subcategoria';
        $.ajax({
            type: "post",
            url: pg,
            data: parametro,
            success: function (retorno) {
                if (retorno === '1') {
                    window.location.href = "";
                } else {
                    alert(retorno);
                }
            }
        });
    }

};
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