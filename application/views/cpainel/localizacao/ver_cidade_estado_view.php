<table class="table table-striped">
    <thead>
        <tr>
            <th>Cidades</th>
            <th>status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cidade as $cd) {
            ?>
            <tr>
                <td>
                    <?php echo $cd->nome_cidade ?>
                </td>
                <td>
                    <span id="btnAtivarCidade_<?php echo $cd->id_cidade ?>">
                        <?php if ($cd->status_cidade == 0) { ?>
                            <button type="button" onclick="Localizacao.ativar_desativar_cidade('<?php echo $cd->id_cidade ?>')">Ativar</button>
                        <?php } else if ($cd->status_cidade == 1) { ?>
                            <button type="button" onclick="Localizacao.ativar_desativar_cidade('<?php echo $cd->id_cidade ?>')" >Desativar</button>
                        <?php } ?>
                    </span></td>
            </tr>
        <?php } ?>
    </tbody>
</table>