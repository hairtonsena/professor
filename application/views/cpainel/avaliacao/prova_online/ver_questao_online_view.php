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

                        <h2> Prova on-line / <small> Questão / Alternativa </small></h2>


                        <div class="col-lg-8">
                            <div class="text-right">
                                <a class="btn btn-default" href="<?php echo base_url("cpainel/prova_online/ver_prova_online/" . $prova_on_aux->id_prova_on_matriz) ?>" >Voltar</a>
                            </div>
                            <div class="col-lg-12">
                                <h3 class="text-center"><?php echo $prova_on_aux->nome_prova_on_matriz ?></h3>

                                <p>
                                    <strong>Data realização: </strong><small><?php echo date('d/m/Y', strtotime($prova_on_aux->data_realizacao_prova_on_matriz)) ?></small> 
                                    <strong style="margin-left: 10px">Horario realização: </strong><small><?php echo $prova_on_aux->hora_realizacao_prova_on_matriz ?></small>
                                    <strong style="margin-left: 10px">Tempo duração: </strong><small><?php echo $prova_on_aux->tempo_duracao_prova_on_matriz ?></small>
                                    <strong style="margin-left: 10px">Ponto : </strong><small><?php echo number_format($prova_on_aux->valor_ponto_prova_on_matriz, 2) ?></small>
                                </p>

                                <p>
                                    <?php echo $prova_on_aux->informacao_prova_on_matriz ?>
                                </p>
                            </div>

                            <div class="col-lg-12" style="margin-top: 25px">
                                <p class="text-right">
                                    <a href="<?php echo base_url("cpainel/prova_online/alterar_questao_prova_online/" . $questao->id_questao_matriz); ?>" class="btn" ><i class="glyphicon glyphicon-edit"></i>Alterar</a>
                                    <a href="<?php echo base_url("cpainel/prova_online/excluir_questao/" . $questao->id_questao_matriz); ?>" class="btn" ><i class="glyphicon glyphicon-remove"></i>Excluir</a>
                                </p>

                                <p>
                                    <?php if (!empty($this->session->flashdata('erro_exclusao'))) { ?>
                                    <div class="alert alert-danger"><?php echo $this->session->flashdata('erro_exclusao'); ?></div>
                                <?php }; ?>
                                </p>
                                <p style=" border-bottom: 1px solid #000;">
                                    <strong> Questão - <?php echo $questao->numero_questao_matriz ?> </strong> <span style="margin-left: 10px"><strong> Valor questão: </strong> <?php echo number_format($questao->valor_ponto_questao_matriz, 2) ?> </span>

                                </p>
                                <?php echo $questao->enunciado_questao_matriz ?>

                            </div>

                            <div class="col-lg-12 alternativas">
                                <?php foreach ($questao->alternativas as $alternativas) { ?>
                                    <div class="col-lg-12"  style="border: 1px solid #E0E0DD">
                                        <p class="text-right">
                                            <a href="<?php echo base_url("cpainel/prova_online/alterar_alternativa/" . $alternativas->id_alternativa_questao) ?>" class="btn btn-default btn-xs" > <i class="glyphicon glyphicon-edit"></i> Alterar </a> 
                                            <a href="<?php echo base_url("cpainel/prova_online/excluir_alternativa/" . $alternativas->id_alternativa_questao) ?>" class="btn btn-default btn-xs" > <i class="glyphicon glyphicon-remove"></i> Excluir </a>
                                        </p>
                                        <p>
                                            <label>
                                                <?php if ($alternativas->opcao_correta_alternativa_questao == 1) { ?>
                                                    <input type="checkbox" disabled="true" checked="true" />
                                                <?php } else { ?>
                                                    <input type="checkbox" disabled="true" />
                                                <?php } ?>
                                                <?php echo $alternativas->texto_alternativa_questao ?>
                                            </label>
                                        </p>



                                    </div>
                                <?php } ?>
                            </div>


                            <div class="col-lg-12" style="margin-top: 50px;">
                                <form class="" action="<?php echo base_url("cpainel/prova_online/add_alternativa_questao") ?>" method="POST">
                                    <input type="hidden" name="id_questao" value="<?php echo $questao->id_questao_matriz ?>" />
                                    <h3>Incluir alternativa</h3>
                                    <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
                                    <div class="form-group">

                                        <!--<label class="label" for="">Alternativa</label>-->
                                        <textarea name="texto_alternativa_questao" class="form-control" id="" placeholder="Digite o texto da alternativa"><?php echo set_value("texto_alternativa_questao") ?></textarea>
                                    </div>

                                    <div class="form-group checkbox">
                                        <label>
                                            <input type="checkbox" name="opcao_correta"> Correta
                                        </label>

                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">incluir</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <!--<h4>Add alternativa</h4>-->

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>