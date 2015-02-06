<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="<?php echo base_url("") ?>" type="image/png"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> Prefessor André </title>

        <link rel="stylesheet" href="<?php echo base_url("bt/css/bootstrap.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("bt/css/bootstrap.min.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("bt/css/bootstrap-theme.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("bt/css/bootstrap-theme.min.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("css/estiloGeralCpainel.css"); ?>">

        <script>
            Config = {
                base_url: function (url) {
                    var url_base = '<?php echo base_url() ?>';
                    return url_base + url;
                },
                redirecionar_pagina: function (pg) {
                    window.location.href = pg;
                }
            };
        </script>
        <script src="<?php echo base_url("js/jquery.js"); ?>"></script>
        <script src="<?php echo base_url("bt/js/bootstrap.min.js"); ?>"></script>
        <!--<script src="<?php // echo base_url("js/cpainel.js");     ?>"></script>-->
        <script src="<?php echo base_url("js/processamento_cpainel.js"); ?>"></script>
        <script src="<?php echo base_url("js/layout_cpainel.js"); ?>"></script>
        <script src="<?php echo base_url("js/jquery-ui-1.10.4/ui/jquery-ui.js") ?>"></script>
        <script type="text/javascript" src="<?php echo base_url("js/jquery.form.js"); ?>"></script>



    </head>
    <body>
