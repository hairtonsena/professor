<?php
$id_aluno;
$nome_aluno;
foreach ($aluno as $an) {
    $id_aluno = $an->id_aluno;
    $nome_aluno = $an->nome_aluno;
}

$nome_disciplina;
$descricao_disciplina;
$id_turma;
$nome_turma;

foreach ($disciplina_turma as $dt) {
    $nome_disciplina = $dt->nome_disciplina;
    
    $descricao_disciplina = $dt->descricao_disciplina;
    $nome_turma = $dt->nome_turma;
    $id_turma = $dt->id_turma;
}
?>
<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/aluno") ?>">Aluno</a></li>
        <li><a href="<?php echo base_url("cpainel/aluno/ver/".$id_aluno) ?>">Ver aluno</a></li>
        <li class="active">Descrição</li>       
    </ol>
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Aluno: <?php echo $nome_aluno ?></div>
        <ul class="list-group">
            <li class="list-group-item">Disciplina: <?php echo $nome_disciplina ?>, Turma: <?php echo $nome_turma ?></li>
        </ul>
        <div class="panel-body">
            <div class="col-lg-12">
                <ul class="nav nav-tabs">
                    <li role="presentation" class="active"><a href="<?php echo base_url("cpainel/aluno/disciplina_turma?turma=".$id_turma."&aluno=".$id_aluno) ?>">Descrição</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/aluno/disciplina_turma_horario?turma=".$id_turma."&aluno=".$id_aluno) ?>">Horários</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/aluno/disciplina_turma_avaliacao?turma=".$id_turma."&aluno=".$id_aluno) ?>">Avaliações</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/aluno/disciplina_turma_trabalho?turma=".$id_turma."&aluno=".$id_aluno) ?>">Trabalhos</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/aluno/disciplina_turma_nota?turma=" . $id_turma . "&aluno=" . $id_aluno) ?>">Notas</a></li>
                </ul>
                <div class="col-lg-6" style="margin-top: 10px;">
                    <?php echo $descricao_disciplina ?>
                </div>
            </div>
        </div>
    </div>
</div>
