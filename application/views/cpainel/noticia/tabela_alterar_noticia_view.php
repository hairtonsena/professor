<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li class="active">Notícia </li>       
    </ol>
    <a class="btn btn-primary" href="<?php echo base_url("cpainel/noticia/nova"); ?>">Nova Notícia</a>
    <a class="btn btn-default" href="<?php echo base_url("cpainel/noticia/slides"); ?>"> Slide</a>
    <table class="table table-striped">
        <thead>
            <tr>

                <td> Titulo </td>
                <td> Imagem </td>
                <td> Ver Texto </td>    
                <td> Excluir </td>
                <td> Status </td>
                <td> Destaque </td>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($noticia as $nt) {
                if ($nt->status_noticia == 0) {
                    ?>
                    <tr>
                        <!--<td> <?php // echo $nt->id_noticia;           ?> </td>-->
                        <td> <a href="<?php echo base_url("cpainel/noticia/forme_editar_titulo_noticia/" . $nt->id_noticia); ?>"> <?php echo $nt->titulo_noticia; ?> </a></td>
                        <td> <a href="<?php echo base_url("cpainel/noticia/alterar_imagem_noticia/" . $nt->id_noticia); ?>">alterar <br/> <img src="<?php echo base_url("imagem_noticia/" . $nt->imagem_noticia); ?>" width="100px" height="100px" /> </a></td>

                        <td> <a href="<?php echo base_url("cpainel/noticia/alterar_texto_noticia/" . $nt->id_noticia); ?>"> alterar texto </a></td>
                        <td> <a href = "javascript:func()" onclick="confirmacao('<?php echo $nt->id_noticia ?>')"> Excluir </a></td>
                        <td><a  href="<?php echo base_url("cpainel/noticia/ativar_noticia/" . $nt->id_noticia); ?>"> Ativar </a> </td>

                        <td>
                            <?php if ($nt->destaque_noticia == 0) { ?>
                                <a  href="<?php echo base_url("cpainel/noticia/ativar_destaque/" . $nt->id_noticia); ?>"> <i class="glyphicon glyphicon-remove"></i> </a> 
                            <?php } else { ?>
                                <a  href="<?php echo base_url("cpainel/noticia/desativar_destaque/" . $nt->id_noticia); ?>"> <i class="glyphicon glyphicon-ok"></i> </a> 
                            <?php } ?>
                        </td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <!--<td> <?php // echo $nt->id_noticia;           ?> </td>-->
                        <td> <?php echo $nt->titulo_noticia; ?> </td>
                        <td> <img src="<?php echo base_url("imagem_noticia/" . $nt->imagem_noticia); ?>" width="100px" height="100px" /> </td>

                        <td> <a class="btn" href="javascript:void(0)" onclick="Noticia.verTextoNoticia('<?php echo $nt->id_noticia; ?>')"> Ver texto </a></td>
                        <td>  -- </td>
                        <td> <a href="<?php echo base_url("cpainel/noticia/desativar_noticia/" . $nt->id_noticia); ?>"> Desativar </a></td>
                        <td>
                            <?php if ($nt->destaque_noticia == 0) { ?>
                                <i class="glyphicon glyphicon-remove"></i> 
                            <?php } else { ?>
                                <i class="glyphicon glyphicon-ok"></i> 
                            <?php } ?>
                        </td>
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
    <script type="text/javascript">
        function confirmacao(id) {
            var resposta = confirm("Você está removendo uma notícia!");
            if (resposta == true) {
                window.location.href = "<?php echo base_url('cpainel/noticia/excluir_noticia/'); ?>/" + id;
            }
        }

    </script>
</div>