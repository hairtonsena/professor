
<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li class="active">Notícia</li>
    </ol>
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Notícia</div>
        <div class="panel-body">
            <div class="col-lg-12 semMargem">
                <a  href="<?php echo base_url("cpainel/noticia/nova") ?>" class="btn btn-primary" id="btnNovaNoticia">Nova notícia</a>
                <div style="margin-top: 5px">
                    <table class="table table-bordered" id="tabelaCategoria">
                        <thead>
                            <tr>
                                <th class="col-lg-2"> imagem mini </th>
                                <th class="col-lg-4"> Titulo </th>
                                <th class="col-lg-1 text-center">texto</th>
                                <th class="col-lg-1 text-center">data</th>
                                <th class="col-lg-1 text-center"> Alterar </th>
                                <th class="col-lg-1 text-center"> Excluir </th>
                                <th class="col-lg-1 text-center"> status </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($todas_noticias as $tnc) {
                                if ($tnc->status_noticia == 0) {
                                    ?>
                                    <tr>
                                        <td> 
                                            <span class="pull-right" id="btnImagemMini_<?php echo $tnc->id_noticia ?>">
                                                <a href="<?php echo base_url("cpainel/noticia/alterar_imagem_mini/" . $tnc->id_noticia) ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> <a href="javascript:void(0)" onclick="Noticia.excluir_imagem_mini('<?php echo $tnc->id_noticia ?>')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                                            </span><br/>

                                            <?php
                                            if ($tnc->imagem_mini_noticia == null) {
                                                echo "sem imagem";
                                            } else {
                                                ?>
                                                <img src="<?php echo base_url("noticia/imagem_mini/" . $tnc->imagem_mini_noticia) ?>" width="180" />

                                            <?php }
                                            ?>
                                        </td>
                                        <td class=""><?php echo $tnc->titulo_noticia ?></td>
                                        <td class="text-center"><a href="javascript:void(0)" data-toggle="modal" data-target="#modelExibirConteudoNoticia" data-noticia="<?php echo $tnc->id_noticia ?>"> <span class="glyphicon glyphicon-list-alt"></span></a></td>
                                        <td class="text-center"><?php
                                            if ($tnc->data_noticia != "0000-00-00")
                                                echo date('d/m/Y', strtotime($tnc->data_noticia));
                                            else
                                                echo "00/00/0000";
                                            ?></td>
                                        <td class="text-center"><span id="btnEditarNoticia_<?php echo $tnc->id_noticia ?>"><a href="<?php echo base_url('cpainel/noticia/alterar/' . $tnc->id_noticia) ?>"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </a></span></td>
                                        <td class="text-center"><span id="btnExcluirNoticia_<?php echo $tnc->id_noticia ?>"><a href="javascript:void(0)" data-toggle="modal" data-target="#modelExcluirNoticia" data-noticia="<?php echo $tnc->id_noticia ?>"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </a></span></td>
                                        <td class="text-center">
                                            <span id="btnAtivarNoticia_<?php echo $tnc->id_noticia ?>">
                                                <a href="javascript:void(0)" onclick="Noticia.ativar_desativar_noticia('<?php echo $tnc->id_noticia ?>')">
                                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                                </a>
                                            </span>
                                        </td>
                                    </tr>
                                <?php } else {
                                    ?>
                                    <tr>
                                        <td>
                                            <span class="pull-right" id="btnImagemMini_<?php echo $tnc->id_noticia ?>">
                                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                            </span>
                                            <br/>

                                            <?php
                                            if ($tnc->imagem_mini_noticia == null) {
                                                echo "sem imagem";
                                            } else {
                                                ?>
                                                <img src="<?php echo base_url("noticia/imagem_mini/" . $tnc->imagem_mini_noticia) ?>" width="180" />

                                            <?php }
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $tnc->titulo_noticia; ?></td>
                                        <td class="text-center"><a href="javascript:void(0)" data-toggle="modal" data-target="#modelExibirConteudoNoticia" data-noticia="<?php echo $tnc->id_noticia ?>"> <span class="glyphicon glyphicon-list-alt"></span></a></td>
                                        <td class="text-center">
                                            <?php
                                            if ($tnc->data_noticia != "0000-00-00")
                                                echo date('d/m/Y', strtotime($tnc->data_noticia));
                                            else
                                                echo "00/00/0000";
                                            ?>
                                        </td>
                                        <td class="text-center"><span id="btnEditarNoticia_<?php echo $tnc->id_noticia ?>"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </span></td>
                                        <td class="text-center"><span id="btnExcluirNoticia_<?php echo $tnc->id_noticia ?>"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </span></td>
                                        <td class="text-center"><span id="btnAtivarNoticia_<?php echo $tnc->id_noticia ?>"> <a href="javascript:void(0)" onclick="Noticia.ativar_desativar_noticia('<?php echo $tnc->id_noticia ?>')"> <span class="glyphicon glyphicon-check" aria-hidden="true"></span> </a></span></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<!--Comfimação de exclusão-->
<div class="modal fade" id="modelExcluirNoticia" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Excluir notícia</h4>
            </div>
            <div class="modal-body">
                <p>Você realmente deseja excluir esta notícia?</p>
                <input type="hidden" id="noticia_excluir" value="" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                <button type="button" class="btn btn-primary" onclick="Noticia.excluir_noticia()">Sim</button>
            </div>
        </div>
    </div>
</div>
<!--Final de confirmação-->
<!--Madal para exibir o conteudo da notícia-->
<div class="modal fade" id="modelExibirConteudoNoticia" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Notícia</h4>
            </div>
            <div class="modal-body" id="textoNoticia">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!-- Fim forme de alterar senha aluno -->
