<?php

class professor_model extends CI_Model {
    // Função para verificar os dados do professor para logar.
    function obterProfessorLogin($dados) {
        return $this->db->get_where('professor', array('email_professor' => $dados['email_professor'], 'senha_professor' => $dados['senha_professor']));
    }
    // Função para pegar o prefessor pelo id;
    function obter_professor_id($id_professor) {
        return $this->db->get_where('professor', array('id_professor' => $id_professor));
    }
    // Função para salvar os dados alterado do professor 
    function alterar_dados_professor($dados, $id_porfessor) {
        $this->db->where('id_professor', $id_porfessor);
        $this->db->update('professor', $dados);
    }

}

?>
