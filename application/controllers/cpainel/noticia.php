<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class noticia extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->library('session');
        $this->load->model('cpainel/noticia_model');
        $this->load->library('upload');
    }

    public function index() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {
            $this->session->unset_userdata('paginacao_noticia');
            $this->ver_todas();
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
                $links_paginacao = $links_paginacao . '<li class="active"><a href="#">' . $numPagina . '<span class="sr-only">(current)</span></a></li>';
            } else {
                $links_paginacao = $links_paginacao . '<li><a href="' . base_url("cpainel/noticia/ver_todas/$numPagina") . '" >' . $numPagina . '</a></li>';
            }
        }

        $links_paginacao = $links_paginacao . '</ul>';

        return $links_paginacao;
    }

    public function ver_todas() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $paginacao['total_de_registros'] = $this->noticia_model->ver_todas_noticias()->num_rows();
            $paginacao['qtde_Registros_por_pagina'] = 8;

            $paginacao['paramentro_paginacao'] = (int) $this->uri->segment(4);

            if (!$paginacao['paramentro_paginacao'] > 0) {
                if (!$this->session->userdata('paginacao_noticia')) {
                    $paginacao['paramentro_paginacao'] = 1;
                } else {
                    $paginacao['paramentro_paginacao'] = $this->session->userdata('paginacao_noticia');
                }
            }

            $this->session->set_userdata('paginacao_noticia', $paginacao['paramentro_paginacao']);

            $paginacao['numero_da_pagina'] = $paginacao['paramentro_paginacao'] - 1;
            $inicio = $paginacao['numero_da_pagina'] * $paginacao['qtde_Registros_por_pagina'];

            $links_paginacao = $this->gera_paginacao($paginacao);

            $dados = array(
                'noticia' => $this->noticia_model->ver_todas_noticias($paginacao['qtde_Registros_por_pagina'], $inicio)->result(),
                'paginacao' => $links_paginacao,
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/noticia/tabela_alterar_noticia_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function ver_todas_backup() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $paginacao['total_de_registros'] = $this->noticia_model->ver_todas_noticias()->num_rows();

            $paginacao['qtde_Registros_por_pagina'] = 2;

            $paginacao['qtde_Registros_por_pagina'];

            $numero_paginas = ceil($paginacao['total_de_registros'] / $paginacao['qtde_Registros_por_pagina']);

            $paramentro_paginacao = 1;

            if ((int) $this->uri->segment(4) > 0) {

                $paramentro_paginacao = $this->uri->segment(4);
                if ($paramentro_paginacao > $numero_paginas) {
                    $paramentro_paginacao = $numero_paginas;
                }
            }

            $paginacao['numero_da_pagina'] = $paramentro_paginacao - 1;

            $inicio = $paginacao['numero_da_pagina'] * $paginacao['qtde_Registros_por_pagina'];


            $links_paginacao = '<ul class="pagination">';

            for ($i = 0; $i < $numero_paginas; $i++) {

                $numPagina = $i + 1;

                if ($i == $paginacao['numero_da_pagina']) {
                    $links_paginacao = $links_paginacao . '<li class="active"><a href="#">' . $numPagina . '<span class="sr-only">(current)</span></a></li>';
                } else {
                    $links_paginacao = $links_paginacao . '<li><a href="' . base_url("cpainel/noticia/ver_todas/$numPagina") . '" >' . $numPagina . '</a></li>';
                }
            }

            $links_paginacao = $links_paginacao . '</ul>';



            $dados = array(
                'noticia' => $this->noticia_model->ver_todas_noticias($paginacao['qtde_Registros_por_pagina'], $inicio)->result(),
                'paginacao' => $links_paginacao,
            );


            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/noticia/tabela_alterar_noticia_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function nova() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/noticia/forme_criar_noticia_view');
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function criar_nova_noticia() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {
            $this->form_validation->set_rules('titulo_noticia', 'Titulo', 'required|trim|min_length[5]');

            if ($this->form_validation->run() == FALSE) {
                $this->nova();
            } else {

                $titulo_noticia = $this->input->post('titulo_noticia');
                $id_noticia = url_title($titulo_noticia);
                $dados = array(
                    'id_noticia' => $id_noticia,
                    'titulo_noticia' => ucfirst(strip_tags($titulo_noticia)),
                    'data_noticia' => date("Y-m-d"),
                    'ordem_noticia' => date('Y-m-d H:i:s')  // 2013-11-19 04:20:08
                );

                $this->noticia_model->salvarNovoNoticia($dados);

                redirect(base_url("cpainel/noticia/alterar_texto_noticia/" . $id_noticia));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function forme_editar_titulo_noticia() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {


            $id_noticia = $this->uri->segment(4);
            $titulo_noticia = $this->noticia_model->obter_noticia($id_noticia)->result();
            if (count($titulo_noticia) == 0) {
                redirect(base_url("cpainel/noticia"));
            } else {

                $dados = array(
                    'id_noticia' => $id_noticia,
                    'titulo_noticia' => $titulo_noticia
                );


                $this->load->view('cpainel/tela/titulo');
                $this->load->view('cpainel/tela/menu');
                $this->load->view('cpainel/noticia/forme_editar_titulo_noticia_view', $dados);
                $this->load->view('cpainel/tela/rodape');
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function alterar_titulo_noticia() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            $this->form_validation->set_rules('titulo_noticia', 'Titulo', 'required|trim|min_length[5]');
            $id_noticia = $this->input->post('id_noticia');

            if ($this->form_validation->run() == FALSE) {

                $titulo_noticia = $this->noticia_model->obter_noticia($id_noticia)->result();
                if (count($titulo_noticia) == 0) {
                    redirect(base_url("cpainel/noticia"));
                } else {

                    $dados = array(
                        'id_noticia' => $id_noticia,
                        'titulo_noticia' => $titulo_noticia
                    );


                    $this->load->view('tela/titulo');
                    $this->load->view('tela/menu');
                    $this->load->view('noticia/forme_editar_titulo_noticia_view', $dados);
                    $this->load->view('tela/rodape');
                }
            } else {



                $titulo_noticia = $this->input->post('titulo_noticia');

                $dados = array(
                    'titulo_noticia' => $titulo_noticia,
                );


                $this->noticia_model->alterarDadosNoticia($dados, $id_noticia);

                redirect(base_url("cpainel/noticia"));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function verTextoNoticia() {
        $id_noticia = $_POST['idNoticia'];
        $dados = array(
            'noticia' => $this->noticia_model->obter_noticia($id_noticia)->result()
        );

        $this->load->view('cpainel/noticia/verTextoNoticia_view', $dados);
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

    public function alterar_imagem_noticia($id_noticia = NULL, $erro_up = NULL) {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {

            if ($id_noticia == NULL) {
                $id_noticia = $this->uri->segment(4);
            }

            $query = $this->noticia_model->obter_noticia($id_noticia)->result();
            if (count($query) == 0) {
                redirect(base_url("cpainel/noticia/ver_todas"));
            } else {

                $dados = array(
                    'id_noticia' => $id_noticia,
                    'erro_upload' => $erro_up
                );

                $this->load->view('cpainel/tela/titulo');
                $this->load->view('cpainel/tela/menu');
                $this->load->view('cpainel/noticia/forme_editar_imagem_noticia_view', $dados);
                $this->load->view('cpainel/tela/rodape');
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
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

    public function salvar_imagem_noticia() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {


            $id_noticia = $this->input->post('id_noticia');

            $diretorio_imagem_noticia = 'imagem_noticia';

            if (!file_exists($diretorio_imagem_noticia)) {
                mkdir($diretorio_imagem_noticia);
            }
            $field_name = "imagem_noticia";

            $imagem = $_FILES['imagem_noticia'];

            $imagemExtecao = strtolower(end(explode('.', $imagem['name'])));

            $nome_imagem = md5(uniqid(time())) . "." . $imagemExtecao;


            $config['file_name'] = $nome_imagem;
            $config['upload_path'] = $diretorio_imagem_noticia; // server directory
            $config['allowed_types'] = 'jpg|jpeg|png'; // by extension, will check for whether it is an image
            $config['max_size'] = 1024 * 1024 * 2; // in kb
            $config['max_width'] = '2024';
            $config['max_height'] = '1468';


            $this->upload->initialize($config);

            $files = $this->upload->do_upload($field_name);

            if (!$files) {

                $erro_up = $this->upload->display_errors();

                $this->alterar_imagem_noticia($id_noticia, $erro_up);
            } else {

                $query = $this->noticia_model->obter_noticia($id_noticia)->result();

                foreach ($query as $q) {
                    if (file_exists("imagem_noticia/" . $q->imagem_noticia)) {
                        unlink("imagem_noticia/" . $q->imagem_noticia);
                    }
                }

                $dados = array(
                    'imagem_noticia' => $nome_imagem,
                );


                $this->noticia_model->alterarDadosNoticia($dados, $id_noticia);

                redirect(base_url("cpainel/noticia/ver_todas"));
            }
        } else {
            redirect(base_url('cpainel/seguranca'));
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
