<?php
$nome_disciplina;
$id_disciplina;
foreach ($disciplina as $dc) {
    $nome_disciplina = $dc->nome_disciplina;
    $id_disciplina = $dc->id_disciplina;
}

$id_turma;
$nome_turma;
foreach ($turma as $tm) {
    $id_turma = $tm->id_turma;
    $nome_turma = $tm->nome_turma;
}
?>
<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/disciplina") ?>">Disciplina</a></li>
        <li><a href="<?php echo base_url("cpainel/turma?disciplina=" . $id_disciplina) ?>">Turma</a></li>
        <li class="active"> Alterar turma </li>       
    </ol>
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Disciplina: <?php echo $nome_disciplina ?></div>
        <div class="panel-body">
            <div class="col-lg-6 semMargem">

                <form class="form-horizontal" action="<?php echo base_url("cpainel/turma/salvar_turma_alterada"); ?>" method="post" role="form">
                    <input type="hidden" name="turma" value="<?php echo $id_turma ?>" />
                    <fieldset>
                        <legend>Alterar turma</legend>
                        <div class="form-group">
                            <label for="nome_turma" class="col-sm-2 control-label">Nome</label>
                            <div class="col-sm-10">
                                <input type="text" name="nome_turma" class="form-control" id="nome_turma" placeholder="Nome" value="<?php echo $nome_turma ?>" />
                                <span class="text-danger"> <?php echo validation_errors(); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-8 col-sm-4">
                                <a href="<?php echo base_url("cpainel/turma?disciplina=" . $id_disciplina); ?>" class="btn btn-default" >Cancelar</a>
                                <button type="submit" class="btn btn-primary"> Salvar </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

</div>