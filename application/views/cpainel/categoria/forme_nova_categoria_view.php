<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/categoria") ?>">Categoria</a></li>
        <li class="active">Nova categoria</li>       
    </ol>
    <div class="col-lg-8">
        <form class="form-horizontal" action="<?php echo base_url("cpainel/categoria/salvar_nova_categoria"); ?>" method="post" role="form">
            <div class="form-group">
                <label for="nome" class="col-sm-2 control-label">Nome</label>
                <div class="col-sm-10">
                    <input type="text" name="nome_categoria" class="form-control" id="titulo" placeholder="Nome">
                    <span class="text-danger"> <?php echo validation_errors(); ?></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-8 col-sm-4">
                    <a href="<?php echo base_url("cpainel/categoria"); ?>" class="btn btn-default" >Cancelar</a>
                    <button type="submit" class="btn btn-primary"> Salvar </button>
                </div>
            </div>
        </form>
    </div>
</div>