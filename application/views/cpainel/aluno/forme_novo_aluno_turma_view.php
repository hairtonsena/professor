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
<div class="col-lg-12 semMargem">

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading"><a href="<?php echo base_url("cpainel/disciplina") ?>"><i class="glyphicon glyphicon-arrow-left"></i> Disciplina</a>: <?php echo $nome_disciplina ?> / <a href="<?php echo base_url("cpainel/turma?disciplina=" . $id_disciplina) ?>"><i class="glyphicon glyphicon-arrow-left"></i>Turma</a>: <?php echo $nome_turma ?>
        </div>

        <div class="panel-body">
            <div class="col-lg-12 semMargem">
                <ul class="nav nav-tabs">
                    <li role="presentation" class="active"><a href="<?php echo base_url("cpainel/turma/alunos/" . $id_turma) ?>">Alunos</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/avaliacao?turma=" . $id_turma) ?>">Avaliações</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/trabalho?turma=" . $id_turma) ?>">Trabalhos</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/notas?turma=" . $id_turma) ?>">Notas</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/turma/horario/" . $id_turma) ?>">Horário</a></li>
                </ul>
                <div class="col-lg-12 semMargem" style="/*border-left: 1px solid #ddd;border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; */">


                    <div class="col-lg-6"  style="padding-top: 5px; border-right: 1px solid #ddd;">

                        <form class="form-horizontal" action="<?php echo base_url("cpainel/aluno/salvar_novo_aluno_turma"); ?>" method="post" role="form">
                            <input type="hidden" name="turma" id="turma" value="<?php echo $id_turma ?>" />
                            <fieldset>
                                <legend>Novo aluno</legend>
                                <div class="form-group">
                                    <label for="nome_aluno" class="col-sm-2 control-label">Nome</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nome_aluno" class="form-control" id="nome_turma" value="<?php echo set_value('nome_aluno') ?>" placeholder="Nome do aluno">
                                        <span class="text-danger"> <?php echo form_error('nome_aluno'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email_aluno" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input type="email" name="email_aluno" class="form-control" id="nome_turma" value="<?php echo set_value('email_aluno') ?>" placeholder="Email do aluno">
                                            <span class="input-group-addon" >Opcional</span>
                                        </div>
                                        <span class="text-danger"> <?php echo form_error('email_aluno'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="matricula_aluno" class="col-sm-2 control-label">Matricula</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="matricula_aluno" class="form-control" id="matricula_aluno" value="<?php echo set_value('matricula_aluno') ?>" placeholder="Matricula do aluno">
                                        <span class="text-danger"> <?php echo form_error('matricula_aluno'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cpf_aluno" class="col-sm-2 control-label">CPF</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="cpf_aluno" class="form-control" id="cpf_aluno" value="<?php echo set_value('cpf_aluno') ?>" placeholder="CPF do aluno">
                                        <span class="text-danger"> <?php echo form_error('cpf_aluno'); ?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-offset-8 col-sm-4">
                                        <a href="<?php echo base_url("cpainel/turma/alunos/" . $id_turma); ?>" class="btn btn-default" >Cancelar</a>
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
                                    <input type="radio" checked="true" name="rdbFiltroPesquisa" id="rdbFiltroPesquisa" value="nome"> Nome
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="rdbFiltroPesquisa" id="rdbFiltroPesquisa" value="matricula"> Matricula
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="rdbFiltroPesquisa" id="rdbFiltroPesquisa" value="cpf"> CPF
                                </label>
                                <div class="col-lg-12 semMargem">
                                    <div class="input-group">
                                        <input class="form-control" name="aluno" id="ipt_aluno" placeholder="Buscar aluno" />
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button">Pesquisar</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div id="">
                            <table class="table" id="tbl_resultado">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Matricula</th>
                                        <th>CPF</th>
                                        <th>adicionar</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <div id="imag_carrgando"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>