<?php

class professor_vw_model extends CI_Model {

    // Função para pegar o prefessor pelo id;
    function obter_professor_cpf($cpf_professor) {
        return $this->db->get_where('professor', array('cpf_professor' => $cpf_professor));
    }

}

?>
