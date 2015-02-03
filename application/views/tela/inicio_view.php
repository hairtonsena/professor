<div class="row posicao_conteiner conteiner_smartphone ">

    <div  class="col-md-7 row sem_margen_pading">
        <div class="titulos">Publicações</div>

        <?php
        foreach ($noticias_pagina_inicial as $ntpi) {
            if ($ntpi->imagem_mini_noticia == NULL) {
                ?>
                <div class="col-md-12 linha">
                    <a href="<?php echo base_url("publicacao/ler/" . $ntpi->url_noticia) ?>">
        <!--                <div class="img_conteudo"><img src="./imagens/imagen_teste.jpg" alt="..."></div>-->
                        <h3><?php echo $ntpi->titulo_noticia ?></h3>
                        <p>jhsdfhshf jh klashdfk kjhf sjdhf asdflhasdf asdfkjhsadf sdafhasdf sadlkjfhasd fasdfjh sdfjh sdfhsdf asdjfh sdfjhasdf kljhsd fkljhasdfhsd kjhsdf asjh</p>
                    </a>
                </div>
            <?php } else { ?>
                <div class="col-md-12 linha">
                    <a href="<?php echo base_url("publicacao/ler/" . $ntpi->url_noticia) ?>">
                        <div class="img_conteudo"><img src="<?php echo base_url("noticia/imagem_mini/" . $ntpi->imagem_mini_noticia) ?>" alt="..."></div>
                        <h3><?php echo $ntpi->titulo_noticia ?></h3>
                        <p>jhsdfhshf jh klashdfk kjhf sjdhf asdflhasdf asdfkjhsadf sdafhasdf sadlkjfhasd fasdfjh sdfjh sdfhsdf asdjfh sdfjhasdf kljhsd fkljhasdfhsd kjhsdf asjh</p>
                    </a>
                </div>
                <?php
            }
        }
        ?>

        <!--        <div class="col-md-12 linha">
                    <div class="img_conteudo"><img src="./imagens/imagen_teste.jpg" alt="..."></div>
                    <h3>Thumbnail label</h3>
                    <p>jhsdfhshf jh klashdfk kjhf sjdhf asdflhasdf asdfkjhsadf sdafhasdf sadlkjfhasd fasdfjh sdfjh sdfhsdf asdjfh sdfjhasdf kljhsd fkljhasdfhsd kjhsdf asjh</p>
                </div>-->

        <div class="col-md-12 linha">
            <h4>Lembrete</h4>
            <p>Teste de texto avuso, por que o hairton não me falo o que mais tinha pra por na tela inicial.</p>
            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                Ver
            </button>
        </div>
    </div>




