<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li class="active">Empreendimento </li>       
    </ol>
    <a class="btn btn-primary" href="<?php echo base_url("cpainel/empreendimento/novo"); ?>">Novo empreendimento</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <td> Nome </td>
                <td> Logo </td> 
                <td> Descrição </td>
                <td> Excluir </td>
                <td> Status </td>

            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($empreendimento as $nt) {
                if ($nt->status_secretaria == 0) {
                    ?>
                    <tr>
                        <!--<td> <?php // echo $nt->id_secretaria;   ?> </td>-->
                        <td> <a href="<?php echo base_url("cpainel/secretaria/forme_editar_titulo_secretaria/" . $nt->id_secretaria); ?>"> <?php echo $nt->titulo_secretaria; ?> </a></td>
                        <td> <a href="<?php echo base_url("cpainel/secretaria/alterar_imagem_secretaria/" . $nt->id_secretaria); ?>"> <img src="<?php echo base_url($nt->imagem_secretaria); ?>" width="100px" height="70px" /> </a></td>

                        <td> <a href="<?php echo base_url("cpainel/secretaria/alterar_texto_secretaria/" . $nt->id_secretaria); ?>"> Texto </a></td>
                        <td> <a href = "javascript:func()" onclick="confirmacao('<?php echo $nt->id_secretaria ?>')"> Excluir </a></td>
                        <td> <a class="text-info" href="<?php echo base_url("cpainel/secretaria/ativar_secretaria/" . $nt->id_secretaria); ?>"> Ativar </a> </td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <!--<td> <?php // echo $nt->id_secretaria;   ?> </td>-->
                        <td> <?php echo $nt->titulo_secretaria; ?> </td>
                        <td> <img src="<?php echo base_url() . $nt->imagem_secretaria; ?>" width="100px" height="70px" /> </td>

                        <td><a class="btn" href="javascript:void(0)" onclick="Secretaria.verTextoSecretaria('<?php echo $nt->id_secretaria; ?>')">  Texto </a></td>
                        <td>  Excluir </td>
                        <td><a class="text-danger" href="<?php echo base_url("cpainel/secretaria/desativar_secretaria/" . $nt->id_secretaria); ?>"> Desativar </a> </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>

    </table>

    <script type="text/javascript">
        function confirmacao(id) { 
            var resposta = confirm("Você esta excluindo uma Secretaria!");   
            if (resposta == true) { window.location.href = "<?php echo base_url('cpainel/secretaria/excluir_secretaria/'); ?>/"+id; } 
        } 
    
    </script>
</div>