<?php
$id_noticia;
$titulo_noticia;
$data_noticia;
$imagem_mini_noticia;
foreach ($noticia as $nt) {
    $id_noticia = $nt->id_noticia;
    $titulo_noticia = $nt->titulo_noticia;
    $data_noticia = $nt->data_noticia;
    $imagem_mini_noticia = $nt->imagem_mini_noticia;
}
?>
<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/noticia") ?>">Notícia</a></li>
        <li class="active">Adicionar ou alterar imagem </li>       
    </ol>
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Notícia</div>
        <div class="panel-body">
            <div class="col-lg-12 semMargem" style="/*border-left: 1px solid #ddd;border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; */">


                <legend>Adicionar ou alterar imagem</legend>
                <div class="col-lg-4"  style="padding-top: 5px;">
                    <div class="form-group">
                        <label for="titulo_noticia" class="col-sm-12">Titulo</label>
                        <div class="col-sm-12">
                            <input type="text" disabled="true" name="titulo_noticia" class="form-control" id="titulo_noticia" value="<?php echo $titulo_noticia ?>" placeholder="Nome">
                            <span class="text-danger"> <?php echo form_error('titulo_noticia'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="data_noticia" class="col-sm-12">Data</label>
                        <div class="col-sm-12">
                            <input type="text" disabled="true" name="data_noticia" class="form-control" id="data_noticia" value="<?php if ($data_noticia != "0000-00-00") echo date('d/m/Y', strtotime($data_noticia)) ?>" placeholder="00/00/0000">
                            <span class="text-danger"> <?php echo form_error('data_noticia'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8"  style="padding-top: 5px; border-left: 1px solid #ddd;">


                    <form action="<?php echo base_url("cpainel/") ?>" method="post" id="form_upload" enctype="multipart/form-data">
                        <fieldset>
                            <legend>Adicionar imagem de capa</legend>
                            <div id="container">
                                <input type="hidden" name="noticia" id="iptNoticia" value="<?php echo $id_noticia ?>"/>
                                <div id="mensagem"></div>
                                <div class="inputFile col-lg-12">
                                    <span class="" id=""><i class="glyphicon glyphicon-camera"></i> Selecione uma imagem </span>
                                    <input type="file" id="arquivo"  name="arquivo">
                                    <!--accept="application/pdf"-->
                                </div>

                                <div class="progress" id="porcentagem">
                                    <div class="progress-bar" id="barra" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
                                        0%
                                    </div>
                                </div>
                                <div class="text-center">
                                    <input type="submit" class="btn btn-primary pull-right" name="enviar" id="btn_enviar_imagem_mini">
                                </div>  
                            </div>
                        </fieldset>
                    </form>
                    <br/>
                    <div>
                        <div class="panel panel-primary">
                            <div class="panel-heading" style="color: white">
                                Imagem
                            </div>
                            <div class="panel-body">
                                <div id="imagem_mini_retorno">
                                    <?php if ( $imagem_mini_noticia != NULL) { ?>
                                        <img src="<?php echo base_url("noticia/imagem_mini/" . $imagem_mini_noticia) ?>" />
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>