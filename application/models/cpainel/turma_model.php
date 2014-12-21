<?php

class turma_model extends CI_Model {

    // Obter turma ativa por disciplina.
    function obter_turma_ativa_por_disciplina($id_disciplina) {
        $this->db->where(['disciplina_id_disciplina'=> $id_disciplina,'status_turma'=>1]);
        return $this->db->get('turma');
    }
    // salvando nava turma no banco de dados
    function salvar_nova_turma($data) {
        $this->db->insert('turma', $data);
    }
    // Obtendo uma turma no banco de dados pelo id_turma.
    function obter_uma_turma($id_turma) {
        $this->db->where('id_turma', $id_turma);
        return $this->db->get('turma');
    }
    // Alterando os dados da turma.
    function alterar_dados_turma($dados, $id_turma) {
        $this->db->where('id_turma', $id_turma);
        $this->db->update('turma', $dados);
    }
    // Excluindo uma tuma
    function excluir_turma($id_turma) {
        $this->db->delete('sub_categoria', array('id_turma' => $id_turma));
    }

    //put your code here
}

?>
