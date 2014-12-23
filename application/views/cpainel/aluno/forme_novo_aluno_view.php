<?php
$nome_disciplina;
$id_disciplina;
$nome_turma;
$id_turma;
foreach ($turma_disciplina as $td) {
    $nome_disciplina = $td->nome_disciplina;
    $id_disciplina = $td->id_disciplina;
    $nome_turma = $td->nome_turma;
    $id_turma = $td->id_turma;
}
?>
<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/disciplina") ?>">Disciplina</a></li>
        <li><a href="<?php echo base_url("cpainel/turma?disciplina=" . $id_disciplina) ?>">Turma</a></li>
        <li><a href="<?php echo base_url("cpainel/turma/alunos/" . $id_turma) ?>">Alunos</a></li>
        <li class="active">Novo alunos </li>       
    </ol>
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Disciplina: <?php echo $nome_disciplina ?></div>
        <ul class="list-group">
            <li class="list-group-item text-danger">Turma: <?php echo $nome_turma ?></li>
        </ul>
        <div class="panel-body">
            <div class="col-lg-12 semMargem">
                <ul class="nav nav-tabs">
                    <li role="presentation" class="active"><a href="#">Alunos</a></li>
                    <li role="presentation"><a href="#">Avaliações</a></li>
                    <li role="presentation"><a href="#">Trabalhos</a></li>
                </ul>
                <div class="col-lg-12 semMargem" style="/*border-left: 1px solid #ddd;border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; */">


                    <div class="col-lg-6"  style="padding-top: 5px;">

                        <form class="form-horizontal" action="<?php echo base_url("cpainel/aluno/salvar_novo_aluno"); ?>" method="post" role="form">
                            <input type="hidden" name="turma" value="<?php echo $id_turma ?>" />
                            <fieldset>
                                <legend>Novo aluno</legend>
                                <div class="form-group">
                                    <label for="nome_aluno" class="col-sm-2 control-label">Nome</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nome_aluno" class="form-control" id="nome_turma" value="<?php echo set_value('nome_aluno') ?>" placeholder="Nome">
                                        <span class="text-danger"> <?php echo form_error('nome_aluno'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="matricula_aluno" class="col-sm-2 control-label">Matricula</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="matricula_aluno" class="form-control" id="matricula_aluno" placeholder="Matricula">
                                        <span class="text-danger"> <?php echo form_error('matricula_aluno'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cpf_aluno" class="col-sm-2 control-label">CPF</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="cpf_aluno" class="form-control" id="cpf_aluno" placeholder="CPF">
                                        <span class="text-danger"> <?php echo form_error('cpf_aluno'); ?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-offset-8 col-sm-4">
                                        <a href="<?php echo base_url("cpainel/turma?disciplina=" . $id_disciplina); ?>" class="btn btn-default" >Cancelar</a>
                                        <button type="submit" class="btn btn-primary"> Salvar </button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>

                    </div>
                    <div class="col-lg-6" style="padding-top: 5px;">
                        <form>
                            <fieldset>
                                <legend>Adicionar aluno já existente</legend>
                            </fieldset>
                            <div class="form-group">
                                Filtrar por: 
                                <label class="radio-inline">
                                    <input type="radio" checked="true" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Nome
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Matricula
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"> CPF
                                </label>
                                <div class="col-lg-12 semMargem">
                                    <div class="input-group">
                                        <input class="form-control" name="aluno" id="ipt_aluno" />
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button">Pesquisar</button>
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div id="resultado_pesquisa_aluno">
                            
                            <div id="log" style="height: 200px; width: 300px; overflow: auto;" class="ui-widget-content"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>