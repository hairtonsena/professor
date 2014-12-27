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
        <li class="active">Trabalho </li>       
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
                    <li role="presentation" ><a href="<?php echo base_url("cpainel/avaliacao?turma=".$id_turma) ?>">Avaliações</a></li>
                    <li role="presentation" class="active"><a href="#">Trabalhos</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/notas?turma=".$id_turma) ?>">Notas</a></li>
                </ul>
                <div class="col-lg-12 semMargem" style="border-left: 1px solid #ddd;border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; ">
                    <div class="col-lg-12" style="padding-top: 5px;">
                        <a class="btn btn-primary" href="<?php echo base_url("cpainel/trabalho/novo/" . $id_turma); ?>">Novo Trabalho</a>
                        <div style="margin-top: 5px">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> Descricao </th>
                                        <th class="col-lg-1 center"> Data  </th>
                                        <th class="col-lg-1 center"> valor </th>
                                        <th class="col-lg-1 center"> Excluir </th>
                                        <th class="col-lg-1 center"> status </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total_pontos = 0;

                                    foreach ($trabalhos_turma as $tt) {
                                        if (0 == 0) {
                                            $total_pontos+=$tt->valor_nota_trabalho;
                                            ?>
                                            <tr>
                                                <td><?php echo $tt->titulo_trabalho; ?></td>   
                                                <td class="text-center"><?php echo date('d/m/Y', strtotime($tt->data_entrega_trabalho)); ?></td> 
                                                <td  class="text-center"><?php echo $tt->valor_nota_trabalho; ?></td> 


                                                <td class="text-center"><span id="btnExcluirTurma_<?php echo $tt->id_trabalho ?>"><a href="javascript:void(0)" data-toggle="modal" data-target="#modelExcluirAlunoTurma" data-aluno="<?php echo $tt->id_trabalho ?>" data-turma="<?php echo $id_turma ?>"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </a></span></td>                                                
                                                <td class="text-center"><span id="btnAtivarTurma_<?php echo $tt->id_trabalho ?>"><a href="javascript:void(0)" onclick="Turma.ativar_desativar_turma('<?php echo $tt->id_trabalho ?>')"> <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> </a></span></td>
                                            </tr>
                                        <?php } else { ?>
                                            <tr id="linha_aluno_turma_<?php echo $tm->id_turma ?>">
                                                <td> <?php echo $tm->nome_turma; ?> </td>
                                                <td class="text-center"><span id="btnExcluirTurma_<?php echo $tm->id_turma ?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></span></td>                                               
                                                <td class="text-center"><span id="btnAtivarTurma_<?php echo $tm->id_turma ?>"><a href="javascript:void(0)" onclick="Turma.ativar_desativar_turma('<?php echo $tm->id_turma ?>')"> <span class="glyphicon glyphicon-collapse-up" aria-hidden="true"></span> </a></span></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                            <tr style="background-color: #eee">
                                        <td colspan="2"><strong> Total de Pontes </strong></td>
                                        <td  class="text-center"><strong><?php echo $total_pontos; ?></strong></td>
                                        <td  class="text-center" colspan="2"> -- </td>
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
<!--Comfimação de exclusão-->
<div class="modal fade" id="modelExcluirAlunoTurma" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">        
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Excluir aluno da turma</h4>
            </div>
            <div class="modal-body">
                <p>Você realmente deseja excluir este aluno? </p>
                <input type="hidden" id="aluno_excluir" value="" />
                <input type="hidden" id="turma_excluir" value="" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                <button type="button" class="btn btn-primary" onclick="Aluno.excluir_aluno_turma()">Sim</button>
            </div>
        </div>
    </div>
</div>
<!--Final de confirmação-->