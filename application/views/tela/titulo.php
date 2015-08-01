<!DOCTYPE html>
<html lang="pt">
    <head>
        <title>Professor André</title>
        <meta charset="UTF-8" />
        <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,400,300,700" />
        <link href="<?php echo base_url('bt/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <!--<link href="<?php// echo base_url('css/estilo.css'); ?>" rel="stylesheet">-->
        <link href="<?php echo base_url('css/layout_geral.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('css/layout_geral_smart.css'); ?>" rel="stylesheet">

        <!--<link href='http://fonts.googleapis.com/css?family=Courgette|Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>-->
        <link href="<?php echo base_url('css/saSlider.css') ?>" rel='stylesheet' type='text/css'>
        <!--<link href="<?php echo base_url('css/demo.css') ?>" rel='stylesheet' type='text/css'>-->

        <script>

            Config = {
                base_url: function (url) {
                    var url_base = '<?php echo base_url() ?>';
                    return url_base + url;
                }
            };

        </script>

        <script type="text/javascript" src="<?php echo base_url('js/jquery.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('bt/js/bootstrap.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.scrollTo.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/layout_geral.js'); ?>"></script>

        <script src="<?php echo base_url("js/jquery-ui-1.10.4/ui/jquery-ui.js") ?>"></script>
        <script type="text/javascript" src="<?php echo base_url("js/jquery.form.js"); ?>"></script>

    </head>
    <body>