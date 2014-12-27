<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trabalho extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->library('session');
        $this->load->model('cpainel/turma_model');
        $this->load->model('cpainel/trabalho_model');
    }

    public function index() {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            $id_turma = $this->input->get('turma');

            $turma_disciplina = $this->turma_model->obter_turma_disciplina($id_turma)->result();
            $trabalho_por_turma = $this->trabalho_model->obter_todos_trabalhos_turma($id_turma)->result();


            $dados = array(
                "turma_disciplina" => $turma_disciplina,
                "trabalhos_turma" => $trabalho_por_turma
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/trabalho/trabalho_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function novo($id_turma = NULL) {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            if ($id_turma == null) {
                $id_turma = $this->uri->segment(4);
            }
            $turma_disciplina = $this->turma_model->obter_turma_disciplina($id_turma)->result();

            $dados = array(
                "turma_disciplina" => $turma_disciplina
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/trabalho/forme_novo_trabalho_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function salvar_novo_trabalho() {
        // veirificando usuario logado
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            $this->form_validation->set_rules('titulo_trabalho', 'Titulo', 'required|trim|min_length[4]|max_length[45]');
            $this->form_validation->set_rules('descricao_trabalho', 'Descrição', 'required|trim|min_length[4]');
            $this->form_validation->set_rules('data_entrega_trabalho', 'Data entrega', 'required|trim|min_length[2]|max_length[45]');
            $this->form_validation->set_rules('valor_trabalho', 'Valor nota', 'required|trim|min_length[0]|max_length[45]');

            $id_turma = $this->input->post('turma');

            if ($this->form_validation->run() == FALSE) {
                $this->novo($id_turma);
            } else {

                $titulo_trabalho = $this->input->post('titulo_trabalho');
                $descricao_trabalho = $this->input->post('descricao_trabalho');
                $data_entrega_trabalho = $this->input->post('data_entrega_trabalho');
                $valor_nota_trabalho = $this->input->post('valor_trabalho');

                $dados = array(
                    "titulo_trabalho" => $titulo_trabalho,
                    "descricao_trabalho" => $descricao_trabalho,
                    "data_entrega_trabalho" => $data_entrega_trabalho,
                    "valor_nota_trabalho" => $valor_nota_trabalho,
                    "turma_id_turma" => $id_turma
                );

                $this->trabalho_model->salvar_novo_trabalho($dados);

                redirect(base_url("cpainel/trabalho?turma=" . $id_turma));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

}

?>
