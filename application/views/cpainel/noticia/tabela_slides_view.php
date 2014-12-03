<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/noticia") ?>" >Notícia </a></li>
        <li class="active">Slide Notícia </li>       
    </ol>

    <a class="btn btn-default" href="<?php echo base_url("cpainel/noticia/criar_slide"); ?>">Novo slide</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <td> Url slide </td>
                <td> Excluir </td>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($arquivo = $diretorio->read()) {

                if ((strlen($arquivo) > 2)&&($arquivo!='index.html')) {
                    ?>
                    <tr>
                        <td> <a href="<?php echo base_url($path . $arquivo) ?>"> <?php echo $arquivo ?></a></td>
                        <td> <a href="<?php echo base_url("cpainel/noticia/excluir_slide/". $arquivo) ?>"> excluir </td>

                    </tr>
        <?php
    }
}
?>
        </tbody>

    </table>

</div>
