<div class=" col-lg-12 semMargem">
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Disciplina</div>
        <div class="panel-body">
            <div class="col-lg-6">
                <a  href="<?php echo base_url("cpainel/disciplina/nova_disciplina") ?>" class="btn btn-primary" id="btnNovaDdisciplina"><i class="glyphicon glyphicon-plus"></i><strong> Disciplina</strong></a>

                <div style="margin-top: 5px">
                    <table class="table table-bordered" id="tabelaCategoria">
                        <thead>
                            <tr>
                                <th class="col-lg-7"> Nome </th>
                                <th class="col-lg-1 center"> Descrição </th>
                                <th class="col-lg-1 center"> Turma </th>
                                <th class="col-lg-1 center"> Alterar </th>
                                <th class="col-lg-1 center"> Excluir </th>
                                <th class="col-lg-1 center"> status </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($disciplina as $dc) {
                                if ($dc->status_disciplina == 0) {
                                    ?>
                                    <tr>
                                        <td ><span id="nome_<?php echo $dc->id_disciplina ?>"> <?php echo $dc->nome_disciplina; ?></span></td>
                                        <td class="text-center"><span id="btnDescricaoDisciplina_<?php echo $dc->id_disciplina ?>"><a href="javascript:void(0)" data-toggle="modal" data-target="#modelVerDescricaDisciplina" data-disciplina="<?php echo $dc->id_disciplina ?>"> <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> </a></span></td>
                                        <td class="text-center"><span id="btnAddTurma_<?php echo $dc->id_disciplina ?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </span></td>
                                        <td class="text-center"><span id="btnEditarDisciplina_<?php echo $dc->id_disciplina ?>"><a href="<?php echo base_url('cpainel/disciplina/alterar_disciplina/' . $dc->id_disciplina) ?>"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </a></span></td>
                                        <td class="text-center"><span id="btnExcluirDisciplina_<?php echo $dc->id_disciplina ?>"><a href="javascript:void(0)" data-toggle="modal" data-target="#modelExcluirDisciplina" data-disciplina="<?php echo $dc->id_disciplina ?>"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </a></span></td>
                                        <td class="text-center"><span id="btnAtivarDisciplina_<?php echo $dc->id_disciplina ?>"><a href="javascript:void(0)" onclick="Disciplina.ativar_desativar_disciplina('<?php echo $dc->id_disciplina ?>')"> <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> </a></span></td>
                                    </tr>
                                <?php } else {
                                    ?>
                                    <tr>
                                        <td><span id="nome_<?php echo $dc->id_disciplina ?>"><?php echo $dc->nome_disciplina; ?></span></td>
                                        <td class="text-center"><span id="btnDescricaoDisciplina_<?php echo $dc->id_disciplina ?>"><a href="javascript:void(0)" data-toggle="modal" data-target="#modelVerDescricaDisciplina" data-disciplina="<?php echo $dc->id_disciplina ?>"> <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> </a></span></td>
                                        <td class="text-center"><span id="btnAddTurma_<?php echo $dc->id_disciplina ?>"> <a href="<?php echo base_url('cpainel/turma?disciplina=' . $dc->id_disciplina) ?>" ><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </a></span></td>
                                        <td class="text-center"><span id="btnEditarDisciplina_<?php echo $dc->id_disciplina ?>"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </span></td>
                                        <td class="text-center"><span id="btnExcluirDisciplina_<?php echo $dc->id_disciplina ?>"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </span></td>
                                        <td class="text-center"><span id="btnAtivarDisciplina_<?php echo $dc->id_disciplina ?>"> <a href="javascript:void(0)" onclick="Disciplina.ativar_desativar_disciplina('<?php echo $dc->id_disciplina ?>')"> <span class="glyphicon glyphicon-check" aria-hidden="true"></span> </a></span></td>
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
                <p id="mensagem_retorno" class="text-danger"></p>
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
<!--Visualização da descrição da disciplina-->
<div class="modal fade" id="modelVerDescricaDisciplina" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">        
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Descrição disciplina</h4>
            </div>
            <div class="modal-body" id="textoDescricao_disciplina">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <!--<button type="button" class="btn btn-primary" onclick="">Sim</button>-->
            </div>
        </div>
    </div>
</div>
<!--Fim da visualização da disciplina-->
