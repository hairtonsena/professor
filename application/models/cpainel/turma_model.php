<?php

class turma_model extends CI_Model {

    // Obter turma ativa por disciplina.
    function obter_turma_ativa_por_disciplina($id_disciplina) {
        $this->db->order_by("nome_turma","asc");
        $this->db->where(['disciplina_id_disciplina' => $id_disciplina, 'status_turma <>' => 2]);
        return $this->db->get('turma');
    }

    // Obter turma ativa por disciplina.
    function obter_turmas_arquivadas_por_disciplina($id_disciplina) {
        $this->db->where(['disciplina_id_disciplina' => $id_disciplina, 'status_turma ' => 2]);
        return $this->db->get('turma');
    }

    // Obter turma e disciplina pelo inner join
    function obter_turma_disciplina($id_turma) {
        $this->db->select('*');
        $this->db->from('turma');
        $this->db->join('disciplina', 'disciplina.id_disciplina=turma.disciplina_id_disciplina');
        $this->db->where('turma.id_turma', $id_turma);
        return $this->db->get();
    }

    // Obter todos os alunos te uma turma.
    function obter_todos_alunos_turma($id_turma) {
        $this->db->select('*');
        $this->db->from('aluno');
        $this->db->join('aluno_has_turma', 'aluno_has_turma.aluno_id_aluno=aluno.id_aluno');
        $this->db->where(array('aluno_has_turma.turma_id_turma' => $id_turma, 'aluno.status_aluno <>' => 0));
        $this->db->order_by("nome_aluno","asc");
        return $this->db->get();
    }

    // salvando nava turma no banco de dados
    function salvar_nova_turma($data) {
        $this->db->insert('turma', $data);
    }

    function obter_ultimo_id_turma() {
        $this->db->select_max('id_turma', 'id_turma');
        return $this->db->get('turma');
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
        $this->db->delete('turma', array('id_turma' => $id_turma));
    }

    ///////////////////////////////////////////
    // Trabalho com avaliacao de recuperacao //
    ///////////////////////////////////////////
    // Função para salvar avaliacão de recuperação da turma.
    function salvar_avaliacao_recuperacao($dados) {
        $this->db->insert('avaliacao_recuperacao', $dados);
    }

}

?>
