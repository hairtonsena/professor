<div class="col-md-4 box_coluna_outros">
    <!--<div class="titulos">Outros</div>-->


    <?php if (($this->session->userdata('id_aluno')) && ($this->session->userdata('nome_aluno')) && ($this->session->userdata('cpf_aluno')) && ($this->session->userdata('matricula_aluno')) && ($this->session->userdata('verificar_login') == 'cored.com')) { ?>
        <div class="semMargem">
            Bem Vindo(a)
            <div class="input-group">
                <p><?php echo $this->session->userdata('nome_aluno') ?></p>
                <p>CPF : <?php echo $this->session->userdata('cpf_aluno') ?></p>
                <p>Matrícula : <?php echo $this->session->userdata('matricula_aluno') ?></p>
                <a href="<?php echo base_url("aluno") ?>" class="btn btn-default " >Painel</a>
                <a href="<?php echo base_url("aluno/alterar_senha") ?>" class="btn btn-default" >Alterar Senha</button>
                    <a href="<?php echo base_url("inicio/logout_aluno") ?>" class="btn btn-default">Sair</a>
            </div>
        </div>

    <?php } else { ?>
        <div class="semMargem">
            <p class="titulo_outros">Login </p>
            <form action="<?php echo base_url("inicio/acesso_aluno") ?>" method="post" >
                <div class="input-group">
                    <span class="text-danger"><?php echo validation_errors(); ?></span>
                    <input type="text" name="cpf_or_matricula" class="form-control" placeholder="CPF ou Matricula" >
                    <input type="password" name="senha" class="form-control" placeholder="senha" >
                    <button type="submit" class="btn btn-default">Logar</button>
                    <!--<button type="button" class="btn btn-default">Esqueci</button>-->
                </div>
            </form>
        </div>
    <?php } ?>
    <!-- Só Logado -->
    <!--    <div class="col-md-12 linha">
            Trabalho
            <div style="background-color: #F3F3F3" class="col-md-12 linha">
                <div class="titulos">Teste de tema de trabalhos</div>
                <p>Teste de descrição de trabalhos</p>
                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    Baixar
                </button>
                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    Enviar
                </button>
                <input type="text" class="form-control" placeholder="e-mail" aria-describedby="basic-addon1">
                <p>Trabalho tal - X</p>
            </div>
        </div>-->
    <!-- Fim Só logado -->

    <div class="semMargem">
        <p class="titulo_outros complemento_titulo_outros">Contato</p>
        <p>
            <strong>Email: </strong> hairtonsena@yahoo.com.br<br/>
            <strong>Telefone: </strong> (38) 9191-5050
        </p>
    </div>
    <!--Redes sociais-->

    <div class="semMargem">
        <p class="titulo_outros complemento_titulo_outros">Redes Sociais</p> 
        <p>
            <a  href="https://www.facebook.com/" target="_blank" > <img class="icone_rede_sociais" src="<?php echo base_url("imagens/sociais/facebook.ico") ?>" /> </a>
            <a href="https://plus.google.com/" target="_blank" > <img class="icone_rede_sociais" src="<?php echo base_url("imagens/sociais/google_plus.ico") ?>" /> </a>
            <a href="https://twitter.com/" target="_blank" > <img class="icone_rede_sociais" src="<?php echo base_url("imagens/sociais/twitter_logo.ico") ?>" /> </a>
            <a href="https://br.linkedin.com/" target="_blank" > <img class="icone_rede_sociais" src="<?php echo base_url("imagens/sociais/linkedin.ico") ?>" /> </a>
        </p>
    </div>
    <div class="semMargem">
        <p class="titulo_outros complemento_titulo_outros">Relacionados</p>
        <p>
                <a  href="http://www.ifnmg.edu.br/cursos-jan/579-bacharelado-em-administracao" target="_blank" > <img class="icone_rede_sociais" src="<?php echo base_url("imagens/sociais/logo-administracao.png") ?>" height="50" /> </a>
            <a  href="http://www.ifnmg.edu.br/januaria" target="_blank" > <img class="icone_rede_sociais" src="<?php echo base_url("imagens/sociais/LogoIFSP.png") ?>" height="50" /> </a>
        </p>
    </div>


    <div class="semMargem">
        <p class="titulo_outros complemento_titulo_outros">Enconomia no mundo</p>
        <?php
//        $link = "http://g1.globo.com/dynamo/economia/rss2.xml";
        //link do arquivo xml
        $xml = simplexml_load_file($link)->channel;
        //carrega o arquivo XML e retornando um Array
        $qtd_maxima = 3;
        $contar_loop = 0;
        foreach ($xml->item as $item) {
            //faz o loop nas tag com o nome "item"
            //exibe o valor das tags que estão dentro da tag "item"
            //utilizamos a função "utf8_decode" para exibir os caracteres corretamente
            echo "<p class='titulo_rss'> <strong>" . $item->title . "</strong></p>";
//            echo "<strong>Link:</strong> " . utf8_decode($item->link) . "<br />";
            echo "<p>". strip_tags($item->description); 
            echo " <a href='" . utf8_decode($item->link) . "' target='_blank'>Ler mais...</a>";
//            echo "<strong>Data:</strong> " . utf8_decode($item->pubDate) . "<br />";
            echo "<hr/> </p>";
            $contar_loop++;
            if ($contar_loop == $qtd_maxima) {
                break;
            }
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
