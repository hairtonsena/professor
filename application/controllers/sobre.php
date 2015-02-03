<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sobre extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('disciplina_model');
        $this->load->model('aluno_model');
    }

    // Funçao da pagina inicial
    public function index() {

        $disciplina_menu = $this->disciplina_model->ver_todas_disciplina_ativas()->result();
        $dados_menu = array(
            "munu_disciplina" => $disciplina_menu,
        );

        $cpf_prefessor = "12345678901";
        $sobre_professor;
        $professor = $this->professor_vw_model->obter_professor_cpf($cpf_prefessor)->result();
        foreach ($professor as $pf) {
            $sobre_professor = $pf->sobre_professor;
        }



        $dados_conteudo = array(
            "sobre_professor" => $sobre_professor
        );

        $this->load->view('tela/titulo');
        $this->load->view('tela/menu', $dados_menu);
        $this->load->view('sobre/sobre_view', $dados_conteudo);
        $this->load->view('tela/outros_view');
        $this->load->view('tela/rodape');
    }

}
