<?php

class noticia_model extends CI_Model {

//    // Obter uma notícia por ID;
//    function obter_noticia_por_id($id_noticia) {
//        return $this->db->get_where('noticia', array('id_noticia' => $id_noticia));
//    }
//
    // Obter uma noticia pelo url_noticia.
    function obter_noticia_por_url($url_noticia) {
        return $this->db->get_where('noticia', array('url_noticia' => $url_noticia,'status_noticia >='=>1));
    }

//    
//    // alterando os dados do aluno pelo id;
//    function alterar_dados_noticia($dados, $id_noticia) {
//        $this->db->where('id_noticia', $id_noticia);
//        $this->db->update('noticia', $dados);
//    }
//
//    
//    // Função para excluir a notícia no banco de dados.
//    function excluir_noticia($id_noticia) {
//        $this->db->delete('noticia', array('id_noticia' => $id_noticia));
//    }
//    
//    
//    // Salvando uma nova notícia no banco de dados.
//    function salvar_nova_noticia($dados) {
//        $this->db->insert('noticia', $dados);
//    }

    // Pegando poucas noticias para a pagina inicial.
    function obter_noticias_pagina_inicial() {
        $this->db->where(array("status_noticia"=>1));
        $this->db->order_by("data_noticia", "desc");
        return $this->db->get('noticia',2,0);
    }

    // Pegando todas noticias ativa do banco de dados.
    function obter_todas_noticias_ativas() {
        $this->db->where(array("status_noticia"=>1));
        $this->db->order_by("data_noticia", "desc");
        return $this->db->get('noticia');
    }
}

?>
