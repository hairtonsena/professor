<form action="#" onsubmit="return Tela.acesso_aluno()" id="forme_acesso_aluno" method="post" >
    <div class="modal-header" >
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Área do aluno - acesso restrito</h4>
    </div>
    <div class="modal-body" >
        <div class="semMargem" >


            <div class="form-group" >

                <input type="text" name="cpf_or_matricula" id="cpf_or_matricula" class="form-control" placeholder="CPF ou Matricula" >

                <?php echo form_error('cpf_or_matricula', '<span class="text-danger">', '</span>'); ?>
            </div>
            <div class="form-group">

                <input type="password" name="senha" id="senha" class="form-control" placeholder="senha" >
                <?php echo form_error('senha', '<span class="text-danger">', '</span>'); ?>

            </div>

        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </div>
</form>