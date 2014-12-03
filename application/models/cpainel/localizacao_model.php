<?php

class Localizacao_model extends CI_Model {

    function ver_todos_uf() {
        return $this->db->get('uf');
    }

    function obter_cidade_uf($id_estado) {
        return $this->db->get_where('cidade', array('id_uf' => $id_estado));
    }

    function salvarNovoSecretaria($data) {
        $this->db->insert('secretaria', $data);
    }

    function ativar_desativar_uf($dados, $idUf) {
        $this->db->where('id_uf', $idUf);
        $this->db->update('uf', $dados);
    }

    function alterarDadosSecretaria($dados, $idUf) {
        $this->db->where('id_uf', $idUf);
        $this->db->update('uf', $dados);
    }

    function excluirSecretaria($idSecretaria) {
        $this->db->delete('secretaria', array('id_secretaria' => $idSecretaria));
    }

    //put your code here
}

?>
