<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/secretaria") ?>">Secretaria</a></li>
        <li class="active">Nova Secretaria</li>       
    </ol>
    <div class="col-lg-8">
        <form class="form-horizontal" action="<?php echo base_url("cpainel/secretaria/criar_nova_secretaria"); ?>" method="post" role="form">
            <div class="form-group">
                <label for="titulo" class="col-sm-2 control-label">Titulo</label>
                <div class="col-sm-10">
                    <input type="titulo" name="titulo_secretaria" class="form-control" id="titulo" placeholder="Titulo">
                    <span class="text-danger"><?php echo validation_errors() ?></span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-8 col-sm-4">
                     <a class="btn btn-default" href="<?php echo base_url("cpainel/secretaria") ?>" > Cancelar </a>
                    <button type="submit" class="btn btn-primary"> Criar</button>
                </div>
            </div>
        </form>
    </div>
</div>