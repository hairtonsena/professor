<?php
$nome_disciplina;
$descricao_disciplina;

$nome_turma;
$horario_turma;
foreach ($disciplina_turma as $dt) {
    $nome_disciplina = $dt->nome_disciplina;
    $descricao_disciplina = $dt->descricao_disciplina;

    $nome_turma = $dt->nome_turma;
    $horario_turma = $dt->horario_turma;
}
?>

<!--inicio logado-->
<div  class="col-md-8 row ">

    <div class="titulos">Painel - aluno</div>
    <div class="titulos"><?php echo $nome_disciplina ?></div>
    <div class="col-md-12 linha">
        <?php echo $descricao_disciplina ?>
    </div>
    <div class="titulos">Turma: <?php echo $nome_turma ?></div>
    <div class="col-md-12 linha">
        <h4>Horários</h4>
        <p>
            <?php echo $horario_turma ?>
        </p>
    </div>

    <div class="col-md-12 linha">
        <h4>Trabalhos 2</h4>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th class="col-md-3 text-center">Data entrega</th>
                    <th class="col-md-1 text-center">Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($trabalhos_turma as $trt) { ?>

                    <tr  class="botao">
                        <td><a data-toggle="collapse" href="#maisInformacoesTrabalho_<?php echo $trt->id_trabalho ?>" aria-expanded="false" aria-controls="maisInformacoesTrabalho_<?php echo $trt->id_trabalho ?>"><?php echo $trt->titulo_trabalho ?></a></td>
                        <td class="text-center"><a data-toggle="collapse" href="#maisInformacoesTrabalho_<?php echo $trt->id_trabalho ?>" aria-expanded="false" aria-controls="maisInformacoesTrabalho_<?php echo $trt->id_trabalho ?>"><?php echo date('d/m/Y', strtotime($trt->data_entrega_trabalho)) ?></a></td>
                        <td class="text-center"><a data-toggle="collapse" href="#maisInformacoesTrabalho_<?php echo $trt->id_trabalho ?>" aria-expanded="false" aria-controls="maisInformacoesTrabalho_<?php echo $trt->id_trabalho ?>"><?php echo $trt->valor_nota_trabalho ?></a></td>
                    </tr>
                    <tr>
                        <td colspan="3" >
                            <div class="collapse margem_detalhes_trabalhos" id="maisInformacoesTrabalho_<?php echo $trt->id_trabalho ?>">
                                <?php echo $trt->descricao_trabalho ?>
                                <br/>
                                <br/>
                                <div class="panel panel-primary">
                                    <div class="panel-heading" style="color: white">
                                        Anexos
                                    </div>
                                    <ul class="list-group" id="anexo_trabalho">
                                        <?php
                                        foreach ($trt->anexos_trabalho as $ant) {
                                            ?>
                                            <li class="list-group-item">
                                                <a target="blank" href="<?php echo base_url("trabalho/" . $trt->pasta_upload_trabalho . "/" . $ant->arquivo_anexo_trabalho) ?>    "> <?php echo $ant->nome_anexo_trabalho ?> </a></li>
                                        <?php } ?>
                                    </ul>
                                </div>


                                <?php
                                $data_hoje = date("Y-m-d", time());

                                if (($trt->abilitar_upload_trabalho == 1) && ($trt->data_entrega_trabalho >= $data_hoje)) {
                                    ?>
                                    <form action="<?php echo base_url("trabalho/salvar_anexo_tsarabalh_o") ?>"  method="post" id="form_upload_<?php echo $trt->id_trabalho ?>" enctype="multipart/form-data">
                                        <div class="linha">


                                            <input type="hidden" id="iptTrabalho" name="trabalho" value="<?php echo $trt->id_trabalho ?>"/> 
                                            <div id="mensagem_<?php echo $trt->id_trabalho ?>"></div>

                                            <div class="inputFile col-lg-12 sem_margen_pading">
                                                <h4>Enviar tabalho</h4>
        <!--                                                    <span class="" id="textoCampoUp"><i class="glyphicon glyphicon-file"></i> Selecione o arquivo </span>-->
                                                <input type="file" class="" id="arquivo_<?php echo $trt->id_trabalho ?>" accept="application/pdf" name="arquivo">
                                            </div>

                                            <div class="progress invisivel" id="porcentagem_<?php echo $trt->id_trabalho ?>">
                                                <div class="progress-bar invisivel" id="barra_<?php echo $trt->id_trabalho ?>" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
                                                    0%
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <input type="submit" class="btn btn-primary pull-right" data-enviar_trabalho="<?php echo $trt->id_trabalho ?>" onclick="enviar_arquivo_aluno('<?php echo $trt->id_trabalho ?>')" name="enviar" id="btn_enviar_old">
                                            </div>


                                        </div>
                                    </form>
                                <?php } ?>

                                <br/>
                                Meu trabalho
                                <div class="row col-lg-12" id="meu_trabalho_<?php echo $trt->id_trabalho ?>">
                                    <div style="background-color: #F3F3F3; padding-bottom: 10px; border: 1px solid #dcdcdc;" class="col-md-4 text-center">

                                        <?php
                                        foreach ($trt->trabalho_aluno as $tra) {
                                            ?>
                                            <a target="blank" href="<?php echo base_url("trabalho/" . $trt->pasta_upload_trabalho . "/" . $tra->nome_arquivo_trabalho_aluno) ?>"> 
                                                <span class="glyphicon glyphicon-file"></span><br/>
                                                <?php echo $tra->nome_arquivo_trabalho_aluno ?> 
                                            </a>
                                        <?php } ?>

                                    </div>
                                </div>
                                <br/>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="col-md-12 linha">
        <h4>Avaliações</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th class="col-md-3 text-center">Data entrega</th>
                    <th class="col-md-1 text-center">Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($avaliacoes_turma as $avt) { ?>
                    <tr>
                        <td><?php echo $avt->descricao_avaliacao ?></td>
                        <td class="text-center"><?php echo date('d/m/Y', strtotime($avt->data_avaliacao)) ?></td>
                        <td class="text-center"><?php echo $avt->valor_avaliacao ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="col-md-12 linha">
        <h4>Notas Aluno</h4>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th class="text-center">Valor nota</th>
                    <th class="text-center">Nota aluno</th>
                    <th class="text-center">Tipo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_nota_distribuida = 0;
                $total_nota_anual_aluno = 0;

                $verificar_recuperacao = FALSE;
                $verificar_recuperacao_realizada = FALSE;
                $valor_nota_recuperacao = 0;
                $total_nota_definitiva = 0;
                ?>
                <?php foreach ($trabalhos_turma as $trt) { ?>
                    <?php
                    $total_nota_distribuida += $trt->valor_nota_trabalho;
                    $total_nota_anual_aluno += $trt->nota_aluno;
                    ?>
                    <tr>
                        <td><?php echo $trt->titulo_trabalho ?></td>
                        <td class="text-center"><?php echo $trt->valor_nota_trabalho ?></td>
                        <td class="text-center"><?php echo $trt->nota_aluno ?></td>
                        <td class="text-center"><span title="Trabalho">T</span></td>
                    </tr>
                <?php } ?>  
                <?php foreach ($avaliacoes_turma as $avt) { ?>
                    <?php
                    $total_nota_distribuida += $avt->valor_avaliacao;
                    $total_nota_anual_aluno += $avt->nota_aluno;
                    ?>
                    <tr>
                        <td><?php echo $avt->descricao_avaliacao ?></td>
                        <td class="text-center"><?php echo $avt->valor_avaliacao ?></td>
                        <td class="text-center"><?php echo $avt->nota_aluno ?></td>
                        <td class="text-center"><span title="Avaliação"> A</span></td>
                    </tr>
                <?php } ?>

                <tr>
                    <td>
                        Total
                    </td>
                    <td class="text-center"><?php echo $total_nota_distribuida ?></td>
                    <td class="text-center"><?php echo $total_nota_anual_aluno ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Prova final</td>
                    <td class="text-center">100</td>
                    <td class="text-center">
                        <?php if ($total_nota_distribuida < 100) { ?>
                            --
                            <?php
                        } else if (($total_nota_anual_aluno < 40)or ( $total_nota_anual_aluno >= 60)) {
                            echo "--";
                        } else {
                            $verificar_recuperacao = TRUE;
                            foreach ($avaliacao_recuperacao_turma as $art) {
                                if ($art->nota_aluno == null) {
                                    echo "--";
                                } else {
                                    echo $art->nota_aluno;
                                    $valor_nota_recuperacao = $art->nota_aluno;
                                    $verificar_recuperacao_realizada = TRUE;
                                }
                            }
                            ?>


                        <?php } ?>
                    </td>
                    <td class="text-center"><span title="Recuperação">R</span></td>
                </tr>
                <tr>
                    <td>Resultado Final</td>
                    <td class="text-center"></td>
                    <td class="text-center">
                        <?php
                        if ($verificar_recuperacao == FALSE) {
                            echo $total_nota_anual_aluno;
                        } else {
                            $total_nota_recuperacao = ($total_nota_anual_aluno + $valor_nota_recuperacao) / 2;
                            if ($total_nota_recuperacao < $total_nota_anual_aluno) {
                                echo $total_nota_anual_aluno;
                                $total_nota_definitiva = $total_nota_anual_aluno;
                            } else {
                                echo $total_nota_recuperacao;
                                $total_nota_definitiva = $total_nota_recuperacao;
                            }
                        }
                        ?>
                    </td>
                    <td class="text-center"><span title="Resultado final">F</span></td>
                </tr>
                <tr>
                    <td>Situação aluno</td>
                    <td class="text-center" colspan="2">
                        <?php
                        if ($total_nota_distribuida < 100) {
                            echo "Em andamento";
                        } else if ($total_nota_anual_aluno < 40) {
                            echo "Reprovado";
                        } else if ($total_nota_anual_aluno >= 60) {
                            echo "Aprovado";
                        } else if ($verificar_recuperacao_realizada == FALSE) {
                            echo 'Recuperação';
                        } else if ($total_nota_definitiva < 60) {
                            echo "Reprovado";
                        } else {
                            echo "Aprovado";
                        }
                        ?>
                    </td>
                    <td class="text-center"><span title="Situação">S</span></td>
                </tr>
            </tbody>
        </table>
        <p>
            * T = Trabalho<br/>
            * A = Avaliação<br/>
            * R = Recuperação<br/>
            * F = Resultado final<br/>
            * S = Situação
        </p>

    </div>
</div>
<!--fim logado-->