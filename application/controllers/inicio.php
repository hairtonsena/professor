<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inicio extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index() {
        $this->load->view('tela/titulo');
        $this->load->view('tela/menu');
        $this->load->view('tela/inicio_view');
        $this->load->view('tela/rodape');
    }

    // Pagina individual de cada empreendimento
    public function empreendimento() {

        $this->load->view('tela/titulo');
        $this->load->view('tela/menu');
        $this->load->view('empreendimento/empreendimento_view');
        $this->load->view('tela/rodape');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */