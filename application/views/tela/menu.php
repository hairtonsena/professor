<div id="teste" class="caixa_menu flutuante_menu menu_smartphone ">
    <img id="esconder" class="mini_perfil menu_smartphone_esconde" width="210px" height="160px" src="<?php echo base_url('imagens/imagen_teste.jpg') ?>" >
    <div class="nome ">André Fulano de Tal e talves mais
        <img id="icone_reponsivo" class="icone_menu_mostrar icone_menu_oculto" 
             src="<?php echo base_url('imagens/show-menu-icon.d59195e741b3ab51c22688596ce04277.png') ?>">
    </div>

    <div id="item_menu" class="esconder">

        <ul class="link link_smart nav nav-pills nav-stacked ">
            <li role="presentation"><a href="<?php echo base_url() ?>">Início</a></li>
            <li role="presentation" class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                    Disciplinas <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <?php foreach ($munu_disciplina as $mdp) { ?>
                    <li role="presentation"><a href="<?php echo base_url("disciplina?disciplina=".$mdp->id_disciplina) ?>"><?php echo $mdp->nome_disciplina; ?></a></li>
                    <?php } ?>

                </ul>
            </li>
            <li role="presentation"><a href="#">Publicações</a></li>
            <li role="presentation"><a href="#">Sobre</a></li>
            <!--                <li role="presentation"><a href="#">Messages</a></li>
                            <li role="presentation"><a href="#">Profile</a></li>
                            <li role="presentation"><a href="#">Messages</a></li>-->


        </ul>
    </div>
</div>


