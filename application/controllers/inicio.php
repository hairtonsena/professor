<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inicio extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('disciplina_model');
    }

    public function index() {
        
        $disciplina_menu = $this->disciplina_model->ver_todas_disciplina_ativas()->result();
        $dados_menu = array(
            "munu_disciplina"=>$disciplina_menu
        );
        
        
        
        
        $this->load->view('tela/titulo');
        $this->load->view('tela/menu',$dados_menu);
        //$this->load->view('tela/inicio_view');
        //$this->load->view('tela/disciplina_sem_logar_view');
        $this->load->view('tela/disciplina_logado_view');
        $this->load->view('tela/outros_view');
        $this->load->view('tela/rodape');
    }

    // Pagina individual de cada empreendimento
    public function disciplina() {

        $this->load->view('tela/titulo');
        $this->load->view('tela/menu');
        $this->load->view('tela/disciplina_view');
        $this->load->view('tela/rodape');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */