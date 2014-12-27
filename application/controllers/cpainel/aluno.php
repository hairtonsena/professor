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
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {


//            $this->load->view('cpainel/tela/titulo');
//            $this->load->view('cpainel/tela/menu');
//            $this->load->view('cpainel/localizacao/localizacao_view', $dados);
//
//            $this->load->view('cpainel/tela/rodape');
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
                foreach ($aluno_salvo as $as) {
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

    public function obter_alunos_cadastrados() {
        // veirificando usuario logado
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $texto_pesquisa = $this->input->get('q');
            $id_turma = $this->input->get('turma');

            $alunos_da_turma = $this->aluno_model->alunos_na_turma($id_turma)->result();
            $alunos_pesquisado = $this->aluno_model->obter_alunos_pesquisa_nome($texto_pesquisa, $id_turma)->result();
            $alunos_nao_adicionado = array();

            foreach ($alunos_pesquisado as $ap) {
                $teste = TRUE;
                foreach ($alunos_da_turma as $adt) {
                    if ($ap->id_aluno == $adt->aluno_id_aluno) {
                        $teste = FALSE;
                        break;
                    }
                }
                if ($teste == TRUE) {
                    $alunos_nao_adicionado[] = $ap;
                }
            }

            echo json_encode($alunos_nao_adicionado);
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Incluindo aluno existente em uma turma.
    public function add_aluno_turma() {
        $id_aluno = $this->input->post('aluno');
        $id_turma = $this->input->post('turma');

        $retorno = '0';

        $aluno_turma = $this->aluno_model->aluno_em_turma($id_aluno, $id_turma)->result();
        if (count($aluno_turma) != 0) {
            $retorno = "Aluno já está cadastrado!";
        } else {
            $dados = array(
                "aluno_id_aluno" => $id_aluno,
                "turma_id_turma" => $id_turma
            );
            $this->aluno_model->salvar_aluno_turma($dados);
            $retorno = '1';
        }
        echo $retorno;
    }

    // Função para excluir aluno da turma;
    public function excluir_aluno_turma() {
        // verificando usuario logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            $id_aluno = $this->input->post('aluno');
            $id_turma = $this->input->post('turma');

            $retorno = '';

            $query = $this->aluno_model->aluno_em_turma($id_aluno, $id_turma)->result();
            if (count($query) != 0) {
                $this->aluno_model->excluir_aluno_em_tuma($id_aluno, $id_turma);
                $retorno = '1';
            } else {
                $retorno = 'Aluno não foi encontrada nesta turma!';
            }

            echo $retorno;
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

//put your code here
}
