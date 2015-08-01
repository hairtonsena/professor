<div  class="col-md-8 row semMargem">
    <div class="titulos">Alterar senha</div>

    <div class="col-md-12 linha">
        <form action="<?php echo base_url("aluno/salvar_nova_senha") ?>" method="POST" >
            <div class="form-group">
                <label for="senha_atual" class="col-md-12">Senha atual</label>
                <div class="col-md-12">
                    <input type="password" name="senha_atual" id="senha_atual" class="form-control" placeholder="********" />
                    <span class="text-danger"><?php echo form_error("senha_atual") ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="nova_senha" class="col-md-12">Nova senha</label>
                <div class="col-md-12">
                    <input type="password" name="nova_senha" id="nova_senha" class="form-control" placeholder="********" />
                    <span class="text-danger"><?php echo form_error("nova_senha") ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="confirmar_senha" class="col-md-12">Confirmar senha</label>
                <div class="col-md-12">
                    <input type="password" name="confirma_senha" id="confirma_senha" class="form-control" placeholder="********" />
                    <span class="text-danger"><?php echo form_error("confirma_senha") ?></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary pull-right">Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>








