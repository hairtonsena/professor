<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Empreendimento extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('cpainel/empreendimento_model');
        $this->load->library('upload');
    }

    // Utilizando
    public function index() {

        if (($this->session->userdata('id_admin')) && ($this->session->userdata('nome_admin')) && ($this->session->userdata('email_admin')) && ($this->session->userdata('senha_admin'))) {
            $dados = array(
                'empreendimento' => $this->empreendimento_model->ver_todas_empreendimento()->result(),
            );


            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/empreendimento/empreendimento_view', $dados);

            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Utilizando
    public function novo() {
        if (($this->session->userdata('id_admin')) && ($this->session->userdata('nome_admin')) && ($this->session->userdata('email_admin')) && ($this->session->userdata('senha_admin'))) {

            $dados = array(
                'tipo_empreendimento' => $this->empreendimento_model->obter_tipo_empreendimento()->result(),
            );


            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/empreendimento/forme_criar_empreendimento_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function fome_opcao_tipo_empreendimento() {
        if (($this->session->userdata('id_admin')) && ($this->session->userdata('nome_admin')) && ($this->session->userdata('email_admin')) && ($this->session->userdata('senha_admin'))) {

            $opcao_tipo_empreendimento = $_POST['tipo_empreendimento'];

                if ($opcao_tipo_empreendimento == 2) {
                    $this->load->view('cpainel/empreendimento/forme_criar_empreendimento_cnpj_view');
                } else if ($opcao_tipo_empreendimento == 1) {
                    $this->load->view('cpainel/empreendimento/forme_criar_empreendimento_cpf_view');
                } else {
                    echo '';
                }
            
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function criar_nova_secretaria() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {
            $this->form_validation->set_rules('titulo_secretaria', 'Titulo', 'required|trim|min_length[5]');
            if ($this->form_validation->run() == FALSE) {
                $this->nova();
            } else {
                $titulo_secretaria = $this->input->post('titulo_secretaria');
                $id_secretaria = url_title($titulo_secretaria);
                $dados = array(
                    'id_secretaria' => $id_secretaria,
                    'titulo_secretaria' => $titulo_secretaria
                );

                $this->secretaria_model->salvarNovoSecretaria($dados);

                redirect(base_url("cpainel/secretaria/alterar_texto_secretaria/" . $id_secretaria));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function forme_editar_titulo_secretaria($id_secretaria = NULL) {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {
            if ($id_secretaria == NULL) {
                $id_secretaria = $this->uri->segment(4);
            }
            $titulo_secretaria = $this->secretaria_model->obter_secretaria($id_secretaria)->result();
            if (count($titulo_secretaria) == 0) {
                redirect(base_url("cpainel/secretaria"));
            } else {
                $dados = array(
                    'id_secretaria' => $id_secretaria,
                    'titulo_secretaria' => $titulo_secretaria
                );

                $this->load->view('cpainel/tela/titulo');
                $this->load->view('cpainel/tela/menu');
                $this->load->view('cpainel/secretaria/forme_editar_titulo_secretaria_view', $dados);
                $this->load->view('cpainel/tela/rodape');
            }
        } else {
            redirect(base_url("cpainel/seguranca/"));
        }
    }

    public function alterar_titulo_secretaria() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $this->form_validation->set_rules('titulo_secretaria', 'Titulo', 'required|trim|min_length[5]');
            $id_secretaria = $this->input->post('id_secretaria');

            if ($this->form_validation->run() == FALSE) {
                $this->forme_editar_titulo_secretaria($id_secretaria);
            } else {
                $titulo_secretaria = $this->input->post('titulo_secretaria');
                $dados = array(
                    'titulo_secretaria' => $titulo_secretaria,
                );

                $this->secretaria_model->alterarDadosSecretaria($dados, $id_secretaria);

                redirect(base_url("cpainel/secretaria"));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function alterar_texto_secretaria() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $id_secretaria = $this->uri->segment(4);
            $texto_secretaria = $this->secretaria_model->obter_secretaria($id_secretaria)->result();

            if (count($texto_secretaria) == 0) {
                redirect(base_url("cpainel/secretaria"));
                exit();
            }

            $dados = array(
                'id_secretaria' => $id_secretaria,
                'texto_secretaria' => $texto_secretaria
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/secretaria/forme_editar_texto_secretaria_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url('cpainel/seguranca'));
        }
    }

    public function alterar_imagem_secretaria($id_secretaria = NULL, $error = NULL) {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            if ($id_secretaria == NULL) {
                $id_secretaria = $this->uri->segment(4);
                $error = '';
            }

            $texto_secretaria = $this->secretaria_model->obter_secretaria($id_secretaria)->result();

            if (count($texto_secretaria) == 0) {
                redirect(base_url("cpainel/secretaria"));
                exit();
            }

            $dados = array(
                'id_secretaria' => $id_secretaria,
                'error' => $error
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/secretaria/forme_editar_imagem_secretaria_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function salvar_texto_secretaria() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $id_secretaria = $this->input->post('id_secretaria');
            $texto_secretaria = $this->input->post('texto_secretaria');

            $dados = array(
                'texto_secretaria' => $texto_secretaria,
            );

            $this->secretaria_model->alterarDadosSecretaria($dados, $id_secretaria);

            redirect(base_url("cpainel/secretaria"));
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function salvar_imagem_secretaria() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $id_secretaria = $this->input->post('id_secretaria');

            $diretorio_imagem_secretaria = 'imagem_secretaria';

            if (!file_exists($diretorio_imagem_secretaria)) {
                mkdir($diretorio_imagem_secretaria);
            }
            $field_name = "imagem_secretaria";

            $file = $_FILES['imagem_secretaria'];


            $imagemExtecao = strtolower(end(explode('.', $file['name'])));


            $nome_imagem = md5(uniqid(time())) . "." . $imagemExtecao;
            $config['file_name'] = $nome_imagem;
            $config['upload_path'] = $diretorio_imagem_secretaria; // server directory
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|JPEG|JPG'; // by extension, will check for whether it is an image
            $config['max_size'] = '100000000000000'; // in kb
            $config['max_width'] = '2024';
            $config['max_height'] = '1468';


            $this->upload->initialize($config);

            $files = $this->upload->do_upload($field_name);

            if (!$files) {

                $error = $this->upload->display_errors();

                $this->alterar_imagem_secretaria($id_secretaria, $error);
            } else {

                $query = $this->secretaria_model->obter_secretaria($id_secretaria)->result();

                foreach ($query as $q) {
                    if (file_exists($q->imagem_secretaria)) {
                        unlink($q->imagem_secretaria);
                    }
                }

                $dados = array(
                    'imagem_secretaria' => $diretorio_imagem_secretaria . "/" . $nome_imagem,
                );


                $this->secretaria_model->alterarDadosSecretaria($dados, $id_secretaria);

                redirect(base_url("cpainel/secretaria"));
            }
        } else {
            redirect(base_url('cpainel/seguranca'));
        }
    }

    public function ativar_secretaria() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $id_secretaria = $this->uri->segment(4);

            $dados = array(
                'status_secretaria' => '1',
            );

            $this->secretaria_model->alterarDadosSecretaria($dados, $id_secretaria);

            redirect(base_url("cpainel/secretaria"));
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function desativar_secretaria() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $id_secretaria = $this->uri->segment(4);

            $dados = array(
                'status_secretaria' => '0',
            );

            $this->secretaria_model->alterarDadosSecretaria($dados, $id_secretaria);

            redirect(base_url("cpainel/secretaria"));
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function verTextoSecretaria() {
        $id_secretaria = $_POST['idSecretaria'];
        $dados = array(
            'secretaria' => $this->secretaria_model->obter_secretaria($id_secretaria)->result()
        );

        $this->load->view('cpainel/secretaria/verTextoSecretaria_view', $dados);
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
