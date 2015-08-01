<?php
//$nome_disciplina;
//$descricao_disciplina;
//foreach ($disciplina as $ds) {
//    $nome_disciplina = $ds->nome_disciplina;
//    $descricao_disciplina = $ds->descricao_disciplina;
//}
?>

<!--inicio logado-->
    <div  class="col-md-8 row semMargem">

        <div class="col-md-12 linha row">

            <div class="titulos">Painel - aluno</div>

            <span class="titulos"> Escolhar um turma </span>

            <ul class="list-group">
                <?php foreach ($disciplina_turma as $dct) { ?>
                    <a href="<?php echo base_url("aluno/turma/" . $dct->id_turma) ?>" class="list-group-item"><?php echo $dct->nome_disciplina ?> <span class="pull-right"><?php echo $dct->nome_turma ?></span></a>
                    <?php } ?>
            </ul>

        </div>

    </div>
    <!--fim logado-->








