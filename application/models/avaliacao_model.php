<?php

class avaliacao_model extends CI_Model {


    // função para pegar todas as avaliações que estão cadatradas para uma determinada turma.
    function obter_todas_avaliacoes_turma($id_turma) {
        return $this->db->get_where('avaliacao', array('turma_id_turma' => $id_turma));
    }


}

?>
