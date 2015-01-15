<?php

if (!defined('BASEPATH'))
    exit
            ('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of seguranca
 *
 * @author hairton
 * 
 */
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


    
    
    
    
    ////////////////////////////////////////////////   _||_
    ///  Área reservada para cadastro de aluno  ////   \  /
    ////////////////////////////////////////////////    \/
    
    function cadastraCidadaoEXE() {

        $this->form_validation->set_rules('nomeCidadaoCadastro', 'Nome', 'required|trim|min_length[4]|max_length[50]');
        $this->form_validation->set_rules('cpfCidadaoCadastro', 'CPF', 'callback_cpf_check|required|trim|numeric|min_length[11]|max_length[11]|is_unique[cidadao.cpfCidadao]');
        $this->form_validation->set_rules('emailCidadaoCadastro', 'Email', 'required|trim|min_length[5]|max_length[70]|valid_email|is_unique[cidadao.emailCidadao]');
        $this->form_validation->set_rules('senhaCidadaoCadastro', 'Senha', 'required|min_length[6]|max_length[20]');
        $this->form_validation->set_rules('confirmaSenhaCidadaoCadastro', 'Senha de Confirmação', 'callback_confirmaSenha_check');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('user_cidadao/seguranca/cadastraCidadao_view');
        } else {

            $cidadaoCadastro = array(
                'idCidadao' => '',
                'nomeCidadao' => $this->input->post('nomeCidadaoCadastro'),
                'cpfCidadao' => $this->input->post('cpfCidadaoCadastro'),
                'emailCidadao' => $this->input->post('emailCidadaoCadastro'),
                'senhaCidadao' => md5($this->input->post('senhaCidadaoCadastro')),
                'estadoCidadao' => 1,
            );

            $this->cidadao_model->salvarNovoCidadao($cidadaoCadastro);

            $dadosLogin = array(
                'emailCidadao' => $this->input->post('emailCidadaoCadastro'),
                'senhaCidadao' => md5($this->input->post('senhaCidadaoCadastro')),
            );

            $userLogin = $this->cidadao_model->obterCidadaoLogin($dadosLogin)->result();

            if (empty($userLogin)) {
                $this->load->view('user_cidadao/seguranca/cadastraCidadao_view');
            } else {
                foreach ($userLogin as $ul) {
                    $dadosUser = array(
                        'idCidadao' => $ul->idCidadao,
                        'nomeCidadao' => $ul->nomeCidadao,
                        'emailCidadao' => $ul->emailCidadao,
                        'senhaCidadao' => $ul->senhaCidadao
                    );
                    $this->session->set_userdata($dadosUser);

                    echo '<script language = "JavaScript">location.href = "' . base_url() . '";</script>';
                }
            }
        }
    }

    public function confirmaSenha_check($conSenha) {

        if ($conSenha != $this->input->post('senhaCidadaoCadastro')) {
            $this->form_validation->set_message('confirmaSenha_check', 'A %s esta incorreta!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function cpf_check($cpf) {

//Etapa 1: Cria um array com apenas os digitos numéricos, isso permite receber o cpf em diferentes formatos como "000.000.000-00", "00000000000", "000 000 000 00" etc...
        $j = 0;
        for ($i = 0; $i < (strlen($cpf)); $i++) {
            if (is_numeric($cpf[$i])) {
                $num[$j] = $cpf[$i];
                $j++;
            }
        }
//Etapa 2: Conta os dígitos, um cpf válido possui 11 dígitos numéricos.
        if (count($num) != 11) {
            $isCpfValid = false;
        }
//Etapa 3: Combinações como 00000000000 e 22222222222 embora não sejam cpfs reais resultariam em cpfs válidos após o calculo dos dígitos ve rificares e por isso precisam ser filtradas nesta parte.
        else {
            for ($i = 0; $i < 10; $i++) {
                if ($num[0] == $i && $num[1] == $i && $num[2] == $i && $num[3] == $i && $num[4] == $i && $num[5] == $i && $num[6] == $i && $num[7] == $i && $num[8] == $i) {
                    $isCpfValid = false;
                    break;
                }
            }
        }
//Etapa 4: Calcula e compara o primeiro dígito verificador.
        if (!isset($isCpfValid)) {
            $j = 10;
            for ($i = 0; $i < 9; $i++) {
                $multiplica[$i] = $num[$i] * $j;
                $j--;
            }
            $soma = array_sum($multiplica);
            $resto = $soma % 11;
            if ($resto < 2) {
                $dg = 0;
            } else {
                $dg = 11 - $resto;
            }
            if ($dg != $num[9]) {
                $isCpfValid = false;
            }
        }
//Etapa 5: Calcula e compara o segundo dígito verificador.
        if (!isset($isCpfValid)) {
            $j = 11;
            for ($i = 0; $i < 10; $i++) {
                $multiplica[$i] = $num[$i] * $j;
                $j--;
            }
            $soma = array_sum($multiplica);
            $resto = $soma % 11;
            if ($resto < 2) {
                $dg = 0;
            } else {
                $dg = 11 - $resto;
            }
            if ($dg != $num[10]) {
                $isCpfValid = false;
            } else {
                $isCpfValid = true;
            }
        }

//$isCpfValid;


        if ($isCpfValid == FALSE) {
            $this->form_validation->set_message('cpf_check', 'O %s é invalido, Verirfique se digitou corretamente!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function nova_senha() {

        $this->load->view('user_cidadao/seguranca/gerarNovaSenha');
    }

    function gerar_nova_senha() {

        if ((isset($_POST['email']))) {

            $queryCidadao = $this->cidadao_model->obterTodosCidadaos()->result();


            $email = $_POST['email'];
            $teste = FALSE;
            $idCidadao;
            $nomeCidadao;


            foreach ($queryCidadao as $cd) {
                if (strtoupper($email) == strtoupper($cd->emailCidadao)) {
                    $teste = TRUE;
                    $idCidadao = $cd->idCidadao;
                    break;
                }
            }

            if ($teste == TRUE) {

                $novaSenha = rand(10000000, 99999999);

                $alterarSenha = array(
                    'senhaCidadao' => md5($novaSenha),
                );

                $this->cidadao_model->alterarStatusConclusao($alterarSenha, $idCidadao);

                $textoMensagem = "Uma nova senha foi gerada para você acessa um Projeto TCC<br/><br/> Senha: " . $novaSenha . "";

                $tituloMensagem = 'Projeto TCC, nova senha';

                $paraEmail = $email;
                $assunto = $tituloMensagem;


                $assunto = 'Novo Email Projeto TCC';
                $this->email->from('hairtontcc@yahoo.com.br', 'Projeto TCC');
                $this->email->to($email);
                $this->email->subject($assunto);
                $this->email->message($textoMensagem);

                if (!$this->email->send()) {
                    echo $this->email->print_debugger();
                }

                echo "Email gerado com sucesso!<br/><br/>
                    Acesse seu email para pegar a nova senha.";
                //redirect(base_url() . 'seguranca/nova_senha');
            } else {
                echo "<script> alert('Este emial não esta registrado!'); </script>";
            }
        }
    }

    function alterar_nome() {
        if (($this->session->userdata('idCidadao')) && ($this->session->userdata('nomeCidadao')) && ($this->session->userdata('emailCidadao')) && ($this->session->userdata('senhaCidadao'))) {
            $this->load->view('user_cidadao/seguranca/alterarNomeCidadao');
        } else {
            redirect(base_url());
        }
    }

    function alterar_nome_cidadao() {

        if (($this->session->userdata('idCidadao')) && ($this->session->userdata('nomeCidadao')) && ($this->session->userdata('emailCidadao')) && ($this->session->userdata('senhaCidadao'))) {
            if ((isset($_POST['senhaAtual'])) && (isset($_POST['alterarNome']))) {


                $this->form_validation->set_rules('alterarNome', 'Alterar Nome', 'required|trim|min_length[4]|max_length[50]');
                $this->form_validation->set_rules('senhaAtual', 'Senha Atual', 'required|min_length[6]|max_length[20]|callback_verificarUsuario_check');


                if ($this->form_validation->run() == FALSE) {

                    $this->load->view('user_cidadao/seguranca/alterarNomeCidadao');
                } else {

                    $alterarNome = trim($_POST['alterarNome']);

                    $dadosNome = array(
                        'nomeCidadao' => $alterarNome,
                    );

                    $this->cidadao_model->alterarStatusConclusao($dadosNome, $this->session->userdata('idCidadao'));

                    $this->session->set_userdata(array('nomeCidadao' => $alterarNome));
                    echo '<script language="javascript" type="text/javascript">';
                    echo 'window.alert("Nome alterado com sucesso!");';
                    echo 'window.location.href="' . base_url() . '";';
                    echo '</script>';
                }
            }
        }
    }

    public function verificarUsuario_check() {
        $queryCidadao = $this->cidadao_model->obterTodosCidadaos()->result();

        $senhaAtual = md5($_POST['senhaAtual']);
        $teste = FALSE;

        foreach ($queryCidadao as $cd) {
            if (($this->session->userdata('idCidadao') == $cd->idCidadao) && ($senhaAtual == $cd->senhaCidadao)) {
                $teste = TRUE;
                break;
            }
        }

        if ($teste == FALSE) {
            $this->form_validation->set_message('verificarUsuario_check', 'A %s esta incorreta!');
            return $teste;
        } else {
            return $teste;
        }
    }

    function alterar_senha() {
        if (($this->session->userdata('idCidadao')) && ($this->session->userdata('nomeCidadao')) && ($this->session->userdata('emailCidadao')) && ($this->session->userdata('senhaCidadao'))) {
            $this->load->view('user_cidadao/seguranca/alterarSenhaCidadao');
        } else {

            redirect(base_url());
        }
    }

    function alterar_senha_cidadao() {

        if (($this->session->userdata('idCidadao')) && ($this->session->userdata('nomeCidadao')) && ($this->session->userdata('emailCidadao')) && ($this->session->userdata('senhaCidadao'))) {

            if ((isset($_POST['senhaAtual'])) && (isset($_POST['novaSenha'])) && (isset($_POST['confirmarNovaSenha']))) {

                $this->form_validation->set_rules('senhaAtual', 'Senha Atual', 'required|min_length[6]|max_length[20]|callback_verificarUsuario_check');
                $this->form_validation->set_rules('novaSenha', 'Nova Senha', 'required|trim|min_length[6]|max_length[20]');
                $this->form_validation->set_rules('confirmarNovaSenha', 'Confirmação de Senha', 'required|trim|min_length[6]|max_length[20]|callback_verificarSenhaIguais_check');

                if ($this->form_validation->run() == FALSE) {
                    $this->load->view('user_cidadao/seguranca/alterarSenhaCidadao');
                } else {

                    $alterarSenha = md5($_POST['novaSenha']);

                    $dadosSenha = array(
                        'senhaCidadao' => $alterarSenha,
                    );

                    $this->cidadao_model->alterarStatusConclusao($dadosSenha, $this->session->userdata('idCidadao'));

                    $this->session->set_userdata(array('senhaCidadao' => $alterarSenha));
                    echo '<script language="javascript" type="text/javascript">';
                    echo 'window.alert("Senha alterada com sucesso!");';
                    echo 'window.location.href="' . base_url() . '";';
                    echo '</script>';
                }
            }
        } else {
            redirect(base_url());
        }
    }

    public function verificarSenhaIguais_check() {
        if (trim($_POST['novaSenha']) == trim($_POST['confirmarNovaSenha'])) {
            return TRUE;
        } else {
            $this->form_validation->set_message('verificarSenhaIguais_check', 'A %s esta incorreta!');
            return FALSE;
        }
    }

//put your code here
}

?>
