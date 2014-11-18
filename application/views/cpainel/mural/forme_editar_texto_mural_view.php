<script type="text/javascript" src="<?php echo base_url();?>ckeditor/ckeditor.js" ></script>
   <script type="text/javascript">
      window.onload = function()  {
        CKEDITOR.replace( 'texto_mural' );
      };
    </script> 

<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/mural") ?>">Mural</a></li>
        <li class="active">Alterar Texto</li>       
    </ol>
    
    <form class="form-horizontal" action="<?php echo base_url("cpainel/mural/salvar_texto_mural") ;?>" method="post" role="form">
        
        <input type="hidden" name="id_mural" value="<?php echo $id_mural; ?>"/>
        
        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Texto</label>
            <div class="col-sm-10">
                <textarea name="texto_mural" class="form-control" rows="5" id="texto_secretaria" placeholder="Texto Mural">

                <?php foreach ($texto_mural as $tm){
                    echo $tm->texto_mural;
                }
                ?>
                </textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-8 col-sm-4">
                <a href="<?php echo base_url("cpainel/mural"); ?>" class="btn btn-default">Cancelar</a>
                <button type="submit" class="btn btn-primary"> Salvar</button>
            </div>
        </div>
    </form>

</div>