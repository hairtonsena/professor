<html>
    <head>
        <title> cPainel  </title>
        <meta charset="utf-8"/>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url("bt/css/bootstrap-responsive.css") ?>" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url("bt/css/bootstrap-responsive.min.css") ?>" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url("bt/css/bootstrap.css") ?>" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url("bt/css/bootstrap.min.css") ?>" />

        <style type="text/css">
            html {
                height: 100%;
            }
            body {
                height: 100%;
                background-color: #fcfcfc;
            }

            #conteiner {
                height: 80%;

            }

            #pnlLogin {
                margin: 6% 30%;
                background-color: #eee;
            }

            .amentarCampo {height: 30px;}
        </style>
    </head>
    <body>
        <div class="nav navbar" style="background-color: #eee;">
            <div class="container">
                <!--<div class="col-lg-3 pull-right" >-->
                    <p class="navbar-text navbar-right"> Professor André </p>
                <!--</div>-->
                <!--<div class="col-lg-9">-->
                    <a href="<?php echo base_url() ?>" class="btn btn-large btn-primary navbar-btn"> Voltar para o inicio </a> 
                <!--</div>-->
            </div>
        </div>
        <div id="conteiner">
            <div class="thumbnail col-lg-5" id="pnlLogin">
                <form name="frmLogin" action="<?php echo base_url("cpainel/seguranca/logarUsuario") ?>" method="post">
                    <fieldset class="col-lg-12">

                        <legend> Painel de Controle </legend>
                        <span class="text-error"> 
                            <?php echo validation_errors(); ?>
                        </span>
                        <label> Email: </label>
                        <input type="email" name="email" class="form-control" required /><br/>
                        <label> Senha: </label>
                        <input type="password" name="senha" class="form-control" required />                        
                        <br/>
                        <label>Codigo de Validação:</label>
                        <?php echo $imagemCaptcha ?>
                        <input type="text" name="textoImagem" class="form-control" required />
                        <br/>
                        <input type="submit" name="acao" class="btn pull-right btn-primary" value="Entrar"/>

                    </fieldset>
                </form>
            </div>
        </div>
    </body>
</html>