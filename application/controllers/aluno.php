<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class aluno extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('disciplina_model');
        $this->load->model('aluno_model');
        $this->load->model('turma_model');
        $this->load->model('avaliacao_model');
        $this->load->model('trabalho_model');
        date_default_timezone_set('UTC');
    }

    public function index() {
        redirect(base_url("aluno/disciplina_turma"));
    }

    public function disciplina_turma() {
        if (($this->session->userdata('id_aluno')) && ($this->session->userdata('nome_aluno')) && ($this->session->userdata('cpf_aluno')) && ($this->session->userdata('matricula_aluno')) && ($this->session->userdata('verificar_login') == 'cored.com')) {
            $id_aluno = $this->session->userdata('id_aluno');


            $disciplina_turma = $this->aluno_model->obter_disciplina_turma_aluno($id_aluno)->result();

            // Carregar o menu disciplina
            $disciplina_menu = $this->disciplina_model->ver_todas_disciplina_ativas()->result();
            $dados_menu = array(
                "munu_disciplina" => $disciplina_menu
            );



            $dados = array(
                "disciplina_turma" => $disciplina_turma,
            );

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu', $dados_menu);
            $this->load->view('painel_aluno/disciplina_turma_view', $dados);
            $this->load->view('tela/outros_view');
            $this->load->view('tela/rodape');
        } else {
            redirect(base_url());
        }
    }

    public function turma() {
        if (($this->session->userdata('id_aluno')) && ($this->session->userdata('nome_aluno')) && ($this->session->userdata('cpf_aluno')) && ($this->session->userdata('matricula_aluno')) && ($this->session->userdata('verificar_login') == 'cored.com')) {
            $id_turma = (int) mysql_real_escape_string($this->uri->segment(3));

            $id_aluno = $this->session->userdata('id_aluno');


            $disciplina_turma = $this->aluno_model->obter_turma_disciplina_aluno($id_turma,$id_aluno)->result(); //$this->aluno_model->obter_disciplina_turma_aluno($id_aluno)->result();
            if(count($disciplina_turma)==0){
                redirect(base_url());
            }

            // Carregar o menu disciplina
            $disciplina_menu = $this->disciplina_model->ver_todas_disciplina_ativas()->result();
            $dados_menu = array(
                "munu_disciplina" => $disciplina_menu
            );


            // Buscando todas avaliações da turma selecionada.
            $avaliacoes = $this->avaliacao_model->obter_todas_avaliacoes_turma($id_turma)->result();

            // Buscando todos os trabalhos da turma selecionada.
            $trabalhos = $this->trabalho_model->obter_todos_trabalhos_turma($id_turma)->result();
            foreach ($trabalhos as $trb) {
                $trb->anexos_trabalho = $this->trabalho_model->obeter_anexos_trabalho($trb->id_trabalho)->result();
                $trb->trabalho_aluno = $this->trabalho_model->obeter_aluno_trabalho($id_aluno, $trb->id_trabalho)->result();
            }


            $dados = array(
                "disciplina_turma" => $disciplina_turma,
                "avaliacoes_turma" => $avaliacoes,
                "trabalhos_turma" => $trabalhos
            );

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu', $dados_menu);
            $this->load->view('painel_aluno/turma_view', $dados);
            $this->load->view('tela/outros_view');
            $this->load->view('tela/rodape');
        } else {
            redirect(base_url());
        }
    }

    public function salvar_trabalho_aluno() {
        if (($this->session->userdata('id_aluno')) && ($this->session->userdata('nome_aluno')) && ($this->session->userdata('cpf_aluno')) && ($this->session->userdata('matricula_aluno')) && ($this->session->userdata('verificar_login') == 'cored.com')) {
            $id_aluno = $this->session->userdata('id_aluno');
            $id_trabalho = $this->input->post('trabalho');


            $trabalho = $this->trabalho_model->obter_um_trabalho($id_trabalho)->result();
            $pasta;
            if (count($trabalho) > 0) {
                foreach ($trabalho as $tr) {
                    $pasta = $tr->pasta_upload_trabalho;
                }
            }

            $diretorio_anexo = 'trabalho/' . $pasta . "/";

            $field_name = "arquivo";

            $nome_arquivo = $_FILES[$field_name]['name'];


            $config['remove_spaces'] = TRUE;
            $config['overwrite'] = FALSE;
            $config['file_name'] = $nome_arquivo;
            $config['upload_path'] = $diretorio_anexo; // server directory
            $config['allowed_types'] = 'pdf'; // by extension, will check for whether it is an image
            $config['max_size'] = 1024 * 10; // in kb -> total 10MB
            $config['is_image'] = 0;

            $this->upload->initialize($config);

            $files = $this->upload->do_upload($field_name);

            if (!$files) {

                $error = $this->upload->display_errors('<div class="alert alert-danger">', '<div>');
                echo $error;
            } else {
                $dadosImagem = $this->upload->data();

                $trabalho_aluno = $this->trabalho_model->obeter_aluno_trabalho($id_aluno, $id_trabalho)->result();

                if (count($trabalho_aluno) == 0) {
                    $dados = array(
                        'nome_arquivo_trabalho_aluno' => $dadosImagem['file_name'],
                        'data_envio_trabalho_aluno' => date("Y-m-d"),
                        'hora_envio_trabalho_aluno' => date("H:i:s"),
                        'aluno_id_aluno' => $id_aluno,
                        'trabalho_id_trabalho' => $id_trabalho
                    );

                    $this->trabalho_model->salvar_trabalho_aluno($dados);
                } else {
                    $arquivo_antigo = '';
                    foreach ($trabalho_aluno as $ta) {
                        $arquivo_antigo = $ta->nome_arquivo_trabalho_aluno;
                    }
                    if (file_exists("trabalho/" . $pasta . "/" . $arquivo_antigo)) {
                        unlink("trabalho/" . $pasta . "/" . $arquivo_antigo);
                    }


                    $dados = array(
                        'nome_arquivo_trabalho_aluno' => $dadosImagem['file_name'],
                        'data_envio_trabalho_aluno' => date("Y-m-d"),
                        'hora_envio_trabalho_aluno' => date("H:i:s"),
                    );


                    $this->trabalho_model->alterar_trabalho_aluno($dados, $id_aluno, $id_trabalho);
                }

                echo "sucesso";
            }
        } else {
            redirect(base_url());
        }
    }

    // Função para pegar trablho do aluno;
    public function obter_trabalho_aluno_json() {
        // veirificando usuario logado
        if (($this->session->userdata('id_aluno')) && ($this->session->userdata('nome_aluno')) && ($this->session->userdata('cpf_aluno')) && ($this->session->userdata('matricula_aluno')) && ($this->session->userdata('verificar_login') == 'cored.com')) {

            $id_aluno = $this->session->userdata('id_aluno');
            $id_trabalho = $this->input->get('trabalho');

            $trabalho_aluno = $this->trabalho_model->obeter_trabalho_aluno($id_trabalho,$id_aluno)->result();

            $trabalho = array();
            foreach ($trabalho_aluno as $ta) {
                $trabalho[] = $ta;
            }
            echo json_encode($trabalho);
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

}
