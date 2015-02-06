<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Noticia extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('UTC');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->database();
        $this->load->library('form_validation');

        $this->load->model('cpainel/noticia_model');

        $this->load->library('upload');

        $this->load->library('canvas');
    }

    public function index() {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $noticias = $this->noticia_model->obter_todos_noticias()->result();

            $dados = array(
                "todas_noticias" => $noticias
            );



            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/noticia/noticia_view', $dados);

            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    //Função para exibir o formulário cadastrar uma nova noticia.
    public function nova() {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/noticia/forme_nova_noticia_view');
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para salvar uma nova notícia.
    public function salvar_nova_noticia() {
        // veirificando usuario logado
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $this->form_validation->set_rules('titulo_noticia', 'Titulo', 'required|trim|min_length[3]|max_length[120]');
            $this->form_validation->set_rules('data_noticia', 'Data', 'required|trim|min_length[5]|max_length[10]');
            $this->form_validation->set_rules('conteudo_noticia', 'Notícia', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->nova();
            } else {

                $titulo_noticia = $this->input->post('titulo_noticia');

                $url_noticia = url_title($this->tiraAcento($titulo_noticia));

                // Tratando a url_notícia para sempre ser diferente.
                $temp = $url_noticia;
                $contador = 0;
                while (count($this->noticia_model->obter_noticia_por_url($url_noticia)->result()) > 0) {
                    $contador ++;
                    $url_noticia = $temp . "_" . $contador;
                }
                // Fim do tratamento.



                $data_noticia = $this->input->post('data_noticia');
                $conteudo_noticia = $this->input->post('conteudo_noticia');


                $dados = array(
                    "titulo_noticia" => $titulo_noticia,
                    "url_noticia" => $url_noticia,
                    "data_noticia" => implode("-", array_reverse(explode("/", $data_noticia))),
                    "conteudo_noticia" => $conteudo_noticia,
                    "status_noticia" => 0
                );

                $this->noticia_model->salvar_nova_noticia($dados);
                redirect(base_url("cpainel/noticia"));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para retirar os caractere especias de uma string.
    protected function tiraAcento($str) {
        return strtr(utf8_decode($str), utf8_decode('ŠŒŽšœžŸ¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ'), 'SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy');
    }

    //Função para exibir o formulário de alterar noticias.
    public function alterar($id_noticia = null) {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            if ($id_noticia == null) {
                $id_noticia = $this->uri->segment(4);
            }
            $noticia = $this->noticia_model->obter_noticia_por_id($id_noticia)->result();
            if (count($noticia) == 0) {
                redirect(base_url("cpainel/noticia"));
            }

            $dados = array(
                "noticia" => $noticia
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/noticia/forme_alterar_noticia_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para salvar aluno e adicionar em uma turma.
    public function salvar_noticia_alterada() {
        // veirificando usuario logado
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $this->form_validation->set_rules('titulo_noticia', 'Titulo', 'required|trim|min_length[3]|max_length[120]');
            $this->form_validation->set_rules('data_noticia', 'Data', 'required|trim|min_length[5]|max_length[10]');
            $this->form_validation->set_rules('conteudo_noticia', 'Notícia', 'required');

            $id_noticia = $this->input->post('noticia');

            if ($this->form_validation->run() == FALSE) {
                $this->alterar($id_noticia);
            } else {

                $titulo_noticia = $this->input->post('titulo_noticia');

                // Função para retirar os acentos das pelavras
                $url_noticia = url_title($this->tiraAcento($titulo_noticia));

                // Tratando a url_notícia para sempre ser diferente.
                $temp = $url_noticia;
                $contador = 0;
                while (count($this->noticia_model->obter_noticia_por_url($url_noticia)->result()) > 0) {
                    $contador ++;
                    $url_noticia = $temp . "_" . $contador;
                }
                // Fim do tratamento.



                $data_noticia = $this->input->post('data_noticia');


                $conteudo_noticia = $this->input->post('conteudo_noticia');


                $dados = array(
                    "titulo_noticia" => $titulo_noticia,
                    "url_noticia" => $url_noticia,
                    "data_noticia" => implode("-", array_reverse(explode("/", $data_noticia))),
                    "conteudo_noticia" => $conteudo_noticia,
                );


                $this->noticia_model->alterar_dados_noticia($dados, $id_noticia);

                redirect(base_url("cpainel/noticia"));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para retornar o conteudo da notíciar por ajax
    public function ver_conteudo_noticia_ajax() {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $id_noticia = $this->input->post("noticia");
            $retorno = '';


            $noticia = $this->noticia_model->obter_noticia_por_id($id_noticia)->result();
            if (count($noticia) == 0) {
                $retorno = "Erro a acessar esta pagina";
            } else {
                foreach ($noticia as $nt) {
                    $retorno = $nt->conteudo_noticia;
                }
            }

            echo $retorno;
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function alterar_imagem_mini($id_noticia = NULL) {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            if ($id_noticia == null) {
                $id_noticia = $this->uri->segment(4);
            }


            $noticia = $this->noticia_model->obter_noticia_por_id($id_noticia)->result();
            if (count($noticia) == 0) {
                redirect(base_url("cpainel/noticia"));
            }

            $dados = array(
                "noticia" => $noticia
            );


            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/noticia/forme_alterar_imagem_mini_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para salvar as imagem mini das notícias
    public function salvar_imagem_mini_noticia_ajax() {
        // verificando usuario logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $id_noticia = $this->input->post('noticia');

            $noticia = $this->noticia_model->obter_noticia_por_id($id_noticia)->result();

            if (count($noticia) == 0) {
                echo "erro";
                exit();
            }
            $pasta = "noticia/imagem_mini/";
            $diretorio_anexo = $pasta;

            $field_name = "arquivo";

            $nome_arquivo = $_FILES[$field_name]['name'];


            $config['remove_spaces'] = TRUE;
            $config['overwrite'] = FALSE;
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $diretorio_anexo; // server directory
            $config['allowed_types'] = 'png|jpg|jpeg'; // by extension, will check for whether it is an image
            $config['max_size'] = 1024 * 1024 * 10; // in kb -> total 10MB
            $config['is_image'] = 1;

            $this->upload->initialize($config);

            $files = $this->upload->do_upload($field_name);

            if (!$files) {

                $error = $this->upload->display_errors('<div class="alert alert-danger">', '<div>');

                echo $error;
            } else {
                $dadosImagem = $this->upload->data();

                $imagem_mini = $this->redimencionar_imagem($pasta, $dadosImagem['file_name']);

                // Excluindo a imagem antiga.
                foreach ($noticia as $nt) {
                    if ($nt->imagem_mini_noticia != null) {
                        $arquivo = $pasta . $nt->imagem_mini_noticia;
                        if (is_file($arquivo))
                            unlink($arquivo);
                    }
                }


                $dados = array(
                    'imagem_mini_noticia' => $imagem_mini,
                );

                $this->noticia_model->alterar_dados_noticia($dados, $id_noticia);
                echo "sucesso";
            }
        } else {
            echo "Acesso negado";
        }
    }

    public function obter_imagem_noticia_ajax() {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $id_noticia = $this->input->post("noticia");

            $retorno = "";

            $noticia = $this->noticia_model->obter_noticia_por_id($id_noticia)->result();
            if (count($noticia) == 0) {
                $retorno = "Notícia não encontrada.";
            } else {
                foreach ($noticia as $nt) {
                    if ($nt->imagem_mini_noticia != NULL) {
                        $arquivo = "noticia/imagem_mini/" . $nt->imagem_mini_noticia;
                        $retorno = "<img src='" . base_url($arquivo) . "' />";
                    }
                }

                //  $retorno = "1";
            }

            echo $retorno;
        } else {
            echo "Acesso negado!";
        }
    }

    // Função para excluir uma notícia. Requisição AJAX.
    public function excluir_noticia() {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $id_noticia = $this->input->post("noticia");

            $retorno;

            $noticia = $this->noticia_model->obter_noticia_por_id($id_noticia)->result();
            if (count($noticia) == 0) {
                $retorno = "Notícia não encontrada.";
            } else {
                foreach ($noticia as $nt) {
                    if ($nt->imagem_mini_noticia != NULL) {
                        $arquivo = "noticia/imagem_mini/" . $nt->imagem_mini_noticia;
                        if (is_file($arquivo)) {
                            unlink($arquivo);
                        }
                    }
                }

                $this->noticia_model->excluir_noticia($id_noticia);

                $retorno = "1";
            }

            echo $retorno;
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para excluir a imagem de capa da notícia. Requisiçõa AJAX.
    public function excluir_imagem_mini_noticia() {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $id_noticia = $this->input->post("noticia");

            $retorno;

            $noticia = $this->noticia_model->obter_noticia_por_id($id_noticia)->result();
            if (count($noticia) == 0) {
                $retorno = "Notícia não encontrada.";
            } else {
                foreach ($noticia as $nt) {
                    if ($nt->imagem_mini_noticia != NULL) {
                        $arquivo = "noticia/imagem_mini/" . $nt->imagem_mini_noticia;
                        if (is_file($arquivo)) {
                            unlink($arquivo);
                        }
                    }
                }

                $dados = array(
                    "imagem_mini_noticia" => NULL,
                );
                $this->noticia_model->alterar_dados_noticia($dados, $id_noticia);

                $retorno = "1";
            }

            echo $retorno;
        } else {
            echo "Acesso negado!";
        }
    }

    function redimencionar_imagem($pasta, $imag) {

        $origem_imagem = $pasta . $imag;
        $nome_nova_imagem = 'mini_' . $imag;
        $destino_imagem = $pasta . $nome_nova_imagem;

        $img = new canvas();
        $img->carrega($origem_imagem)
                ->redimensiona(200, 150, 'crop')
                ->grava($destino_imagem, 100);

        if (is_file($origem_imagem))
            unlink($origem_imagem);

        return $nome_nova_imagem;
    }

    // Função para ativar e desativar aluno. Requisição AJAX.
    public function ativar_desativar_noticia() {
        // verificando usuario logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            $id_noticia = $this->input->post('noticia');

            $retorno = '';

            $noticia = $this->noticia_model->obter_noticia_por_id($id_noticia)->result();
            if (count($noticia) != 0) {
                foreach ($noticia as $nt) {
                    if ($nt->status_noticia == 0) {
                        $dados = array(
                            "status_noticia" => 1,
                        );

                        $this->noticia_model->alterar_dados_noticia($dados, $id_noticia);

                        $retorno = '1';
                    } else {
                        $dados = array(
                            "status_noticia" => 0,
                        );
                        $this->noticia_model->alterar_dados_noticia($dados, $id_noticia);
                        $retorno = '0';
                    }
                }
            } else {
                $retorno = 'A notícia não foi encontrada!';
            }

            echo $retorno;
        } else {
            echo "Acesso negado!";
        }
    }

}

?>