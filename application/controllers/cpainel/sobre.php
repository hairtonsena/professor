<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sobre extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('session');
//        $this->load->model('cpainel/trabalho_model');
//        $this->load->model('cpainel/turma_model');
        $this->load->model('cpainel/professor_model');
//        $this->load->model('cpainel/avaliacao_model');
        $this->load->library('upload');
        date_default_timezone_set('UTC');
    }

    public function index() {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $id_professor = $this->session->userdata('id_professor');

            $professor = $this->professor_model->obter_professor_id($id_professor)->result();

            $dados = array(
                "professor" => $professor
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/sobre/sobre_view', $dados);

            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

//    Função para mostrar o formulário de alterar os dados do professor
    public function alterar_dados() {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $id_professor = $this->session->userdata('id_professor');

            $professor = $this->professor_model->obter_professor_id($id_professor)->result();

            $dados = array(
                "professor" => $professor
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/sobre/forme_alterar_dados_view', $dados);

            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

//    Função para salvar os dados alterados do professor
    public function salvar_dados() {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $id_professor = $this->session->userdata('id_professor');

            $this->form_validation->set_rules('nome_professor', 'Nome', 'required|trim|min_length[4]|max_length[45]');

            if ($this->form_validation->run() == FALSE) {
                $this->alterar_dados();
            } else {

                $nome_professor = $this->input->post("nome_professor");
                $sobre_professor = $this->input->post("sobre_professor");

                $dados_alterar = array(
                    "nome_professor" => $nome_professor,
                    "sobre_professor" => $sobre_professor
                );

                $this->professor_model->alterar_dados_professor($dados_alterar, $id_professor);


                redirect(base_url("cpainel/sobre"));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

//    Função para mostrar o formulário de alterar imagem do professor
    public function alterar_imagem_professor($erro = NULL) {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $id_professor = $this->session->userdata('id_professor');

            $professor = $this->professor_model->obter_professor_id($id_professor)->result();

            $dados = array(
                "professor" => $professor,
                "erro_upload" => $erro
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/sobre/forme_alterar_imagem_view', $dados);

            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    //    Função para salvar a imagem alterada do professor
    public function salvar_imagem_professor() {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $id_professor = $this->session->userdata('id_professor');

            $diretorio_anexo = 'imagens/';

            $field_name = "arquivo";

            $config['remove_spaces'] = TRUE;
            $config['overwrite'] = FALSE;
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $diretorio_anexo; // server directory
            $config['allowed_types'] = 'jpg'; // by extension, will check for whether it is an image
            $config['max_size'] = 1024 * 10; // in kb -> total 10MB
            $config['is_image'] = 0;

            $this->upload->initialize($config);

            $files = $this->upload->do_upload($field_name);

            if (!$files) {

                $error = $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
                $this->alterar_imagem_professor($error);
            } else {
                $dadosImagem = $this->upload->data();

                $professor = $this->professor_model->obter_professor_id($id_professor)->result();


                $arquivo_antigo = '';
                foreach ($professor as $pr) {
                    $arquivo_antigo = $pr->imagem_professor;
                }
                if (file_exists("imagens/" . $arquivo_antigo)) {
                    unlink("imagens/" . $arquivo_antigo);
                }


                $dados = array(
                    'imagem_professor' => $dadosImagem['file_name'],
                );


                $this->professor_model->alterar_dados_professor($dados, $id_professor);


                redirect(base_url("cpainel/sobre"));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para alterar a senha do professor
    public function salva_nova_senha() {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            $id_professor = $this->session->userdata('id_professor');

            $this->form_validation->set_rules('senha_atual', 'Senha atual', 'required|trim|min_length[6]|max_length[20]|callback_verificar_senha_atual_check');
            $this->form_validation->set_rules('nova_senha', 'Nova senha', 'required|trim|min_length[6]|max_length[20]');
            $this->form_validation->set_rules('confirmacao_senha', 'Repitir nova senha', 'required|trim|min_length[6]|max_length[20]|matches[nova_senha]');

            if ($this->form_validation->run() == FALSE) {
                $this->index();
            } else {

                $nova_senha = $this->input->post("nova_senha");

                $dados_alterar = array(
                    "senha_professor" => md5($nova_senha),
                );

                $this->professor_model->alterar_dados_professor($dados_alterar, $id_professor);

                $this->session->set_flashdata("senha_alterada",'<div class="alert alert-success" role="alert">A senha foi alterada com sucesso!</div>');
                redirect(base_url("cpainel/sobre"));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

//    Função para verificar se a senha informada no formulário de
//    alterar senha está igual a senha salva no banco de daods.
    public function verificar_senha_atual_check($valor_campo) {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            $id_professor = $this->session->userdata('id_professor');
            $verificar_senha_igual = FALSE;
            $professor = $this->professor_model->obter_professor_id($id_professor)->result();
            foreach ($professor as $pr) {
                if ($pr->senha_professor == md5($valor_campo)) {
                    $verificar_senha_igual = TRUE;
                }
            }

            if ($verificar_senha_igual == TRUE) {
                return TRUE;
            } else {
                $this->form_validation->set_message('verificar_senha_atual_check', 'A %s está incorreta');
                return FALSE;
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

}
