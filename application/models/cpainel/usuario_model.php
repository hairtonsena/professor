<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ususario_model
 *
 * @author hairton
 */
class usuario_model extends CI_Model {

    function obterUsuarioLogin($dados) {
        return $this->db->get_where('admin', array('email_admin' => $dados['email_admin'], 'senha_admin' => $dados['senha_admin']));
    }

    function obterGestor($idGestor) {
        return $this->db->get_where('gestor', array('idGestor' => $idGestor));
    }

    function obterTodosGestor() {
        return $this->db->get('gestor');
    }

    function obterTodosGestorAtivos() {
        return $this->db->get_where('gestor', array('estadoGestor' => 1));
    }

    function inserirGestor($dados) {
        $this->db->insert('gestor', $dados);
    }

    function alterarEstadosGestor($dados, $idGestor) {

        $this->db->where('idGestor', $idGestor);
        $this->db->update('gestor', $dados);
    }

    function alterarDadosGestor($dados, $idGestor) {
        $this->db->where('idGestor', $idGestor);
        $this->db->update('gestor', $dados);
    }

    function excluirGestor($idGestor) {

        $this->db->delete('gestor', array('idGestor' => $idGestor));
    }

    //put your code here
}

?>
