<div class="col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/empreendimento") ?>">Empreendimento</a></li>
        <li class="active">Novo empreendimento</li>       
    </ol>
    <form class="form-horizontal" action="<?php echo base_url("cpainel/secretaria/criar_nova_secretaria"); ?>" method="post" role="form">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="titulo" class="col-sm-1 control-label">Tipo</label>
                <div class="col-sm-5">
                    <select name="tipo" id="tipo_empreendimento" class="form-control" onchange="Empreendimento.opcao_formulario()">
                        <option value="">Selecione um Tipo</option>
                        <?php foreach ($tipo_empreendimento as $te){ ?>
                        <option value="<?php echo $te->id_tipo_empreendimento ?>"><?php echo $te->nome_tipo_empreendimento ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>            
        </div>
        <hr/>
        <div id="form_cadastro_empreendimento">
        </div>
    </form>
</div>

</div>