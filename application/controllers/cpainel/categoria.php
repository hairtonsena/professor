<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class categoria extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('cpainel/categoria_model');
        $this->load->library('upload');
        date_default_timezone_set('UTC');
    }

    public function index() {

        if (($this->session->userdata('id_admin')) && ($this->session->userdata('nome_admin')) && ($this->session->userdata('email_admin')) && ($this->session->userdata('senha_admin'))) {

            $todosCategoria = $this->categoria_model->ver_todas_categoria()->result();

            $dados = array(
                'categoria' => $todosCategoria,
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/categoria/categoria_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function nova_categoria() {
        if (($this->session->userdata('id_admin')) && ($this->session->userdata('nome_admin')) && ($this->session->userdata('email_admin')) && ($this->session->userdata('senha_admin'))) {
            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/categoria/forme_nova_categoria_view');
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function salvar_nova_categoria() {
        if (($this->session->userdata('id_admin')) && ($this->session->userdata('nome_admin')) && ($this->session->userdata('email_admin')) && ($this->session->userdata('senha_admin'))) {

            $this->form_validation->set_rules('nome_categoria', 'Nome', 'required|trim|min_length[5]');

            if ($this->form_validation->run() == FALSE) {

                $this->nova_categoria();
            } else {


                $nome_categoria = $this->input->post("nome_categoria");
                $dados = array("nome_categoria" => $nome_categoria);
                $this->categoria_model->salvar_nova_categoria($dados);


                redirect(base_url("cpainel/categoria"));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function ativar_desativar_categoria() {
        if (($this->session->userdata('id_admin')) && ($this->session->userdata('nome_admin')) && ($this->session->userdata('email_admin')) && ($this->session->userdata('senha_admin'))) {
            $reterno = '';
            $categoria = $this->input->post('categoria');
            $query = $this->categoria_model->obter_uma_categoria($categoria)->result();
            if (count($query) > 0) {
                foreach ($query as $qr) {
                    if ($qr->status_categoria == 0) {
                        $dados = array(
                            'status_categoria' => 1
                        );
                        $reterno = '1';
                    } else {
                        $dados = array(
                            'status_categoria' => 0
                        );
                        $reterno = '0';
                    }
                    $this->categoria_model->alterar_dados_categoria($dados, $categoria);
                }
            }
            echo $reterno;
        } else {
            //redirect(base_url("cpainel/seguranca"));
            echo 'ola';
        }
    }

    public function alterar_categoria($id_categoria = NULL) {
        if (($this->session->userdata('id_admin')) && ($this->session->userdata('nome_admin')) && ($this->session->userdata('email_admin')) && ($this->session->userdata('senha_admin'))) {
            if ($id_categoria == NULL) {
                $id_categoria = $this->uri->segment(4);
            }
            $query = $this->categoria_model->obter_uma_categoria($id_categoria)->result();

            if (count($query) == 0) {
                redirect(base_url("cpainel/categoria"));
            }
            $dados = array(
                'id_categoria' => $id_categoria,
                'categoria' => $query
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/categoria/forme_editar_categoria_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function alterar_nome_categoria() {
        if (($this->session->userdata('id_admin')) && ($this->session->userdata('nome_admin')) && ($this->session->userdata('email_admin')) && ($this->session->userdata('senha_admin'))) {

            $this->form_validation->set_rules('nome_c', 'Nome', 'required|trim|min_length[5]');
            if ($this->form_validation->run() == FALSE) {
                echo form_error('nome_c');
                // echo $this->forme_validation->display_error();
            } else {

                $nome_categoria = $this->input->post('nome_c');
                $id_categoria = $this->input->post('id_c');
                $campo_categoria = $this->input->post('campo_c');

                $dados = array(
                    'nome_categoria' => $nome_categoria,
                );


                $this->categoria_model->alterar_dados_categoria($dados, $id_categoria);


                echo '1';
                // redirect(base_url("cpainel/mural"));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function salvar_categoria_alterada() {
        if (($this->session->userdata('id_admin')) && ($this->session->userdata('nome_admin')) && ($this->session->userdata('email_admin')) && ($this->session->userdata('senha_admin'))) {

            $this->form_validation->set_rules('nome_categoria', 'Nome', 'required|trim|min_length[5]');
            $id_categoria = $this->input->post('id_categoria');
            if ($this->form_validation->run() == FALSE) {
                $this->alterar_categoria($id_categoria);
            } else {

                $nome_categoria = $this->input->post('nome_categoria');
                $dados = array(
                    'nome_categoria' => $nome_categoria,
                );
                $this->categoria_model->alterar_dados_categoria($dados, $id_categoria);
                redirect(base_url("cpainel/categoria/"));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function excluir_categoria() {
        if (($this->session->userdata('id_admin')) && ($this->session->userdata('nome_admin')) && ($this->session->userdata('email_admin')) && ($this->session->userdata('senha_admin'))) {
            $id_categoria = $this->input->post('categoria');
            $this->categoria_model->excluir_categoria($id_categoria);
            echo '1';
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    //----------------------------------------//
    // Area para manipulação de subcategoria -//
    //----------------------------------------//

    public function subcategoria($id_categoria = NULL) {
        if (($this->session->userdata('id_admin')) && ($this->session->userdata('nome_admin')) && ($this->session->userdata('email_admin')) && ($this->session->userdata('senha_admin'))) {
            if ($id_categoria == NULL) {
                $id_categoria = $this->uri->segment(4);
            }
            $query = $this->categoria_model->obter_uma_categoria($id_categoria)->result();

            if (count($query) == 0) {
                redirect(base_url("cpainel/categoria"));
            }

            $subcategoria_categoria = $this->categoria_model->obter_subcategorias_de_categoria($id_categoria)->result();

            $dados = array(
                'categoria' => $query,
                'subcategorias' => $subcategoria_categoria
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/categoria/subcategoria_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function nova_subcategoria($categoria = null) {
        if (($this->session->userdata('id_admin')) && ($this->session->userdata('nome_admin')) && ($this->session->userdata('email_admin')) && ($this->session->userdata('senha_admin'))) {
            if ($categoria == NULL) {
                $categoria = $this->uri->segment(4);
            }
            $query = $this->categoria_model->obter_uma_categoria($categoria)->result();

            if (count($query) == 0) {
                redirect(base_url("cpainel/categoria"));
            }

            $dados = array(
                'categoria' => $query
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/categoria/forme_nova_subcategoria_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function salvar_nova_subcategoria() {
        if (($this->session->userdata('id_admin')) && ($this->session->userdata('nome_admin')) && ($this->session->userdata('email_admin')) && ($this->session->userdata('senha_admin'))) {

            $this->form_validation->set_rules('nome_subcategoria', 'Nome', 'required|trim|min_length[5]');

            $categoria = $this->input->post('categoria');
            if ($this->form_validation->run() == FALSE) {
                $this->nova_categoria($categoria);
            } else {

                $nome_subcategoria = $this->input->post("nome_subcategoria");

                $dados = array(
                    "nome_sub_categoria" => $nome_subcategoria,
                    "id_categoria" => $categoria,
                );
                $this->categoria_model->salvar_nova_subcategoria($dados);


                redirect(base_url("cpainel/categoria/subcategoria/" . $categoria));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function alterar_subcategoria($id_subcategoria = NULL) {
        if (($this->session->userdata('id_admin')) && ($this->session->userdata('nome_admin')) && ($this->session->userdata('email_admin')) && ($this->session->userdata('senha_admin'))) {
            if ($id_subcategoria == NULL) {
                $id_subcategoria = $this->uri->segment(4);
            }
            $query = $this->categoria_model->obter_subcategoria($id_subcategoria)->result();

            if (count($query) == 0) {
                redirect(base_url("cpainel/categoria"));
            }
            $dados = array(
                'subcategoria' => $query
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/categoria/forme_editar_subcategoria_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

}

?>
