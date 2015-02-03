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
        <li><a href="<?php echo base_url("cpainel/trabalho?turma=" . $id_turma) ?>">Trabalho</a></li>
        <li class="active">Novo trabalho </li>       
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
                    <li role="presentation" ><a href="<?php echo base_url("cpainel/avaliacao?turma=" . $id_turma) ?>">Avaliações</a></li>
                    <li role="presentation" class="active"><a href="<?php echo base_url("cpainel/trabalho?turma=" . $id_turma) ?>">Trabalhos</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/notas?turma=" . $id_turma) ?>">Notas</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/turma/horario/" . $id_turma) ?>">Horário</a></li>
                </ul>
                <div class="col-lg-12 semMargem" style="/*border-left: 1px solid #ddd;border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; */">


                    <div class="col-lg-6"  style="padding-top: 5px; /* border-right: 1px solid #ddd; */">

                        <form class="form-horizontal" action="<?php echo base_url("cpainel/trabalho/salvar_novo_trabalho"); ?>" method="post" role="form">
                            <input type="hidden" name="turma" id="turma" value="<?php echo $id_turma ?>" />
                            <fieldset>
                                <legend>Novo trabalho</legend>
                                <div class="form-group">
                                    <label for="titulo_trabalho" class="col-sm-2 control-label">Titulo</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="titulo_trabalho" class="form-control" id="titulo_trabalho" value="<?php echo set_value('titulo_trabalho') ?>" placeholder="Titulo">
                                        <span class="text-danger"> <?php echo form_error('titulo_trabalho'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="descricao_trabalho" class="col-sm-2 control-label">Descrição</label>
                                    <div class="col-sm-10">
                                        <textarea name="descricao_trabalho" rows="4" class="form-control" id="descricao_trabalho" placeholder="Descrição"><?php echo set_value('descricao_trabalho') ?></textarea>
                                        <span class="text-danger"> <?php echo form_error('descricao_trabalho'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="data_entrega_trabalho" class="col-sm-2 control-label">Data entrega</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="data_entrega_trabalho" class="form-control" id="data_entrega_trabalho" value="<?php echo set_value('data_entrega_trabalho') ?>" placeholder="Data entrega">
                                        <span class="text-danger"> <?php echo form_error('data_entrega_trabalho'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="valor_trabalho" class="col-sm-2 control-label">Valor nota</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="valor_trabalho" class="form-control" id="valor_trabalho" value="<?php echo set_value('valor_trabalho') ?>" placeholder="Valor da nota">
                                        <span class="text-danger"> <?php echo form_error('valor_trabalho'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-sm-10">
                                        <div class="checkbox">
                                            <label for="abilitar_uplaod_trabalho">
                                                <input type="checkbox" id="abilitar_uplaod_trabalho" name="abilitar_upload_trabalho" value="1"  <?php echo set_checkbox('abilitar_upload_trabalho','1'); ?> >
                                                Abilitar upload de alunos.
                                            </label>
                                        </div>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <div class="col-md-offset-8 col-sm-4">
                                        <a href="<?php echo base_url("cpainel/trabalho?turma=" . $id_turma); ?>" class="btn btn-default" >Cancelar</a>
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