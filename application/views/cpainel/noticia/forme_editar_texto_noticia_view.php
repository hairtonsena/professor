<script type="text/javascript" src="<?php echo base_url("ckeditor/ckeditor.js");?>" ></script>
   <script type="text/javascript">
      window.onload = function()  {
        CKEDITOR.replace( 'texto_noticia' );
      };
    </script> 

<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/noticia") ?>">Notícia</a></li>
        <li class="active">Alterar Texto</li>       
    </ol>
    <form class="form-horizontal" action="<?php echo base_url("cpainel/noticia/salvar_texto_noticia") ;?>" method="post" role="form">
        
        <input type="hidden" name="id_noticia" value="<?php echo $id_noticia; ?>"/>
        
        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Texto</label>
            <div class="col-sm-10">
                <textarea name="texto_noticia" class="form-control" rows="5" id="texto_noticia" placeholder="Texto Noticia">

                <?php foreach ($texto_noticia as $tn){
                    echo $tn->texto_noticia;
                }
                ?>
                </textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-2 col-sm-2" >
                <a class="btn btn-default" href="<?php echo base_url("cpainel/noticia/criar_slide") ?>" > Criar Slide </a>
            </div>
            <div class="col-md-offset-6 col-sm-2">
                <a class="btn btn-default" href="<?php echo base_url("cpainel/noticia/ver_todas") ?>" > Cancelar </a>
                <button type="submit" class="btn btn-primary"> Salvar </button>
            </div>
        </div>
    </form>

</div>