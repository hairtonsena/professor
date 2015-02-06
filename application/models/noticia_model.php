<?php

class noticia_model extends CI_Model {

    // Obter uma noticia pelo url_noticia.
    function obter_noticia_por_url($url_noticia) {
        return $this->db->get_where('noticia', array('url_noticia' => $url_noticia,'status_noticia >='=>1));
    }

    // Pegando poucas noticias para a pagina inicial.
    function obter_noticias_pagina_inicial() {
        $this->db->where(array("status_noticia"=>1));
        $this->db->order_by("data_noticia", "desc");
        return $this->db->get('noticia',4,0);
    }

    // Pegando todas noticias ativa do banco de dados.
    function obter_todas_noticias_ativas() {
        $this->db->where(array("status_noticia"=>1));
        $this->db->order_by("data_noticia", "desc");
        return $this->db->get('noticia');
    }
}

?>
