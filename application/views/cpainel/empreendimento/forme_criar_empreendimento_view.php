<div class="col-lg-12">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("cpainel/") ?>">cpainel</a></li>
        <li><a href="<?php echo base_url("cpainel/empreendimento") ?>">Empreendimento</a></li>
        <li class="active">Novo empreendimento</li>       
    </ol>
    <form class="form-horizontal" action="<?php echo base_url("cpainel/secretaria/criar_nova_secretaria"); ?>" method="post" role="form">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="titulo" class="col-sm-1 control-label">Tipo</label>
                <div class="col-sm-5">
                    <!--<input type="titulo" name="titulo_secretaria" class="form-control" id="titulo" placeholder="Titulo">-->
                    <select name="tipo" class="form-control">

                        <option value="1">aaaaa</option>
                        <option value="1">bbbbb</option>

                    </select>
                    <span class="text-danger"><?php echo validation_errors() ?></span>
                </div>
            </div>            
        </div>
        <hr/>
        <div class="col-lg-6">

            <div class="form-group">
                <label for="titulo" class="col-sm-2 control-label">Nome:</label>
                <div class="col-sm-10">
                    <input type="titulo" name="titulo_secretaria" class="form-control" id="titulo" placeholder="Titulo">
                    <span class="text-danger"><?php echo validation_errors() ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="titulo" class="col-sm-2 control-label">CPF:</label>
                <div class="col-sm-10">
                    <input type="titulo" name="titulo_secretaria" class="form-control" id="titulo" placeholder="Titulo">
                    <span class="text-danger"><?php echo validation_errors() ?></span>
                </div>
            </div>
        </div>
        <div class="col-lg-6">

            <div class="form-group">
                <label for="titulo" class="col-sm-2 control-label">Nome</label>
                <div class="col-sm-10">
                    <input type="titulo" name="titulo_secretaria" class="form-control" id="titulo" placeholder="Titulo">
                    <span class="text-danger"><?php echo validation_errors() ?></span>
                </div>
            </div>

            <div class="form-group">
                <label for="titulo" class="col-sm-2 control-label">CPF:</label>
                <div class="col-sm-10">
                    <input type="titulo" name="titulo_secretaria" class="form-control" id="titulo" placeholder="Titulo">
                    <span class="text-danger"><?php echo validation_errors() ?></span>
                </div>
            </div>


        </div>


        <div class="col-lg-12">

            <div class="form-group">
                <div class="col-md-offset-4 col-sm-4">
                    <a class="btn btn-default" href="<?php echo base_url("cpainel/secretaria") ?>" > Cancelar </a>
                    <button type="submit" class="btn btn-primary"> Criar</button>
                </div>
            </div>
        </div>

</div>
</form>
</div>