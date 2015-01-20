<?php

class trabalho_model extends CI_Model {

    function obter_notas_trabalho($id_turma) {
        $this->db->select('aluno.id_aluno, trabalho.id_trabalho, nota_trabalho.valor_nota_trabalho');
        $this->db->from('aluno');
        $this->db->join('nota_trabalho', 'nota_trabalho.aluno_id_aluno = aluno.id_aluno');
        $this->db->join('trabalho', 'trabalho.id_trabalho=nota_trabalho.trabalho_id_trabalho', 'right');
        $this->db->where('trabalho.turma_id_turma', $id_turma);
        return $this->db->get();
    }

    // Função para pegar as notas do aluno de um determinado trabalho.
    function obter_nota_trabalho_aluno($id_trabalho) {
        return $this->db->get_where('nota_trabalho', array('trabalho_id_trabalho' => $id_trabalho));
    }

    // Função para pegar a nota de um aluno de um determinado trabalho.
    function obter_nota_trabalho_um_aluno($id_trabalho, $id_aluno) {
        return $this->db->get_where('nota_trabalho', array('trabalho_id_trabalho' => $id_trabalho, 'aluno_id_aluno' => $id_aluno));
    }

    // Função para salvar as notas dos alunos de um determinado trabalho
    function alterar_nota_trabalho_aluno($dados, $id_nota_trabalho) {
        $this->db->where(array('id_nota_trabalho' => $id_nota_trabalho));
        $this->db->update('nota_trabalho', $dados);
    }

    // função para pegar todos os trabalhos que estão cadatrados para uma determinada turma.
    function obter_todos_trabalhos_turma($id_turma) {
        return $this->db->get_where('trabalho', array('turma_id_turma' => $id_turma));
    }

    // Função para pegar um trabalho pele id do trabalho.
    function obter_um_trabalho($id_trabalho) {
        return $this->db->get_where('trabalho', array('id_trabalho' => $id_trabalho));
    }

    function obter_trabalho_salvo($dados) {
        return $this->db->get_where('trabalho', $dados);
    }

    // Função para salvar um novo trabalho.
    function salvar_novo_trabalho($dados) {
        $this->db->insert('trabalho', $dados);
    }

    // Função para alterar os dados do trabalho.
    function alterar_trabalho($dados, $id_trabalho) {
        $this->db->where(array('id_trabalho' => $id_trabalho));
        $this->db->update('trabalho', $dados);
    }

    // Função para verificar se nota já foi criada.
    function verificar_nota_exite($id_trabalho, $id_aluno) {
        return $this->db->get_where('nota_trabalho', array('trabalho_id_trabalho' => $id_trabalho, 'aluno_id_aluno' => $id_aluno));
    }

    // Savanda nota que não foi criada ainda
    function salvar_nota_trabalho_aluno($dados) {
        $this->db->insert('nota_trabalho', $dados);
    }

    // Alterando nota que já foi criada para o aluno e para o trabalho.
    function alterando_nota_trabalho_aluno($dados, $id_trabalho, $id_aluno) {
        $this->db->where(array('aluno_id_aluno' => $id_aluno, 'trabalho_id_trabalho' => $id_trabalho));
        $this->db->update('nota_trabalho', $dados);
    }

// Função para excluir trabalho e suas notas
    function excluir_trabalho($id_trabalho) {
        $this->db->delete('nota_trabalho', array('trabalho_id_trabalho' => $id_trabalho));
        $this->db->delete('trabalho', array('id_trabalho' => $id_trabalho));
    }

    //--------------------------------//
    // Trabalhando com anexo trabalho //
    //--------------------------------//
    // Função para adicionar anexos de trabalho.
    function add_anexo_trabalho($dados) {
        $this->db->insert('anexo_trabalho', $dados);
    }

    // Função para pegar todos os anexos de trabalho
    function obeter_anexos_trabalho($id_trabalho) {
        $this->db->join('trabalho', 'trabalho.id_trabalho = anexo_trabalho.trabalho_id_trabalho');
        return $this->db->get_where('anexo_trabalho', array('trabalho_id_trabalho' => $id_trabalho));
    }

    // Função para pegar um anexo de trabalho
    function obeter_um_anexo_trabalho($id_anexo) {
        $this->db->join('trabalho', 'trabalho.id_trabalho = anexo_trabalho.trabalho_id_trabalho');
        return $this->db->get_where('anexo_trabalho', array('id_anexo_trabalho' => $id_anexo));
    }

    // Função para excluir anexo de trabalho
    function excluir_anexo_trabalho($id_anexo) {
        $this->db->delete('anexo_trabalho', array('id_anexo_trabalho' => $id_anexo));
    }

    //-------------------------------------//
    // trabalho com os trabalho dos alunos //
    //-------------------------------------//
    // Função para pegar todos os trabalho enviados pelos alunos da turma
    function obeter_trabalho_dos_alunos($id_trabalho) {
        $this->db->join('trabalho', 'trabalho.id_trabalho = trabalho_aluno.trabalho_id_trabalho');
        $this->db->join('aluno', 'aluno.id_aluno = trabalho_aluno.aluno_id_aluno');
        return $this->db->get_where('trabalho_aluno', array('trabalho_id_trabalho' => $id_trabalho));
    }

    //put your code here
}

?>
