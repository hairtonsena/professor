<?php

class disciplina_model extends CI_Model {

    // pegando todas as diciplinas do banco de dados
    function ver_todas_disciplina() {
        $this->db->order_by("nome_disciplina","asc");
        return $this->db->get('disciplina');
    }

    // pegando todas as diciplinas ativas do banco de dados
    function ver_todas_disciplina_ativas() {
        return $this->db->get_where('disciplina', array('status_disciplina' => 1));
    }

    // pegando apenas uma disciplina no banco e filtrando pelo id
    function obter_uma_disciplina($id_disciplina) {
        return $this->db->get_where('disciplina', array('id_disciplina' => $id_disciplina));
    }

    // salvando uma nova disciplina no banco de dados
    function salvar_nova_disciplina($data) {
        $this->db->insert('disciplina', $data);
    }

    // alterando os dados de uma disciplina pelo id;
    function alterar_dados_disciplina($dados, $id_disciplina) {
        $this->db->where('id_disciplina', $id_disciplina);
        $this->db->update('disciplina', $dados);
    }

    // excluindo um diciplina
    function excluir_disciplina($id_disciplina) {
        $this->db->delete('disciplina', array('id_disciplina' => $id_disciplina));
    }

    // Obter as turmas de uma disciplina.
    function obter_turmas_da_disciplina($id_disciplina) {
        $this->db->where(array('disciplina_id_disciplina' => $id_disciplina));
        return $this->db->get('turma');
    }

    //put your code here
}

?>
