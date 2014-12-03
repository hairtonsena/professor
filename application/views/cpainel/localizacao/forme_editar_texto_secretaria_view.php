<script type="text/javascript" src="<?php echo base_url();?>ckeditor/ckeditor.js" ></script>
   <script type="text/javascript">
      window.onload = function()  {
        CKEDITOR.replace( 'texto_secretaria' );
      };
    </script> 

<div class="row col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/secretaria") ?>">Secretaria</a></li>
        <li class="active">Alterar Texto</li>       
    </ol>
    <form class="form-horizontal" action="<?php echo base_url("cpainel/secretaria/salvar_texto_secretaria") ;?>" method="post" role="form">
        
        <input type="hidden" name="id_secretaria" value="<?php echo $id_secretaria; ?>"/>
        
        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Texto</label>
            <div class="col-sm-10">
                <textarea name="texto_secretaria" class="form-control" rows="5" id="texto_secretaria" placeholder="Texto Secretaria">

                <?php foreach ($texto_secretaria as $ts){
                    echo $ts->texto_secretaria;
                }
                ?>
                </textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-9 col-sm-4">
                <a class="btn btn-default" href="<?php echo base_url("cpainel/secretaria") ?>"> Cancelar</a>
                <button type="submit" class="btn btn-primary"> Salvar</button>
            </div>
        </div>
    </form>

</div>