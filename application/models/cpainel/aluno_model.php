<?php

class aluno_model extends CI_Model {

    // Salvando aluno
    function salvar_novo_aluno($data) {
        $this->db->insert('aluno', $data);
    }

    function obter_aluno_salvo($cpf) {
        return $this->db->get_where('aluno', array('cpf_aluno' => $cpf));
    }

    // Salvando um aluno em uma turma.
    function salvar_aluno_turma($dados) {
        $this->db->insert('aluno_has_turma', $dados);
    }

    // Pegando alunos ativos
    function obter_todos_alunos_ativo() {
        return $this->db->get_where('aluno', array('status_aluno' => 0));
    }

    // Buscando as aluno pesquisado inicialmente por nome.
    function obter_alunos_pesquisa_nome($q, $id_turma) {
        $this->db->select('*');
        $this->db->from('aluno');
        // $this->db->join('aluno_has_turma', 'aluno_has_turma.aluno_id_aluno=aluno.id_aluno','left');
        $this->db->like('aluno.nome_aluno', $q);
        $this->db->where(array('aluno.status_aluno' => 0));
        return $this->db->get();
    }

    // obter todos aluno já cadastrado  nesta turma.
    function alunos_na_turma($id_turma) {
        return $this->db->get_where('aluno_has_turma', array('turma_id_turma' => $id_turma));
    }

    // verificar se alunos esta cadastrado na turma.
    function aluno_em_turma($id_aluno, $id_turma) {
        return $this->db->get_where('aluno_has_turma', array('aluno_id_aluno' => $id_aluno, 'turma_id_turma' => $id_turma));
    }

    function excluir_aluno_em_tuma($id_aluno, $id_turma) {
        $this->db->delete('aluno_has_turma', array('aluno_id_aluno' => $id_aluno, 'turma_id_turma' => $id_turma));
    }

    //put your code here
}

?>
