<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class seguranca extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
        $this->load->helper('captcha');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('cpainel/professor_model');
    }

    function index() {

        $wordCp = rand(000000, 999999);
        $this->session->set_userdata(array('textCaptcha' => $wordCp));
        $vals = array(
            'word' => $wordCp,
            'img_path' => './captcha/',
            'img_url' => base_url() . 'captcha/',
            // 'font_path' => './path/to/fonts/texb.ttf',
            'img_width' => 130,
            'img_height' => 30,
            'expiration' => 7200
        );


        $cap = create_captcha($vals); // , "./captcha/", base_url('captcha/'), NULL);


        $dados = array(
            'imagemCaptcha' => $cap['image'],
        );

        $this->load->view('cpainel/seguranca/formLogin_view', $dados);
    }

    function logarUsuario() {
        $teste = false;
        $this->form_validation->set_rules('textoImagem', 'Codigo', 'callback_codigoValidacao_check');
        if ($this->form_validation->run() == TRUE) {
            $teste = TRUE;
        }
        if ($teste == TRUE) {
            $this->form_validation->set_rules('email', 'Email', 'required|trim|min_length[5]|valid_email');
            $this->form_validation->set_rules('senha', 'Senha', 'required|min_length[6]|callback_validarUsuario_check');
            $this->form_validation->set_rules('textoImagem', 'Codigo', '');
        }
        if ($this->form_validation->run() == FALSE) {

            $this->index();
        } else {
            redirect(base_url("cpainel/inicio"));
        }
    }

    function validarUsuario_check() {
        $dadosLogin = array(
            'email_professor' => $this->input->post('email'),
            'senha_professor' => md5($this->input->post('senha'))
        );

        $userLogin = $this->professor_model->obterProfessorLogin($dadosLogin)->result();

        if (empty($userLogin)) {

            $this->form_validation->set_message('validarUsuario_check', 'Email ou senha incorretos!');
            return FALSE;
        } else {
            foreach ($userLogin as $ul) {
                $dadosUser = array(
                    'id_professor' => $ul->id_professor,
                    'nome_professor' => $ul->nome_professor,
                    'email_professor' => $ul->email_professor,
                    'senha_professor' => $ul->senha_professor
                );
                $this->session->set_userdata($dadosUser);
            }
            return TRUE;
        }
    }

    function codigoValidacao_check($cod) {
        if ($this->input->post('textoImagem') != $this->session->userdata('textCaptcha')) {
            $this->form_validation->set_message('codigoValidacao_check', 'O %s está incorreta!');
            return FALSE;
        } else {
            $this->session->unset_userdata('textCaptcha');
            return TRUE;
        }
    }

    function logoutUser() {
        $this->session->unset_userdata('id_professor');
        $this->session->unset_userdata('nome_professor');
        $this->session->unset_userdata('email_professor');
        $this->session->unset_userdata('senha_professor');
        //$this->session->unset_userdata('id_privilegio_admin');
        redirect(base_url());
    }

//put your code here
}

?>
