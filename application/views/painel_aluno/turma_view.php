<?php
$nome_disciplina;
$descricao_disciplina;

$nome_turma;
foreach ($disciplina_turma as $dt) {
    $nome_disciplina = $dt->nome_disciplina;
    $descricao_disciplina = $dt->descricao_disciplina;

    $nome_turma = $dt->nome_turma;
}
?>

<!--inicio logado-->
<div class="row posicao_conteiner conteiner_smartphone ">
    <div  class="col-md-7 row sem_margen_pading">

        <div class="titulos">Painel - aluno</div>
        <div class="titulos"><?php echo $nome_disciplina ?></div>
        <div class="col-md-12 linha">
            <?php echo $descricao_disciplina ?>
        </div>
        <div class="titulos">Turma: <?php echo $nome_turma ?></div>
        <div class="col-md-12 linha">
            <h4>Horários</h4>
            <p>Aqui fica os Horarios!</p>
        </div>

        <div class="col-md-12 linha">
            <h4>Trabalhos 2</h4>
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
                            <td><a class="" data-toggle="collapse" href="#maisInformacoesTrabalho_<?php echo $trt->id_trabalho ?>" aria-expanded="false" aria-controls="maisInformacoesTrabalho_<?php echo $trt->id_trabalho ?>"><?php echo $trt->titulo_trabalho ?></a></td>
                            <td class="text-center"><?php echo date('d/m/Y', strtotime($trt->data_entrega_trabalho)) ?></td>
                            <td class="text-center"><?php echo $trt->valor_nota_trabalho ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" >
                                <div class="collapse" id="maisInformacoesTrabalho_<?php echo $trt->id_trabalho ?>">
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
                                    <br/>
                                    <br/>

                                    <?php if ($trt->abilitar_upload_trabalho == 1) { ?>
                                    <form action="<?php echo base_url("trabalho/salvar_anexo_tsarabalh_o") ?>"  method="post" id="form_upload_<?php echo $trt->id_trabalho ?>" enctype="multipart/form-data">
                                            <fieldset>
                                                <legend>Enviar tabalho</legend>
                                                <!--<div id="container">-->
                                                    <input type="hidden" id="iptTrabalho" name="trabalho" value="<?php echo $trt->id_trabalho ?>"/> 
                                                    <div id="mensagem_<?php echo $trt->id_trabalho ?>"></div>
                                                    <div class="inputFile col-lg-12">
                                                        <span class="" id="textoCampoUp"><i class="glyphicon glyphicon-camera"></i> Selecione uma imagem </span>
                                                        <input type="file" class="form-control" id="arquivo_<?php echo $trt->id_trabalho ?>" accept="application/pdf" name="arquivo">
                                                    </div>

                                                    <div class="progress" id="porcentagem_<?php echo $trt->id_trabalho ?>">
                                                        <div class="progress-bar" id="barra_<?php echo $trt->id_trabalho ?>" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
                                                            0%
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <input type="submit" class="btn btn-primary pull-right" data-enviar_trabalho="<?php echo $trt->id_trabalho ?>" onclick="enviar_arquivo_aluno('<?php echo $trt->id_trabalho ?>')" name="enviar" id="btn_enviar_old">
                                                    </div>

                                                <!--</div>-->
                                            </fieldset>
                                        </form>

                                    <?php } ?>
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