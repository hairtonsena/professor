<div class="col-lg-6">
    <div class="form-group">
        <label for="nome_empreendimento" class="col-sm-2 control-label">Nome:</label>
        <div class="col-sm-10">
            <input type="text" name="nome_empreendimento" class="form-control" id="nome" placeholder="Nome">
            <span class="text-danger"><?php echo validation_errors() ?></span>
        </div>
    </div>
    <div class="form-group">
        <label for="cpf_empreendimento" class="col-sm-2 control-label">CPF:</label>
        <div class="col-sm-10">
            <input type="text" name="cpf_empreendimento" class="form-control" id="titulo" placeholder="CPF">
            <span class="text-danger"><?php echo validation_errors() ?></span>
        </div>
    </div>
    <div class="form-group">
        <label for="endereco_empreendimento" class="col-sm-2 control-label">Endereço</label>
        <div class="col-sm-10">
            <input type="text" name="endereco_empreendimento" class="form-control" id="titulo" placeholder="Endereço">
            <span class="text-danger"><?php echo validation_errors() ?></span>
        </div>
    </div>
    <div class="form-group">
        <label for="bairro_empreendimento" class="col-sm-2 control-label">Bairro</label>
        <div class="col-sm-10">
            <input type="text" name="bairro_empreendimento" class="form-control" id="titulo" placeholder="Bairro">
            <span class="text-danger"><?php echo validation_errors() ?></span>
        </div>
    </div>

</div>
<div class="col-lg-6">
    <div class="form-group">
        <label for="titulo" class="col-sm-2 control-label">Nome</label>
        <div class="col-sm-10">
            <input type="titulo" name="titulo_secretaria" class="form-control" id="titulo" placeholder="Titulo">
            <span class="text-danger"><?php echo validation_errors() ?></span>
        </div>
    </div>
    <div class="form-group">
        <label for="titulo" class="col-sm-2 control-label">CPF:</label>
        <div class="col-sm-10">
            <input type="titulo" name="titulo_secretaria" class="form-control" id="titulo" placeholder="Titulo">
            <span class="text-danger"><?php echo validation_errors() ?></span>
        </div>
    </div>
</div>
<div class="col-lg-12">

    <div class="form-group">
        <div class="col-md-offset-4 col-sm-4">
            <a class="btn btn-default" href="<?php echo base_url("cpainel/empreendimento") ?>" > Cancelar </a>
            <button type="submit" class="btn btn-primary"> Criar</button>
        </div>
    </div>
</div>