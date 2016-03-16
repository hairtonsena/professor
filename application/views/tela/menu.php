<?php
$cpf_prefessor = "12345678901";
$nome_professor = "";

$imagem_professor = "";
$professor = $this->professor_vw_model->obter_professor_cpf($cpf_prefessor)->result();
foreach ($professor as $pf) {
    $nome_professor = $pf->nome_professor;
}
?>

<div class="area_menu" >
    <div class="container" >
        <div class="area_informativa">
            <div class="logotipo_menu col-lg-4">
                André Aristóteles
            </div>

            <div class="col-lg-8" style="margin: 0px; padding: 0px;">

                <div class="area_aluno_menu col-lg-12" >


                    <?php if (($this->session->userdata('id_aluno')) && ($this->session->userdata('nome_aluno')) && ($this->session->userdata('cpf_aluno')) && ($this->session->userdata('matricula_aluno')) && ($this->session->userdata('verificar_login') == 'cored.com')) { ?>

                    <span>Olá, <?php echo $this->session->userdata('nome_aluno') ?> </span>
                        <a class="btn btn-default" href="<?php echo base_url("aluno") ?>">Painel do aluno</a>

                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-cog"></i> </a>
                        <ul class="dropdown-menu pull-right text-left" >

                            <!--<li><a href="<?php// echo base_url("aluno") ?>"> Painel aluno </a></li>-->
                            <li><a href="<?php echo base_url("aluno/alterar_senha") ?>" > Alterar Senha</a></li>
                            

                        </ul>

                        <a class="btn btn-default" href="<?php echo base_url("inicio/logout_aluno") ?>" ><i class="glyphicon glyphicon-log-out"></i> Sair</a>

                    <?php } else { ?>
                        <span><a href="javascript:void(0)" onclick="Tela.abrirFomeAcessoAluno()"><i class="glyphicon glyphicon-user"></i> Área do aluno</a> </span>
                    <?php } ?>

                </div>




                <div class="busca_menu col-lg-12 semMargem">
                    <div class="col-lg-8 semMargem pull-right">
                        <div class="input-group">
                            <input type="text" class="form-control"  placeholder="Pesquisar por ...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Pesquisar</button>
                            </span>
                        </div>
                    </div>
                </div>

            </div>

        </div>


        <div class="nav barra_menu" style="clear: both;">
            <ul class="nav nav-pills">
                <li role="presentation"><a href="<?php echo base_url() ?>">  Início </a></li>

                <li role="presentation"><a href="<?php echo base_url("ifnmg/") ?>">IFNMG</a></li>

                <!--                <li role="presentation" class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                        Disciplinas <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                <?php // foreach ($munu_disciplina as $mdp) { ?>
                                            <li role="presentation"><a class="" href="<?php // echo base_url("disciplina?disciplina=" . $mdp->id_disciplina)                    ?>"><?php // echo $mdp->nome_disciplina;                    ?></a></li>
                <?php // } ?>
                                        
                                    </ul>
                                </li>-->

                <li role="presentation"><a href="<?php echo base_url("publicacao") ?>">Publicações</a></li>
                <li role="presentation"><a href="<?php echo base_url("sobre") ?>">Sobre</a></li>


            </ul>
        </div>

    </div>
</div>
<div class="container" >