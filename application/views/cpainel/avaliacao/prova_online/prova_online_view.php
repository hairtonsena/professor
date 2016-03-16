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
                    <li role="presentation"><a href="<?php echo base_url("cpainel/turma/alunos/" . $id_turma) ?>">Alunos</a></li>
                    <li role="presentation" ><a href="<?php echo base_url("cpainel/avaliacao/prova_escrita/?turma=" . $id_turma) ?>">Prova escrita</a></li>
                    <li role="presentation" class="active"><a href="<?php echo base_url("cpainel/prova_online?turma=" . $id_turma) ?>">Prova online</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/trabalho?turma=" . $id_turma) ?>">Trabalhos</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/avaliacao/avaliacao_recuperacao/" . $id_turma) ?>">Prova recuperação</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/notas?turma=" . $id_turma) ?>">Notas</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/turma/horario/" . $id_turma) ?>">Horário</a></li>
                </ul>
                <div class="col-lg-12 semMargem" style="border-left: 1px solid #ddd;border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; ">
                    <div class="col-lg-12" style="padding-top: 5px;">
                        <?php if ($status_turma != 2) { ?>
                            <a class="btn btn-primary" href="<?php echo base_url("cpainel/prova_online/nova_prova_online/" . $id_turma); ?>"><i class="glyphicon glyphicon-plus"></i> Prova on-line</a>
                        <?php } ?>
                        <div style="margin-top: 5px">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> Nome </th>
                                        <th class="col-lg-1 center"> Data </th>
                                        <th class="col-lg-1 center"> valor </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total_pontos = 0;

                                    foreach ($prova_on_matriz_turma as $pro_on_mat_tur) {

                                        $total_pontos+=$pro_on_mat_tur->valor_ponto_prova_on_matriz;
                                        ?>
                                        <tr>
                                            <td> 
                                                <a href="<?php echo base_url("cpainel/prova_online/ver_prova_online/".$pro_on_mat_tur->id_prova_on_matriz) ?>" >
                                                <?php echo $pro_on_mat_tur->nome_prova_on_matriz; ?>
                                                </a>
                                                </td>   
                                            <td class="text-center"><?php echo date('d/m/Y', strtotime($pro_on_mat_tur->data_realizacao_prova_on_matriz)); ?></td> 
                                            <td class="text-center"><?php echo number_format($pro_on_mat_tur->valor_ponto_prova_on_matriz,2); ?></td> 

                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr style="background-color: #eee">
                                        <td colspan="2"><strong> Total de Pontes </strong></td>
                                        <td  class="text-center"><strong id="total_pontos_avaliacoes"><?php echo number_format($total_pontos,2); ?></strong></td>
                                        
                                    </tr>
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
<div class="modal fade" id="modelExcluirAvaliacao" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">        
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Excluir avaliação</h4>
            </div>
            <div class="modal-body">
                <p>
                    Se você excluir esta avaliação, automaticamente as notas para a mesma seram excluidas<br/>
                    Você realmente deseja excluir?
                </p>
                <input type="hidden" id="avaliacao_excluir" value="" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                <button type="button" class="btn btn-primary" onclick="Avaliacao.excluir_avaliacao()">Sim</button>
            </div>
        </div>
    </div>
</div>
<!--Final de confirmação-->