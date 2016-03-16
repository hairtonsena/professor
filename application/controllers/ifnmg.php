<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ifnmg extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('disciplina_model');
        $this->load->model('turma_model');
        $this->load->model('avaliacao_model');
        $this->load->model('trabalho_model');
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

    public function index() {

        // Carregar o menu disciplina
        $disciplinas_ativas = $this->disciplina_model->ver_todas_disciplina_ativas()->result();
        $this->dados_menu = array(
            "munu_disciplina" => $disciplinas_ativas
        );

        $this->dados_conteudo = array(
            "disciplinas_ativa" => $disciplinas_ativas
        );

        $this->pg_view = 'ifnmg/ifnmg_view';
        
        $this->showTela();
        
        
    }

    public function disciplina() {

        if ($this->uri->segment(3) == NULL) {
            redirect(base_url());
        }

        $id_disciplina = (int) mysql_real_escape_string($this->uri->segment(3));
        // Buscando e verificando a disciplina escolhida.
        $disciplina = $this->disciplina_model->obter_uma_disciplina($id_disciplina)->result();
        if (count($disciplina) == 0) {
            redirect(base_url());
        }

        // Carregar o menu disciplina
        $disciplina_menu = $this->disciplina_model->ver_todas_disciplina_ativas()->result();
        $this->dados_menu = array(
            "munu_disciplina" => $disciplina_menu
        );


        // Buscando as turnas da disciplina escolida
        $turmas = $this->turma_model->obter_turma_ativa_por_disciplina($id_disciplina)->result();


        $this->dados_conteudo = array(
            "disciplina" => $disciplina,
            "turmas" => $turmas
        );

        $this->pg_view = 'ifnmg/disciplina_view';
        
        $this->showTela();
        
    }

    public function turma() {

        $id_turma = (int) mysql_real_escape_string($this->uri->segment(3));


        $disciplina_turma = $this->turma_model->obter_turma_disciplina($id_turma)->result();
        if (count($disciplina_turma) == 0) {
            redirect(base_url());
        }

        // Carregar o menu disciplina
        $disciplinas_menu = $this->disciplina_model->ver_todas_disciplina_ativas()->result();
        $this->dados_menu = array(
            "munu_disciplina" => $disciplinas_menu
        );

        // Buscando todas avaliações da turma selecionada.
        $avaliacoes = $this->avaliacao_model->obter_todas_avaliacoes_turma($id_turma)->result();

        // Buscando todos os trabalhos da turma selecionada.
        $trabalhos = $this->trabalho_model->obter_todos_trabalhos_turma($id_turma)->result();
        foreach ($trabalhos as $trb) {

            $trb->anexos_trabalho = $this->trabalho_model->obeter_anexos_trabalho($trb->id_trabalho)->result();
        }

        $this->dados_conteudo = array(
            "disciplina_turma" => $disciplina_turma,
            "avaliacoes_turma" => $avaliacoes,
            "trabalhos_turma" => $trabalhos
        );
        
        $this->pg_view = 'ifnmg/disciplina_turma_view';
        
        $this->showTela();

    }

    public function turma_arquivada() {


        $id_disciplina = (int) mysql_real_escape_string($this->uri->segment(3));
        // Buscando e verificando a disciplina escolhida.
        $disciplina = $this->disciplina_model->obter_uma_disciplina($id_disciplina)->result();
        if (count($disciplina) == 0) {
            redirect(base_url());
        }

        // Carregar o menu disciplina
        $disciplina_menu = $this->disciplina_model->ver_todas_disciplina_ativas()->result();
        $dados_menu = array(
            "munu_disciplina" => $disciplina_menu
        );


        // Buscando as turnas da disciplina escolida
        $turmas = $this->turma_model->obter_turmas_arquivadas_por_disciplina($id_disciplina)->result();


        $dados = array(
            "disciplina" => $disciplina,
            "turmas" => $turmas
        );

        $this->load->view('tela/titulo');
        $this->load->view('tela/menu', $dados_menu);
        $this->load->view('ifnmg/disciplina_turma_arquivada_view', $dados);
        $this->load->view('tela/outros_view');
        $this->load->view('tela/rodape');
    }

}
