<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class disciplina extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('cpainel/disciplina_model');
        $this->load->library('upload');
        date_default_timezone_set('UTC');
    }

    public function index() {

        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $todosCategoria = $this->disciplina_model->ver_todas_disciplina()->result();

            $dados = array(
                'disciplina' => $todosCategoria,
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/disciplina/disciplina_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // visualizando apenas a descrição de uma disciplina
    public function ver_descricao_disciplina() {
        // verificando usuario logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            // pagena id da disciplina
            $id_disciplina = $this->input->post('disciplina');
            // variavel para retornar resultado para o ajax;
            $retorno = '';
            // buscando no banco de dados a diciplina que será que tem a descrição
            $query = $this->disciplina_model->obter_uma_disciplina($id_disciplina)->result();
            // verificando se a disciplina existe;
            if (count($query) != 0) {
                // se existe então percorra a lista para pegar a descriçõa;
                foreach ($query as $qy) {
                    // pegando a descrição
                    $retorno = $qy->descricao_disciplina;
                    // finalizando o loop
                    break;
                }
            } else {
                $retorno = 'Disciplina não foi encontrada!';
            }
            // retorna o resultado para o ajax;
            echo $retorno;
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function nova_disciplina() {
        // verificando usuario logado
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/disciplina/forme_nova_disciplina_view');
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function salvar_nova_disciplina() {
        // veirificando usuario logado
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            // validando campo nome
            $this->form_validation->set_rules('nome_disciplina', 'Nome', 'required|trim|min_length[5]|max_length[45]');
            // testando validação
            if ($this->form_validation->run() == FALSE) {
                // rotornando para o fomulário com erros.
                $this->nova_disciplina();
            } else {
                // pagando o campo nome da nova disciplina
                $nome_disciplina = $this->input->post("nome_disciplina");
                // pegando a descrição da nova disciplina
                $descricao_disciplina = $this->input->post('descricao_disciplina');
                // criando array de dados
                $dados = array(
                    "nome_disciplina" => $nome_disciplina,
                    "descricao_disciplina" => $descricao_disciplina,
                    "status_disciplina" => 1
                );
                // enviando os dados para ser salvos 
                $this->disciplina_model->salvar_nova_disciplina($dados);
                // redirecionando para disciplina
                redirect(base_url("cpainel/disciplina"));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // função para ativar e desativar disciplina
    public function ativar_desativar_disciplina() {
        // verificando usuário logado
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            // variavel para retorno
            $reterno = '';
            // pegando o id da disciplina para ser alterado
            $disciplina = $this->input->post('disciplina');
            // buscado a disciplina pelo id no banco de dados
            $query = $this->disciplina_model->obter_uma_disciplina($disciplina)->result();
            // verificando se a disciplina existe
            if (count($query) > 0) {
                // se existe percorra a lista;
                foreach ($query as $qr) {
                    // verificando se a disciplina está dessativada
                    if ($qr->status_disciplina == 0) {
                        // então ativa
                        $dados = array(
                            'status_disciplina' => 1
                        );
                        $reterno = '1';
                    } else {
                        // se não desativa
                        $dados = array(
                            'status_disciplina' => 0
                        );
                        $reterno = '0';
                    }
                    // enviando os dados alterados
                    $this->disciplina_model->alterar_dados_disciplina($dados, $disciplina);
                }
            }
            // retonando o resultado para o ajax
            echo $reterno;
        } else {
            //redirect(base_url("cpainel/seguranca"));
        }
    }

    public function alterar_disciplina($id_disciplina = NULL) {
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            if ($id_disciplina == NULL) {
                $id_disciplina = $this->uri->segment(4);
            }
            $query = $this->disciplina_model->obter_uma_disciplina($id_disciplina)->result();

            if (count($query) == 0) {
                redirect(base_url("cpainel/disciplina"));
            }
            $dados = array(
                'id_disciplina' => $id_disciplina,
                'disciplina' => $query
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/disciplina/forme_editar_disciplina_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function salvar_disciplina_alterada() {
        // verificando usuario logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            // funçõa do codeigniter para validar campos do formulário de disciplina.
            $this->form_validation->set_rules('nome_disciplina', 'Nome', 'required|trim|min_length[5]');
            //pegando o id da disciplina que será alterada
            $id_disciplina = $this->input->post('id_disciplina');
            // verificando se a validação foi aceita.
            if ($this->form_validation->run() == FALSE) {
                // se a validação não passou retorne para o formulário de alteração com a mensagem de erro.
                $this->alterar_disciplina($id_disciplina);
            } else {
                // pegando o nome da disciplina que veio do formulário alterar
                $nome_disciplina = $this->input->post('nome_disciplina');
                // pegando a descrição da disciplina que veio do formulário alterar
                $descricao_disciplina = $this->input->post('descricao_disciplina');
                // criando um array de dados para salvar a alteração no banco.
                $dados = array(
                    'nome_disciplina' => $nome_disciplina,
                    'descricao_disciplina' => $descricao_disciplina
                );
                // enviando os dados alterados para o banco de dados.
                $this->disciplina_model->alterar_dados_disciplina($dados, $id_disciplina);
                redirect(base_url("cpainel/disciplina/"));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // função para excluir um diciplina pelo id;
    public function excluir_disciplina() {
        // verificando usuario logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            // pagena id da disciplina que cerá excluida
            $id_disciplina = $this->input->post('disciplina');
            // variavel para retornar resultado para o ajax;
            $retorno = '';
            // buscando no banco de dados a diciplina que será excluida
            $query = $this->disciplina_model->obter_uma_disciplina($id_disciplina)->result();
            // verificando se a disciplina existe;
            if (count($query) != 0) {
                // se existe manda excluir
                $this->disciplina_model->excluir_disciplina($id_disciplina);
                $retorno = '1';
            } else {
                $retorno = 'Disciplina não foi encontrada!';
            }
            // retorna o resultado para o ajax;
            echo $retorno;
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    //----------------------------------------//
    // Area para manipulação de subcategoria -//
    //----------------------------------------//

    public function ativar_desativar_subcategoria() {
        if (($this->session->userdata('id_admin')) && ($this->session->userdata('nome_admin')) && ($this->session->userdata('email_admin')) && ($this->session->userdata('senha_admin'))) {
            $reterno = '';
            $subcategoria = $this->input->post('subcategoria');
            $query = $this->categoria_model->obter_subcategoria($subcategoria)->result();
            if (count($query) > 0) {
                foreach ($query as $qr) {
                    if ($qr->status_sub_categoria == 0) {
                        $dados = array(
                            'status_sub_categoria' => 1
                        );
                        $reterno = '1';
                    } else {
                        $dados = array(
                            'status_sub_categoria' => 0
                        );
                        $reterno = '0';
                    }
                    $this->categoria_model->alterar_dados_subcategoria($dados, $subcategoria);
                }
            }
            echo $reterno;
        } else {
            //redirect(base_url("cpainel/seguranca"));
            echo 'ola';
        }
    }

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
                $this->nova_subcategoria($categoria);
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

    public function salvar_subcategoria_alterada() {
        if (($this->session->userdata('id_admin')) && ($this->session->userdata('nome_admin')) && ($this->session->userdata('email_admin')) && ($this->session->userdata('senha_admin'))) {

            $this->form_validation->set_rules('nome_subcategoria', 'Nome', 'required|trim|min_length[5]');
            $id_subcategoria = $this->input->post('id_subcategoria');
            if ($this->form_validation->run() == FALSE) {
                $this->alterar_subcategoria($id_subcategoria);
            } else {

                $nome_subcategoria = $this->input->post('nome_subcategoria');
                $dados = array(
                    'nome_sub_categoria' => $nome_subcategoria,
                );
                $this->categoria_model->alterar_dados_subcategoria($dados, $id_subcategoria);

                $query = $this->categoria_model->obter_subcategoria($id_subcategoria)->result();

                $id_categoria;
                foreach ($query as $qy) {
                    $id_categoria = $qy->id_categoria;
                };

                redirect(base_url("cpainel/categoria/subcategoria/" . $id_categoria));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function excluir_subcategoria() {
        if (($this->session->userdata('id_admin')) && ($this->session->userdata('nome_admin')) && ($this->session->userdata('email_admin')) && ($this->session->userdata('senha_admin'))) {
            $id_subcategoria = $this->input->post('subcategoria');
            $this->categoria_model->excluir_subcategoria($id_subcategoria);

            echo '1';
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // obter subcategoria por json
    public function ober_subcategoria_json() {

        if (($this->session->userdata('id_admin')) && ($this->session->userdata('nome_admin')) && ($this->session->userdata('email_admin')) && ($this->session->userdata('senha_admin'))) {

            $id_categoria = $this->input->get('categoria');
            $query = $this->categoria_model->obter_subcategorias_de_categoria($id_categoria)->result();



            echo json_encode($query);
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

}

?>
