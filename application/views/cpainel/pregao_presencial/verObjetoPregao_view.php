<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4> Objeto pregão </h4>
</div>
<div class="modal-body">
    <?php
    foreach ($pregao_presencial as $pp) {
        echo $pp->objeto_pp;
    }
    ?>
</div>