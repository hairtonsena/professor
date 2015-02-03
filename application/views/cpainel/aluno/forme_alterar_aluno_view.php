<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/aluno") ?>">Aluno</a></li>
        <li class="active">Alterar aluno </li>       
    </ol>
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Aluno</div>
        <div class="panel-body">
            <div class="col-lg-12 semMargem" style="/*border-left: 1px solid #ddd;border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; */">
                <div class="col-lg-6"  style="padding-top: 5px; border-right: 1px solid #ddd;">
                    <?php foreach ($aluno as $al) { ?>
                        <form class="form-horizontal" action="<?php echo base_url("cpainel/aluno/salvar_aluno_alterado"); ?>" method="post" role="form">
                            <input type="hidden" name="aluno" value="<?php echo $al->id_aluno ?>"
                                   <fieldset>
                                <legend>Alterar aluno</legend>
                                <div class="form-group">
                                    <label for="nome_aluno" class="col-sm-2 control-label">Nome</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nome_aluno" class="form-control" id="nome_turma" value="<?php echo $al->nome_aluno ?>" placeholder="Nome">
                                        <span class="text-danger"> <?php echo form_error('nome_aluno'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email_aluno" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input type="email" name="email_aluno" class="form-control" id="nome_turma" value="<?php echo $al->email_aluno ?>" placeholder="Email">
                                            <span class="input-group-addon" >Opcional</span>
                                        </div>
                                        <span class="text-danger"> <?php echo form_error('email_aluno'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="matricula_aluno" class="col-sm-2 control-label">Matricula</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="matricula_aluno" class="form-control" id="matricula_aluno" value="<?php echo $al->matricula_aluno ?>" placeholder="Matricula">

                                        <span class="text-danger"> <?php echo form_error('matricula_aluno'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cpf_aluno" class="col-sm-2 control-label">CPF</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="cpf_aluno" class="form-control" id="cpf_aluno" value="<?php echo $al->cpf_aluno ?>" placeholder="CPF">
                                        <span class="text-danger"> <?php echo form_error('cpf_aluno'); ?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-offset-8 col-sm-4">
                                        <a href="<?php echo base_url("cpainel/aluno"); ?>" class="btn btn-default" >Cancelar</a>
                                        <button type="submit" class="btn btn-primary"> Salvar </button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    <?php } ?>
                </div>
                <div class="col-lg-6"  style="padding-top: 5px;">
                    <!--                    <h2>informativo</h2>
                                        <p><strong>Atenção !</strong> Os alunos cadastrados neste formulário não estara vinculados a uma turma. </p>-->
                </div>
            </div>
        </div>
    </div>
</div>