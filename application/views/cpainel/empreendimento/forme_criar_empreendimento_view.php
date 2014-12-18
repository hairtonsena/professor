<div class="col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/empreendimento") ?>">Empreendimento</a></li>
        <li class="active">Novo empreendimento</li>       
    </ol>
    <form class="form-horizontal" action="<?php echo base_url("cpainel/secretaria/criar_nova_secretaria"); ?>" method="post" role="form">
        <div class="col-lg-4">
            <div class="form-group">
                <label for="titulo" class="col-sm-3 control-label">Categoria</label>
                <div class="col-sm-9">
                    <select name="categoria" id="categoria" class="form-control" onchange="Empreendimento.obter_select_subcategoria()">
                        <option value="">Selecione Categoria</option>
                        <?php foreach ($categoria as $ct) { ?>
                            <option value="<?php echo $ct->id_categoria ?>"><?php echo $ct->nome_categoria ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>            
        </div>
        <div class="col-lg-4">

            <div class="form-group">
                <label for="titulo" class="col-sm-3 control-label">Subcategoria</label>
                <div class="col-sm-9" id="campo_subcategoria">
                    <select name="subcategoria" id="subcategoria" class="form-control" onchange="">
                        <option value="">Selecione subcategoira</option>
                        <option value="">Selecione subcategoira</option>
 
                    </select>
                </div>
            </div>            
        </div>
        <div class="col-lg-4">

            <div class="form-group">
                <label for="titulo" class="col-sm-3 control-label">Tipo</label>
                <div class="col-sm-9">
                    <select name="tipo" id="tipo_empreendimento" class="form-control" onchange="Empreendimento.opcao_formulario()">
                        <option value="">Selecione um Tipo</option>
                        <?php foreach ($tipo_empreendimento as $te) { ?>
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