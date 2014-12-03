<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li class="active">Pregão Presencial</li>       
    </ol>
    <a class="btn btn-primary" href="<?php echo base_url("cpainel/pregao_presencial/novo"); ?>">Novo pregão presencial</a>
    <table class="table table-striped">
        <thead>
            <tr>

                <td> Titulo </td>
                <td> Objeto </td>
                <td> Anexos </td>
                <td> Data realização </td>
                <td> Status </td>

            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($pregao as $pg) {
                if ($pg->status_pp == 0) {
                    ?>
                    <tr>

                        <td> <a href="<?php echo base_url("cpainel/pregao_presencial/forme_editar_titulo_pregao/" . $pg->id_pp); ?>"> <?php echo $pg->titulo_pp; ?> </a></td>
                        <td><a href="<?php echo base_url("cpainel/pregao_presencial/alterar_objeto_pregao/" . $pg->id_pp); ?>">Alterar objeto</a></td>                    
                        <td> <a href="<?php echo base_url("cpainel/pregao_presencial/forme_add_anexo_pregao/" . $pg->id_pp); ?>"> add anexo </a>
                            <br/>
                            <?php
                            foreach ($anexo_pregao as $ap) {
                                if ($pg->id_pp == $ap->id_pp) {
                                    ?>  
                                    <a class="text-success" target="_blank" href="<?php echo base_url("anexo_pregao/" . $ap->nome_anexo_ap) ?>" ><?php echo $ap->nome_anexo_ap ?></a>
                                    | <?php if ($ap->status_ap == 0) { ?>
                                        <a href="<?php echo base_url("cpainel/pregao_presencial/ativar_anexor/" . $ap->id_ap) ?>" >ativar </a><br/>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="<?php echo base_url("cpainel/pregao_presencial/desativar_anexor/" . $ap->id_ap) ?>" > Desativar </a><br/>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </td>


                        <td> <a href = "<?php echo base_url("cpainel/pregao_presencial/form_data_realizacao_pregao/" . $pg->id_pp); ?>"> <?php echo implode("/", array_reverse(explode("-", $pg->data_realizacao_pp))) ?> </a></td>
                        <td>
                            <div class="dropdown pull-right">

                                <a class="dropdown-toggle" data-toggle="dropdown" data-toggle="dropdown" href="#"> Desativado
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="<?php echo base_url("cpainel/pregao_presencial/ativar_pregao/" . $pg->id_pp); ?>">Ativar</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php
                } else {
                    ?>
                    <tr>

                        <td> <?php echo $pg->titulo_pp; ?> </td>
                        <td> <a href="javascript:void(0)" onclick="Pregao.verObjetoPregao('<?php echo $pg->id_pp ?>')"> Ver objeto </a></td>
                        <td>       
                            <?php
                            foreach ($anexo_pregao as $ap) {
                                if ($pg->id_pp == $ap->id_pp) {
                                    ?>
                                    <a  class="text-success" target="_blank" href="<?php echo base_url("anexo_pregao/" . $ap->nome_anexo_ap) ?>" ><?php echo $ap->nome_anexo_ap ?></a><br/>
                                    <?php
                                }
                            }
                            ?>  </td>
                        <td> <?php echo implode("/", array_reverse(explode("-", $pg->data_realizacao_pp))) ?> </td>
                        <td> <?php if ($pg->status_pp == 1) { ?>
                                <div class="dropdown pull-right">

                                    <a class="dropdown-toggle" data-toggle="dropdown" data-toggle="dropdown" href="#"> Ativado
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                        <li><a href="<?php echo base_url("cpainel/pregao_presencial/desativar_pregao/" . $pg->id_pp); ?>">Desativar</a></li>
                                        <li><a href="<?php echo base_url("cpainel/pregao_presencial/arquivar_pregao/" . $pg->id_pp); ?>">Arquivar</a></td></li>
                                    </ul>
                                </div>
                                <?php
                            } else {
                                 ?>
                                <div class="dropdown pull-right">

                                    <a class="dropdown-toggle" data-toggle="dropdown" data-toggle="dropdown" href="#"> Arquivado
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                        <li><a href="<?php echo base_url("cpainel/pregao_presencial/desativar_pregao/" . $pg->id_pp); ?>">Desativar</a></li>
                                        <li><a href="<?php echo base_url("cpainel/pregao_presencial/ativar_pregao/" . $pg->id_pp); ?>">Desarquivar</a></td></li>
                                    </ul>
                                </div>
                            <?php
                            }
                            ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>

    </table>
    <div class="col-lg-12 text-center">
        <?php
        if ($paginacao) {
            echo $paginacao;
        }
        ?>
    </div>


</div>