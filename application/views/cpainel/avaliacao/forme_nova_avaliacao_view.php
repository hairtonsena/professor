<?php
$nome_disciplina;
$id_disciplina;
$nome_turma;
$id_turma;
foreach ($turma_disciplina as $td) {
    $nome_disciplina = $td->nome_disciplina;
    $id_disciplina = $td->id_disciplina;
    $nome_turma = $td->nome_turma;
    $id_turma = $td->id_turma;
}
?>
<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/disciplina") ?>">Disciplina</a></li>
        <li><a href="<?php echo base_url("cpainel/turma?disciplina=" . $id_disciplina) ?>">Turma</a></li>
        <li><a href="<?php echo base_url("cpainel/avaliacao?turma=" . $id_turma) ?>">Avaliação</a></li>
        <li class="active">Nova avaliação </li>       
    </ol>
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Disciplina: <?php echo $nome_disciplina ?></div>
        <ul class="list-group">
            <li class="list-group-item text-danger">Turma: <?php echo $nome_turma ?></li>
        </ul>
        <div class="panel-body">
            <div class="col-lg-12 semMargem">
                <ul class="nav nav-tabs">
                    <li role="presentation"><a href="<?php echo base_url("cpainel/turma/alunos/" . $id_turma) ?>">Alunos</a></li>
                    <li role="presentation" class="active"><a href="<?php echo base_url("cpainel/avaliacao?turma=" . $id_turma) ?>">Avaliações</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/trabalho?turma=" . $id_turma) ?>">Trabalhos</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/notas?turma=" . $id_turma) ?>">Notas</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/turma/horario/" . $id_turma) ?>">Horário</a></li>
                </ul>
                <div class="col-lg-12 semMargem" style="/*border-left: 1px solid #ddd;border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; */">


                    <div class="col-lg-6"  style="padding-top: 5px; /* border-right: 1px solid #ddd; */">

                        <form class="form-horizontal" action="<?php echo base_url("cpainel/avaliacao/salvar_nova_avaliacao"); ?>" method="post" role="form">
                            <input type="hidden" name="turma" id="turma" value="<?php echo $id_turma ?>" />
                            <fieldset>
                                <legend>Nova avaliação</legend>
                                <div class="form-group">
                                    <label for="descricao_avaliacao" class="col-sm-2 control-label">Descrição</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="descricao_avaliacao" class="form-control" id="descricao_avaliacao" value="<?php echo set_value('descricao_avaliacao') ?>" placeholder="Descrição">
                                        <span class="text-danger"> <?php echo form_error('descricao_avaliacao'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="data_avaliacao" class="col-sm-2 control-label">Data</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="data_avaliacao" class="form-control" id="data_avaliacao" value="<?php echo set_value('data_avaliacao') ?>" placeholder="Data">
                                        <span class="text-danger"> <?php echo form_error('data_avaliacao'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="valor_avaliacao" class="col-sm-2 control-label">Valor</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="valor_avaliacao" class="form-control" id="valor_avaliacao" value="<?php echo set_value('valor_avaliacao') ?>" placeholder="Valor">
                                        <span class="text-danger"> <?php echo form_error('valor_avaliacao'); ?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-offset-8 col-sm-4">
                                        <a href="<?php echo base_url("cpainel/avaliacao?turma=" . $id_turma); ?>" class="btn btn-default" >Cancelar</a>
                                        <button type="submit" class="btn btn-primary"> Salvar </button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>