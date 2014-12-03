<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li class="active">Localização </li>       
    </ol>
    <div class="col-lg-6">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th> Id </th>
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
                        <td> <?php echo $estados->id_uf; ?> </td>
                        <td> <?php echo $estados->nome_uf; ?></td>
                        <td> <?php echo $estados->sigla_uf; ?></td>
                        <?php if ($estados->status_uf == 0) { ?>
                            <td>
                                <!--<a href="<?php // echo base_url("cpainel/localizacao/?ativar_uf=" . $estados->id_uf)  ?>">a </a>-->
                                <input type="checkbox" name="check_estado_<?php echo $estados->id_uf ?>" id="check_estado_<?php echo $estados->id_uf ?>" onclick="Localizacao.cheque_estado('<?php echo $estados->id_uf ?>')" />
                            </td>
                            <td>>></td>
                        <?php } else { ?>
                            <td>
                                <!--<a href="<?php // echo base_url("cpainel/localizacao/?desativar_uf=" . $estados->id_uf)  ?>">b </a>--> 
                            </td>
                            <td><a href="javascript:void(0)" onclick="Localizacao.obter_ciadade_estado('<?php echo $estados->id_uf ?>')" >>></a></td>
                        <?php } ?>
                        <?php
                    }
                    ?>
            </tbody>

        </table>
    </div>
    <div class="col-lg-6" id="localCidades">
<!--        <form action="<?php // base_url("./localizacao")  ?>" method="post">
            <div class="input-group col-lg-12">
                <select class="form-control" name="uf">
                    <option value="">Selecione o estado.</option>
        <?php
        //   foreach ($uf as $ea) {
        //  if ($ea->status_uf == 1) {
        ?>
                            <option value="<?php // echo $ea->id_uf  ?>"><?php // echo $ea->nome_uf  ?></option>
                      //  <?php
        //    }
        //    }
        ?>
                </select>
            </div>
            <div class="input-group col-lg-12">
                <input type="text" name="novo_uf" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">Add</button>
                </span>
            </div> /input-group 
        </form>-->
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