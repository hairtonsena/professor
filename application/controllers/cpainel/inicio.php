<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inicio extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index() {

        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/tela/inicio_view');

            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }
}