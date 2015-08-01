<?php

class trabalho_model extends CI_Model {

    // função para pegar todos os trabalhos que estão cadatrados para uma determinada turma.
    function obter_todos_trabalhos_turma($id_turma) {
        return $this->db->get_where('trabalho', array('turma_id_turma' => $id_turma));
    }

    // Função para pegar um trabalho pele id do trabalho.
    function obter_um_trabalho($id_trabalho) {
        return $this->db->get_where('trabalho', array('id_trabalho' => $id_trabalho));
    }

    // Função para pegar um anexo de trabalho
    function obeter_aluno_trabalho($id_aluno, $id_trabalho) {
        return $this->db->get_where('trabalho_aluno', array('aluno_id_aluno' => $id_aluno, 'trabalho_id_trabalho' => $id_trabalho));
    }

    // Função para adicionar anexos de trabalho.
    function salvar_trabalho_aluno($dados) {
        $this->db->insert('trabalho_aluno', $dados);
    }

    // Função para alterar os dados do trabalho.
    function alterar_trabalho_aluno($dados, $id_aluno, $id_trabalho) {
        $this->db->where(array('aluno_id_aluno' => $id_aluno, 'trabalho_id_trabalho' => $id_trabalho));
        $this->db->update('trabalho_aluno', $dados);
    }

    // Função para pegar todos os anexos de trabalho
    function obeter_trabalho_aluno($id_trabalho, $id_aluno) {
        $this->db->join('trabalho', 'trabalho.id_trabalho = trabalho_aluno.trabalho_id_trabalho');
        return $this->db->get_where('trabalho_aluno', array('trabalho_id_trabalho' => $id_trabalho, 'aluno_id_aluno' => $id_aluno));
    }

    // Função para pegar a nota de um aluno de um determinado trabalho.
    function obter_nota_trabalho_um_aluno($id_trabalho, $id_aluno) {
        return $this->db->get_where('nota_trabalho', array('trabalho_id_trabalho' => $id_trabalho, 'aluno_id_aluno' => $id_aluno));
    }

    //--------------------------------//
    // Trabalhando com anexo trabalho //
    //--------------------------------//
//
    // Função para pegar todos os anexos de trabalho
    function obeter_anexos_trabalho($id_trabalho) {
//        $this->db->join('trabalho', 'trabalho.id_trabalho = anexo_trabalho.trabalho_id_trabalho');
        return $this->db->get_where('anexo_trabalho', array('trabalho_id_trabalho' => $id_trabalho));
    }

}

?>
