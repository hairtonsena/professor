<?php
$id_aluno;
$nome_aluno;
foreach ($aluno as $an) {
    $id_aluno = $an->id_aluno;
    $nome_aluno = $an->nome_aluno;
}
?>
<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/aluno") ?>">Aluno</a></li>
        <li class="active">Ver aluno</li>       
    </ol>
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Aluno: <?php echo $nome_aluno ?></div>
        <div class="panel-body">
            <div class="col-lg-8">
                <div class="page-header">
                    <h4 class="">Disciplina / turma</h4>
                </div>


                <div style="margin-top: 5px">
                    <table class="table table-bordered" id="tabelaCategoria">
                        <thead>
                            <tr>
                                <th class="col-lg-5"> Disciplina </th>
                                <th class="col-lg-5"> Turma </th>
                                <th class="col-lg-1 text-center">Ver</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($disciplina_turma_aluno as $dta) {
                                ?>
                                <tr>
                                    <td><?php echo $dta->nome_disciplina ?></td>
                                    <td><?php echo $dta->nome_turma ?></td>
                                    <td class="text-center  "><a href="<?php echo base_url("cpainel/aluno/disciplina_turma?turma=".$dta->id_turma."&aluno=".$id_aluno) ?>"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<!--Comfimação de exclusão-->
<div class="modal fade" id="modelExcluirDisciplina" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">        
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Excluir disciplina</h4>
            </div>
            <div class="modal-body">
                <p>Você realmente deseja excluir está disciplina? </p>
                <input type="hidden" id="disciplina_excluir" value="" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                <button type="button" class="btn btn-primary" onclick="Disciplina.excluir_disciplina()">Sim</button>
            </div>
        </div>
    </div>
</div>
<!--Final de confirmação-->
<!--Forme para alterar senha do aluno-->
<div class="modal fade" id="modelSenhaAluno" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">        
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Alterar senha aluno</h4>
            </div>
            <div class="modal-body" id="textoDescricao_disciplina">
                <input type="hidden" id="aluno" value="" />
                <label>Informe a nova senha</label>
                <input type="text" class="form-control" id="nova_senha" required="true" value="" />
                <span class="text-danger" id="erro_senha"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" onclick="Aluno.alterar_senha_aluno()">Salvar</button>
            </div>
        </div>
    </div>
</div>
<!-- Fim forme de alterar senha aluno -->
