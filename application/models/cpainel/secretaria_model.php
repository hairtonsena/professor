<?php

class secretaria_model extends CI_Model {

    function ver_todas_secretaria() {
        return $this->db->get('secretaria');
    }

    function obter_secretaria($id_secretaria) {
        return $this->db->get_where('secretaria', array('id_secretaria' => $id_secretaria));
    }

    function salvarNovoSecretaria($data) {
        $this->db->insert('secretaria', $data);
    }

    function alterarDadosSecretaria($dados, $idSecretraria) {
        $this->db->where('id_secretaria', $idSecretraria);
        $this->db->update('secretaria', $dados);
    }

    function excluirSecretaria($idSecretaria) {
        $this->db->delete('secretaria', array('id_secretaria' => $idSecretaria));
    }

    //put your code here
}

?>
