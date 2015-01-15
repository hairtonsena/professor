<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inicio extends CI_Controller {

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
            "munu_disciplina" => $disciplina_menu
        );



        $this->load->view('tela/titulo');
        $this->load->view('tela/menu', $dados_menu);
        $this->load->view('tela/inicio_view');
        //$this->load->view('tela/disciplina_sem_logar_view');
        // $this->load->view('tela/disciplina_logado_view');
        $this->load->view('tela/outros_view');
        $this->load->view('tela/rodape');
    }

    public function acesso_aluno() {
        $this->form_validation->set_rules('cpf_or_matricula', 'CPF ou Matrícula', 'required|trim|min_length[5]');
        $this->form_validation->set_rules('senha', 'Senha', 'required|min_length[6]|callback_validarUsuario_check');

        if ($this->form_validation->run() == FALSE) {

            $this->index();
        } else {
            redirect(base_url("inicio"));
        }
    }

    function validarUsuario_check() {
        $verificar_aluno_logado = FALSE;
        $mensagem_erro = 'Dados incorretos!';

        $cpf_or_matricula_aluno = mysql_real_escape_string($this->input->post('cpf_or_matricula'));
        $senha_aluno = md5(mysql_real_escape_string($this->input->post('senha')));


        $alunos = $this->aluno_model->obter_aluno_cpf($cpf_or_matricula_aluno)->result();
        if (count($alunos) !== 0) {
            foreach ($alunos as $al) {
                if ($al->senha_aluno === $senha_aluno) {
                    if ($al->status_aluno != 0) {
                        // aqui o codigo para logar
                        $this->criar_sessao_aluno($al);
                        $verificar_aluno_logado = TRUE;
                    } else {
                        $mensagem_erro = 'Aluno bloqueado';
                    }
                }
            }
        } else {
            $alunos = $this->aluno_model->obter_aluno_matricula($cpf_or_matricula_aluno)->result();
            if (count($alunos) !== 0) {
                foreach ($alunos as $al) {
                    if ($al->senha_aluno === $senha_aluno) {
                        if ($al->status_aluno != 0) {
                            // aqui o codigo para logar
                            $this->criar_sessao_aluno($al);
                            $verificar_aluno_logado = TRUE;
                        } else {
                            $mensagem_erro = 'Aluno bloqueado';
                        }
                    }
                }
            }
        }


        if ($verificar_aluno_logado === FALSE) {

            $this->form_validation->set_message('validarUsuario_check', $mensagem_erro);
            return FALSE;
        } else {
            return TRUE;
        }
    }

    protected function criar_sessao_aluno($aluno) {
        // foreach ($userLogin as $ul) {
        $dadosUser = array(
            'id_aluno' => $aluno->id_aluno,
            'nome_aluno' => $aluno->nome_aluno,
            'cpf_aluno' => $aluno->cpf_aluno,
            'matricula_aluno' => $aluno->matricula_aluno,
            'verificar_login' => "cored.com"
        );
        $this->session->set_userdata($dadosUser);
        // }
    }

    public function logout_aluno() {
        $this->session->unset_userdata('id_aluno');
        $this->session->unset_userdata('nome_aluno');
        $this->session->unset_userdata('cpf_aluno');
        $this->session->unset_userdata('matricula_aluno');
        $this->session->unset_userdata('verificar_login');
        redirect(base_url());
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */