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


$notas_avaliacoes = array();

foreach ($notas_aluno_avaliacao as $naa) {
    $notas_avaliacoes[$naa->id_aluno][$naa->id_avaliacao] = $naa->valor_nota;
}
?>
<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/disciplina") ?>">Disciplina</a></li>
        <li><a href="<?php echo base_url("cpainel/turma?disciplina=" . $id_disciplina) ?>">Turma</a></li>
        <li class="active">Notas </li>       
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
                    <li role="presentation"><a href="#">Alunos</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/avaliacao?turma=" . $id_turma) ?>">Avaliações</a></li>
                    <li role="presentation"><a href="#">Trabalhos</a></li>
                    <li role="presentation"  class="active"><a href="<?php echo base_url("cpainel/notas?turma=" . $id_turma) ?>">Notas</a></li>
                </ul>
                <div class="col-lg-12 semMargem" style="border-left: 1px solid #ddd;border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; ">
                    <div class="col-lg-12" style="padding-top: 5px;">
                        <div style="margin-top: 5px">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> Nome </th>
                                        <?php
                                        foreach ($avaliacoes_turma as $atr) {
                                            echo '<th>' . $atr->descricao_avaliacao . '</th>';
                                        }
                                        ?>
                                        <th rowspan="2">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <?php
                                        foreach ($avaliacoes_turma as $atr) {
                                            echo '<td><a title="Alterar notas" href="' . base_url("cpainel/notas/alterar_notas?turma=" . $id_turma) . '&avaliacao=' . $atr->id_avaliacao . ' "><span class="glyphicon glyphicon-pencil"></span></a></td>';
                                        }
                                        ?>
                                        <td></td>
                                    </tr>



                                    <?php
                                    foreach ($alunos_turma as $alunoTurma) {
                                        ?>
                                        <tr>
                                            <td><?php echo $alunoTurma->nome_aluno; ?></td>

                                            <?php
                                            $total_ponto_aluno = 0;
                                            foreach ($avaliacoes_turma as $avt) {


                                                if (!empty($notas_avaliacoes[$alunoTurma->id_aluno][$avt->id_avaliacao])) {
                                                    echo '<td>' . $notas_avaliacoes[$alunoTurma->id_aluno][$avt->id_avaliacao] . '</td>';
                                                    $total_ponto_aluno += $notas_avaliacoes[$alunoTurma->id_aluno][$avt->id_avaliacao];
                                                } else {
                                                    echo '<td>0</td>';
                                                }
                                            }
                                            ?>
                                            <td><strong><?php echo $total_ponto_aluno ?></strong></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr style="background-color: #eee">
                                        <td></td>
                                        <?php
                                        $total_nota_avaliacoes = 0;
                                        foreach ($avaliacoes_turma as $atr) {
                                            $total_nota_avaliacoes += $atr->valor_avaliacao;
                                            echo '<td>' . $atr->valor_avaliacao . '</td>';
                                        }
                                        ?>
                                        <td><strong><?php echo $total_nota_avaliacoes ?></strong></td>
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