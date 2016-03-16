<?php
$nome_disciplina;
$id_disciplina;
foreach ($disciplina as $dc) {
    $nome_disciplina = $dc->nome_disciplina;
    $id_disciplina = $dc->id_disciplina;
}
?>
<div class="col-lg-12 semMargem">

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">
            <a href="<?php echo base_url("cpainel/disciplina") ?>"> <i class="glyphicon glyphicon-arrow-left"></i> Disciplina</a>: <?php echo $nome_disciplina ?> / <a href="<?php echo base_url("cpainel/turma?disciplina=" . $id_disciplina) ?>">  <i class="glyphicon glyphicon-arrow-left"></i>Turma / </a> Nova turma
        </div>
        <div class="panel-body">
            <div class="col-lg-6">

                <h3>Nova turma</h3>
                <form class="" action="<?php echo base_url("cpainel/turma/salvar_nova_turma"); ?>" method="post" role="form">
                    <input type="hidden" name="disciplina" value="<?php echo $id_disciplina ?>" />

                    <div class="form-group">
                        <label for="nome_turma" class="control-label">Nome</label>

                        <input type="text" name="nome_turma" class="form-control" id="nome_turma" placeholder="Nome">
                        <span class="text-danger"> <?php echo validation_errors(); ?></span>

                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-8 col-sm-4">
                            <a href="<?php echo base_url("cpainel/turma?disciplina=" . $id_disciplina); ?>" class="btn btn-default" >Cancelar</a>
                            <button type="submit" class="btn btn-primary"> Salvar </button>
                        </div>
                    </div>
                  
                </form>
            </div>
        </div>
    </div>

</div>