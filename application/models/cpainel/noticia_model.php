<?php

class noticia_model extends CI_Model {

    function ver_todas_noticias($qtde = 0, $inicio = 0) {
        $this->db->order_by("ordem_noticia", "desc");
        if ($qtde > 0){
            $this->db->limit($qtde, $inicio);
        }
        return $this->db->get('noticia_inicio');
    }

    function obter_noticia($id_noticia) {
        return $this->db->get_where('noticia_inicio', array('id_noticia' => $id_noticia));
    }

    function salvarNovoNoticia($data) {
        $this->db->insert('noticia_inicio', $data);
    }

    function alterarDadosNoticia($dados, $id_noticia) {
        $this->db->where('id_noticia', $id_noticia);
        $this->db->update('noticia_inicio', $dados);
    }

    function excluirNoticia($id_noticia) {
        $this->db->delete('noticia_inicio', array('id_noticia' => $id_noticia));
    }

    //put your code here
}

?>
