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
    break;
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
                    <li role="presentation"><a href="<?php echo base_url("cpainel/turma/alunos/" . $id_turma) ?>">Alunos</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/avaliacao?turma=" . $id_turma) ?>">Avaliações</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/trabalho?turma=" . $id_turma) ?>">Trabalhos</a></li>
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
                                        $total_pontos_distribuido = 0;
                                        foreach ($avaliacoes_turma as $atr) {
                                            ?>
                                            <th><span title="<?php echo $atr->descricao_avaliacao ?>">A</span> </th>
                                            <?php
                                            $total_pontos_distribuido += $atr->valor_avaliacao;
                                        }
                                        foreach ($todos_trabalhos_turma as $ttt) {
                                            ?>
                                            <th><span title="<?php echo $ttt->titulo_trabalho ?>">T</span></th>
                                            <?php
                                            $total_pontos_distribuido += $ttt->valor_nota_trabalho;
                                        }
                                        ?>
                                        <th>Total</th>
                                        <th>Prova final</th>
                                        <th>Resultado final</th>
                                        <th>Situação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <?php
                                        foreach ($avaliacoes_turma as $atr) {
                                            echo '<td><a title="Alterar notas" href="' . base_url("cpainel/notas/alterar_notas?turma=" . $id_turma) . '&avaliacao=' . $atr->id_avaliacao . ' "><span class="glyphicon glyphicon-pencil"></span></a></td>';
                                        }
                                        foreach ($todos_trabalhos_turma as $ttt) {
                                            echo '<td><a title="Alterar notas" href="' . base_url("cpainel/notas/alterar_notas_trabalho?turma=" . $id_turma) . '&trabalho=' . $ttt->id_trabalho . ' "><span class="glyphicon glyphicon-pencil"></span></a></td>';
                                        }
                                        ?>
                                        <td></td>
                                        <td>
                                            <?php if ($total_pontos_distribuido >= 100) { ?>
                                                <a title="Alterar notas" href="<?php echo base_url("cpainel/notas/alterar_notas_avaliacao_recuperacao?turma=" . $id_turma) ?>">
                                                    <span class="glyphicon glyphicon-pencil"></span>
                                                </a>
                                            <?php } else { ?>
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            <?php } ?>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <?php
                                    $alunos_recuperacao = array();

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

                                            foreach ($todos_trabalhos_turma as $ttt) {
                                                if (!empty($notas_trabalhos[$alunoTurma->id_aluno][$ttt->id_trabalho])) {
                                                    echo '<td>' . $notas_trabalhos[$alunoTurma->id_aluno][$ttt->id_trabalho] . '</td>';
                                                    $total_ponto_aluno += $notas_trabalhos[$alunoTurma->id_aluno][$ttt->id_trabalho];
                                                } else {
                                                    echo '<td>0</td>';
                                                }
                                            }
                                            ?>
                                            <td>
                                                <strong>
                                                    <?php
                                                    echo $total_ponto_aluno;
                                                    ?>
                                                </strong>
                                            </td>
                                            <?php
                                            $verificar_recuperacao = 0;
                                            $valor_nota_recuperacao = 0;
                                            if ($total_ponto_aluno >= 20 && $total_ponto_aluno < 60 && $total_pontos_distribuido >= 100) {
                                                $alunos_recuperacao[] = $alunoTurma->id_aluno;

                                                foreach ($avaliacao_recuperacao as $ar) {
                                                    if (isset($nota_recuperacao[$alunoTurma->id_aluno][$ar->id_avaliacao_recuperacao])) {
                                                        echo '<td>' . $nota_recuperacao[$alunoTurma->id_aluno][$ar->id_avaliacao_recuperacao] . '</td>';
                                                        $verificar_recuperacao = 1;
                                                        $valor_nota_recuperacao = $nota_recuperacao[$alunoTurma->id_aluno][$ar->id_avaliacao_recuperacao];
                                                    } else {
                                                        echo '<td>-</td>';
                                                    }
                                                }
                                            } else {
                                                echo '<td>-</td>';
                                            }
                                            ?>
                                            <td>
                                                <strong>
                                                    <?php
                                                    $total_ponto_final_aluno = 0;
                                                    if ($verificar_recuperacao == 1) {
                                                        if ($total_ponto_aluno < (($total_ponto_aluno + $valor_nota_recuperacao) / 2)) {
                                                            $total_ponto_final_aluno = ($total_ponto_aluno + $valor_nota_recuperacao) / 2;
                                                        } else {
                                                            $total_ponto_final_aluno = $total_ponto_aluno;
                                                        }
                                                        echo $total_ponto_final_aluno;
                                                    } else {
                                                        $total_ponto_final_aluno = $total_ponto_aluno;
                                                        echo $total_ponto_final_aluno;
                                                    }
                                                    ?>
                                                </strong>
                                            </td>
                                            <td>

                                                <?php
                                                if ($total_ponto_final_aluno >= 60) {
                                                    ?>
                                                    <span class="text-success">Aprovado</span>
                                                    <?php
                                                } else if ($total_ponto_aluno >= 20 && $verificar_recuperacao == 0) {
                                                    ?>
                                                    <span class="text-warning">Recuperação</span>
                                                <?php } else { ?>
                                                    <span class="text-danger">Reprovado</span>
                                                    <?php
                                                }
                                                ?>
                                            </td>
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
                                        foreach ($todos_trabalhos_turma as $ttt) {
                                            $total_nota_avaliacoes += $ttt->valor_nota_trabalho;
                                            echo '<th>' . $ttt->valor_nota_trabalho . '</th>';
                                        }
                                        ?>
                                        <td><strong><?php echo $total_nota_avaliacoes ?></strong></td>
                                        <td>100</td>
                                        <td class="text-center" colspan="2">--</td>

                                        <?php
                                        $this->session->set_userdata(array("alunos_recuperacao" => $alunos_recuperacao));
                                        ?>
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