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
        <li><a href="<?php echo base_url("cpainel/avaliacao?turma=" . $id_turma) ?>">Avaliação</a></li>
        <li class="active">Avaliação de recuperacao </li>       
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
                    <li role="presentation" class="active"><a href="<?php echo base_url("cpainel/avaliacao?turma=" . $id_turma) ?>">Avaliações</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/trabalho?turma=" . $id_turma) ?>">Trabalhos</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/notas?turma=" . $id_turma) ?>">Notas</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/turma/horario/" . $id_turma) ?>">Horário</a></li>
                </ul>
                <div class="col-lg-12 semMargem" style="border-left: 1px solid #ddd;border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; ">
                    <div class="col-lg-12" style="padding-top: 5px;">
                        <h3>Avaliação de recuperação</h3>
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
                                            <td><span id="descricao_ar"><?php echo $ar->descricao_avaliacao_recuperacao; ?></span></td>   
                                            <td class="text-center"><span id="data_ar"><?php echo implode("/", array_reverse(explode("-", $ar->data_avaliacao_recuperacao))); ?></span></td> 
                                            <td  class="text-center"><?php echo $ar->valor_avaliacao_recuperacao; ?></td> 


                                            <td class="text-center"><a href="javascript:void(0)" data-toggle="modal" data-target="#modelFormeAlerarAvaliacaoRecuperacao" data-avaliacao_recuperacao="<?php echo $ar->id_avaliacao_recuperacao ?>"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>

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
<!--Comfimação de exclusão-->
<div class="modal fade" id="modelFormeAlerarAvaliacaoRecuperacao" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">        
        <div class="modal-content">
            <form class="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Alterar avaliação de recupercação</h4>
                </div>
                <div class="modal-body">
                    <p id="mensagem_retorno">
                        
                    </p>
                    
                    
                    <input type="hidden" id="iptAvaliacao_recuperacao" value="" />
                    <div class="form-group">
                        <label class="col-lg-12">Descrição</label>
                        <div class="col-lg-12">
                            <input type="text" class="form-control" name="iptDescricao_avaliacao_recuperacao" id="iptDescricao_avaliacao_recuperacao" value=""/> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-12">Data</label>
                        <div class="col-lg-12">
                            <input type="text" class="form-control" name="iptData_avaliacao_recuperacao" id="iptData_avaliacao_recuperacao" value="" placeholder="00/00/0000"/> 
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="Avaliacao.alterar_avaliacao_recuperacao()">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Final de confirmação-->