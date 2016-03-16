<?php
//$nome_disciplina;
//$descricao_disciplina;
//foreach ($disciplina as $ds) {
//    $nome_disciplina = $ds->nome_disciplina;
//    $descricao_disciplina = $ds->descricao_disciplina;
//}
?>

<!--inicio logado-->
<div  class="col-md-12" style="padding-left: 0px;" >

    <div class="col-md-12 semMargem">

        <div class="titulos">Painel aluno</div>
    </div>
    <div class="col-md-12 semMargem">

        <span class=""> Escolha a disciplina e turma </span>

        <div class="link_opcao_turmas">
            <?php foreach ($disciplina_turma as $dct) { ?>
                <a href="<?php echo base_url("aluno/turma/" . $dct->id_turma) ?>" class="">
                    <span class="col-md-6"> <?php echo $dct->nome_disciplina ?> </span>

                    <span class=""><?php echo $dct->nome_turma ?></span>
                </a>
            <?php } ?>
        </div>
    </div>
    <div class="col-md-12" style="margin-bottom: 50px;">
        
    </div>
</div>

</div>