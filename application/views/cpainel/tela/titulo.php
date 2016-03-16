<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="<?php echo base_url("") ?>" type="image/png"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> Prefessor André </title>

        <!--<link rel="stylesheet" href="<?php // echo base_url("bt/css/bootstrap.css");  ?>">-->
        <link rel="stylesheet" href="<?php echo base_url("bt/css/bootstrap.min.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("css/estiloGeralCpainel.css"); ?>">

        <script>
            Config = {
                base_url: function (url) {
                    var url_base = '<?php echo base_url() ?>';
                    return url_base + url;
                },
                redirecionar_pagina: function (pg) {
                    window.location.href = pg;
                },
                inicioaliza_editor_tinymce: function (campo_texto) {
                    tinymce.init({
                        selector: campo_texto,
                        theme: "modern",
//                        width: 800,
//                        height: 300,
                        document_base_url: "",
                        relative_urls: false,
                        plugins: [
                            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                            "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager"
                        ],
                        toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
                        style_formats: [
                            {title: 'Bold text', inline: 'b'},
                            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                            {title: 'Example 1', inline: 'span', classes: 'example1'},
                            {title: 'Example 2', inline: 'span', classes: 'example2'},
                            {title: 'Table styles', selector: 'table', classes: 'table table-bordered'},
                            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                        ],
                        toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
                        image_advtab: true,
                        external_filemanager_path: this.base_url("/noticia/filemanager/"),
                        filemanager_title: "Responsive Filemanager",
                        external_plugins: {"filemanager": this.base_url("/noticia/filemanager/plugin.min.js")}

                    });
                }

            };
        </script>
        <script src="<?php echo base_url("js/jquery.js"); ?>"></script>
        <script src="<?php echo base_url("bt/js/bootstrap.min.js"); ?>"></script>
        <!--<script src="<?php // echo base_url("js/cpainel.js");      ?>"></script>-->
        <script src="<?php echo base_url("js/processamento_cpainel.js"); ?>"></script>
        <script src="<?php echo base_url("js/layout_cpainel.js"); ?>"></script>
        <script src="<?php echo base_url("js/jquery-ui-1.10.4/ui/jquery-ui.js") ?>"></script>
        <script type="text/javascript" src="<?php echo base_url("js/jquery.form.js"); ?>"></script>
        <script src="<?php echo base_url('lib/tinymce/tinymce/tinymce.min.js') ?>"></script>




    </head>
    <body>
