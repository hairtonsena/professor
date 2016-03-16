<?php
$nome_disciplina;
$descricao_disciplina;
$id_disciplina;

$nome_turma;
$horario_turma;
foreach ($disciplina_turma as $dt) {
    $nome_disciplina = $dt->nome_disciplina;
    $descricao_disciplina = $dt->descricao_disciplina;
    $id_disciplina = $dt->id_disciplina;

    $nome_turma = $dt->nome_turma;
    $horario_turma = $dt->horario_turma;
}
?>

<!--inicio logado-->
<div  class="col-md-9" style="padding-left: 0px;">

    <div class="col-md-12 semMargem">
        <div class="titulos">
            <a href="<?php echo base_url("ifnmg/") ?>"> IFNMG </a> / <a href="<?php echo base_url("ifnmg/disciplina/" . $id_disciplina) ?>"> Discliplina </a> / Turma
        </div>
        <h3 class="text-center"><?php echo $nome_disciplina ?></h3>
        <?php echo $descricao_disciplina ?>
    </div>


    <div class="col-md-12 semMargem">
        <div class="box_label_turma" style="border-bottom: 5px solid #0066cc;">
            <span class="titulo_turma_label">
                Turma: <?php echo $nome_turma ?>
            </span>
        </div>
    </div>
    
    <div class="col-md-12 semMargem">
        <h4 class="titulo_subitem_turma">Horários</h4>
        <p>
            <?php echo $horario_turma ?>
        </p>
    </div>

    <div class="col-md-12 semMargem">
        <h4 class="titulo_subitem_turma">Trabalhos</h4>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>Título</th>
                    <th class="col-md-3 text-center">Data entrega</th>
                    <th class="col-md-1 text-center">Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($trabalhos_turma as $trt) { ?>

                    <tr class="botao">
                        <td class="semMargem ">
                            <div >
                                <a data-toggle="collapse" href="#maisInformacoesTrabalho_<?php echo $trt->id_trabalho ?>" aria-expanded="false" aria-controls="maisInformacoesTrabalho_<?php echo $trt->id_trabalho ?>">
                                    <!--<span class="glyphicon glyphicon-triangle-bottom" ></span>-->
                                    <i class="glyphicon glyphicon-download"></i>
                                    <?php echo $trt->titulo_trabalho ?> 
                                </a>
                            </div>
                        </td>

                        <td class="text-center col-md-3">
                            <a data-toggle="collapse" href="#maisInformacoesTrabalho_<?php echo $trt->id_trabalho ?>" aria-expanded="false" aria-controls="maisInformacoesTrabalho_<?php echo $trt->id_trabalho ?>">
                                <?php echo date('d/m/Y', strtotime($trt->data_entrega_trabalho)) ?>
                            </a>
                        </td>
                        <td class="text-center col-md-1">
                            <a data-toggle="collapse" href="#maisInformacoesTrabalho_<?php echo $trt->id_trabalho ?>" aria-expanded="false" aria-controls="maisInformacoesTrabalho_<?php echo $trt->id_trabalho ?>">
                                <?php echo $trt->valor_nota_trabalho ?>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" >
                            <div class="collapse margem_detalhes_trabalhos" id="maisInformacoesTrabalho_<?php echo $trt->id_trabalho ?>">
                                <p class="text-center" style="font-size: 14px;"><strong> Descrição do trabalho </strong></p>
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
                                                <a target="blank" href="<?php echo base_url("trabalho/" . $trt->pasta_upload_trabalho . "/" . $ant->arquivo_anexo_trabalho) ?>    "> <?php echo $ant->nome_anexo_trabalho ?> </a></li>
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
    <div class="col-md-12 semMargem">
        <h4 class="titulo_subitem_turma">Avaliações</h4>
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