<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li class="active">Localização </li>       
    </ol>
    <div class="col-lg-6">
        <table class="table table-striped">
            <thead>
                <tr>
                    <!--<th> Id </th>-->
                    <th> Estado </th>
                    <th> Sigla</th>
                    <th>Status</th>
                    <th>ver</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($uf as $estados) {
                    ?>
                    <tr>
                        <!--<td> <?php// echo $estados->id_uf; ?> </td>-->
                        <td> <?php echo $estados->nome_uf; ?></td>
                        <td> <?php echo $estados->sigla_uf; ?></td>
                        <?php if ($estados->status_uf == 0) { ?>
                            <td>
                                <span id="btnAtivarEstado_<?php echo $estados->id_uf ?>"> <button type="button" onclick="Localizacao.ativar_desativar_estado('<?php echo $estados->id_uf ?>')" >Ativar</button></span>
                            </td>
                            <td><span id="btnVerCidadeEstado_<?php echo $estados->id_uf ?>">  >> </span></td>
                        <?php } else { ?>
                            <td>
                                <span id="btnAtivarEstado_<?php echo $estados->id_uf ?>"> <button type="button" onclick="Localizacao.ativar_desativar_estado('<?php echo $estados->id_uf ?>')" >Desativar</button></span>
                            </td>
                            <td>
                                <span id="btnVerCidadeEstado_<?php echo $estados->id_uf ?>">
                                    <button type="button" onclick="Localizacao.obter_ciadade_estado('<?php echo $estados->id_uf ?>')" >>></button>
                                </span>
                            </td>
                        <?php } ?>
                        <?php
                    }
                    ?>
            </tbody>

        </table>
    </div>
    <div class="col-lg-6" id="localCidades">

    </div>

    <script type="text/javascript">
        function confirmacao(id) {
            var resposta = confirm("Você esta excluindo uma Secretaria!");
            if (resposta == true) {
                window.location.href = "<?php echo base_url('cpainel/secretaria/excluir_secretaria/'); ?>/" + id;
            }
        }

    </script>
</div>