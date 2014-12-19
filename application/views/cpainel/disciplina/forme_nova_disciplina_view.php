<script type="text/javascript" src="<?php echo base_url("lib/ckeditor/ckeditor.js"); ?>" ></script>
<script type="text/javascript">
    window.onload = function () {
        CKEDITOR.replace('descricao_diciplina');
    };
</script> 
<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/disciplina") ?>">Disciplina</a></li>
        <li class="active">Nova Disciplina</li>       
    </ol>
    <div class="col-lg-12">
        <form class="form-horizontal" action="<?php echo base_url("cpainel/disciplina/salvar_nova_disciplina"); ?>" method="post" role="form">
            <div class="form-group">
                <label for="nome" class="col-sm-2 control-label">Nome</label>
                <div class="col-sm-10">
                    <input type="text" name="nome_disciplina" class="form-control" id="titulo" placeholder="Nome">
                    <span class="text-danger"> <?php echo validation_errors(); ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="descricao" class="col-sm-2 control-label">Descrição</label>
                <div class="col-sm-10">
                    <textarea name="descricao_disciplina" class="form-control" id="descricao_diciplina" rows="8" placeholder="Descrição"></textarea>
                   
                </div>
            </div>            

            <div class="form-group">
                <div class="col-md-offset-8 col-sm-4">
                    <a href="<?php echo base_url("cpainel/disciplina"); ?>" class="btn btn-default" >Cancelar</a>
                    <button type="submit" class="btn btn-primary"> Salvar </button>
                </div>
            </div>
        </form>
    </div>
</div>