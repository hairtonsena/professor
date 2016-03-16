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

$prova_on_aux;
foreach ($prova_online as $pro_on) {
    $prova_on_aux = $pro_on;
}

$questao_aux;
foreach ($questao as $ques) {
    $questao_aux = $ques;
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
                    <li role="presentation" class="active"><a href="<?php echo base_url("cpainel/avaliacao/prova_online?turma=" . $id_turma) ?>">Prova online</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/trabalho?turma=" . $id_turma) ?>">Trabalhos</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/notas?turma=" . $id_turma) ?>">Notas</a></li>
                    <li role="presentation"><a href="<?php echo base_url("cpainel/turma/horario/" . $id_turma) ?>">Horário</a></li>
                </ul>
                <div class="col-lg-12 semMargem" style="/*border-left: 1px solid #ddd;border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; */">


                    <div class="col-lg-12"  style="padding-top: 5px; /* border-right: 1px solid #ddd; */">

                        <h2>Prova on-line / <small>Questao / Alterar </small></h2>


                        <div class="col-lg-8">
                            <div class="text-right">
                                <a class="btn btn-default" href="<?php echo base_url("cpainel/prova_online/ver_questao_prova/" . $questao_aux->id_questao_matriz) ?>" >Voltar</a>
                            </div>
                            <div class="col-lg-12">
                                <h3 class="text-center"><?php echo $prova_on_aux->nome_prova_on_matriz ?></h3>
                                <p>
                                    <strong>Data realização: </strong><small><?php echo date("d/m/Y", strtotime($prova_on_aux->data_realizacao_prova_on_matriz)) ?></small> 
                                    <strong style="margin-left: 10px">Horario realização: </strong><small><?php echo $prova_on_aux->hora_realizacao_prova_on_matriz ?></small>
                                    <strong style="margin-left: 10px">Tempo duração: </strong><small><?php echo $prova_on_aux->tempo_duracao_prova_on_matriz ?></small>
                                    <strong style="margin-left: 10px">Ponto : </strong><small><?php echo number_format($prova_on_aux->valor_ponto_prova_on_matriz, 2) ?></small>
                                </p>
                                <p>
                                    <?php echo $prova_on_aux->informacao_prova_on_matriz ?>
                                </p>
                            </div>
                            <script>
                                Config.inicioaliza_editor_tinymce('textarea#enunciado_questao')
                            </script>

                            <div class="col-lg-12" style="margin-top: 50px"> 
                                <form class="" action="<?php echo base_url("cpainel/prova_online/salvar_questao_alterarda") ?>" method="POST">
                                    <input type="hidden" name="id_questao" value="<?php echo $questao_aux->id_questao_matriz ?>" />
                                    
                                    <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
                                    <div class="form-group">
                                        <div class="col-lg-6 semMargem">
                                            <label class="">Numero questão:</label>
                                            <input type="text" name="numero_questao" class="form-control" value="<?php echo $questao_aux->numero_questao_matriz; ?>">
                                        </div>
                                        <div class="col-lg-6 semMargem">
                                            <label class="">Valor questão:</label>
                                            <input type="text" name="valor_questao" class="form-control" value="<?php echo $questao_aux->valor_ponto_questao_matriz; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="">Enunciado:</label>
                                        <textarea class="form-control" name="enunciado_questao" rows="4" id="enunciado_questao" ><?php echo $questao_aux->enunciado_questao_matriz; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">salvar</button>
                                    </div>
                                </form>
                            </div>

                        </div>

                        <div class="col-lg-4">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>