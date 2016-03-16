<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Publicacao extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('disciplina_model');
        $this->load->model('aluno_model');
        $this->load->model('noticia_model');
    }

    public function carregarRSS($link = NULL) {
        if ($link != NULL) {
            $xml = simplexml_load_file($link)->channel;
            return $xml;
        }
    }

    protected $dados_menu = NULL;
    protected $dados_conteudo = NULL;
    protected $pg_view = 'tela/inicio_view';

    protected function showTela() {

        $this->dados_conteudo['xml_rss'] = $this->carregarRSS("http://g1.globo.com/dynamo/economia/rss2.xml");

        $this->load->view('tela/titulo');
        $this->load->view('tela/menu', $this->dados_menu);
        $this->load->view($this->pg_view, $this->dados_conteudo);
        $this->load->view('tela/outros_view');
        $this->load->view('tela/rodape');
    }

    // Funçao da pagina inicial
    public function index() {

        $disciplina_menu = $this->disciplina_model->ver_todas_disciplina_ativas()->result();

        $noticias_pagina_inicial = $this->noticia_model->obter_todas_noticias_ativas()->result();


        $this->dados_menu = array(
            "munu_disciplina" => $disciplina_menu,
        );

        $this->dados_conteudo = array(
            "noticias_pagina_inicial" => $noticias_pagina_inicial
        );

        $this->pg_view = 'noticia/noticia_view';

        $this->showTela();
    }

    // Funçao para abrir uma noticia pelo url e deixar visivel para ler.
    public function ler() {

        $url_noticia = $this->uri->segment(3);
        $noticia = $this->noticia_model->obter_noticia_por_url($url_noticia)->result();
        if (count($noticia) == 0) {
            redirect("publicacao");
        }

        $disciplina_menu = $this->disciplina_model->ver_todas_disciplina_ativas()->result();

        $this->dados_menu = array(
            "munu_disciplina" => $disciplina_menu,
        );

        $this->dados_conteudo = array(
            "noticia" => $noticia
        );

        $this->pg_view = 'noticia/noticia_ler_view';

        $this->showTela();
    }

}
