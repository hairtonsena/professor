<?php
$id_professor;
$nome_professor;
$sobre_professor;
foreach ($professor as $prf) {
    $id_professor = $prf->id_professor;
    $nome_professor = $prf->nome_professor;
    $sobre_professor = $prf->sobre_professor;
}
?>

<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/sobre") ?>">Sobre</a></li>
        <li class="active">Alterar imagem</li>       
    </ol>
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Sobre</div>
        <div class="panel-body">
            <div class="col-lg-12">
                <div class="col-lg-7">

                    <form action="<?php echo base_url("cpainel/sobre/salvar_imagem_professor") ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <fieldset>
                            <legend>Alterar imagem</legend>
                            <?php echo $erro_upload ?>
                            <div class="form-group">
                                <label for="arquivo">File input</label>
                                <input type="file" name="arquivo" id="arquivo" class="form-control">
                                <p class="help-block">Esta imagem ficará em todas as paginas do site</p>
                            </div>

                            <div class="form-group">

                                <a class="btn btn-default" href="<?php echo base_url("cpainel/sobre") ?>" >Cancelar</a> <button type="submit" class="btn btn-primary">Salvar</button>

                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!--Comfimação de exclusão-->
<div class="modal fade" id="modelExcluirDisciplina" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">        
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Excluir disciplina</h4>
            </div>
            <div class="modal-body">
                <p>Você realmente deseja excluir está disciplina? </p>
                <input type="hidden" id="disciplina_excluir" value="" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                <button type="button" class="btn btn-primary" onclick="Disciplina.excluir_disciplina()">Sim</button>
            </div>
        </div>
    </div>
</div>
<!--Final de confirmação-->
<!--Forme para alterar senha do aluno-->
<div class="modal fade" id="modelSenhaAluno" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">        
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Alterar senha aluno</h4>
            </div>
            <div class="modal-body" id="textoDescricao_disciplina">
                <input type="hidden" id="aluno" value="" />
                <label>Informe a nova senha</label>
                <input type="text" class="form-control" id="nova_senha" required="true" value="" />
                <span class="text-danger" id="erro_senha"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" onclick="Aluno.alterar_senha_aluno()">Salvar</button>
            </div>
        </div>
    </div>
</div>
<!-- Fim forme de alterar senha aluno -->
