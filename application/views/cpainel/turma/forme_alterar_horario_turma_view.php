<?php
$nome_disciplina;
$id_disciplina;
$nome_turma;
$id_turma;
$status_turma;
$horario_turma;
foreach ($turma_disciplina as $td) {
    $nome_disciplina = $td->nome_disciplina;
    $id_disciplina = $td->id_disciplina;
    $nome_turma = $td->nome_turma;
    $id_turma = $td->id_turma;
    $status_turma = $td->status_turma;
    $horario_turma = $td->horario_turma;
}
?>
<script type="text/javascript" src="<?php echo base_url("lib/ckeditor/ckeditor.js"); ?>" ></script>
<script type="text/javascript">
    window.onload = function () {
        CKEDITOR.replace('horario_turma');
    };
</script> 
<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/disciplina") ?>">Disciplina</a></li>
        <li><a href="<?php echo base_url("cpainel/turma?disciplina=" . $id_disciplina) ?>">Turma</a></li>
        <li class="active">Horário </li>       
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
                    <li role="presentation"><a href="<?php echo base_url("cpainel/avaliacao?turma=" . $id_turma) ?>">Avaliações</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/trabalho?turma=" . $id_turma) ?>">Trabalhos</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/notas?turma=" . $id_turma) ?>">Notas</a></li>
                    <li role="presentation" class="active"><a href="<?php echo base_url("cpainel/turma/horario/" . $id_turma) ?>">Horário</a></li>
                </ul>
                <div class="col-lg-12 semMargem" style="">
                    <div class="col-lg-8" style="padding-top: 5px;">

                        <!--<div  style="margin-top: 5px">-->

                        <form action="<?php echo base_url("cpainel/turma/salvar_horario") ?>" method="post">
                            <fieldset>
                                <legend>Alterar Horário</legend>
                                <input type="hidden" name="turma" value="<?php echo $id_turma ?>" />
                                <div class="form-group">
                                    <textarea class="form-control" id="horario_turma" name="horario_turma"><?php echo $horario_turma ?></textarea>
                                </div>
                                <!--</div>-->
                                <button class="btn btn-primary" type="submit">Salvar</button>
                            </fieldset>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!--Comfimação de exclusão-->
<div class="modal fade" id="modelExcluirAlunoTurma" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">        
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Excluir aluno da turma</h4>
            </div>
            <div class="modal-body">
                <p>Você realmente deseja excluir este aluno? </p>
                <input type="hidden" id="aluno_excluir" value="" />
                <input type="hidden" id="turma_excluir" value="" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                <button type="button" class="btn btn-primary" onclick="Aluno.excluir_aluno_turma()">Sim</button>
            </div>
        </div>
    </div>
</div>
<!--Final de confirmação-->