<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li class="active">Disciplina</li>       
    </ol>
    <div class="col-lg-6">
        <a  href="<?php echo base_url("cpainel/disciplina/nova_disciplina") ?>" class="btn btn-primary" id="btnNovaDdisciplina">Nova Disciplina</a>

        <div style="margin-top: 5px">
            <table class="table table-bordered" id="tabelaCategoria">
                <thead>
                    <tr>
                        <th class="col-lg-7"> Nome </th>
                        <th class="col-lg-1 center"> Descrição </th>
                        <th class="col-lg-1 center"> Alterar </th>
                        <th class="col-lg-1 center"> Excluir </th>
                        <th class="col-lg-1 center"> sub </th>
                        <th class="col-lg-1 center"> status </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($disciplina as $dc) {
                        if ($dc->status_disciplina == 0) {
                            ?>
                            <tr id="<?php echo $dc->id_disciplina; ?>">
                                <td ><a href="javascript:void(0)"><span id="nome_<?php echo $dc->id_disciplina ?>"> <?php echo $dc->nome_disciplina; ?></span></td>
                                <td class="text-center"><span id="btnEditarCategoria_<?php echo $dc->id_disciplina ?>"><a href="<?php echo base_url('cpainel/categoria/alterar_categoria/' . $dc->id_disciplina) ?>"> <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> </a></span></td>
                                <td class="text-center"><span id="btnEditarCategoria_<?php echo $dc->id_disciplina ?>"><a href="<?php echo base_url('cpainel/disciplina/alterar_disciplina/' . $dc->id_disciplina) ?>"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </a></span></td>
                                <td class="text-center"><span id="btnExcluirCategoria_<?php echo $dc->id_disciplina ?>"><a href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-sm" data-categoria="<?php echo $dc->id_disciplina ?>"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </a></span></td>
                                <td class="text-center"><span id="btnAddSubcategoria_<?php echo $dc->id_disciplina ?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </span></td>
                                <td class="text-center"><span id="btnAtivarCategoria_<?php echo $dc->id_disciplina ?>"><a href="javascript:void(0)" onclick="Categoria.ativar_desativar_categoria('<?php echo $dc->id_disciplina ?>')"> <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> </a></span></td>
                            </tr>
                        <?php } else {
                            ?>
                            <tr id="<?php echo $ct->id_categoria; ?>">
                                <td><span id="nome_<?php echo $ct->id_categoria ?>"><?php echo $ct->nome_categoria; ?></span></td>
                                <td class="text-center"><span id="btnEditarCategoria_<?php echo $ct->id_categoria ?>"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </span></td>
                                <td class="text-center"><span id="btnExcluirCategoria_<?php echo $ct->id_categoria ?>"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </span></td>
                                <td class="text-center"> <span id="btnAddSubcategoria_<?php echo $ct->id_categoria ?>"> <a href="<?php echo base_url('cpainel/categoria/subcategoria/' . $ct->id_categoria) ?>" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </a></span></td>
                                <td class="text-center"><span id="btnAtivarCategoria_<?php echo $ct->id_categoria ?>"> <a href="javascript:void(0)" onclick="Categoria.ativar_desativar_categoria('<?php echo $ct->id_categoria ?>')"> <span class="glyphicon glyphicon-collapse-up" aria-hidden="true"></span> </a></span></td>
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

<!--Comfimação de exclusão-->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">        
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Excluir categoria</h4>
            </div>
            <div class="modal-body">
                <p>Você realmente deseja excluir está categoria? </p>
                <input type="hidden" id="categoria_excluir" value="" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                <button type="button" class="btn btn-primary" onclick="Categoria.excluir_categoria()">Sim</button>
            </div>
        </div>
    </div>
</div>
<!--Final de confirmação-->
