<?php
$nome_disciplina;
$id_disciplina;
foreach ($disciplina as $dc) {
    $nome_disciplina = $dc->nome_disciplina;
    $id_disciplina = $dc->id_disciplina;
}
?>
<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/disciplina") ?>">Disciplina</a></li>
        <li class="active">Turma </li>       
    </ol>
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Disciplina: <?php echo $nome_disciplina ?></div>
        <div class="panel-body">
            <div class="col-lg-6 semMargem">
                <a class="btn btn-primary" href="<?php echo base_url("cpainel/turma/nova/" . $id_disciplina); ?>">Nova Turma</a>
                <div style="margin-top: 5px">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> Nome </th>
                                <th class="col-lg-1 center"> Alterar </th>
                                <th class="col-lg-1 center"> Excluir </th>
                                <th class="col-lg-1 center"> Turma </th>
                                <th class="col-lg-1 center"> status </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($turma as $tm) {
                                if ($tm->status_turma == 0) {
                                    ?>
                                    <tr>
                                        <td><?php echo $tm->nome_turma; ?></td>
                                        <td>as</td>

                                    </tr>
                                <?php } else { ?>
                                    <tr>
                                        <td> <?php echo $tm->nome_turma; ?> </td>
                                        <td class="text-center"><span id="btnEditarTurma_<?php echo $tm->id_turma ?>"><a href="<?php echo base_url('cpainel/turma/alterar/' . $tm->id_turma) ?>"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </a></span></td>
                                        <td class="text-center"><span id="btnExcluirTurma_<?php echo $tm->id_turma ?>"><a href="javascript:void(0)" data-toggle="modal" data-target="#modelExcluirDisciplina" data-disciplina="<?php echo $tm->id_turma ?>"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </a></span></td>
                                        <td class="text-center"><span id="btnAddTurma_<?php echo $tm->id_turma ?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </span></td>
                                        <td class="text-center"><span id="btnAtivarTurma_<?php echo $tm->id_turma ?>"><a href="javascript:void(0)" onclick="Disciplina.ativar_desativar_disciplina('<?php echo $tm->id_turma ?>')"> <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> </a></span></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>

                    </table>

                    <script type="text/javascript">
                        function confirmacao(id) {
                            var resposta = confirm("Você esta excluindo uma Secretaria!");
                            if (resposta == true) {
                                window.location.href = "<?php echo base_url('cpainel/secretaria/excluir_secretaria/'); ?>/" + id;
                            }
                        }

                    </script>
                </div>
            </div>
        </div>
    </div>

</div>