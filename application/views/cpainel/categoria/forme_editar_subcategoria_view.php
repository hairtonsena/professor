<?php
$id_categoria;
foreach ($subcategoria as $sc) {
    $id_categoria = $sc->id_categoria;
}
?>
<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/categoria") ?>">Categoria</a></li>
        <li><a href="<?php echo base_url("cpainel/categoria/subcategoria/" . $id_categoria) ?>">Subcategoria</a></li>
        <li class="active">Alterar subcategoria </li>       
    </ol>
    <div class="col-lg-8">
        <form class="form-horizontal" action="<?php echo base_url("cpainel/categoria/salvar_subcategoria_alterada"); ?>" method="post" role="form">
            <fieldset>
                <legend>Alterar subcategoria</legend>
                <?php foreach ($subcategoria as $sc) { ?>
                    <div class="form-group">
                        <label for="nome" class="col-sm-2 control-label">Nome</label>
                        <div class="col-sm-10">
                            <input type="text" name="nome_subcategoria" value="<?php echo $sc->nome_sub_categoria ?>" class="form-control" id="nome_categoria" placeholder="Nome">
                            <span class="text-danger"> <?php echo validation_errors(); ?></span>
                        </div>
                    </div>
                    <div class="form-group">

                        <input type="hidden" name="id_subcategoria" class="form-control" value="<?php echo $sc->id_sub_categoria ?>" />

                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-8 col-sm-4">
                            <a href="<?php echo base_url("cpainel/categoria/subcategoria/" . $id_categoria); ?>" class="btn btn-default">Cancelar</a>
                            <button type="submit" class="btn btn-primary"> Salvar </button>
                        </div>
                    </div>
                <?php } ?>
            </fieldset>
        </form>
    </div>
</div>
