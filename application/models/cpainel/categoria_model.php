<?php

class categoria_model extends CI_Model {

    function ver_todas_categoria() {
        return $this->db->get('categoria');
    }

    function obter_uma_categoria($id_categoria) {
        return $this->db->get_where('categoria', array('id_categoria' => $id_categoria));
    }

    function salvar_nova_categoria($data) {
        $this->db->insert('categoria', $data);
    }

    function alterar_dados_categoria($dados, $idcategoria) {
        $this->db->where('id_categoria', $idcategoria);
        $this->db->update('categoria', $dados);
    }

    function excluir_categoria($idCategoira) {
        $this->db->delete('categoria', array('id_categoria' => $idCategoira));
    }

    function salvarAnexoMural($dados) {
        $this->db->insert('anexo_mural', $dados);
    }

    function alterarDadosAnexo($dados, $id_anexo) {
        $this->db->where('id_am', $id_anexo);
        $this->db->update('anexo_mural', $dados);
    }

    //put your code here
}

?>
