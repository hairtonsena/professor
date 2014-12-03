<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class mural extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('cpainel/mural_model');
        $this->load->library('upload');
        date_default_timezone_set('UTC');
    }

    public function index() {

        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $todosMurais = $this->mural_model->ver_todas_murais()->result();


            $dados = array(
                'mural' => $todosMurais,
                'anexo_mural' => $this->mural_model->ver_todos_anexos_mural()->result(),
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/mural/tabela_alterar_mural_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("seguranca"));
        }
    }

    public function nova() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/mural/forme_criar_publicacao_view');
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function criar_nova_publicacao() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $this->form_validation->set_rules('titulo_publicacao', 'Titulo', 'required|trim|min_length[5]');

            if ($this->form_validation->run() == FALSE) {

                $this->nova();
            } else {

                $titulo_publicacao = $this->input->post('titulo_publicacao');
                $id_publicacao = url_title($titulo_publicacao);

                $data_publicacao = date('Y-m-d');



                $dados = array(
                    'id_mural' => $id_publicacao,
                    'titulo_mural' => $titulo_publicacao,
                    'data_mural' => $data_publicacao,
                    'ordem_mural' => date('Y-m-d H:i:s')  // 2013-11-19 04:20:08
                );

                $this->mural_model->salvarNovoMural($dados);

                redirect(base_url("cpainel/mural/alterar_texto_mural/" . $id_publicacao));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function forme_editar_titulo_mural($id_mural = NULL) {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {
            if ($id_mural == NULL) {
                $id_mural = $this->uri->segment(4);
            }
            $query = $this->mural_model->obter_mural($id_mural)->result();

            if (count($query) == 0) {
                redirect(base_url("cpainel/mural"));
            }


            $dados = array(
                'id_mural' => $id_mural,
                'titulo_mural' => $query
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/mural/forme_editar_titulo_mural_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function alterar_titulo_publicacao() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $this->form_validation->set_rules('titulo_publicacao', 'Titulo', 'required|trim|min_length[5]');
            $id_mural = $this->input->post('id_mural');
            if ($this->form_validation->run() == FALSE) {

                $this->forme_editar_titulo_mural($id_mural);
            } else {

                $titulo_mural = $this->input->post('titulo_publicacao');

                $dados = array(
                    'titulo_mural' => $titulo_mural,
                );


                $this->mural_model->alterarDadosMural($dados, $id_mural);

                redirect(base_url("cpainel/mural"));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function alterar_texto_mural() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $id_mural = $this->uri->segment(4);

            $marul = $this->mural_model->obter_mural($id_mural)->result();

            if (count($marul) == 0) {
                redirect(base_url("cpainel/mural"));
            } else {

                $dados = array(
                    'id_mural' => $id_mural,
                    'texto_mural' => $marul,
                );

                $this->load->view('cpainel/tela/titulo');
                $this->load->view('cpainel/tela/menu');
                $this->load->view('cpainel/mural/forme_editar_texto_mural_view', $dados);
                $this->load->view('cpainel/tela/rodape');
            }
        } else {
            redirect(base_url('cpainel/seguranca'));
        }
    }

    public function verTextoMural() {
        $id_mural = $_POST['idMural'];
        $dados = array(
            'mural' => $this->mural_model->obter_mural($id_mural)->result()
        );

        $this->load->view('cpainel/mural/verTextoMural_view', $dados);
    }

    public function forme_add_anexo_mural($id_mural = NULL, $erro_up = NULL) {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {
            if ($id_mural == NULL) {
                $id_mural = $this->uri->segment(4);
            }
            $marul = $this->mural_model->obter_mural($id_mural)->result();

            if (count($marul) == 0) {
                redirect(base_url("cpainel/mural"));
            } else {

                $dados = array(
                    'id_mural' => $id_mural,
                    'error' => $erro_up,
                );

                $this->load->view('cpainel/tela/titulo');
                $this->load->view('cpainel/tela/menu');
                $this->load->view('cpainel/mural/forme_add_anexo_view', $dados);
                $this->load->view('cpainel/tela/rodape');
            }
        } else {
            redirect(base_url("seguranca"));
        }
    }

    public function salvar_texto_mural() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $id_mural = $this->input->post('id_mural');
            $texto_mural = $this->input->post('texto_mural');

            $dados = array(
                'texto_mural' => $texto_mural,
            );

            $this->mural_model->alterarDadosMural($dados, $id_mural);

            redirect(base_url("cpainel/mural"));
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function salvar_anexo_mural() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $id_mural = $this->input->post('id_mural');

            $diretorio_anexo_mural = 'anexo_mural';

            if (!file_exists($diretorio_anexo_mural)) {
                mkdir($diretorio_anexo_mural);
            }
            $field_name = "anexo_mural";

            $file = $_FILES["anexo_mural"];


            $nome_arquivo = $file['name'];

            $extencaoArquivo = strtolower(end(explode('.', $nome_arquivo)));
            $nome_array = explode('.', $nome_arquivo);

            $nome_anexo = $nome_array[0] . date("_y_m_d_H_i_s") . "." . $extencaoArquivo;
            ;


            $config['file_name'] = $nome_anexo;
            $config['upload_path'] = $diretorio_anexo_mural; // server directory
            $config['allowed_types'] = 'pdf'; // by extension, will check for whether it is an image
            $config['max_size'] = '100000000000000'; // in kb
            $config['is_image'] = 0;


            $this->upload->initialize($config);

            $files = $this->upload->do_upload($field_name);

            if (!$files) {
                $erro_up = $this->upload->display_errors();
                $this->forme_add_anexo_mural($id_mural, $erro_up);
            } else {

                $dados = array(
                    'nome_arquivo_am' => $nome_arquivo,
                    'arquivo_am' => $nome_anexo,
                    'id_mural' => $id_mural,
                    'data_am' => date("Y-m-d"),
                    'status_am' => 0
                );

                $this->mural_model->salvarAnexoMural($dados);
                redirect(base_url("cpainel/mural"));
            }
        } else {
            redirect(base_url('cpainel/seguranca'));
        }
    }

//    public function alterar_mural() {
//        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {
//
//            $dados = array(
//                'mural' => $this->mural_model->ver_todas_murais()->result(),
//                'anexo_mural' => $this->mural_model->ver_todos_anexos_mural()->result(),
//            );
//
//
//            $this->load->view('tela/titulo');
//            $this->load->view('tela/menu');
//            $this->load->view('mural/tabela_alterar_mural_view', $dados);
//
//            $this->load->view('tela/rodape');
//        } else {
//            redirect(base_url() . "seguranca");
//        }
//    }
//    public function ativar_desativar() {
//        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {
//
//            $dados = array(
//                'mural' => $this->mural_model->ver_todas_murais()->result(),
//            );
//
//
//            $this->load->view('tela/titulo');
//            $this->load->view('tela/menu');
//            $this->load->view('mural/tabela_ativar_desativar_mural_view', $dados);
//
//            $this->load->view('tela/rodape');
//        } else {
//            redirect(base_url() . "seguranca");
//        }
//    }

    public function ativar_mural() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $id_mural = $this->uri->segment(4);

            $dados = array(
                'status_mural' => '1',
            );

            $this->mural_model->alterarDadosMural($dados, $id_mural);

            redirect(base_url("cpainel/mural"));
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function desativar_mural() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $id_mural = $this->uri->segment(4);

            $dados = array(
                'status_mural' => '0',
            );

            $this->mural_model->alterarDadosMural($dados, $id_mural);

            redirect(base_url("cpainel/mural"));
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function arquivar_mural() {

        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $id_mural = $this->uri->segment(4);

            $dados = array(
                'status_mural' => '2',
            );

            $this->mural_model->alterarDadosMural($dados, $id_mural);

            redirect(base_url("cpainel/mural"));
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function excluir_mural() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $id_mural = $this->uri->segment(4);

            $dados = array(
                'status_mural' => '-1',
            );

            $this->mural_model->alterarDadosMural($dados, $id_mural);

            redirect(base_url("cpainel/mural"));
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function ativar_anexor() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $id_anexo = $this->uri->segment(4);

            $dados = array(
                'status_am' => 1
            );

            $this->mural_model->alterarDadosAnexo($dados, $id_anexo);

            redirect(base_url("cpainel/mural"));
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function desativar_anexor() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

        $id_anexo = $this->uri->segment(4);

        $dados = array(
            'status_am' => 0
        );

        $this->mural_model->alterarDadosAnexo($dados, $id_anexo);

        redirect(base_url("cpainel/mural"));
                } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

}

?>
