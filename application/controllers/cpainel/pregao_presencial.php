<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pregao_presencial extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('UTC');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('cpainel/pregao_presencial_model');
        $this->load->library('upload');
    }

    public function index() {



        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $this->session->unset_userdata('paginacao_processo_licitatorio');
            $this->ver_todos();


//            $dados = array(
//                'pregao' => $this->pregao_presencial_model->ver_todos_pregoes()->result(),
//                'anexo_pregao' => $this->pregao_presencial_model->ver_todos_anexos_mural()->result(),
//            );
//
//
//            $this->load->view('cpainel/tela/titulo');
//            $this->load->view('cpainel/tela/menu');
//            $this->load->view('cpainel/pregao_presencial/tabela_alterar_pregao_view', $dados);
//
//            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function gera_paginacao($paginacao) {

        $numero_paginas = ceil($paginacao['total_de_registros'] / $paginacao['qtde_Registros_por_pagina']);

        if ($paginacao['paramentro_paginacao'] > 0) {
            if ($paginacao['paramentro_paginacao'] > $numero_paginas) {
                $paginacao['paramentro_paginacao'] = $numero_paginas;
            }
        } else {
            $paginacao['paramentro_paginacao'] = 1;
        }

        $paginacao['numero_da_pagina'] = $paginacao['paramentro_paginacao'] - 1;

        $links_paginacao = '<ul class="pagination">';

        for ($i = 0; $i < $numero_paginas; $i++) {

            $numPagina = $i + 1;

            if ($i == $paginacao['numero_da_pagina']) {
                $links_paginacao = $links_paginacao . '<li class="active"><a href="javascript:void(0)">' . $numPagina . '<span class="sr-only">(current)</span></a></li>';
            } else {
                $links_paginacao = $links_paginacao . '<li><a href="' . base_url("cpainel/pregao_presencial/ver_todos/$numPagina") . '" >' . $numPagina . '</a></li>';
            }
        }

        $links_paginacao = $links_paginacao . '</ul>';

        return $links_paginacao;
    }

    public function ver_todos() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $paginacao['total_de_registros'] = $this->pregao_presencial_model->ver_todos_pregoes()->num_rows();
            $paginacao['qtde_Registros_por_pagina'] = 8;

            $paginacao['paramentro_paginacao'] = (int) $this->uri->segment(4);

            if (!$paginacao['paramentro_paginacao'] > 0) {
                if (!$this->session->userdata('paginacao_processo_licitatorio')) {
                    $paginacao['paramentro_paginacao'] = 1;
                } else {
                    $paginacao['paramentro_paginacao'] = $this->session->userdata('paginacao_processo_licitatorio');
                }
            }

            $this->session->set_userdata('paginacao_processo_licitatorio', $paginacao['paramentro_paginacao']);

            $paginacao['numero_da_pagina'] = $paginacao['paramentro_paginacao'] - 1;
            $inicio = $paginacao['numero_da_pagina'] * $paginacao['qtde_Registros_por_pagina'];

            $links_paginacao = $this->gera_paginacao($paginacao);

            $dados = array(
                'pregao' => $this->pregao_presencial_model->ver_todos_pregoes($paginacao['qtde_Registros_por_pagina'], $inicio)->result(),
                'anexo_pregao' => $this->pregao_presencial_model->ver_todos_anexos_mural()->result(),
                'paginacao' => $links_paginacao,
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/pregao_presencial/tabela_alterar_pregao_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function novo() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/pregao_presencial/forme_criar_pregao_view');
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function criar_novo_pregao() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $this->form_validation->set_rules('titulo_pregao', 'Titulo', 'required|trim|min_length[5]');
            if ($this->form_validation->run() == FALSE) {
                $this->novo();
            } else {

                $titulo_pregao = $this->input->post('titulo_pregao');
                $id_pp = url_title($titulo_pregao);
                $data_publicacao = date('Y-m-d');

                $dados = array(
                    'id_pp' => $id_pp,
                    'titulo_pp' => $titulo_pregao,
                    'data_publicacao_pp' => $data_publicacao,
                    'data_ordem_pp' => date('Y-m-d H:i:s')  // 2013-11-19 04:20:08
                );

                $this->pregao_presencial_model->salvarNovoPregao($dados);
                redirect(base_url("cpainel/pregao_presencial/alterar_objeto_pregao/" . $id_pp));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function forme_editar_titulo_pregao($id_pregao = NULL) {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            if ($id_pregao == NULL) {
                $id_pregao = $this->uri->segment(4);
            }

            $dados = array(
                'id_pregao' => $id_pregao,
                'titulo_pregao' => $this->pregao_presencial_model->obter_pregao($id_pregao)->result()
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/pregao_presencial/forme_editar_titulo_pregao_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function alterar_titulo_pregao() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {
            $this->form_validation->set_rules('titulo_pregao', 'Titulo', 'required|trim|min_length[5]');
            $id_pregao = $this->input->post('id_pregao');
            if ($this->form_validation->run() == FALSE) {
                $this->forme_editar_titulo_pregao($id_pregao);
            } else {

                $titulo_pregao = $this->input->post('titulo_pregao');
                $dados = array(
                    'titulo_pp' => $titulo_pregao,
                );

                $this->pregao_presencial_model->alterarDadosPregao($dados, $id_pregao);
                redirect(base_url("cpainel/pregao_presencial/ver_todos/"));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function verTextoPregaoPresencial() {

        $id_pregao = $_POST['idPregao'];
        $dados = array(
            'pregao_presencial' => $this->pregao_presencial_model->obter_pregao($id_pregao)->result()
        );
        $this->load->view('cpainel/pregao_presencial/verObjetoPregao_view', $dados);
    }

    public function alterar_objeto_pregao() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $id_pregao = $this->uri->segment(4);
            $objeto_pregao = $this->pregao_presencial_model->obter_pregao($id_pregao)->result();

            if (count($objeto_pregao) == 0) {
                redirect(base_url("cpainel/pregao_presencial"));
                exit();
            }

            $dados = array(
                'id_pregao' => $id_pregao,
                'objeto_pregao' => $objeto_pregao
            );


            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/pregao_presencial/forme_editar_objeto_pregao_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url('cpainel/seguranca'));
        }
    }

    public function forme_add_anexo_pregao($id_pregao = NULL, $erros = NULL) {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            if ($id_pregao == NULL) {
                $id_pregao = $this->uri->segment(4);
                $erros = '';
            }
            $objeto_pregao = $this->pregao_presencial_model->obter_pregao($id_pregao)->result();

            if (count($objeto_pregao) == 0) {
                redirect(base_url("cpainel/pregao_presencial"));
                exit();
            }

            $dados = array(
                'id_pregao' => $id_pregao,
                'erros' => $erros
            );


            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/pregao_presencial/forme_add_anexo_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function salvar_objeto_pregao() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $id_pregao = $this->input->post('id_pregao');
            $objeto_pregao = $this->input->post('objeto_pregao');

            $dados = array(
                'objeto_pp' => $objeto_pregao,
            );

            $this->pregao_presencial_model->alterarDadosPregao($dados, $id_pregao);

            redirect(base_url("cpainel/pregao_presencial/ver_todos/"));
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function salvar_anexo_pregao() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {
            $id_pregao = $this->input->post('id_pregao');
            $diretorio_anexo_pregao = 'anexo_pregao';

            if (!file_exists($diretorio_anexo_pregao)) {
                mkdir($diretorio_anexo_pregao);
            }
            $field_name = "anexo_pregao";

            $file = $_FILES["anexo_pregao"];

            $nome_arquivo = $file['name'];

            $extecaoAnexo = strtolower(end(explode('.', $nome_arquivo)));

            $nome_arquivo = explode('.', $nome_arquivo);



            $nome_anexo = $nome_arquivo[0] . date("_y_m_d_H_i_s") . "." . $extecaoAnexo;

            $config['file_name'] = $nome_anexo;
            $config['upload_path'] = $diretorio_anexo_pregao; // server directory
            $config['allowed_types'] = 'pdf'; // by extension, will check for whether it is an image
            $config['max_size'] = '100000000000000'; // in kb
            $config['is_image'] = 0;


            $this->upload->initialize($config);
            $files = $this->upload->do_upload($field_name);

            if (!$files) {
                $erros = $this->upload->display_errors();
                $this->forme_add_anexo_pregao($id_pregao, $erros);
            } else {

                $dados = array(
                    'nome_anexo_ap' => $nome_anexo,
                    'id_pp' => $id_pregao,
                    'data_ap' => date("Y-m-d"),
                    'status_ap' => 0
                );


                $this->pregao_presencial_model->salvarAnexoPregao($dados);

                redirect(base_url("cpainel/pregao_presencial/ver_todos/"));
            }
        } else {
            redirect(base_url('cpainel/seguranca'));
        }
    }

    public function ativar_pregao() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $id_pregao = $this->uri->segment(4);

            $dados = array(
                'status_pp' => '1',
            );

            $this->pregao_presencial_model->alterarDadosPregao($dados, $id_pregao);

            redirect(base_url("cpainel/pregao_presencial/ver_todos/"));
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function desativar_pregao() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $id_pregao = $this->uri->segment(4);
            $dados = array(
                'status_pp' => '0',
            );
            $this->pregao_presencial_model->alterarDadosPregao($dados, $id_pregao);
            redirect(base_url("cpainel/pregao_presencial/ver_todos/"));
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function arquivar_pregao() {

        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {
            $id_pregao = $this->uri->segment(4);
            $dados = array(
                'status_pp' => '2',
            );
            $this->pregao_presencial_model->alterarDadosPregao($dados, $id_pregao);
            redirect(base_url("cpainel/pregao_presencial/ver_todos/"));
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function ativar_anexor() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $id_anexo = $this->uri->segment(4);

            $dados = array(
                'status_ap' => 1
            );

            $this->pregao_presencial_model->alterarDadosAnexo($dados, $id_anexo);

            redirect(base_url("cpainel/pregao_presencial/ver_todos/"));
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function desativar_anexor() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $id_anexo = $this->uri->segment(4);

            $dados = array(
                'status_ap' => 0
            );

            $this->pregao_presencial_model->alterarDadosAnexo($dados, $id_anexo);

            redirect(base_url("cpainel/pregao_presencial/ver_todos/"));
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function form_data_realizacao_pregao($id_pregao = NULL) {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {
            if ($id_pregao == NULL) {
                $id_pregao = $this->uri->segment(4);
            }
            $objeto_pregao = $this->pregao_presencial_model->obter_pregao($id_pregao)->result();

            if (count($objeto_pregao) == 0) {
                redirect(base_url("cpainel/pregao_presencial"));
                exit();
            }
            $dados = array(
                'id_pregao' => $id_pregao
            );


            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/pregao_presencial/forme_editar_data_realizacao_pregao_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function alterar_data_realizacao_pregao() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {
            $id_pregao = $this->input->post('id_pregao');
            $this->form_validation->set_rules('data_realizacao_pregao', 'Titulo', 'required|trim|min_length[5]');
            if ($this->form_validation->run() == FALSE) {
                $this->form_data_realizacao_pregao($id_pregao);
            } else {
                $data_realizacao_pregao = implode("-", array_reverse(explode("/", $this->input->post('data_realizacao_pregao'))));
                $dados = array(
                    'data_realizacao_pp' => $data_realizacao_pregao,
                );

                $this->pregao_presencial_model->alterarDadosPregao($dados, $id_pregao);
                redirect(base_url("cpainel/pregao_presencial/ver_todos/"));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

//put your code here
}

?>
