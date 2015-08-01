    <div  class="col-md-8" style="padding-left: 0px;">
        <div class="titulos"><a href="<?php echo base_url("publicacao") ?>"> Publicações </a> / ler</div>
        <div class="col-md-12 linha">
            <?php
            foreach ($noticia as $nt) { 
                echo "<div><h3>".$nt->titulo_noticia.'</h3></div>';
                echo $nt->conteudo_noticia;
            }
            ?>
        </div>
    </div>




