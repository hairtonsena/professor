<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class avaliacao extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->library('session');
        $this->load->model('cpainel/turma_model');
        $this->load->model('cpainel/avaliacao_model');
    }

    public function index() {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            $id_turma = $this->input->get('turma');


            $query = $this->turma_model->obter_turma_disciplina($id_turma)->result();
            $avaliacao_por_turma = $this->avaliacao_model->obter_todas_avaliacoes_turma($id_turma)->result();


            $dados = array(
                "turma_disciplina" => $query,
                "avaliacoes_turma" => $avaliacao_por_turma
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/avaliacao/avaliacao_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function nova($id_turma = NULL) {
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
            $this->load->view('cpainel/avaliacao/forme_nova_avaliacao_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function salvar_nova_avaliacao() {
        // veirificando usuario logado
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $this->form_validation->set_rules('descricao_avaliacao', 'Descrição', 'required|trim|min_length[4]|max_length[45]');
            $this->form_validation->set_rules('data_avaliacao', 'Data', 'required|trim|min_length[2]|max_length[45]');
            $this->form_validation->set_rules('valor_avaliacao', 'CPF', 'required|trim|min_length[0]|max_length[45]');

            $id_turma = $this->input->post('turma');

            if ($this->form_validation->run() == FALSE) {
                $this->nova($id_turma);
            } else {

                $descricao_avaliacao = $this->input->post('descricao_avaliacao');
                $data_avaliacao = $this->input->post('data_avaliacao');
                $valor_avaliacao = $this->input->post('valor_avaliacao');

                $dados = array(
                    "descricao_avaliacao" => $descricao_avaliacao,
                    "data_avaliacao" => $data_avaliacao,
                    "valor_avaliacao" => $valor_avaliacao,
                    "turma_id_turma" => $id_turma
                );

                $this->avaliacao_model->salvar_nova_avaliacao($dados);

                redirect(base_url("cpainel/avaliacao?turma=" . $id_turma));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function alterar_texto_noticia() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $noticia = $this->noticia_model->obter_noticia($this->uri->segment(4))->result();

            if (count($noticia) == 0) {
                redirect(base_url("cpainel/noticia/ver_todas"));
            } else {

                $dados = array(
                    'id_noticia' => $this->uri->segment(4),
                    'texto_noticia' => $noticia,
                );

                $this->load->view('cpainel/tela/titulo');
                $this->load->view('cpainel/tela/menu');
                $this->load->view('cpainel/noticia/forme_editar_texto_noticia_view', $dados);
                $this->load->view('cpainel/tela/rodape');
            }
        } else {
            redirect(base_url('cpainel/seguranca'));
        }
    }

    public function salvar_texto_noticia() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $id_noticia = $this->input->post('id_noticia');
            $texto_noticia = $this->input->post('texto_noticia');

            $dados = array(
                'texto_noticia' => $texto_noticia,
            );

            $this->noticia_model->alterarDadosNoticia($dados, $id_noticia);

            $query = $this->noticia_model->obter_noticia($id_noticia)->result();
            if (count($query) > 0) {
                foreach ($query as $qr) {
                    if ($qr->imagem_noticia == NULL) {
                        redirect(base_url("cpainel/noticia/alterar_imagem_noticia/" . $id_noticia));
                    } else {
                        redirect(base_url("cpainel/noticia/ver_todas/"));
                    }
                }
            }
            redirect(base_url("cpainel/noticia/ver_todas/"));
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function ativar_noticia() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $id_noticia = $this->uri->segment(4);

            $dados = array(
                'status_noticia' => '1',
            );

            $this->noticia_model->alterarDadosNoticia($dados, $id_noticia);

            redirect(base_url("cpainel/noticia/ver_todas"));
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function desativar_noticia() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $id_noticia = $this->uri->segment(4);

            $dados = array(
                'status_noticia' => '0',
            );

            $this->noticia_model->alterarDadosNoticia($dados, $id_noticia);

            redirect(base_url("cpainel/noticia/ver_todas"));
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function ativar_destaque() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $id_noticia = $this->uri->segment(4);

            $dados = array(
                'destaque_noticia' => '1',
            );

            $this->noticia_model->alterarDadosNoticia($dados, $id_noticia);

            redirect(base_url("cpainel/noticia/ver_todas"));
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function desativar_destaque() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $id_noticia = $this->uri->segment(4);

            $dados = array(
                'destaque_noticia' => '0',
            );

            $this->noticia_model->alterarDadosNoticia($dados, $id_noticia);

            redirect(base_url("cpainel/noticia/ver_todas"));
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function excluir_noticia() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $id_noticia = $this->uri->segment(4);

            $query = $this->noticia_model->obter_noticia($id_noticia)->result();

            foreach ($query as $qr) {
                if (file_exists("imagem_noticia/" . $qr->imagem_noticia)) {
                    unlink("imagem_noticia/" . $qr->imagem_noticia);
                }
            }

            $this->noticia_model->excluirNoticia($id_noticia);
            redirect(base_url("cpainel/noticia/ver_todas"));
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function criar_slide() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {
            $dados = array();
            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/noticia/forme_criar_slide_noticia_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function slides() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $path = "slides_noticia/";
            $diretorio = dir($path);

            $dados = array(
                'path' => $path,
                'diretorio' => $diretorio
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/noticia/tabela_slides_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function gerar_novo_slide() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $tituloSlide = url_title(filter_input(INPUT_POST, 'titulo_slide'));
            $urlImagem = $_POST['url_imagem'];

            if (($tituloSlide == '') || (strlen($tituloSlide) < 4)) {
                redirect(base_url("cpainel/noticia/criar_slide"));
                exit();
            }

            if (count($urlImagem) < 1) {
                redirect(base_url("cpainel/noticia/criar_slide"));
                exit();
            }

            $diretorio = "slides_noticia/";

            if (!file_exists($diretorio)) {
                mkdir($diretorio, 0777);
            }

            $arquivo = 'slide_' . $tituloSlide . "_" . rand(10, 99999) . ".html";

            $fp = fopen($diretorio . $arquivo, "a");

            $conteudo = '<!DOCTYPE html>
<html>
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="../lib/dist/slippry.min.js"></script>
        <link rel="stylesheet" href="../lib/dist/slippry.css">
    </head>
    <body>		
        <section class="demo_wrapper">
            <article class="demo_block">
                <ul id="demo1">';

            foreach ($urlImagem as $ui) {
                $conteudo = $conteudo . '<li><a href = "#"><img src = "' . $ui . '" /></a></li>';
            }

            $conteudo = $conteudo . '                     
                </ul>
            </article>
        </section>		
        <script>
            $(function() {
                var demo1 = $("#demo1").slippry({
                    transition: \'fade\',
                    useCSS: true,
                    speed: 1000,
                    pause: 4000,
                    auto: true,
                    preload: \'visible\'
                });
            });
        </script>
    </body>
</html>';

            $escreve = fwrite($fp, $conteudo);
            fclose($fp);

            $dados = array(
                'diretorio' => $diretorio,
                'arquivo' => $arquivo
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/noticia/visualizar_url_slides_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function excluir_slide() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $nome_arquivo = $this->uri->segment(4);
            if (strlen($nome_arquivo) > 5) {
                $path = 'slides_noticia/';
                if (unlink($path . $nome_arquivo)) {
                    redirect(base_url("cpainel/noticia/slides"));
                } else {
                    echo "Erro ao tentar excluir arquivo";
                };
            } else {
                redirect(base_url("cpainel/noticia/slides"));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

}

?>
