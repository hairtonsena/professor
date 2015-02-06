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
<div class="row posicao_conteiner conteiner_smartphone ">
    <div  class="col-md-7 row sem_margen_pading">
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
            <h4>Trabalhos</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th class="col-md-3 text-center">Data entrega</th>
                        <th class="col-md-1 text-center">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($trabalhos_turma as $trt) { ?>

                        <tr>
                            <td class="col-md-10">
                                <a class="botao" data-toggle="collapse" href="#maisInformacoesTrabalho_<?php echo $trt->id_trabalho ?>" aria-expanded="false" aria-controls="maisInformacoesTrabalho_<?php echo $trt->id_trabalho ?>"><?php echo $trt->titulo_trabalho ?></a></td>
                            <td class="text-center col-md-2"><?php echo date('d/m/Y', strtotime($trt->data_entrega_trabalho)) ?></td>
                            <td class="text-center col-md-1"><?php echo $trt->valor_nota_trabalho ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" >
                                <div class="collapse" id="maisInformacoesTrabalho_<?php echo $trt->id_trabalho ?>">
                                    <p><?php echo $trt->descricao_trabalho ?></p>
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
                                                    <a target="blank" href="<?php echo base_url("trabalho/".$trt->pasta_upload_trabalho."/".$ant->arquivo_anexo_trabalho) ?>    "> <?php echo $ant->nome_anexo_trabalho ?> </a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
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
    </div>
    <!--fim logado-->