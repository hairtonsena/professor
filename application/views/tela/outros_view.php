<div class="col-md-3 box_coluna_outros semMargem">
    <!--<div class="titulos">Outros</div>-->



    <div class="col-lg-12 box_lembrete semMargem" >
        <div class="titulo_lembrete"> Lembrete</div>
        <p class="texto_lembrete">
            Prova de tga segunda feira (02/04) as 11:30, no labortório de administração.
        </p>
        <p class="texto_lembrete">
            Trabalho para a tura de contabilidade para entregar terça feira(05/04).
        </p>
    </div>





    <div class="col-lg-12 semMargem box_lembrete" >
        <div class="titulo_lembrete">Contato</div>
        <p>
            <strong>Email: </strong> hairtonsena@yahoo.com.br<br/>
            <strong>Telefone: </strong> (38) 9191-5050
        </p>
    </div>
    <!--Redes sociais-->

    <div class="col-lg-12 semMargem box_lembrete">
        <p class="titulo_lembrete">Redes Sociais</p> 
        <p>
            <a  href="https://www.facebook.com/" target="_blank" > <img class="icone_rede_sociais" src="<?php echo base_url("imagens/sociais/facebook.ico") ?>" /> </a>
            <a href="https://plus.google.com/" target="_blank" > <img class="icone_rede_sociais" src="<?php echo base_url("imagens/sociais/google_plus.ico") ?>" /> </a>
            <a href="https://twitter.com/" target="_blank" > <img class="icone_rede_sociais" src="<?php echo base_url("imagens/sociais/twitter_logo.ico") ?>" /> </a>
            <a href="https://br.linkedin.com/" target="_blank" > <img class="icone_rede_sociais" src="<?php echo base_url("imagens/sociais/linkedin.ico") ?>" /> </a>
        </p>
    </div>
    <div class="col-lg-12 semMargem box_lembrete">
        <p class="titulo_lembrete">Relacionados</p>
        <p>
            <a  href="http://www.ifnmg.edu.br/cursos-jan/579-bacharelado-em-administracao" target="_blank" > <img class="icone_rede_sociais" src="<?php echo base_url("imagens/sociais/logo-administracao.png") ?>" height="50" /> </a>
            <a  href="http://www.ifnmg.edu.br/januaria" target="_blank" > <img class="icone_rede_sociais" src="<?php echo base_url("imagens/sociais/LogoIFSP.png") ?>" height="50" /> </a>
        </p>
    </div>


    <div class="col-lg-12 semMargem box_lembrete">
        <p class="titulo_lembrete">Enconomia no mundo</p>

        <?php
        $qtde = 0;
        foreach ($xml_rss->item as $item) { ?>
        <div style="border-bottom: 2px solid #fafaff">
                <p class='titulo_rss' style="margin-bottom: 0px;"> <strong><?php echo $item->title ?></strong></p>
                <p style="margin-top: 0px; padding-top: 0px">
                    <?php echo strip_tags($item->description); ?>
                    <a href="<?php echo utf8_decode($item->link) ?>" target='_blank'>Ler mais...</a>";
                </p>
            </div>
            <?php
            $qtde++;
            if ($qtde == 3) { break; }
        }
        //fim do foreach 
        ?>

        <!--        Lembrete
                <p>Teste de texto avuso, por que o hairton não me falo o que mais tinha pra por na tela inicial.</p>
                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    Ver
                </button>-->
    </div>

</div>
</div>
