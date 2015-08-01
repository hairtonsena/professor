    <div  class="col-md-8 row"  style="padding: 0px; margin: 0px;">
        <div>

            <?php
            foreach ($noticias_pagina_inicial as $ntpi) {
                if ($ntpi->imagem_mini_noticia == NULL) {
                    ?>
                    <a class="link_lista_noticia" href="<?php echo base_url("publicacao/ler/" . $ntpi->url_noticia) ?>">
                        <div class="row col-md-12 semMargem link_caixa_noticia">

                                                        <!--                <div class="img_conteudo"><img src="./imagens/imagen_teste.jpg" alt="..."></div>-->
                            <p class="titulo_link_lista_noticia"><?php echo $ntpi->titulo_noticia ?></p>
                            <p>
                                <?php echo substr(strip_tags($ntpi->conteudo_noticia), 0, 150) ?>
                                <!--Este teste e para ver como a fonte se comporta com o layout, tendo em vista a melhor aparencia visua do site. por que um monte de asdf nao representa muito bem uma experiencia real.-->
                            </p>

                        </div>
                    </a>
                <?php } else { ?>
                    <a class="link_lista_noticia" href="<?php echo base_url("publicacao/ler/" . $ntpi->url_noticia) ?>">
                        <div class="row col-md-12 semMargem link_caixa_noticia">

                            <img class="img_lista_conteudo pull-left" src="<?php echo base_url("noticia/imagem_mini/" . $ntpi->imagem_mini_noticia) ?>" alt="...">
                            <div class="box_noticia_conteudo">
                                <p class="titulo_link_lista_noticia"><?php echo $ntpi->titulo_noticia ?></p>
                                <p>
                                    <?php echo substr(strip_tags($ntpi->conteudo_noticia), 0, 150); ?>
                                    <!--Este teste e para ver como a fonte se comporta com o layout, tendo em vista a melhor aparencia visua do site.-->
                                </p>
                            </div>

                        </div>
                    </a>
                    <?php
                }
            }
            ?>
        </div>


        <div class="linha semMargem">
            <h4 class="titulos"> Disciplinas </h4>

            <div class="diciplinas_pagina_inicial">

                <?php foreach ($munu_disciplina as $mdp) { ?>
                    <a href="<?php echo base_url("disciplina?disciplina=" . $mdp->id_disciplina) ?>"><span><?php echo $mdp->nome_disciplina; ?></span></a>



                <?php } ?>

                <!--
                
                                <a href="#" ><span>Portugues</span></a>
                                <a href="#" ><span>Portugues</span></a>
                                <a href="#" ><span>Portugues</span></a> -->
            </div>

<!--            <p>Teste de texto avuso, por que o hairton não me falo o que mais tinha pra por na tela inicial.</p>
<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
    Ver
</button>-->
        </div>
    </div>




