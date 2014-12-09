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