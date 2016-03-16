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
        <div class="panel-heading"><a href="<?php echo base_url("cpainel/disciplina") ?>"><i class="glyphicon glyphicon-arrow-left"></i> Disciplina</a>: <?php echo $nome_disciplina ?> / <a href="<?php echo base_url("cpainel/turma?disciplina=" . $id_disciplina) ?>"><i class="glyphicon glyphicon-arrow-left"></i>Turma</a>: <?php echo $nome_turma ?></div>

        <div class="panel-body">
            <div class="col-lg-12 semMargem">
                <ul class="nav nav-tabs">
                    <li role="presentation"><a href="<?php echo base_url("cpainel/turma/alunos/" . $id_turma) ?>">Alunos</a></li>

                    <li role="presentation" ><a href="<?php echo base_url("cpainel/avaliacao/prova_escrita/?turma=" . $id_turma) ?>">Prova escrita</a></li>
                    <li role="presentation" class="active"><a href="<?php echo base_url("cpainel/prova_online?turma=" . $id_turma) ?>">Prova online</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/trabalho?turma=" . $id_turma) ?>">Trabalhos</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/notas?turma=" . $id_turma) ?>">Notas</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/turma/horario/" . $id_turma) ?>">Horário</a></li>
                </ul>
                <div class="col-lg-12 semMargem" style="/*border-left: 1px solid #ddd;border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; */">


                    <div class="col-lg-12"  style="padding-top: 5px; /* border-right: 1px solid #ddd; */">
                        <h2>Prova on-line / <small>Nova</small></h2>
                        <div class="col-lg-8 semMargem">
                            <div class="text-right">
                                <a class="btn btn-default" href="<?php echo base_url("cpainel/prova_online/?turma=" . $id_turma) ?>" >Voltar</a>
                            </div>
                            <form class="" action="<?php echo base_url("cpainel/prova_online/salvar_nova_prova_online"); ?>" method="post" role="form">
                                <input type="hidden" name="turma" id="turma" value="<?php echo $id_turma ?>" />


                                <div class="form-group">
                                    <label for="nome_prova_online" class="control-label">Nome prova</label>

                                    <input type="text" name="nome_prova_online" class="form-control" id="nome_prova_online" value="<?php echo set_value('nome_prova_online') ?>" placeholder="">
                                    <span class="text-danger"> <?php echo form_error('nome_prova_online'); ?></span>

                                </div>
                                <div class="form-group">
                                    <span class="text-danger"> <?php echo form_error('data_realizacao_prova_online'); ?></span>
                                    <span class="text-danger"> <?php echo form_error('hora_realizacao_prova_online'); ?></span>
                                    <span class="text-danger"> <?php echo form_error('tempo_duracao_prova_online'); ?></span>
                                    <span class="text-danger"> <?php echo form_error('valor_ponto_prova_online'); ?></span>
                                    <div class="col-lg-3 semMargem">
                                        <label for="data_realizacao_prova_online" class=" control-label">Data realização</label>

                                        <input type="date" name="data_realizacao_prova_online" class="form-control" id="data_ralizacao_prova_online" value="<?php echo set_value('data_realizacao_prova_online') ?>" placeholder="dd/mm/aaaa" />

                                    </div>

                                    <div class="col-lg-3">
                                        <label class="control-label">Horario Realização</label>
                                        <input type="time" name="hora_realizacao_prova_online" class="form-control" id="hora_realizacao_prova_online" value="<?php echo set_value('hora_realizacao_prova_online') ?>" placeholder="HH:mm" />

                                    </div>
                                    <div class="col-lg-3">
                                        <label class="control-label">Tempo duração</label>
                                        <div class="input-group">
                                        <input type="number" name="tempo_duracao_prova_online" class="form-control" id="tempo_duracao_prova_online" value="<?php echo set_value('tempo_duracao_prova_online') ?>" em Minutos />
                                        <span class="input-group-addon">Minutos</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 semMargem">
                                        <label for="valor_ponto_prova_online" class="control-label">Valor ponto</label>

                                        <input type="text" name="valor_ponto_prova_online" class="form-control" id="valor_ponto_prova_online" value="<?php echo set_value('valor_ponto_prova_online') ?>" placeholder="Valor" />
                                        

                                    </div>
                                </div>



                                <script type="text/javascript">
                                    Config.inicioaliza_editor_tinymce('textarea#informacao_prova_online');
                                </script>

                                <div class="form-group" >
                                    <label for="informacao_prova_online" class="control-label">Informações</label>

                                    <textarea name="informacao_prova_online" class="form-control" id="informacao_prova_online" rows="8" ><?php echo set_value("informacao_prova_online") ?></textarea>
                                    <span class="text-danger"> </span>

                                </div>


                                <div class="form-group">
                                    <div class="col-md-offset-8 col-sm-4">
                                        <a href="<?php echo base_url("cpainel/prova_online?turma=" . $id_turma); ?>" class="btn btn-default" >Cancelar</a>
                                        <button type="submit" class="btn btn-primary"> Salvar </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>