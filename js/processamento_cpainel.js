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
    }
};


Categoria = {
    ativar_desativar_categoria: function (id) {

        var btnAtivarCategoria = '#btnAtivarCategoria_' + id;
        var btnEditarCategoria = '#btnEditarCategoria_' + id;
        var btnExcluirCategoria = '#btnExcluirCategoria_' + id;
        var btnAddSubCategoria = '#btnAddSubcategoria_' + id;

        var campoNome = '#nome_' + id;
        var conteudo = $(campoNome).text();

        var parametro = "categoria=" + id;
        var pg = 'http://localhost/siteservico/cpainel/categoria/ativar_desativar_categoria';
        $.ajax({
            type: "post",
            url: pg,
            data: parametro,
            success: function (retorno) {
                var linkAtivarCategoria;
                var linkEditarCategoria;
                var linkExcluirCategoria;
                var linkAddSubCategoria;
                if (retorno === '1') {
                    linkAtivarCategoria = '<a href="javascript:void(0)" onclick="Categoria.ativar_desativar_categoria(\'' + id + '\')"> <span class="glyphicon glyphicon-collapse-up" aria-hidden="true"></span> </a>';
                    linkEditarCategoria = '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> ';
                    linkExcluirCategoria = '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </span>';
                    linkAddSubCategoria = '<a href="#" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </a>';

                    $(campoNome).parent().parent().html('<span id="nome_' + id + '">' + conteudo + '</span>');

                } else if (retorno === '0') {
                    linkAtivarCategoria = '<a href="javascript:void(0)" onclick="Categoria.ativar_desativar_categoria(\'' + id + '\')"> <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> </a>';
                    linkEditarCategoria = '<a href="javascript:void(0)" id="editar"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </a>';
                    linkExcluirCategoria = '<a href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-sm" data-categoria="' + id + '"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </a>';
                    linkAddSubCategoria = '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </span>';

                    $(campoNome).parent().html('<a href="javascript:void(0)" ondblclick="asfasd"><span id="nome_' + id + '">' + conteudo + '</span></a>');


                } else {
                    //linkAtivarEstado = 'Falha';
                }
                $(btnEditarCategoria).html(linkEditarCategoria);
                $(btnAtivarCategoria).html(linkAtivarCategoria);
                $(btnExcluirCategoria).html(linkExcluirCategoria);
                $(btnAddSubCategoria).html(linkAddSubCategoria);

            }
        });

    },
    excluir_categoria: function () {
        var categoria = $('#categoria_excluir').val();
        var parametro = "categoria="+categoria;
        var pg = 'http://localhost/siteservico/cpainel/categoria/excluir_categoria';
        
        $.ajax({
            type: "post",
            url: pg,
            data: parametro,
            success: function (retorno) {
                if(retorno==='1'){
                    //$(".bs-example-modal-sm").modal("hide");
                    window.location.href = "http://localhost/siteservico/cpainel/categoria";
                }else{
                    alert(retorno);
                    $(".bs-example-modal-sm").modal("hide");
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