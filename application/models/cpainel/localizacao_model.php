<?php

class Localizacao_model extends CI_Model {

    // Utilizando
    function ver_todos_uf() {
        return $this->db->get('uf');
    }

    // Utilizando
    function obter_cidade_uf($id_estado) {
        return $this->db->get_where('cidade', array('id_uf' => $id_estado));
    }

    // Utilizando
    function obter_um_uf($id_estado) {
        return $this->db->get_where('uf', array('id_uf' => $id_estado));
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

    function salvarNovoSecretaria($data) {
        $this->db->insert('secretaria', $data);
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
