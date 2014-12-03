<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4>Texto da Notícia </h4>
</div>
<div class="modal-body">
    <?php
    foreach ($noticia as $tn) {
        echo $tn->texto_noticia;
    }
    ?>
</div>