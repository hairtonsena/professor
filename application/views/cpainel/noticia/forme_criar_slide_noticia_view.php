<script type="text/javascript">

    function adicionarCampos() {
        
        var addCampo = document.getElementById('novoCampo');
        var limparCampos = document.getElementById('limpaCampos');
        addCampo.innerHTML += '<input type="text" name="url_imagem[]" class="form-control" required="true" id="titulo" placeholder="Url imagem">';
        limparCampos.innerHTML = ' | <a href="javascript:void(0)" onClick="limparCampos()">Limpar Campos</a>';
    }

    function limparCampos() {
        var addCampo = document.getElementById('novoCampo');
        var limparCampos = document.getElementById('limpaCampos');
        addCampo.innerHTML = '';
        limparCampos.innerHTML = '';
    }

</script>

<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/noticia") ?>">Notícia</a></li>
        <li class="active">Criar Slide</li>       
    </ol>
    <div class="col-lg-8">

        <form class="form-horizontal" action="<?php echo base_url("cpainel/noticia/gerar_novo_slide"); ?>" method="post" role="form">
            <div class="form-group">

                <label for="titulo" class="col-sm-2 control-label">Titulo:</label>
                <div class="col-sm-10">
                    <input type="text" name="titulo_slide" class="form-control" id="titulo" required="true" placeholder="Titulo slide">                  
                </div>
            </div>


            <div class="form-group">

                <label for="titulo" class="col-sm-2 control-label">Url imagem:</label>
                <div class="col-sm-10">
                    <input type="text" name="url_imagem[]" class="form-control" id="titulo" required="true" placeholder="Url imagem">
                    <div id="novoCampo"></div>
                    <a href="javascript:void(0)" onclick="adicionarCampos()">Add Campo</a>
                    <span id="limpaCampos"></span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-8 col-sm-4">
                    <a class="btn btn-default" href="<?php echo base_url("cpainel/noticia/slides") ?>" > Cancelar </a>
                    <button type="submit" class="btn btn-primary"> Gerar slide</button>
                </div>
            </div>
        </form>
    </div>

</div>