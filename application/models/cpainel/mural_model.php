<?php

class mural_model extends CI_Model {

    function ver_todas_murais() {
        $this->db->order_by("ordem_mural", "desc");
        return $this->db->get('mural');
    }

    function ver_todos_anexos_mural() {
        return $this->db->get('anexo_mural');
    }

    function obter_mural($id_mural) {
        return $this->db->get_where('mural', array('id_mural' => $id_mural));
    }

    function salvarNovoMural($data) {
        $this->db->insert('mural', $data);
    }

    function salvarAnexoMural($dados) {
        $this->db->insert('anexo_mural', $dados);
    }

    function alterarDadosMural($dados, $idmural) {
        $this->db->where('id_mural', $idmural);
        $this->db->update('mural', $dados);
    }

    function excluirSecretaria($idSecretaria) {
        $this->db->delete('secretaria', array('id_secretaria' => $idSecretaria));
    }

    function alterarDadosAnexo($dados, $id_anexo) {
        $this->db->where('id_am', $id_anexo);
        $this->db->update('anexo_mural', $dados);
    }

    //put your code here
}

?>
