<?php
$id_categoria;
$nome_categoria;
foreach ($categoria as $ct) {
    $id_categoria = $ct->id_categoria;
    $nome_categoria = $ct->nome_categoria;
}
?>


<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/categoria") ?>">Categoria</a></li>
        <li><a href="<?php echo base_url("cpainel/categoria/subcategoria/".$id_categoria) ?>">Subcategoria</a></li>
        <li class="active">Nova subcategoria</li>       
    </ol>

    <div class="row col-lg-4">
        <h4>Categoria</h4>
        <h2><?php echo $nome_categoria?></h2>
    </div>
    <div class="col-lg-8">
        <form class="form-horizontal" action="<?php echo base_url("cpainel/categoria/salvar_nova_subcategoria"); ?>" method="post" role="form">
            <input type="hidden" name="categoria" value="<?php echo $id_categoria ?>" />
            <fieldset>
                <legend>Subcategoria</legend>
                <div class="form-group">
                    <label for="nome" class="col-sm-2 control-label">Nome</label>
                    <div class="col-sm-10">
                        <input type="text" name="nome_subcategoria" class="form-control" id="titulo" placeholder="Nome">
                        <span class="text-danger"> <?php echo validation_errors(); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-8 col-sm-4">
                        <a href="<?php echo base_url("cpainel/categoria/subcategoria/".$id_categoria); ?>" class="btn btn-default" >Cancelar</a>
                        <button type="submit" class="btn btn-primary"> Salvar </button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>