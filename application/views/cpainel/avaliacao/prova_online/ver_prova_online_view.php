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

$prova_on_aux = $prova_online[0];

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
                        <h2>Prova on-line <span class="label label-default">editando</span></h2>
                        <div class="col-lg-8">
                            <div class="col-lg-12 text-right" style="margin-bottom: 10px;">
                                <a class="btn btn-primary" href="<?php echo base_url("cpainel/prova_online/publicar_prova_online/".$prova_on_aux->id_prova_on_matriz) ?>" >Publicar</a>
                            </div>
                            <div class="col-lg-12" style="background-color: #E2E3FF">
                                <?php if (!empty($this->session->flashdata("erro_excluir"))) { ?>
                                    <div class="alert alert-danger">
                                        <?php echo $this->session->flashdata("erro_excluir") ?>
                                    </div>
                                <?php } ?>
                                <p class="text-right">
                                    <a class="btn" href="<?php echo base_url("cpainel/prova_online/altera_prova_online/" . $prova_on_aux->id_prova_on_matriz) ?>"><i class="glyphicon glyphicon-edit"></i> Alterar</a>
                                    <a class="btn" href="<?php echo base_url("cpainel/prova_online/excluir_prova_online/" . $prova_on_aux->id_prova_on_matriz) ?>"><i class="glyphicon glyphicon-remove"></i> Excluir </a>
                                </p>

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
                            <div class="col-lg-12">
                                <p class="text-right">
                                    <a class="btn btn-default" href="<?php echo base_url("cpainel/prova_online/add_questao_prova_online/" . $prova_on_aux->id_prova_on_matriz) ?>"><i class="glyphicon glyphicon-plus"></i> Questão</a>
                                </p>
                            </div> 
                            <div class="col-lg-12 semMargem" >
                                <?php $total_pontos_questoes = 0 ?>
                                <?php foreach ($questoes_prova as $questao) { ?>
                                    <?php $total_pontos_questoes += $questao->valor_ponto_questao_matriz ?>
                                    <div class="questao_prova col-lg-12" style="border: 1px solid white; background-color: #e0dfe3">
                                        <p>
                                            <strong>Questão - <?php echo $questao->numero_questao_matriz ?> </strong> <span style="margin-left: 50px"><strong>Pontos: </strong><?php echo number_format($questao->valor_ponto_questao_matriz, 2) ?></span>
                                            <span>
                                                <a class="pull-right" href="<?php echo base_url("cpainel/prova_online/ver_questao_prova/" . $questao->id_questao_matriz) ?>" >
                                                    <i class="glyphicon glyphicon-eye-open"></i>
                                                    Ver questao
                                                </a>
                                            </span>
                                        </p> 
                                        <?php echo $questao->enunciado_questao_matriz ?>
                                        <div class="alternativas">
                                            <?php foreach ($questao->alternativas as $alternativas) { ?>
                                                <div class="col-lg-12">
                                                    <label>
                                                        <?php if ($alternativas->opcao_correta_alternativa_questao == 1) { ?>
                                                            <input type="checkbox" disabled="true" checked="true" />
                                                        <?php } else { ?>
                                                            <input type="checkbox" disabled="true" />
                                                        <?php } ?>
                                                        <?php echo $alternativas->texto_alternativa_questao ?>
                                                    </label>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="col-lg-12" style="border: 1px solid white; background-color: #e0dfe3">
                                    <h3>Total de pontos das questões: <?php echo number_format($total_pontos_questoes,2) ?></h3>                                    
                                </div>
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