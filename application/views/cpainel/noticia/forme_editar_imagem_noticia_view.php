<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/noticia") ?>">Notícia</a></li>
        <li class="active">Nova Notícia</li>       
    </ol>
    <div class="col-lg-8">
        <form class="form-horizontal" action="<?php echo base_url("cpainel/noticia/salvar_imagem_noticia"); ?>" method="post" enctype="multipart/form-data" role="form">

            <input type="hidden" name="id_noticia" value="<?php echo $id_noticia; ?>"/>

            <div class="form-group">
                <label for="titulo" class="col-sm-2 control-label">Texto</label>
                <div class="col-sm-10">
                    <input name="imagem_noticia" type="file" class="form-control" id="texto_noticia" />
                    <span class="text-danger"> <?php echo $erro_upload; ?></span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-8 col-sm-4">
                    <a class="btn btn-default" href="<?php echo base_url("cpainel/noticia/ver_todas") ?>" > Cancelar </a>
                    <button type="submit" class="btn btn-primary"> Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>