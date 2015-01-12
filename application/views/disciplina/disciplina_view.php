<?php
$nome_disciplina;
$descricao_disciplina;
foreach ($disciplina as $ds) {
    $nome_disciplina = $ds->nome_disciplina;
    $descricao_disciplina = $ds->descricao_disciplina;
}
?>

<!--inicio logado-->
<div class="row posicao_conteiner conteiner_smartphone ">
    <div  class="col-md-7 row sem_margen_pading">
        <div class="titulos"><?php echo $nome_disciplina ?></div>

        <div class="col-md-12 linha">
            
            <?php echo $descricao_disciplina ?>
        </div>

        <div class="col-md-12 linha">
            <div class="col-md-12 sem_margen_pading">
                <h4 class="col-md-12 sem_margen_pading pull-left">Turmas <span class=" sem_margen_pading"><a class="pull-right" href="">Arquivadas</a></span></h4>
                <!--<span class="col-md-6 sem_margen_pading"><a class="pull-right" href="">Arquivadas</a></span>-->
            </div>
            <div class="col-md-12">
                <?php foreach ($turmas as $tr){ ?>
                <a href="<?php echo base_url("disciplina/turma/".$tr->id_turma) ?>" class=""> <?php echo $tr->nome_turma ?></a> |
                <?php } ?>
            </div>
        </div>
<!--
        <div class="col-md-12 linha">
            <h4>Notas</h4>
            <p>Aqui fica as Notas!</p>
        </div>

        <div class="col-md-12 linha">
            <h4>Horarios</h4>
            <p>Aqui fica os Horarios!</p>
        </div>
        <div class="col-md-12 linha">
            <h4>Lembrete</h4>
            <p>Teste de texto avuso, por que o hairton não me falo o que mais tinha pra por na tela inicial.</p>
        </div>-->
    </div>
    <!--fim logado-->








