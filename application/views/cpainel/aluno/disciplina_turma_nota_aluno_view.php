<?php
$id_aluno;
$nome_aluno;
foreach ($aluno as $an) {
    $id_aluno = $an->id_aluno;
    $nome_aluno = $an->nome_aluno;
}

$nome_disciplina;
$descricao_disciplina;
$id_turma;
$nome_turma;

foreach ($disciplina_turma as $dt) {
    $nome_disciplina = $dt->nome_disciplina;

    $descricao_disciplina = $dt->descricao_disciplina;
    $nome_turma = $dt->nome_turma;
    $id_turma = $dt->id_turma;
}
?>
<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/aluno") ?>">Aluno</a></li>
        <li><a href="<?php echo base_url("cpainel/aluno/ver/" . $id_aluno) ?>">Ver aluno</a></li>
        <li class="active">Notas</li>       
    </ol>
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Aluno: <?php echo $nome_aluno ?></div>
        <ul class="list-group">
            <li class="list-group-item">Disciplina: <?php echo $nome_disciplina ?>, Turma: <?php echo $nome_turma ?></li>
        </ul>
        <div class="panel-body">
            <div class="col-lg-12">
                <ul class="nav nav-tabs">
                    <li role="presentation"><a href="<?php echo base_url("cpainel/aluno/disciplina_turma?turma=" . $id_turma . "&aluno=" . $id_aluno) ?>">Descrição</a></li>
                    <li role="presentation"><a href="#">Horários</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/aluno/disciplina_turma_avaliacao?turma=" . $id_turma . "&aluno=" . $id_aluno) ?>">Avaliações</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/aluno/disciplina_turma_trabalho?turma=" . $id_turma . "&aluno=" . $id_aluno) ?>">Trabalhos</a></li>
                    <li role="presentation" class="active"><a href="<?php echo base_url("cpainel/aluno/disciplina_turma_nota?turma=" . $id_turma . "&aluno=" . $id_aluno) ?>">Notas</a></li>
                </ul>
                <div class="col-lg-10" style="margin-top: 10px;">


                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <?php
                                $total_pontos_distribuido = 0;
                                foreach ($avaliacoes_turma as $at) {
                                    ?>
                                    <th>
                                        <?php
                                        echo $at->descricao_avaliacao;
                                        $total_pontos_distribuido += $at->valor_avaliacao
                                        ?>
                                    </th>

                                <?php } ?>
                                <?php foreach ($trabalhos_turma as $tt) { ?>

                                    <th>
                                        <?php
                                        echo $tt->titulo_trabalho;
                                        $total_pontos_distribuido += $tt->valor_nota_trabalho
                                        ?>
                                    </th>
                                <?php } ?>
                                <th>Total</th>
                                <th>Prova final</th>
                                <th>Resultado final</th>
                                <th>Situação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong> Notas do aluno </strong></td>
                                <?php
                                $total_pontos_trabalhos = 0;
                                $total_pontos_aluno = 0;
                                foreach ($avaliacoes_turma as $at) {
                                    ?>
                                    <td>
                                        <?php
                                        echo $at->nota_aluno;
                                        $total_pontos_aluno += $at->nota_aluno;
                                        ?>
                                    </td>
                                <?php } ?>
                                <?php foreach ($trabalhos_turma as $tt) {
                                    ?>
                                    <td>
                                        <?php
                                        echo $tt->nota_aluno;
                                        $total_pontos_aluno += $tt->nota_aluno;
                                        ?>
                                    </td>
                                <?php } ?>
                                <td>
                                    <?php
                                    echo $total_pontos_aluno;
                                    $total_ponto_final_aluno = $total_pontos_aluno
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    // Campo de nota de recuperação
                                    $recuperacao_existe = 0;
                                    if ($total_pontos_distribuido >= 100 && $total_pontos_aluno < 60) {
                                        foreach ($recuperacao_turma as $rt) {
                                            if ($rt->nota_aluno != NULL) {
                                                echo $rt->nota_aluno;
                                                if (($total_pontos_aluno + $rt->nota_aluno) / 2 > $total_pontos_aluno) {
                                                    $total_ponto_final_aluno = ($total_pontos_aluno + $rt->nota_aluno) / 2;
                                                } else {
                                                    $total_ponto_final_aluno = $total_pontos_aluno;
                                                }
                                                $recuperacao_existe = 1;
                                            } else {
                                                echo '--';
                                            }
                                        }
                                    } else {
                                        echo '--';
                                    }
                                    // final do campo de recuperaçõa
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $total_ponto_final_aluno;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($total_ponto_final_aluno >= 60) {
                                        ?>
                                        <span class="text-success">Aprovado</span>
                                        <?php
                                    } else if ($total_ponto_final_aluno >= 20 && $recuperacao_existe == 0) {
                                        ?>
                                        <span class="text-warning">Recuperação</span>
                                        <?php
                                    } else {
                                        ?>
                                        <span class="text-danger">Reprovado</span>
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr class="active">
                                <td><strong> Notas distribuidas </strong></td>
                                <?php
                                foreach ($avaliacoes_turma as $at) {
                                    ?>
                                    <td><strong>
                                            <?php
                                            echo $at->valor_avaliacao
                                            ?>
                                        </strong>
                                    </td>

                                <?php } ?>
                                <?php foreach ($trabalhos_turma as $tt) { ?>

                                    <td><strong>
                                            <?php
                                            echo $tt->valor_nota_trabalho
                                            ?>
                                        </strong>
                                    </td>
                                <?php } ?>
                                <td><strong><?php echo $total_pontos_distribuido ?></strong></td>
                                <td><strong>100</strong></td>
                                <td colspan="2" class="text-center"><strong>--</strong></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
