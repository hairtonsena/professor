<div style="background-color: #dfdfdf;"  class="col-md-4 row sem_margen_pading">
    <div class="titulos">Outros</div>


    <?php if (($this->session->userdata('id_aluno')) && ($this->session->userdata('nome_aluno')) && ($this->session->userdata('cpf_aluno')) && ($this->session->userdata('matricula_aluno')) && ($this->session->userdata('verificar_login') == 'cored.com')) { ?>
        <div class="col-md-12 linha">
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
        <div class="col-md-12 linha">
            Login
            <form action="<?php echo base_url("inicio/acesso_aluno") ?>" method="post" >
                <div class="input-group">
                    <span class="text-danger"><?php echo validation_errors(); ?></span>
                    <input type="text" name="cpf_or_matricula" class="form-control" placeholder="CPF ou Matricula" >
                    <input type="password" name="senha" class="form-control" placeholder="senha" >
                    <button type="submit" class="btn btn-default">Logar</button>
                    <button type="button" class="btn btn-default">Esqueci</button>
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

    <div class="col-md-12 linha">
        Contato
        <p>Teste de texto avuso, por que o hairton não me falo o que mais tinha pra por na tela inicial.</p>
        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            Ver
        </button>
    </div>

    <div class="col-md-12 linha">
        Lembrete
        <p>Teste de texto avuso, por que o hairton não me falo o que mais tinha pra por na tela inicial.</p>
        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            Ver
        </button>
    </div>

</div>
</div>
