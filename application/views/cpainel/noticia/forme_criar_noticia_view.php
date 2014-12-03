<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/noticia") ?>">Notícia</a></li>
        <li class="active">Nova Notícia</li>       
    </ol>
    <div class="col-lg-8">
        <form class="form-horizontal" action="<?php echo base_url("cpainel/noticia/criar_nova_noticia"); ?>" method="post" role="form">
            <div class="form-group">

                <label for="titulo" class="col-sm-2 control-label">Titulo</label>
                <div class="col-sm-10">
                    <input type="text" name="titulo_noticia" class="form-control" id="titulo" placeholder="Titulo">
                    <span class="text-danger"> <?php echo validation_errors(); ?></span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-8 col-sm-4">
                    <a class="btn btn-default" href="<?php echo base_url("cpainel/noticia/ver_todas") ?>" > Cancelar </a>
                    <button type="submit" class="btn btn-primary"> Criar notícia</button>
                </div>
            </div>
        </form>
    </div>

</div>