<?php
$nome_disciplina;
$descricao_disciplina;
$id_disciplina;
foreach ($disciplina as $ds) {
    $nome_disciplina = $ds->nome_disciplina;
    $descricao_disciplina = $ds->descricao_disciplina;
    $id_disciplina = $ds->id_disciplina;
}
?>
<div  class="col-md-8" style="padding-left: 0px;">
    <div class="col-md-12 semMargem">            
        <div class="titulos">
            <a href="<?php echo base_url("ifnmg/") ?>"> IFNMG </a> /  Discliplina</div>
        
        <h3 class="text-center"> <?php echo $nome_disciplina ?></h3>
        <?php echo $descricao_disciplina ?>
    </div>
    
    
    <div class="col-md-12 semMargem" >
        <div class="box_label_turma">
            <span class="titulo_turma_label">Turma </span>
            <span class="pull-right  arquivado">
                <a class="" href="<?php echo base_url("ifnmg/turma_arquivada/" . $id_disciplina) ?>">Turmas passadas</a>
            </span>
        </div>         
        <div class="link_opcao_turmas">
            <?php foreach ($turmas as $tr) { ?>
                <a href="<?php echo base_url("ifnmg/turma/" . $tr->id_turma) ?>"> <?php echo $tr->nome_turma ?></a>
            <?php } ?>
        </div>
    </div>
</div>