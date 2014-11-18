<?php

class Pregao_presencial_model extends CI_Model {

    function ver_todos_pregoes($qtdeRegisntro = 0, $inicio = 0) {
        $this->db->order_by("data_ordem_pp", "desc");
        if ($qtdeRegisntro > 0) {
            $this->db->limit($qtdeRegisntro, $inicio);
        }
        return $this->db->get('pregao_presencial');
    }

    function ver_todos_anexos_mural() {
        return $this->db->get('anexo_pp');
    }

    function obter_pregao($id_pregao) {
        return $this->db->get_where('pregao_presencial', array('id_pp' => $id_pregao));
    }

    function salvarNovoPregao($data) {
        $this->db->insert('pregao_presencial', $data);
    }

    function salvarAnexoPregao($dados) {
        $this->db->insert('anexo_pp', $dados);
    }

    function alterarDadosPregao($dados, $idpregao) {
        $this->db->where('id_pp', $idpregao);
        $this->db->update('pregao_presencial', $dados);
    }

    function excluirSecretaria($idSecretaria) {
        $this->db->delete('secretaria', array('id_secretaria' => $idSecretaria));
    }

    function alterarDadosAnexo($dados, $id_anexo) {
        $this->db->where('id_ap', $id_anexo);
        $this->db->update('anexo_pp', $dados);
    }

    //put your code here
}

?>
