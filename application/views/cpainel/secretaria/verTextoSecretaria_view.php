<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4>Texto da Secretaria </h4>
</div>
<div class="modal-body">
    <?php
    foreach ($secretaria as $sc) {
        echo $sc->texto_secretaria;
    }
    ?>
</div>