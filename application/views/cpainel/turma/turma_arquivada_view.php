<?php
$nome_disciplina;
$id_disciplina;
foreach ($disciplina as $dc) {
    $nome_disciplina = $dc->nome_disciplina;
    $id_disciplina = $dc->id_disciplina;
}
?>
<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/disciplina") ?>">Disciplina</a></li>
        <li><a href="<?php echo base_url("cpainel/turma?disciplina=".$id_disciplina) ?>">Turma</a></li>
        <li class="active">Turma arquivada </li>       
    </ol>
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Disciplina: <?php echo $nome_disciplina ?></div>
        <div class="panel-body">
            <div class="col-lg-6 semMargem">
                <h3>Turmas arquivadas</h3>
                <div style="margin-top: 5px">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> Nome </th>
                                <th class="col-lg-1 center"> Selecionar </th>
                                <th class="col-lg-1 center"> Desarquivar </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($turma as $tm) {
                                ?>

                                <tr id="linha_<?php echo $tm->id_turma ?>">
                                    <td> <?php echo $tm->nome_turma; ?> </td>
                                    <td class="text-center"><span id="btnAbrirTurma_<?php echo $tm->id_turma ?>"><a href="<?php echo base_url('cpainel/turma/alunos/' . $tm->id_turma) ?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </span></td>
                                    
                                    <td class="text-center"><span id="btnArquivaTurma_<?php echo $tm->id_turma ?>"><a href="javascript:void(0)" onclick="Turma.desarquivar_turma('<?php echo $tm->id_turma ?>')"><span class="glyphicon glyphicon-folder-close"></span></a></span></td>
                                </tr>
                                <?php
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