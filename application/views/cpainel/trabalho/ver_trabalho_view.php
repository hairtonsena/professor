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
<style type="text/css">
    /*#container {width: 800px;margin: 0 auto;}*/
    #porcentagem {width: 100%;margin-top: 10px; display: none}
    /*#mensagem {margin-top: 10px;}*/
    /*#barra{color: #000; background-color: #900; width: 0px;color: #000;}*/


    .inputFile {
        /*width: 185px;*/
        height:40px;
        position: relative;
        overflow: hidden;
        background: #5bc0de;
        line-height: 40px;
        /*cursor: pointer;*/
    }



    .inputFile span {
        display: block;
        position: absolute;
        color: #ffffff;
        font-size: 20px;
        /*cursor: pointer;*/
    }
    .inputFile input {
        position: absolute;
        right: 0;
        z-index: 2;
        font-size: 100px; /* Aumenta tamanho do campo */
        opacity: 0;
        filter: alpha(opacity=0);
        cursor: pointer;
    }


</style>
<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/disciplina") ?>">Disciplina</a></li>
        <li><a href="<?php echo base_url("cpainel/turma?disciplina=" . $id_disciplina) ?>">Turma</a></li>
        <li><a href="<?php echo base_url("cpainel/trabalho?turma=" . $id_turma) ?>">Trabalho</a></li>
        <li class="active">Ver trabalho </li>       
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
                    <li role="presentation" ><a href="<?php echo base_url("cpainel/avaliacao?turma=" . $id_turma) ?>">Avaliações</a></li>
                    <li role="presentation" class="active"><a href="<?php echo base_url("cpainel/trabalho?turma=" . $id_turma) ?>">Trabalhos</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/notas?turma=" . $id_turma) ?>">Notas</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/turma/horario/" . $id_turma) ?>">Horário</a></li>
                </ul>
                <div class="row col-lg-12 semMargem" style="/*border-left: 1px solid #ddd;border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; */">


                    <div class="col-lg-6"  style="padding-top: 5px; /* border-right: 1px solid #ddd; */">
                        <?php
                        $id_trabalho;
                        $pasta_trabalho;
                        foreach ($trabalho as $tr) {
                            $id_trabalho = $tr->id_trabalho;
                            $pasta_trabalho = $tr->pasta_upload_trabalho;
                            ?>
                            <div class="">
                                <div class="col-sm-3 control-label"><strong>Titulo</strong></div>
                                <div class="col-sm-9">
                                    <?php echo $tr->titulo_trabalho; ?>
                                </div>
                            </div>
                            <div class="">
                                <div class="col-sm-3 control-label"><strong>Descrição</strong></div>
                                <div class="col-sm-9">
                                    <?php echo $tr->descricao_trabalho; ?>
                                </div>
                            </div>
                            <div class="">
                                <div class="col-sm-3 control-label"><strong>Data entrega</strong></div>
                                <div class="col-sm-9">
                                    <?php  echo  date('d/m/Y', strtotime($tr->data_entrega_trabalho)); ?>
                                </div>
                            </div>
                            <div class="">
                                <div class="col-sm-3 control-label"><strong>Valor nota</strong></div>
                                <div class="col-sm-9">
                                    <?php echo $tr->valor_nota_trabalho; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-offset-3 col-sm-9">
                                    <div class="checkbox">
                                        <label for="abilitar_uplaod_trabalho">
                                            <?php if ($tr->abilitar_upload_trabalho == 1) { ?>
                                                <input type="checkbox" disabled="true" checked="true" >
                                            <?php } else { ?>
                                                <input type="checkbox" disabled="true">
                                            <?php } ?>
                                            Abilitar upload de alunos.
                                        </label>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>


                    </div>
                    <div class="col-lg-6"  style="padding-top: 5px; /* border-right: 1px solid #ddd; */">
                        <form action="<?php echo base_url("cpainel/trabalho/salvar_anexo_trabalh_o") ?>" method="post" id="form_upload" enctype="multipart/form-data">
                            <fieldset>
                                <legend>Adicionar anexo</legend>
                                <div id="container">
                                    <input type="hidden" id="iptTrabalho" name="trabalho" value="<?php echo $id_trabalho ?>"/> 
                                    <div id="mensagem"></div>
                                    <div class="inputFile col-lg-12">
                                        <span class="" id="textoCampoUp"><i class="glyphicon glyphicon-camera"></i> Selecione uma imagem </span>
                                        <input <?php
                                        if ($status_turma == 2) {
                                            echo 'disabled="true"';
                                        }
                                        ?> type="file" id="arquivo" accept="application/pdf" name="arquivo">
                                    </div>

                                    <div class="progress" id="porcentagem">
                                        <div class="progress-bar" id="barra" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
                                            0%
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <input type="submit" <?php
                                        if ($status_turma == 2) {
                                            echo 'disabled="true"';
                                        }
                                        ?>  class="btn btn-primary pull-right" name="enviar" id="btn_enviar">
                                    </div>

                                </div>
                            </fieldset>
                        </form>
                        <br/>
                        <div>
                            <div class="panel panel-primary">
                                <div class="panel-heading" style="color: white">
                                    Anexos
                                </div>
                                <ul class="list-group" id="anexo_trabalho">
                                    <?php foreach ($anexo_trabalho as $at) { ?>
                                        <li class="list-group-item" id="linha_anexo_<?php echo $at->id_anexo_trabalho ?>">
                                            <a target="blank" href="<?php echo base_url("trabalho/" . $pasta_trabalho . "/" . $at->arquivo_anexo_trabalho) ?>" ><?php echo $at->nome_anexo_trabalho; ?></a>
                                            <?php if ($status_turma != 2) { ?>
                                                <a href="javascript:void(0)" title="Remover anexo" class="link pull-right" data-toggle="modal" data-target="#modelExcluirAnexoTrabalho" data-anexo_trabalho="<?php echo $at->id_anexo_trabalho ?>">
                                                    <span class="glyphicon glyphicon-remove"></span>
                                                </a>
                                            <?php } else { ?>
                                                <span class="pull-right">
                                                    <span class="glyphicon glyphicon-remove"></span>
                                                </span>
                                            <?php } ?>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row col-lg-12 semMargem" style="padding-top: 25px;">
                    <div class="panel panel-default">
                        <div class="panel-heading">Trabalhos dos alunos</div>
                        <div class="panel-body">
                            <?php foreach ($trabalhos_alunos as $tra) { ?>
                                <div style="background-color: #F3F3F3; padding-bottom: 10px; border: 1px solid #dcdcdc; word-wrap: break-word;" class="col-md-2 ">
                                    <h4><?php echo $tra->nome_aluno ?></h4>
                                    <p class="text-center">
                                        <a target="blank" href="<?php echo base_url("trabalho/" . $tra->pasta_upload_trabalho . "/" . $tra->nome_arquivo_trabalho_aluno) ?>"> 
                                            <span class="glyphicon glyphicon-file"></span><br/>
                                            <?php echo $tra->nome_arquivo_trabalho_aluno ?> 
                                        </a>
                                    </p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!--Comfimação de exclusão-->
<div class="modal fade" id="modelExcluirAnexoTrabalho" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">        
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Excluir Anexo Trabalho</h4>
            </div>
            <div class="modal-body">
                <p>
                    Vecê está excluindo um anexo do trabalho. Deseja continuar ?
                </p>
                <input type="hidden" id="anexo_trabalho_excluir" value="" />

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                <button type="button" class="btn btn-primary" onclick="Trabalho.excluir_anexo_trabalho()">Sim</button>
            </div>
        </div>
    </div>
</div>
<!--Final de confirmação-->