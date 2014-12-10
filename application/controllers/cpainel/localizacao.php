<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Localizacao extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('cpainel/localizacao_model');
        $this->load->library('upload');
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

    //Utilizando
    public function obter_cidade_estado() {
        if (($this->session->userdata('id_admin')) && ($this->session->userdata('nome_admin')) && ($this->session->userdata('email_admin')) && ($this->session->userdata('senha_admin'))) {

            $id_estado = $_POST['estado'];

            $dados = array(
                'cidade' => $this->localizacao_model->obter_cidade_uf($id_estado)->result(),
            );

//            
//            $this->load->view('cpainel/tela/titulo');
//            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/localizacao/ver_cidade_estado_view', $dados);
//            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function ativar_desativar_estado() {
        if (($this->session->userdata('id_admin')) && ($this->session->userdata('nome_admin')) && ($this->session->userdata('email_admin')) && ($this->session->userdata('senha_admin'))) {
            $reterno = '';

            $estado = $_POST['estado'];

            $query = $this->localizacao_model->obter_um_uf($estado)->result();

            //   echo count($query);
            //   print_r($query);
            if (count($query) > 0) {
                foreach ($query as $qr) {
                    if ($qr->status_uf == 0) {
                        $dados = array(
                            'status_uf' => 1
                        );
                        $reterno = '1';
                    } else {
                        $dados = array(
                            'status_uf' => 0
                        );
                        $reterno = '0';
                    }
                    $this->localizacao_model->alterar_dados_uf($dados, $estado);
                }
            }
            echo $reterno;
        } else {
            //redirect(base_url("cpainel/seguranca"));
            echo 'ola';
        }
    }
    // Utilizando
    public function ativar_desativar_cidade() {
        if (($this->session->userdata('id_admin')) && ($this->session->userdata('nome_admin')) && ($this->session->userdata('email_admin')) && ($this->session->userdata('senha_admin'))) {
            $reterno = '';

            $cidade = $_POST['cidade'];

            $query = $this->localizacao_model->obter_um_cidade($cidade)->result();

            if (count($query) > 0) {
                foreach ($query as $qr) {
                    if ($qr->status_cidade == 0) {
                        $dados = array(
                            'status_cidade' => 1
                        );
                        $reterno = '1';
                    } else {
                        $dados = array(
                            'status_cidade' => 0
                        );
                        $reterno = '0';
                    }
                    $this->localizacao_model->alterar_dados_cidade($dados, $cidade);
                }
            }
            echo $reterno;
        } else {
            //redirect(base_url("cpainel/seguranca"));
            echo 'ola';
        }
    }

    public function excluir_secretaria() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $id_secretaria = $this->uri->segment(4);

            $query = $this->secretaria_model->obter_secretaria($id_secretaria)->result();

            foreach ($query as $q) {
                if (file_exists($q->imagem_secretaria)) {
                    unlink($q->imagem_secretaria);
                }
            }

            $this->secretaria_model->excluirSecretaria($id_secretaria);
            redirect(base_url("cpainel/secretaria"));
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

//put your code here
}
