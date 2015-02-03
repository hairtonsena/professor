<?php
$cpf_prefessor = "12345678901";
$nome_professor;

$imagem_professor;
$professor = $this->professor_vw_model->obter_professor_cpf($cpf_prefessor)->result();
foreach ($professor as $pf){
    $nome_professor= $pf->nome_professor;
    $imagem_professor = base_url("imagens/".$pf->imagem_professor);
}
?>

<div id="teste" class="caixa_menu flutuante_menu menu_smartphone ">
    <img id="esconder" class="mini_perfil menu_smartphone_esconde" width="210px" height="160px" src="<?php echo $imagem_professor ?>" >
    <div class="nome "><?php echo $nome_professor; ?>
        <img id="icone_reponsivo" class="icone_menu_mostrar icone_menu_oculto"
             src="<?php echo base_url('imagens/show-menu-icon.d59195e741b3ab51c22688596ce04277.png') ?>">
    </div>
    <div id="item_menu" class="esconder">
        <ul class="link link_smart nav nav-pills nav-stacked box_menu ">
            <li role="presentation"><a href="<?php echo base_url() ?>">Início</a></li>
            <li role="presentation" class="dropdown">
                <a class="dropdown-toggle link" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                    Disciplinas <span class="caret"></span>
                </a>
                <ul class="dropdown-menu barra_rolar_menu" role="menu">
                    <?php foreach ($munu_disciplina as $mdp) { ?>
                        <li role="presentation"><a href="<?php echo base_url("disciplina?disciplina=" . $mdp->id_disciplina) ?>"><?php echo $mdp->nome_disciplina; ?></a></li>
                    <?php } ?>
                </ul>
            </li>
            <li role="presentation"><a href="<?php echo base_url("publicacao") ?>">Publicações</a></li>
            <li role="presentation"><a href="<?php echo base_url("sobre") ?>">Sobre</a></li>
            <!-- <li role="presentation"><a href="#">Messages</a></li>
            <li role="presentation"><a href="#">Profile</a></li>
            <li role="presentation"><a href="#">Messages</a></li>-->
        </ul>
    </div>
</div>