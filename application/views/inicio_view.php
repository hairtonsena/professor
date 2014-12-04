<!DOCTYPE html>
<html lang="pt">
<head>
	<title>Serviços Aki</title>
        <meta charset="UTF-8" />
        <link href="<?php echo base_url('bt/css/bootstrap.min.css');?>" rel="stylesheet">
        <link href="<?php echo base_url('css/estilo.css');?>" rel="stylesheet">
        <link href="<?php echo base_url('css/layout_geral.css');?>" rel="stylesheet">
        
        <script type="text/javascript" src="<?php echo base_url('js/jquery.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('bt/js/bootstrap.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.scrollTo.js');?>"></script>
        
</head>
<body>
    <div class="container-fluid shadow" style="background: #ffffff; color: white; ">
        <div class="row">
            <img class="img-circle" src="<?php echo base_url('imagens/logo.png'); ?>" data-src="" height="55" alt="Generic placeholder image" style="float: left; margin-left: 13%; margin-top: 5px">

            <div style=" margin-left: 34%; margin-top: 10px; width: 100%; height: 50px;">
                <form>
                    <div class="input-group" style="width: 45%">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                        </span>
                    </div>
                </form>
            </div>
        </div>    
    </div>
    
        <div class="col-md-14" style="margin-top: 10px; margin: auto;">
            <div class="col-md-2" style="height: auto;">
                <h3 style="text-align: left; margin-top: 50px; margin-bottom: 20px;">Categorias</h3>
                <ul class="link nav nav-pills nav-stacked">
                    <li role="presentation" class="link_ativo"><a href="#">Home</a></li>
  <li role="presentation"><a href="#">Profile</a></li>
  <li role="presentation"><a href="#">Messages</a></li>
                </ul>
                   
                          
            </div>
            
            <div class="col-md-10" style="height: auto; background-repeat: no-repeat; ">
                <h3 style="text-align: left;  margin-top: 50px; margin-bottom: 20px;">Destaques abc</h3>
                <div class="row">
                            <div class="col-sm-12 col-md-12">
                              <div class="thumbnail">
                                  <div class="imagen_lista"<img  src="./imagens/imagen_teste.jpg"></div>
                                <div class="caption alinha_direita">
                                  <h3>Thumbnail label</h3>
                                  <p>...</p>
                                  <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                </div>
                              </div>
                            
                    
                            
                              <div class="thumbnail">
                                  <div class="imagen_lista"<img src="./imagens/imagen_teste.jpg"></div>
                                <div class="caption alinha_direita">
                                  <h3>Thumbnail label</h3>
                                  <p>...</p>
                                  <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                </div>
                              </div>
                            </div>
                </div>
                </div>
                   
            </div>
        </div>  
    
</body>
</html>