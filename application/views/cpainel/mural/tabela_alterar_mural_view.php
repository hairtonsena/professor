<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li class="active">Mural</li>       
    </ol>

    <a class="btn btn-primary" href="<?php echo base_url("cpainel/mural/nova"); ?>">Novo Mural</a>
    <table class="table table-striped">
        <thead>
            <tr>

                <td> Titulo </td>
                <td> Ver Texto </td>
                <td> anexos </td>
                <td> Excluir </td>
                <td> Status </td>

            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($mural as $mr) {
                if ($mr->status_mural == 0) {
                    ?>
                    <tr>

                        <td> <a href="<?php echo base_url("cpainel/mural/forme_editar_titulo_mural/" . $mr->id_mural); ?>"> <?php echo $mr->titulo_mural; ?> </a></td>
                        <td> <a href="<?php echo base_url("cpainel/mural/alterar_texto_mural/" . $mr->id_mural); ?>"> Texto </a></td>                    
                        <td> <a href="<?php echo base_url("cpainel/mural/forme_add_anexo_mural/" . $mr->id_mural); ?>"> add anexo </a>
                            <br/>

                            <?php
                            foreach ($anexo_mural as $am) {
                                if ($mr->id_mural == $am->id_mural) {
                                    ?>
                                    <a href="<?php echo base_url() . "anexo_mural/" . $am->arquivo_am ?>" ><?php echo $am->nome_arquivo_am ?></a>
                                    | <?php if ($am->status_am == 0) { ?>
                                        <a href="<?php echo base_url("cpainel/mural/ativar_anexor/" . $am->id_am) ?>" >ativar </a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="<?php echo base_url("cpainel/mural/desativar_anexor/" . $am->id_am) ?>" > Desativar </a>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </td>


                        <td> <a href = "javascript:func()" onclick="confirmacao('<?php echo $mr->id_mural ?>')"> Excluir </a></td>
                        <td>  <div class="dropdown pull-right">

                                <a class="dropdown-toggle" data-toggle="dropdown" data-toggle="dropdown" href="#"> Desativado
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="<?php echo base_url("cpainel/mural/ativar_mural/" . $mr->id_mural); ?>">Ativar</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php
                } else if ($mr->status_mural > 0) {
                    ?>
                    <tr>

                        <td> <?php echo $mr->titulo_mural; ?> </td>
                        <td>  <a class="btn" href="javascript:void(0)" onclick="Mural.verTextoMural('<?php echo $mr->id_mural; ?>')"> Ver texto </a> </td>
                        <td>       
                            <?php
                            foreach ($anexo_mural as $am) {
                                if ($mr->id_mural == $am->id_mural) {
                                    ?>
                                    <a href="<?php echo base_url() . "anexo_mural/" . $am->arquivo_am ?>" ><?php echo $am->nome_arquivo_am ?></a>
                                    <?php
                                }
                            }
                            ?>  </td>
                        <td>  Excluir </td>
                        <td>
                            <?php if ($mr->status_mural == 1) { ?>
                                <div class="dropdown pull-right">

                                    <a class="dropdown-toggle" data-toggle="dropdown" data-toggle="dropdown" href="#"> Ativado
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                        <li><a href="<?php echo base_url("cpainel/mural/desativar_mural/" . $mr->id_mural); ?>">Desativar</a></li>
                                        <li><a href="<?php echo base_url("cpainel/mural/arquivar_mural/" . $mr->id_mural); ?>">Arquivar</a></td></li>
                                    </ul>
                                </div>


                            <?php } else {
                                ?>
                                <div class="dropdown pull-right">

                                    <a class="dropdown-toggle" data-toggle="dropdown" data-toggle="dropdown" href="#"> Arquivado
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                        <li><a href="<?php echo base_url("cpainel/mural/desativar_mural/" . $mr->id_mural); ?>">Desativar</a></li>
                                        <li><a href="<?php echo base_url("cpainel/mural/ativar_mural/" . $mr->id_mural); ?>">Desarquivar</a></td></li>
                                    </ul>
                                </div>
                            <?php }
                            ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>

    </table>

    <script type="text/javascript">
        function confirmacao(id) 
        { var resposta = confirm("Você esta removendo um registro!");   
        if (resposta == true) { window.location.href = "<?php echo base_url('cpainel/mural/excluir_mural/'); ?>/"+id; } } 
    </script>
</div>