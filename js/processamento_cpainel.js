Localizacao = {
    obter_ciadade_estado: function (estado) {

        var parametro = "estado=" + estado;
        var pg = 'http://localhost/siteServicos/cpainel/localizacao/obter_cidade_estado';
        var local = 'localCidades';

        CarregarPagina.carregarConteudo(pg, parametro, local);

    },
    cheque_estado:function (id){
        alert(id);
        var ab = "#check_estado_"+id;
        
        $(ab).val({checked:true});
        
        alert(ab);
        
        //return true;
        
    }
};

CarregarPagina = {
    carregarConteudo: function (pg, parametro, local) {
        local = "#" + local;
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
        var parametro = "estado=" + id;
        var pg = 'http://localhost/siteServicos/cpainel/localizacao/obter_cidade_estado';
        var valor;
        $.ajax({
            type: "post",
            url: pg,
            data: parametro,
            success: function (retorno) {
                valor = retorno;
            }
        });
        return valor;
    }
};