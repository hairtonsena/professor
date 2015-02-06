<div class="row posicao_conteiner conteiner_smartphone ">

    <div  class="col-md-7 row sem_margen_pading">
        <div class="titulos">Publicações</div>

        <?php
        foreach ($noticias_pagina_inicial as $ntpi) {
            if ($ntpi->imagem_mini_noticia == NULL) {
                ?>
                <div class="col-md-12 linha">
                    <a class="link_diversos" href="<?php echo base_url("publicacao/ler/" . $ntpi->url_noticia) ?>">
        <!--                <div class="img_conteudo"><img src="./imagens/imagen_teste.jpg" alt="..."></div>-->
                        <h3><?php echo $ntpi->titulo_noticia ?></h3>
                        <p><?php echo substr(strip_tags($ntpi->conteudo_noticia),0,50) ?></p>
                    </a>
                </div>
            <?php } else { ?>
                <div class="col-md-12 linha">
                    <a class="link_diversos" href="<?php echo base_url("publicacao/ler/" . $ntpi->url_noticia) ?>">
                        <div class="img_conteudo"><img src="<?php echo base_url("noticia/imagem_mini/" . $ntpi->imagem_mini_noticia) ?>" alt="..."></div>
                        <h3><?php echo $ntpi->titulo_noticia ?></h3>
                        <p><?php echo substr(strip_tags($ntpi->conteudo_noticia),0,50) ?></p>
                    </a>
                </div>
                <?php
            }
        }
        ?>

    </div>




