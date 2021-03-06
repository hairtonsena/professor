<?php
$nome_disciplina;
$id_disciplina;
$nome_turma;
$id_turma;
$status_turma;
foreach ($turma_disciplina as $td) {
    $nome_disciplina = $td->nome_disciplina;
    $id_disciplina = $td->id_disciplina;
    $nome_turma = $td->nome_turma;
    $id_turma = $td->id_turma;
    $status_turma = $td->status_turma;
}
?>
<div class="col-lg-12 semMargem">

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading"><a href="<?php echo base_url("cpainel/disciplina") ?>"><i class="glyphicon glyphicon-arrow-left"></i> Disciplina</a>: <?php echo $nome_disciplina ?> / <a href="<?php echo base_url("cpainel/turma?disciplina=" . $id_disciplina) ?>"><i class="glyphicon glyphicon-arrow-left"></i>Turma</a>: <?php echo $nome_turma ?></div>

        <div class="panel-body">
            <div class="col-lg-12 semMargem">
                <ul class="nav nav-tabs">
                    <li role="presentation" class="active"><a href="<?php echo base_url("cpainel/turma/alunos/" . $id_turma) ?>">Alunos</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/avaliacao/prova_escrita?turma=" . $id_turma) ?>">Prova escrita</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/trabalho?turma=" . $id_turma) ?>">Trabalhos</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/notas?turma=" . $id_turma) ?>">Notas</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/turma/horario/" . $id_turma) ?>">Horário</a></li>
                </ul>
                <div class="col-lg-12 semMargem" style="border-left: 1px solid #ddd;border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; ">
                    <div class="col-lg-12" style="padding-top: 5px;">
                        <?php if ($status_turma != 2) { ?>
                        <a class="btn btn-primary" href="<?php echo base_url("cpainel/aluno/novo_turma/" . $id_turma); ?>"><i class="glyphicon glyphicon-plus"></i> Aluno</a>
                        <?php } ?> 
                        <div style="margin-top: 5px">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> Nome </th>
                                        <th> Email </th>
                                        <th class="col-lg-1 center"> Excluir </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($alunos_turma as $at) {
                                        if ($at->status_aluno == 1) {
                                            ?>
                                            <tr id="linha_aluno_turma_<?php echo $at->id_aluno ?>">
                                                <td><?php echo $at->nome_aluno; ?></td>
                                                <td><?php echo $at->email_aluno; ?></td>
                                                <td class="text-center">
                                                    <?php if ($status_turma != 2) { ?>
                                                        <span id="btnExcluirTurma_<?php echo $at->id_aluno ?>"><a href="javascript:void(0)" data-toggle="modal" data-target="#modelExcluirAlunoTurma" data-aluno="<?php echo $at->id_aluno ?>" data-turma="<?php echo $id_turma ?>"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </a></span>
                                                    <?php } else { ?>
                                                        <span id="btnExcluirTurma_<?php echo $at->id_aluno ?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></span>                      

                                                    <?php } ?>
                                                </td>                                                
                                                <!--<td class="text-center"><span id="btnAtivarTurma_<?php // echo $at->id_aluno   ?>"><a href="javascript:void(0)" onclick="Turma.ativar_desativar_turma('<?php // echo $at->id_aluno   ?>')"> <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> </a></span></td>-->
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
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
                <p><strong>Atenção: </strong> Este aluno será excluido apenas desta turma, porém continuara cadastrado no site.
                    Desta forma, todos os arquivo e notas deste aluno para esta turma também serão excluidos. </p>
                <p>
                    Deseja continuar?
                </p>
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