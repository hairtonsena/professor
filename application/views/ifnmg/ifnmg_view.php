<div  class="col-md-9" style="padding-left: 0px;">
    <div class="col-md-12 semMargem">            
        <div class="titulos">IFNMG</div>
        <div class="img_instrutiva_pagina_ifnmg" style="background-image: url('<?php echo base_url("/imagens/56216_Papel-de-Parede-Fundo-Azul--56216_1920x1200.jpg") ?>');" >
            <div class="col-lg-4" style="height: 100%;">
                <img class="img_professor_baner" src="<?php echo base_url("imagens/wal-fundo-transparente-830x1024.png") ?>" />
            </div>
            <div class="col-md-8 text-center texto_baner" >
                <p>
                    <span class="titulo_baner" >Adiministração</span>
                </p>
                <p>
                    Texto sobre a imagem do professor e o que faz na fuaculdende. Este texto 
                    é bem breve e bem obejetivo ok. obrigado.
                </p>
                <p>
                    Texto sobre a imagem do professor e o que faz na fuaculdende. Este texto 
                    é bem breve e bem obejetivo ok. obrigado.
                </p>
            </div>
        </div>


    </div>
    <div class="col-md-12 semMargem">
        <h4 class="titulos_diciplinas"> Disciplinas </h4>

        <div class="link_disciplinas">

            <?php foreach ($disciplinas_ativa as $mdp) { ?>
                <a href="<?php echo base_url("ifnmg/disciplina/" . $mdp->id_disciplina) ?>"><span><?php echo $mdp->nome_disciplina; ?></span></a>

            <?php } ?>

        </div>
    </div>
</div>