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
        <li><a href="<?php echo base_url("cpainel/notas?turma=" . $id_turma) ?>">Notas</a></li>
        <li class="active">Alterar notas </li>       
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
                    <li role="presentation"  class="active"><a href="<?php echo base_url("cpainel/notas?turma=" . $id_turma) ?>">Notas</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/turma/horario/" . $id_turma) ?>">Horário</a></li>
                </ul>
                <div class="col-lg-12 semMargem" style="border-left: 1px solid #ddd;border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; ">
                    <div class="col-lg-12" style="padding-top: 5px;">
                        <div style="margin-top: 5px">
                            <form method="post" action="<?php echo base_url("cpainel/notas/salvar_nota_alunos") ?>" >
                                <input type="hidden" name="turma" value="<?php echo $id_turma ?>" />
                                <input type="hidden" name="avaliacao" value="<?php echo $id_avaliacao ?>" />
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th> Nome </th>
                                            <th> <?php
                                                foreach ($avaliacao as $av) {
                                                    echo $av->descricao_avaliacao . " (valor: " . $av->valor_avaliacao . ")";
                                                }
                                                ?>   
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        <?php
                                        foreach ($alunos_turma as $at) {
                                            ?>
                                            <tr id="linha_aluno_turma_<?php echo $at->id_aluno ?>">
                                                <td><?php echo $at->nome_aluno; ?></td>                                                
                                                <td>
                                                    <?php echo form_input($campo_nota[$at->id_aluno]) ?>
                                                    <span class="text-danger"> <?php echo form_error($campo_nota[$at->id_aluno]['name']); ?></span>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <a href="<?php echo base_url("cpainel/notas?turma=" . $id_turma); ?>" class="btn btn-default" >Cancelar</a>
                                                <button type="submit" class="btn btn-primary">Salvar</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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