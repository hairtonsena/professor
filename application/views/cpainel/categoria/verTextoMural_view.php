<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4>Texto da Mural </h4>
</div>
<div class="modal-body">
    <?php
    foreach ($mural as $mr) {
        echo $mr->texto_mural;
    }
    ?>
</div>