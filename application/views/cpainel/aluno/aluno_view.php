
<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li class="active">Aluno</li>       
    </ol>
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Aluno</div>
        <div class="panel-body">
            <div class="col-lg-8">
                <a  href="<?php echo base_url("cpainel/aluno/novo") ?>" class="btn btn-primary" id="btnNovaDdisciplina">Novo aluno</a>
                <div style="margin-top: 5px">
                    <table class="table table-bordered" id="tabelaCategoria">
                        <thead>
                            <tr>
                                <th class="col-lg-4"> Nome </th>
                                <th class="col-lg-1 text-center"> Matricula </th>
                                <th class="col-lg-2 text-center">CPF</th>
                                <th class="col-lg-1 text-center">ver</th>
                                <th class="col-lg-1 text-center"> Alterar </th>
                                <th class="col-lg-2 text-center"> Alterar senha </th>
                                <th class="col-lg-1 text-center"> Excluir </th>
                                <th class="col-lg-1 text-center"> status </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($alunos as $an) {
                                if ($an->status_aluno == 0) {
                                    ?>
                                    <tr>
                                        <td> <?php echo $an->nome_aluno ?></td>
                                        <td class="text-center"><?php echo $an->matricula_aluno ?></td>
                                        <td class="text-center"><?php echo $an->cpf_aluno ?></td>
                                        <td class="text-center"><span id="btnVerAluno_<?php echo $an->id_aluno ?>"><span class="glyphicon glyphicon-eye-open"></span></span></td>
                                        <td class="text-center"><span id="btnEditarAluno_<?php echo $an->id_aluno ?>"><a href="<?php echo base_url('cpainel/aluno/alterar/' . $an->id_aluno) ?>"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </a></span></td>
                                        <td class="text-center"><span id="btnSenhaAluno_<?php echo $an->id_aluno ?>"><a href="javascript:void(0)" data-toggle="modal" data-target="#modelSenhaAluno" data-aluno="<?php echo $an->id_aluno ?>"> <span class="glyphicon glyphicon-lock" aria-hidden="true"></span> </a></span></td>
                                        <td class="text-center"><span id="btnExcluirAluno_<?php echo $an->id_aluno ?>"><a href="javascript:void(0)" data-toggle="modal" data-target="#modelExcluirAluno" data-aluno="<?php echo $an->id_aluno ?>"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </a></span></td>                                  
                                        <td class="text-center"><span id="btnAtivarAluno_<?php echo $an->id_aluno ?>"><a href="javascript:void(0)" onclick="Aluno.ativar_destivar_aluno('<?php echo $an->id_aluno ?>')"><span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span></a></span></td>
                                    </tr>
                                <?php } else {
                                    ?>
                                    <tr>
                                        <td><?php echo $an->nome_aluno; ?></td>
                                        <td class="text-center"><?php echo $an->matricula_aluno ?></td>
                                        <td class="text-center"><?php echo $an->cpf_aluno ?></td>
                                        <td class="text-center"><span id="btnVerAluno_<?php echo $an->id_aluno ?>"><a href="<?php echo base_url("cpainel/aluno/ver/".$an->id_aluno) ?>"> <span class="glyphicon glyphicon-eye-open"></span> </a></span></td>
                                        <td class="text-center"><span id="btnEditarAluno_<?php echo $an->id_aluno ?>"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </span></td>
                                        <td class="text-center"><span id="btnSenhaAluno_<?php echo $an->id_aluno ?>"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span></td>
                                        <td class="text-center"><span id="btnExcluirAluno_<?php echo $an->id_aluno ?>"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </span></td>
                                        <td class="text-center"><span id="btnAtivarAluno_<?php echo $an->id_aluno ?>"> <a href="javascript:void(0)" onclick="Aluno.ativar_destivar_aluno('<?php echo $an->id_aluno ?>')"> <span class="glyphicon glyphicon-collapse-up" aria-hidden="true"></span> </a></span></td>
                                    </tr>
                                    <?php
                                }
                            }
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
