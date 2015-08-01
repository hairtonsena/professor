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
            <div class="busca_menu col-lg-5" style="margin: 0px; padding: 0px;">
                <button class="btn btn-default pull-right" type="button">Pesquisar</button>
                <div class=" pull-right" >
                    <input type="text" class="form-control"  placeholder="Pesquisa...">
                </div>

            </div>
            <div class="area_aluno_menu col-lg-3 text-right" style="margin: 0px; padding:10px 0px 0px 0px;">
                <span><a href="#"><i class="glyphicon glyphicon-user"></i> Área do aluno</a> </span>
            </div>
        </div>
        <div class="nav barra_menu" style="clear: both;">
            <ul class="nav nav-pills">
                <li role="presentation"><a href="<?php echo base_url() ?>">  Inicio </a></li>

                <li role="presentation"><a href="<?php echo base_url("ifnmg/") ?>">IFNMG</a></li>
                
<!--                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                        Disciplinas <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <?php // foreach ($munu_disciplina as $mdp) { ?>
                            <li role="presentation"><a class="" href="<?php // echo base_url("disciplina?disciplina=" . $mdp->id_disciplina) ?>"><?php // echo $mdp->nome_disciplina; ?></a></li>
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