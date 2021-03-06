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
        <div class="panel-heading"><a href="<?php echo base_url("cpainel/disciplina") ?>"><i class="glyphicon glyphicon-arrow-left"></i>Disciplina </a>: <?php echo $nome_disciplina ?></div>
        <div class="panel-body">
            <div class="col-lg-6 semMargem">
                <a class="btn btn-primary" href="<?php echo base_url("cpainel/turma/nova/" . $id_disciplina); ?>"><i class="glyphicon glyphicon-plus"></i> Turma</a>
                <a class="btn btn-default pull-right" href="<?php echo base_url("cpainel/turma/arquivada?disciplina=" . $id_disciplina); ?>">Turmas arquivadas</a>
                <div style="margin-top: 5px">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> Nome </th>
                                <th class="col-lg-1 center"> Selecionar </th>
                                <th class="col-lg-1 center"> Arquivar </th>
                                <th class="col-lg-1 center"> Alterar </th>
                                <th class="col-lg-1 center"> Excluir </th>
                                <th class="col-lg-1 center"> status </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($turma as $tm) {
                                if ($tm->status_turma == 0) {
                                    ?>
                                    <tr id="linha_<?php echo $tm->id_turma ?>">
                                        <td><?php echo $tm->nome_turma; ?></td>
                                        <td class="text-center"><span id="btnAbrirTurma_<?php echo $tm->id_turma ?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </span></td>
                                        <td class="text-center"><span id="btnArquivaTurma_<?php echo $tm->id_turma ?>"><span class="glyphicon glyphicon-folder-open"></span></span></td>
                                        <td class="text-center"><span id="btnEditarTurma_<?php echo $tm->id_turma ?>"><a href="<?php echo base_url('cpainel/turma/alterar/' . $tm->id_turma) ?>"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </a></span></td>

                                        <td class="text-center"><span id="btnExcluirTurma_<?php echo $tm->id_turma ?>"><a href="javascript:void(0)" data-toggle="modal" data-target="#modelExcluirTurma" data-turma="<?php echo $tm->id_turma ?>"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </a></span></td>
                                        <td class="text-center"><span id="btnAtivarTurma_<?php echo $tm->id_turma ?>"><a href="javascript:void(0)" onclick="Turma.ativar_desativar_turma('<?php echo $tm->id_turma ?>')"> <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> </a></span></td>

                                    </tr>
                                <?php } else { ?>
                                    <tr id="linha_<?php echo $tm->id_turma ?>">
                                        <td> <?php echo $tm->nome_turma; ?> </td>
                                        <td class="text-center"><span id="btnAbrirTurma_<?php echo $tm->id_turma ?>"><a href="<?php echo base_url('cpainel/turma/alunos/' . $tm->id_turma) ?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </span></td>
                                        <td class="text-center"><span id="btnArquivaTurma_<?php echo $tm->id_turma ?>"><a href="javascript:void(0)" onclick="Turma.arquivar_turma('<?php echo $tm->id_turma ?>')"><span class="glyphicon glyphicon-folder-open"></span></a></span></td>
                                        <td class="text-center"><span id="btnEditarTurma_<?php echo $tm->id_turma ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></span></td>

                                        <td class="text-center"><span id="btnExcluirTurma_<?php echo $tm->id_turma ?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></span></td>
                                        <td class="text-center"><span id="btnAtivarTurma_<?php echo $tm->id_turma ?>"><a href="javascript:void(0)" onclick="Turma.ativar_desativar_turma('<?php echo $tm->id_turma ?>')"> <span class="glyphicon glyphicon-check" aria-hidden="true"></span> </a></span></td>

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
<!--Comfimação de exclusão-->
<div class="modal fade" id="modelExcluirTurma" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">        
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Excluir turma</h4>
            </div>
            <div class="modal-body">
                <p id="mensagem_retorno" class="text-danger"></p>
                <p>Você realmente deseja excluir está turma? </p>
                <input type="hidden" id="turma_excluir" value="" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                <button type="button" class="btn btn-primary" onclick="Turma.excluir_turma()">Sim</button>
            </div>
        </div>
    </div>
</div>
<!--Final de confirmação-->