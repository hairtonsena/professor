<script>
    Config.inicioaliza_editor_tinymce("textarea#descricao_diciplina");
</script>
<div class="row col-lg-12 semMargem">
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading"><a href="<?php echo base_url("cpainel/disciplina") ?>"><i class="glyphicon glyphicon-arrow-left"></i>  Disciplina</a> / nova disciplina</div>
        <div class="panel-body">
            <div class="col-lg-12">
                <form class="form-horizontal" action="<?php echo base_url("cpainel/disciplina/salvar_disciplina_alterada"); ?>" method="post" role="form">
                    <?php foreach ($disciplina as $dc) { ?>
                        <div class="form-group">
                            <label for="nome" class="control-label">Nome da disciplina</label>

                            <input type="text" name="nome_disciplina" value="<?php echo $dc->nome_disciplina ?>" class="form-control" id="nome_disciplina" placeholder="Nome">
                            <span class="text-danger"> <?php echo validation_errors(); ?></span>

                        </div>
                        <div class="form-group">
                            <label for="descricao" class="control-label">Plano de ensino</label>
                            <textarea name="descricao_disciplina" class="form-control" id="descricao_diciplina" rows="12" placeholder="Descrição"><?php echo $dc->descricao_disciplina ?></textarea>
                        </div> 
                        <div class="form-group">
                            <input type="hidden" name="id_disciplina" class="form-control" value="<?php echo $id_disciplina ?>">
                        </div>

                        <div class="form-group">
                            <div class="text-right">
                                <a href="<?php echo base_url("cpainel/disciplina"); ?>" class="btn btn-default">Cancelar</a>
                                <button type="submit" class="btn btn-primary"> Salvar </button>
                            </div>
                        </div>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</div>
