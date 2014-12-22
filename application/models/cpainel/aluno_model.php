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

    // Utilizando
    function obter_um_cidade($id_cidade) {
        return $this->db->get_where('cidade', array('id_cidade' => $id_cidade));
    }

    // Utilizando
    function alterar_dados_uf($dados, $idUf) {
        $this->db->where('id_uf', $idUf);
        $this->db->update('uf', $dados);
    }

    // Utilizando
    function alterar_dados_cidade($dados, $idCidade) {
        $this->db->where('id_cidade', $idCidade);
        $this->db->update('cidade', $dados);
    }

    function ativar_desativar_uf($dados, $idUf) {
        $this->db->where('id_uf', $idUf);
        $this->db->update('uf', $dados);
    }

    function excluirSecretaria($idSecretaria) {
        $this->db->delete('secretaria', array('id_secretaria' => $idSecretaria));
    }

    //put your code here
}

?>
