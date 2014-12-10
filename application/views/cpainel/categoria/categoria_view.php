<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li class="active">Categaria</li>       
    </ol>
    <div class="col-lg-6">
        <a  href="<?php echo base_url("cpainel/categoria/nova_categoria") ?>" class="btn btn-primary" id="btnNovaCategoria">Nova Categoria</a>
        <div>
            <table class="table table-bordered" id="tabelaCategoria">
                <thead>
                    <tr>
                        <td class="col-lg-9"> Nome </td>
                        <td class="col-lg-1 center"> Alterar </td>
                        <td class="col-lg-1 center"> Excluir </td>
                        <td class="col-lg-1 center"> sub </td>
                        <td class="col-lg-1 center"> status </td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($categoria as $ct) {
                        if ($ct->status_categoria == 0) {
                            ?>
                            <tr id="<?php echo $ct->id_categoria; ?>">
                                <td  title="Nome" class="editavel"><?php echo $ct->nome_categoria; ?></td>
                                <td class="text-center"><span id="btnEditarCategoria_<?php echo $ct->id_categoria ?>"><a href="javascript:void(0)" id="editar"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </a></span></td>
                                <td class="text-center"><span id="btnExcluirCategoria_<?php echo $ct->id_categoria ?>"><a href="#"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </a></span></td>
                                <td class="text-center"><span id="btnAddSubcategoria_<?php echo $ct->id_categoria ?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </span></td>
                                <td class="text-center"><span id="btnAtivarCategoria_<?php echo $ct->id_categoria ?>"><a href="javascript:void(0)" onclick="Categoria.ativar_desativar_categoria('<?php echo $ct->id_categoria ?>')"> <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> </a></span></td>
                            </tr>
                        <?php } else {
                            ?>
                            <tr>
                                <td><?php echo $ct->nome_categoria; ?></td>
                                <td class="text-center"><span id="btnEditarCategoria_<?php echo $ct->id_categoria ?>"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </span></td>
                                <td class="text-center"><span id="btnExcluirCategoria_<?php echo $ct->id_categoria ?>"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </span></td>
                                <td class="text-center"> <span id="btnAddSubcategoria_<?php echo $ct->id_categoria ?>"> <a href="#" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </a></span></td>
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