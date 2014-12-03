<div class="row col-lg-12">

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>

    <script>
        $(function() {
            $("#data_realizacao_pregao").datepicker({
                dateFormat: 'dd/mm/yy',
                dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'],
                dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
                dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
                monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
            });
        });
    </script>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a  href="<?php echo base_url("cpainel/pregao_presencial"); ?>">Pregão Presencial</a></li>
        <li class="active">Alterar data realisação</li>
    </ol>
    <div class="col-lg-8">
        <form class="form-horizontal" action="<?php echo base_url("cpainel/pregao_presencial/alterar_data_realizacao_pregao"); ?>" method="post" role="form">
            <input type="hidden" name="id_pregao" value="<?php echo $id_pregao ?>"/>
            <div class="form-group">
                <label for="data_realizacao" class="col-sm-3 control-label">Data Realização</label>
                <div class="col-sm-9">
                    <input type="text" name="data_realizacao_pregao" class="form-control" id="data_realizacao_pregao" placeholder="00/00/0000">
                    <span class="text-danger"><?php echo validation_errors() ?></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-8 col-sm-4">
                    <a class="btn btn-default" href="<?php echo base_url("cpainel/pregao_presencial/ver_todos/") ?>">Cancelar</a>
                    <button type="submit" class="btn btn-primary"> Salvar </button>
                </div>
            </div>
        </form>
    </div>
</div>