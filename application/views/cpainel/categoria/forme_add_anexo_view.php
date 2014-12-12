
<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/mural") ?>">Mural</a></li>
        <li class="active">adicionar anexo </li>       
    </ol>
    <div class="col-lg-8">
        <form class="form-horizontal" action="<?php echo base_url("cpainel/mural/salvar_anexo_mural"); ?>" method="post" enctype="multipart/form-data" role="form">

            <input type="hidden" name="id_mural" value="<?php echo $id_mural; ?>"/>

            <div class="form-group">
                <label for="titulo" class="col-sm-2 control-label">Texto</label>
                <div class="col-sm-10">

                    <input name="anexo_mural" type="file" class="form-control" id="anexo_mural" />
                    <span class="text-danger"><?php echo $error ?></span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-8 col-sm-4">
                    <a href="<?php echo base_url("cpainel/mural"); ?>" class="btn btn-default">Cancelar</a>
                    <button type="submit" class="btn btn-primary"> Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>