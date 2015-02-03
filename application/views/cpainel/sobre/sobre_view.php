<?php
$id_professor;
$nome_professor;
$sobre_professor;
$imagem_professor;
foreach ($professor as $prf) {
    $id_professor = $prf->id_professor;
    $nome_professor = $prf->nome_professor;
    $sobre_professor = $prf->sobre_professor;
    $imagem_professor = $prf->imagem_professor;
}
?>
<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li class="active">Sobre</li>       
    </ol>
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Sobre</div>
        <div class="panel-body">
            <div class="col-lg-12">
                <div class="col-lg-3">
                    <div class="page-header text-right"><a class="" href="<?php echo base_url("cpainel/sobre/alterar_imagem_professor") ?>">alterar</a></div>

                    <div class="thumbnail">
                        <img src="<?php echo base_url("imagens/" . $imagem_professor) ?>" />
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="page-header text-right"><a class="" href="<?php echo base_url("cpainel/sobre/alterar_dados") ?>">alterar</a></div>

                    <label>Nome: </label>
                    <?php echo $nome_professor ?><br/>

                    <label>Sobre:</label>
                    <div class="panel panel-default">

                        <div class="panel-body">
                            <?php echo $sobre_professor; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="page-header">Alterar Senha</div>
                    <form action="<?php echo base_url("cpainel/sobre/salva_nova_senha") ?>" method="post">
                        <?php echo $this->session->flashdata("senha_alterada") ?>
                        <div class="form-group">
                            <label for="senha_atual">Senha atual</label>
                            <input type="password" name="senha_atual" class="form-control" id="senha_atual" placeholder="******">
                            <span class="text-danger"> <?php echo form_error('senha_atual'); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="nova_senha">Nova senha</label>
                            <input type="password" name="nova_senha" class="form-control" id="nova_senha" placeholder="******">
                            <span class="text-danger"> <?php echo form_error('nova_senha'); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="confirmacao_senha">Repita nova senha</label>
                            <input type="password" name="confirmacao_senha" class="form-control" id="confirmacao_senha" placeholder="******">
                            <span class="text-danger"> <?php echo form_error('confirmacao_senha'); ?></span>
                        </div>

                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
