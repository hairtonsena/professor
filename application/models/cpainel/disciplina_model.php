<?php

class disciplina_model extends CI_Model {

    // pegando todas as diciplinas do banco de dados
    function ver_todas_disciplina() {
        return $this->db->get('disciplina');
    }

    // pegando apenas uma disciplina no banco e filtrando pelo id
    function obter_uma_disciplina($id_disciplina) {
        return $this->db->get_where('disciplina', array('id_disciplina' => $id_disciplina));
    }

    function obter_categoria_ativa(){
        return $this->db->get_where('categoria', array('status_categoria' => 1));
    }
    // salvando uma nova disciplina no banco de dados
    function salvar_nova_disciplina($data) {
        $this->db->insert('disciplina', $data);
    }

    // alterando os dados de uma disciplina pelo id;
    function alterar_dados_disciplina($dados, $id_disciplina) {
        $this->db->where('id_disciplina', $id_disciplina);
        $this->db->update('disciplina', $dados);
    }

    function excluir_categoria($idCategoira) {
        $this->db->delete('categoria', array('id_categoria' => $idCategoira));
    }

    //--------- Trabalhando com sub categoria----------//
    function salvar_nova_subcategoria($data) {
        $this->db->insert('sub_categoria', $data);
    }

    function obter_subcategorias_de_categoria($id_categoria) {
        $this->db->where('id_categoria', $id_categoria);
        return $this->db->get('sub_categoria');
    }

    function obter_subcategoria($id_subcategoria) {
        $this->db->where('id_sub_categoria', $id_subcategoria);
        return $this->db->get('sub_categoria');
    }

    function alterar_dados_subcategoria($dados, $idsubcategoria) {
        $this->db->where('id_sub_categoria', $idsubcategoria);
        $this->db->update('sub_categoria', $dados);
    }

    function excluir_subcategoria($idSubcategoira) {
        $this->db->delete('sub_categoria', array('id_sub_categoria' => $idSubcategoira));
    }

    //put your code here
}

?>
