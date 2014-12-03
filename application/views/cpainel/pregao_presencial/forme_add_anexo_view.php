<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a  href="<?php echo base_url("cpainel/pregao_presencial"); ?>">Pregão Presencial</a></li>
        <li class="active">Adicionar anexo</li>
    </ol>
    <div class="col-lg-8">
        <form class="form-horizontal" action="<?php echo base_url("cpainel/pregao_presencial/salvar_anexo_pregao"); ?>" method="post" enctype="multipart/form-data" role="form">

            <input type="hidden" name="id_pregao" value="<?php echo $id_pregao; ?>"/>

            <div class="form-group">
                <label for="titulo" class="col-sm-2 control-label">Texto</label>
                <div class="col-sm-10">
                    <input name="anexo_pregao" type="file" class="form-control" id="anexo_mural" />
                    <span class="text-danger"><?php echo $erros ?></span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-8 col-sm-4">
                    <a class="btn btn-default" href="<?php echo base_url("cpainel/pregao_presencial/ver_todos/") ?>">Cancelar</a>
                    <button type="submit" class="btn btn-primary"> Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>