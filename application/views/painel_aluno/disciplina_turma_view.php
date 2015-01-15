<?php
//$nome_disciplina;
//$descricao_disciplina;
//foreach ($disciplina as $ds) {
//    $nome_disciplina = $ds->nome_disciplina;
//    $descricao_disciplina = $ds->descricao_disciplina;
//}
?>

<!--inicio logado-->
<div class="row posicao_conteiner conteiner_smartphone ">
    <div  class="col-md-7 row sem_margen_pading">
        <div class="titulos">Painel - aluno</div>

        <div class="col-md-12 linha">
            Escolhar a turma para verificar os dados.
        </div>

        <div class="col-md-12 linha">

            <div class="col-md-12">
                <ul class="list-group">
                    <?php foreach ($disciplina_turma as $dct) { ?>
                        <a href="<?php echo base_url("aluno/turma/" . $dct->id_turma) ?>" class="list-group-item"><?php echo $dct->nome_disciplina ?> <span class="pull-right"><?php echo $dct->nome_turma ?></span></a>
                        <?php } ?>
                </ul>
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








