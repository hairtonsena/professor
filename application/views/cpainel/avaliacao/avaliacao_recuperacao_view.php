<?php
$nome_disciplina;
$id_disciplina;
$nome_turma;
$id_turma;
foreach ($turma_disciplina as $td) {
    $nome_disciplina = $td->nome_disciplina;
    $id_disciplina = $td->id_disciplina;
    $nome_turma = $td->nome_turma;
    $id_turma = $td->id_turma;
}
?>
<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/disciplina") ?>">Disciplina</a></li>
        <li><a href="<?php echo base_url("cpainel/turma?disciplina=" . $id_disciplina) ?>">Turma</a></li>
        <li class="active">Avaliaçao </li>       
    </ol>
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Disciplina: <?php echo $nome_disciplina ?></div>
        <ul class="list-group">
            <li class="list-group-item text-danger">Turma: <?php echo $nome_turma ?></li>
        </ul>
        <div class="panel-body">
            <div class="col-lg-12 semMargem">
                <ul class="nav nav-tabs">
                    <li role="presentation"><a href="<?php echo base_url("cpainel/turma/alunos/" . $id_turma) ?>">Alunos</a></li>
                    <li role="presentation" class="active"><a href="#">Avaliações</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/trabalho?turma=" . $id_turma) ?>">Trabalhos</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/notas?turma=" . $id_turma) ?>">Notas</a></li>
                </ul>
                <div class="col-lg-12 semMargem" style="border-left: 1px solid #ddd;border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; ">
                    <div class="col-lg-12" style="padding-top: 5px;">
                        <a class="btn btn-primary" href="<?php echo base_url("cpainel/avaliacao/nova/" . $id_turma); ?>">Nova Avaliacão</a>
                        <a class="btn btn-danger" href="<?php echo base_url("cpainel/avaliacao_recuperacao/" . $id_turma); ?>">Avaliacão de recuperação</a>
                        <div style="margin-top: 5px">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> Descricao </th>
                                        <th class="col-lg-1 center"> Data </th>
                                        <th class="col-lg-1 center"> valor </th>
                                        <th class="col-lg-1 center"> alterar </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total_pontos = 0;

                                    foreach ($avaliacao_recuperacao as $ar) {

                                        $total_pontos+=$ar->valor_avaliacao_recuperacao;
                                        ?>
                                        <tr id="linha_aluno_turma_<?php echo $ar->id_avaliacao_recuperacao ?>">
                                            <td><?php echo $ar->descricao_avaliacao_recuperacao; ?></td>   
                                            <td class="text-center"><?php echo implode("/", array_reverse(explode("-", $ar->data_avaliacao_recuperacao))); ?></td> 
                                            <td  class="text-center"><?php echo $ar->valor_avaliacao_recuperacao; ?></td> 


                                            <td class="text-center"><span id="btnExcluirTurma_<?php echo $ar->id_avaliacao_recuperacao ?>"><a href="javascript:void(0)"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </a></span></td>                                                
                                            
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr style="background-color: #eee">
                                        <td colspan="2"><strong> Total de Pontes </strong></td>
                                        <td  class="text-center"><strong><?php echo $total_pontos; ?></strong></td>
                                        <td  class="text-center" colspan=""> -- </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>