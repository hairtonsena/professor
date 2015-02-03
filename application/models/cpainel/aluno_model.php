<?php

class aluno_model extends CI_Model {

    // Obter um aluno por ID;
    function obter_aluno_id($id_aluno) {
        return $this->db->get_where('aluno', array('id_aluno' => $id_aluno));
    }

    // Obter um aluno por cpf;
    function obter_aluno_cpf($cpf) {
        return $this->db->get_where('aluno', array('cpf_aluno' => $cpf));
    }

    // Obter um aluno por matricula 
    function obter_aluno_matricula($matricula) {
        return $this->db->get_where('aluno', array('matricula_aluno' => $matricula));
    }

    // Salvando aluno
    function salvar_novo_aluno($data) {
        $this->db->insert('aluno', $data);
    }

    // alterando os dados do aluno pelo id;
    function alterar_dados_aluno($dados, $id_aluno) {
        $this->db->where('id_aluno', $id_aluno);
        $this->db->update('aluno', $dados);
    }

    function obter_aluno_salvo($cpf) {
        return $this->db->get_where('aluno', array('cpf_aluno' => $cpf));
    }

    // Salvando um aluno em uma turma.
    function salvar_aluno_turma($dados) {
        $this->db->insert('aluno_has_turma', $dados);
    }

    // Pegando todos os alunos
    function obter_todos_alunos() {
        $this->db->order_by("nome_aluno","asc");
        return $this->db->get('aluno');
    }

    // Pegando alunos ativos
    function obter_todos_alunos_ativo() {
        return $this->db->get_where('aluno', array('status_aluno' => 1));
    }

    // Buscando as aluno pesquisado inicialmente por nome.
    function obter_alunos_pesquisa_nome($q, $id_turma, $opcao) {
        $this->db->select('*');
        $this->db->from('aluno');
        if ($opcao == "matricula") {
            $this->db->like('aluno.matricula_aluno', $q);
        } else if ($opcao == "cpf") {
            $this->db->like('aluno.cpf_aluno', $q);
        } else {
            $this->db->like('aluno.nome_aluno', $q);
        }
        $this->db->where(array('aluno.status_aluno' => 1));
        return $this->db->get();
    }

    // Obter as disciplinas e turmas do aluno.
    function obter_disciplina_turma_aluno($id_aluno) {
        $this->db->select('*');
        $this->db->from('aluno');
        $this->db->join('aluno_has_turma', 'aluno_has_turma.aluno_id_aluno=aluno.id_aluno');
        $this->db->join('turma', 'aluno_has_turma.turma_id_turma=turma.id_turma');
        $this->db->join('disciplina', 'disciplina.id_disciplina=turma.disciplina_id_disciplina');
        $this->db->where(array('aluno.id_aluno' => $id_aluno));
        return $this->db->get();
    }

    // Obter as disciplinas e turmas do aluno.
    function obter_disciplina_turma_ativa_arquivada_aluno($id_aluno) {
        $this->db->select('*');
        $this->db->from('aluno');
        $this->db->join('aluno_has_turma', 'aluno_has_turma.aluno_id_aluno=aluno.id_aluno');
        $this->db->join('turma', 'aluno_has_turma.turma_id_turma=turma.id_turma');
        $this->db->join('disciplina', 'disciplina.id_disciplina=turma.disciplina_id_disciplina');
        $this->db->where(array('aluno.id_aluno' => $id_aluno, 'turma.status_turma >' => 0));
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
