<?php

class disciplina_model extends CI_Model {

    // pegando todas as diciplinas ativas do banco de dados
    function ver_todas_disciplina_ativas() {
        return $this->db->get_where('disciplina', array('status_disciplina' => 1));
    }

    // pegando apenas uma disciplina no banco e filtrando pelo id
    function obter_uma_disciplina($id_disciplina) {
        return $this->db->get_where('disciplina', array('id_disciplina' => $id_disciplina,'status_disciplina' => 1));
    }

}

?>
