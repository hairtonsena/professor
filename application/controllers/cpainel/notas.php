<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('cpainel/turma_model');
        $this->load->model('cpainel/aluno_model');
        $this->load->model('cpainel/avaliacao_model');
        date_default_timezone_set('UTC');
    }

    public function index() {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            if (!$this->input->get('turma', TRUE)) {
                redirect(base_url("cpainel/disciplina"));
            }

            $id_turma = $this->input->get('turma');

            if (count($turma_existe = $this->turma_model->obter_uma_turma($id_turma)->result()) == 0) {
                redirect(base_url("cpainel/disciplina"));
            }

            $turma_disciplina = $this->turma_model->obter_turma_disciplina($id_turma)->result();


            $alunos_por_turma = $this->turma_model->obter_todos_alunos_turma($id_turma)->result();
            $todas_avaliacoes = $this->avaliacao_model->obter_todas_avaliacoes_turma($id_turma)->result();


            $notas_aluno_avaliacao = $this->avaliacao_model->obter_notas_avaliacao($id_turma)->result();

            $dados = array(
                "turma_disciplina" => $turma_disciplina,
                "alunos_turma" => $alunos_por_turma,
                "avaliacoes_turma" => $todas_avaliacoes,
                "notas_aluno_avaliacao" => $notas_aluno_avaliacao
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/notas/notas_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    //Função para cadastrar um novo aluno
    public function alterar_notas($id_turma = NULL, $id_avaliacao = NULL) {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            if ($id_turma == null) {
                $id_turma = $this->input->get('turma');
                $id_avaliacao = $this->input->get('avaliacao');
            }

            $turma_disciplina = $this->turma_model->obter_turma_disciplina($id_turma)->result();
            $alunos_por_turma = $this->turma_model->obter_todos_alunos_turma($id_turma)->result();
            $todas_avaliacoes = $this->avaliacao_model->obter_todas_avaliacoes_turma($id_turma)->result();
            $notas_aluno_avaliacao = $this->avaliacao_model->obter_notas_avaliacao($id_turma)->result();

            $descricao_avaliacao='';
            foreach ($todas_avaliacoes as $ta){
                if($ta->id_avaliacao==$id_avaliacao){
                    $descricao_avaliacao = $ta->descricao_avaliacao;
                    break;
                }
            }
            
            
            $notas_avaliacoes = array();
            foreach ($notas_aluno_avaliacao as $naa) {
                $notas_avaliacoes[$naa->id_aluno][$naa->id_avaliacao] = $naa->valor_nota;
            }



            $campo_nota = array();

            foreach ($alunos_por_turma as $apt) {
                $valor_campo = 0;
                if(!empty($notas_avaliacoes[$apt->id_aluno][$id_avaliacao])){
                    $valor_campo = $notas_avaliacoes[$apt->id_aluno][$id_avaliacao];
                }
                
                
                $data = array(
                    'name' => 'aluno_' . $apt->id_aluno,
                    'id' => 'aluno_' . $apt->id_aluno,
                    'value' => $valor_campo,
                    'maxlength' => '20',
                    'size' => '50',
//                    'style' => 'width:50%',
                    'class' => 'form-control'
                );
                $campo_nota[$apt->id_aluno] = $data;
            }





            $dados = array(
                "turma_disciplina" => $turma_disciplina,
                "alunos_turma" => $alunos_por_turma,
            //    "avaliacoes_turma" => $todas_avaliacoes,
            //    "notas_aluno_avaliacao" => $notas_aluno_avaliacao,
                "campo_nota" => $campo_nota,
                "id_avaliacao" => $id_avaliacao,
                "descricao_avaliacao" => $descricao_avaliacao
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/notas/alterar_notas_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para salvar aluno
    public function salvar_nota_alunos() {
        // veirificando usuario logado
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {



            //           $this->form_validation->set_rules('nome_aluno', 'Nome', 'required|trim|min_length[4]|max_length[45]');
//            $this->form_validation->set_rules('matricula_aluno', 'Matricula', 'required|trim|min_length[2]|max_length[45]');
//            $this->form_validation->set_rules('cpf_aluno', 'CPF', 'required|trim|min_length[2]|max_length[45]');

            $id_turma = $this->input->post('turma');
            $id_avaliacao = $this->input->post('avaliacao');



//            if ($this->form_validation->run() == FALSE) {
//                 echo 'Ola';
//                $this->novo($id_turma);
//            } else {

            $alunos_por_turma = $this->turma_model->obter_todos_alunos_turma($id_turma)->result();
            foreach ($alunos_por_turma as $apt) {
                $input_name = 'aluno_' . $apt->id_aluno;
                $valor_nota_aluno = $this->input->post($input_name);

                $nota_exite = $this->avaliacao_model->verificar_nota_exite($id_avaliacao, $apt->id_aluno)->result();

                if (count($nota_exite) == 0) {
                    $dados = array(
                        "valor_nota" => $valor_nota_aluno,
                        "aluno_id_aluno" => $apt->id_aluno,
                        "avaliacao_id_avaliacao" => $id_avaliacao
                    );
                    $this->avaliacao_model->salvar_nota_avaliacao_aluno($dados);
                } else {

                    $dados = array(
                        "valor_nota" => $valor_nota_aluno
                    );
                    $this->avaliacao_model->alterando_nota_avaliacao_aluno($dados, $id_avaliacao, $apt->id_aluno);
                }

                //echo 'aluno: ' . $apt->nome_aluno . ' Nota: ' . $valor_nota_aluno . '<br/>';
            }


//                $this->aluno_model->salvar_aluno_turma($dados_aluno_turma);
//
//
            redirect(base_url("cpainel/notas?turma=" . $id_turma));
            // }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function obter_alunos_cadastrados() {
        // veirificando usuario logado
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $texto_pesquisa = $this->input->get('q');
            $id_turma = $this->input->get('turma');

            $todos_alunos = $this->aluno_model->obter_alunos_pesquisa_nome($texto_pesquisa)->result();
            $alunos_nao_adicionado = array();
            foreach ($todos_alunos as $ta) {
                if ($ta->turma_id_turma != $id_turma) {
                    $alunos_nao_adicionado[] = $ta;
                }
            }
            echo json_encode($alunos_nao_adicionado);
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Incluindo aluno existente em uma turma.
    public function add_aluno_turma() {
        $id_aluno = $this->input->post('aluno');
        $id_turma = $this->input->post('turma');

        $retorno = '0';

        $aluno_turma = $this->aluno_model->aluno_em_turma($id_aluno, $id_turma)->result();
        if (count($aluno_turma) != 0) {
            $retorno = "Aluno já está cadastrado!";
        } else {
            $dados = array(
                "aluno_id_aluno" => $id_aluno,
                "turma_id_turma" => $id_turma
            );
            $this->aluno_model->salvar_aluno_turma($dados);
            $retorno = '1';
        }
        echo $retorno;
    }

    // Função para excluir aluno da turma;
    public function excluir_aluno_turma() {
        // verificando usuario logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            $id_aluno = $this->input->post('aluno');
            $id_turma = $this->input->post('turma');

            $retorno = '';

            $query = $this->aluno_model->aluno_em_turma($id_aluno, $id_turma)->result();
            if (count($query) != 0) {
                $this->aluno_model->excluir_aluno_em_tuma($id_aluno, $id_turma);
                $retorno = '1';
            } else {
                $retorno = 'Aluno não foi encontrada nesta turma!';
            }

            echo $retorno;
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

//put your code here
}
