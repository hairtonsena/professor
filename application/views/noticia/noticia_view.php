
<div  class="col-md-8" style="padding-left: 0px;">
    <div class="titulos">Publicações</div>
    <?php
    foreach ($noticias_pagina_inicial as $ntpi) {
        if ($ntpi->imagem_mini_noticia == NULL) {
            ?>
            <a class="link_lista_noticia" href="<?php echo base_url("publicacao/ler/" . $ntpi->url_noticia) ?>">
                <div class="row col-md-12 semMargem link_caixa_noticia">

                <!--                <div class="img_conteudo"><img src="./imagens/imagen_teste.jpg" alt="..."></div>-->
                    <p class="titulo_link_lista_noticia"><?php echo $ntpi->titulo_noticia ?></p>
                    <p class="texto_link_lista_noticia"><?php echo substr(strip_tags($ntpi->conteudo_noticia), 0, 150) ?>...
                        <span class="continue_lendo"> Continue lendo <i class="glyphicon glyphicon-chevron-right"></i> </span>
                    </p>

                </div>
            </a>
        <?php } else { ?>
            <a class="link_lista_noticia" href="<?php echo base_url("publicacao/ler/" . $ntpi->url_noticia) ?>">
                <div class="row col-md-12 semMargem link_caixa_noticia">

                    <img class="img_lista_conteudo pull-left" src="<?php echo base_url("noticia/imagem_mini/" . $ntpi->imagem_mini_noticia) ?>" alt="...">
                    <p class="titulo_link_lista_noticia"><?php echo $ntpi->titulo_noticia ?></p>
                    <p class="texto_link_lista_noticia"><?php echo substr(strip_tags($ntpi->conteudo_noticia), 0, 150) ?>
                        <span class="continue_lendo"> Continue lendo <i class="glyphicon glyphicon-chevron-right"></i> </span>
                    </p>

                </div>
            </a>
            <?php
        }
    }
    ?>

</div>




