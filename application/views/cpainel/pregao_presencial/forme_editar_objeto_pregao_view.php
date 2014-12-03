<script type="text/javascript" src="<?php echo base_url(); ?>ckeditor/ckeditor.js" ></script>
<script type="text/javascript">
    window.onload = function()  {
        CKEDITOR.replace( 'objeto_pregao' );
    };
</script> 

<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a  href="<?php echo base_url("cpainel/pregao_presencial"); ?>">Pregão Presencial</a></li>
        <li class="active">Alterar objeto</li>
    </ol>
    <form class="form-horizontal" action="<?php echo base_url("cpainel/pregao_presencial/salvar_objeto_pregao"); ?>" method="post" role="form">

        <input type="hidden" name="id_pregao" value="<?php echo $id_pregao; ?>"/>

        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label"> Objeto </label>
            <div class="col-sm-10">
                <textarea name="objeto_pregao" class="form-control" rows="5" id="objeto_pregao" placeholder="Objeto Pregão">

                    <?php
                    foreach ($objeto_pregao as $op) {
                        echo $op->objeto_pp;
                    }
                    ?>
                </textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-9 col-sm-4">
                <a class="btn btn-default" href="<?php echo base_url("cpainel/pregao_presencial/ver_todos/"); ?>">Cancelar</a>
                <button type="submit" class="btn btn-primary"> Salvar</button>
            </div>
        </div>
    </form>

</div>