
<script src="<?php echo base_url('lib/tinymce/tinymce/tinymce.min.js') ?>"></script>
<script type="text/javascript">
    tinymce.init({
        selector: "textarea#conteudo_noticia",
        theme: "modern",
        width: 800,
        height: 300,
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
            {title: 'Table styles',selector: 'table', classes: 'table table-bordered'},
            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ],
        toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
        image_advtab: true,
        external_filemanager_path: Config.base_url("/noticia/filemanager/"),
        filemanager_title: "Responsive Filemanager",
        external_plugins: {"filemanager": Config.base_url("/noticia/filemanager/plugin.min.js")}

    });
</script>
<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/noticia") ?>">Notícia</a></li>
        <li class="active">Nova notícia</li>       
    </ol>
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Notícia</div>
        <div class="panel-body">
            <div class="col-lg-12 semMargem" style="/*border-left: 1px solid #ddd;border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; */">
                <form class="form-horizontal" action="<?php echo base_url("cpainel/noticia/salvar_nova_noticia"); ?>" method="post" role="form">

                    <fieldset>
                        <legend>Nova notícia</legend>
                        <div class="col-lg-4"  style="padding-top: 5px;">

                            <div class="form-group">
                                <label for="titulo_noticia" class="col-sm-12">Titulo</label>
                                <div class="col-sm-12">
                                    <input type="text" name="titulo_noticia" class="form-control" id="titulo_noticia" value="<?php echo set_value('titulo_noticia') ?>" placeholder="Nome">
                                    <span class="text-danger"> <?php echo form_error('titulo_noticia'); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="data_noticia" class="col-sm-12">Data</label>
                                <div class="col-sm-12">
                                    <input type="text" name="data_noticia" class="form-control" id="data_noticia" value="<?php echo set_value('data_noticia') ?>" placeholder="00/00/0000">
                                    <span class="text-danger"> <?php echo form_error('data_noticia'); ?></span>
                                </div>
                            </div>


                        </div>
                        <div class="col-lg-8"  style="padding-top: 5px; border-left: 1px solid #ddd;">
                            <div class="form-group">
                                <label for="conteudo_noticia" class="col-sm-12">Notícia</label>
                                <div class="col-sm-12">
                                    <textarea id="conteudo_noticia" name="conteudo_noticia" rows="6" class="form-control"><?php echo set_value('conteudo_noticia') ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-8 col-sm-4">
                                <a href="<?php echo base_url("cpainel/noticia"); ?>" class="btn btn-default" >Cancelar</a>
                                <button type="submit" class="btn btn-primary"> Salvar </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>