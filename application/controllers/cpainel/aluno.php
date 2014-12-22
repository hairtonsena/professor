<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Aluno extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('session');
        //$this->load->model('cpainel/disciplina_model');
        $this->load->model('cpainel/turma_model');
        $this->load->model('cpainel/aluno_model');
        $this->load->library('upload');
        date_default_timezone_set('UTC');
    }

    public function index() {
        // utilizando
        if (($this->session->userdata('id_admin')) && ($this->session->userdata('nome_admin')) && ($this->session->userdata('email_admin')) && ($this->session->userdata('senha_admin'))) {


            // Ativando e desativando os estados para ser cadastrados 
            $id_uf = null;
            // verificando se a requisição get existe
            if ($this->input->get('ativar_uf', TRUE)) {
                // recebendo a id atravez do get 
                $id_uf = $this->input->get('ativar_uf');
                // criando um arrey com os dados a serem alterados
                $dados = array(
                    'status_uf' => 1,
                );
                // enviando a os dadodas para o model alterar os dados
                $this->localizacao_model->ativar_desativar_uf($dados, $id_uf);
                // atualizanda a pagina.
                redirect("/cpainel/localizacao");
                // mesmos passo a cima alterando ampenas o status_uf para 0.                
            } else if ($this->input->get('desativar_uf', TRUE)) {
                $id_uf = $this->input->get('desativar_uf');
                $dados = array(
                    'status_uf' => 0,
                );
                $this->localizacao_model->ativar_desativar_uf($dados, $id_uf);
                redirect("/cpainel/localizacao");
            }




            $dados = array(
                'uf' => $this->localizacao_model->ver_todos_uf()->result(),
            );


            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/localizacao/localizacao_view', $dados);

            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    //Função para cadastrar um novo aluno
    public function novo($id_turma = null) {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            if ($id_turma == null) {
                $id_turma = $this->uri->segment(4);
            }
            $query = $this->turma_model->obter_turma_disciplina($id_turma)->result();

            $dados = array(
                "turma_disciplina" => $query
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/aluno/forme_novo_aluno_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para salvar aluno
    public function salvar_novo_aluno() {
        // veirificando usuario logado
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $this->form_validation->set_rules('nome_aluno', 'Nome', 'required|trim|min_length[4]|max_length[45]');
            $this->form_validation->set_rules('matricula_aluno', 'Matricula', 'required|trim|min_length[2]|max_length[45]');
            $this->form_validation->set_rules('cpf_aluno', 'CPF', 'required|trim|min_length[2]|max_length[45]');

            $id_turma = $this->input->post('turma');

            if ($this->form_validation->run() == FALSE) {
                $this->novo($id_turma);
            } else {

                $nome_aluno = $this->input->post('nome_aluno');
                $matricula_aluno = $this->input->post('matricula_aluno');
                $cpf_aluno = $this->input->post('cpf_aluno');

                $dados = array(
                    "nome_aluno" => $nome_aluno,
                    "matricula_aluno" => $matricula_aluno,
                    "cpf_aluno" => $cpf_aluno
                );
                
                $this->aluno_model->salvar_novo_aluno($dados);
                
                $aluno_salvo = $this->aluno_model->obter_aluno_salvo($cpf_aluno)->result();
                
                $id_aluno_salvo;
                foreach ($aluno_salvo as $as){
                    $id_aluno_salvo = $as->id_aluno;
                }
                
                $dados_aluno_turma = array(
                    "aluno_id_aluno" => $id_aluno_salvo,
                    "turma_id_turma" => $id_turma
                );
                
                $this->aluno_model->salvar_aluno_turma($dados_aluno_turma);
                
                
                redirect(base_url("cpainel/turma/alunos/" . $id_turma));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

//put your code here
}
