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
        $this->load->model('cpainel/trabalho_model');
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

    // Função para casdastrar um nava avaliação.
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
            $this->form_validation->set_rules('valor_avaliacao', 'Valor', 'required|trim|min_length[0]|max_length[45]|callback_varificar_total_notas_distribuidas_check');

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

    public function varificar_total_notas_distribuidas_check($valor_nota_campo = NULL) {
        if ($valor_nota_campo == NULL)
            exit();
        $total_pontos_ja_distribuidos = 0;

        if ($this->input->post('turma', TRUE)) {
            $id_turma = $this->input->post('turma');

            $trabalho_por_turma = $this->trabalho_model->obter_todos_trabalhos_turma($id_turma)->result();
            $avaliacao_por_turma = $this->avaliacao_model->obter_todas_avaliacoes_turma($id_turma)->result();
            foreach ($trabalho_por_turma as $tpt) {
                $total_pontos_ja_distribuidos += $tpt->valor_nota_trabalho;
            }
            foreach ($avaliacao_por_turma as $apt) {
                $total_pontos_ja_distribuidos += $apt->valor_avaliacao;
            }
        } else {
            $id_avaliacao = $this->input->post('avaliacao');
            $avaliacao = $this->avaliacao_model->obter_uma_avaliacao($id_avaliacao)->result();
            $id_turma;
            foreach ($avaliacao as $av) {
                $id_turma = $av->turma_id_turma;
            }

            $trabalho_por_turma = $this->trabalho_model->obter_todos_trabalhos_turma($id_turma)->result();
            $avaliacao_por_turma = $this->avaliacao_model->obter_todas_avaliacoes_turma($id_turma)->result();
            foreach ($trabalho_por_turma as $tpt) {
                $total_pontos_ja_distribuidos += $tpt->valor_nota_trabalho;
            }
            foreach ($avaliacao_por_turma as $apt) {
                if ($apt->id_avaliacao != $id_avaliacao)
                    $total_pontos_ja_distribuidos += $apt->valor_avaliacao;
            }
        }

        $valor_maximo = 100 - $total_pontos_ja_distribuidos;

        if ($valor_maximo < $valor_nota_campo) {
            $this->form_validation->set_message('varificar_total_notas_distribuidas_check', 'O valor do campo %s ultrapassou o limite máximo. Valor máximo: ' . $valor_maximo);
            return FALSE;
        } else if ($valor_nota_campo < 0) {
            $this->form_validation->set_message('varificar_total_notas_distribuidas_check', 'O valor do campo %s não pode ser menor que 0 (zero).');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // Finção para mostra o formulário de alterar avaliação
    public function alterar_avaliacao($id_avaliacao = NULL) {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            if ($id_avaliacao == null) {
                $id_avaliacao = $this->uri->segment(4);
            }

            $avaliacao = $this->avaliacao_model->obter_uma_avaliacao($id_avaliacao)->result();
            $id_turma;
            foreach ($avaliacao as $av) {
                $id_turma = $av->turma_id_turma;
            }


            $turma_disciplina = $this->turma_model->obter_turma_disciplina($id_turma)->result();

            $dados = array(
                "turma_disciplina" => $turma_disciplina,
                "avaliacao" => $avaliacao
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/avaliacao/forme_alterar_avaliacao_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para salvar os dados alterados da avaliação.
    public function salvar_avaliacao_alterada() {
        // verificando usuário logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $this->form_validation->set_rules('descricao_avaliacao', 'Descrição', 'required|trim|min_length[4]|max_length[45]');
            $this->form_validation->set_rules('data_avaliacao', 'Data', 'required|data|trim|min_length[2]|max_length[45]');
            $this->form_validation->set_rules('valor_avaliacao', 'Valor', 'required|trim|min_length[0]|max_length[45]|callback_varificar_total_notas_distribuidas_check');

            $id_avaliacao = $this->input->post('avaliacao');

            if ($this->form_validation->run() == FALSE) {
                $this->alterar_avaliacao($id_avaliacao);
            } else {




                $descricao_avaliacao = $this->input->post('descricao_avaliacao');
                $data_avaliacao = $this->input->post('data_avaliacao');
                $valor_avaliacao = $this->input->post('valor_avaliacao');


                $avaliacao_atual = $this->avaliacao_model->obter_uma_avaliacao($id_avaliacao)->result();
                $valor_atual;
                $id_turma;
                foreach ($avaliacao_atual as $aa) {
                    $valor_atual = $aa->valor_avaliacao;
                    $id_turma = $aa->turma_id_turma;
                }

                if ($valor_atual == $valor_avaliacao) {
                    $dados = array(
                        "descricao_avaliacao" => $descricao_avaliacao,
                        "data_avaliacao" => implode("-", array_reverse(explode("/", $data_avaliacao))),
                    );
                    $this->avaliacao_model->alterar_avaliacao($dados, $id_avaliacao);
                } else {
                    $porcentagem = ($valor_avaliacao / $valor_atual) * 100;
                    $nota_aluno_avaliacao = $this->avaliacao_model->obter_nota_avaliacao_aluno($id_avaliacao)->result();
                    if (count($nota_aluno_avaliacao) != 0) {
                        foreach ($nota_aluno_avaliacao as $naa) {
                            $dados_nota = array(
                                "valor_nota" => ($porcentagem / 100) * $naa->valor_nota,
                            );
                            $this->avaliacao_model->alterar_nota_avaliacao_aluno($dados_nota, $naa->id_nota);
                        }
                    }

                    $dados = array(
                        "descricao_avaliacao" => $descricao_avaliacao,
                        "data_avaliacao" => implode("-", array_reverse(explode("/", $data_avaliacao))),
                        "valor_avaliacao" => $valor_avaliacao
                    );

                    $this->avaliacao_model->alterar_avaliacao($dados, $id_avaliacao);
                }

                redirect(base_url("cpainel/avaliacao/?turma=" . $id_turma));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para excluir avaliação e as nota se já estive dada;
    public function excluir_avaliacao() {
        // verificando usuario logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $id_avaliacao = $this->input->post('avaliacao');

            $retorno = '';
            $query = $this->avaliacao_model->obter_uma_avaliacao($id_avaliacao)->result();

            if (count($query) != 0) {

                $this->avaliacao_model->excluir_uma_avaliacao($id_avaliacao);
                $retorno = '1';
            } else {
                $retorno = 'Avaliação não foi encontrada!';
            }
            echo $retorno;
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    //------------------------------------------//
    //  Trabalhado com avaliação de recuperação //
    //------------------------------------------//
    public function avaliacao_recuperacao($id_turma = NULL) {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            if ($id_turma == null) {
                $id_turma = $this->uri->segment(4);
            }
            $turma_disciplina = $this->turma_model->obter_turma_disciplina($id_turma)->result();
            $avaliacao_recuperacao = $this->avaliacao_model->obter_avaliacao_recuperacao($id_turma)->result();

            $dados = array(
                "turma_disciplina" => $turma_disciplina,
                "avaliacao_recuperacao" => $avaliacao_recuperacao
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/avaliacao/avaliacao_recuperacao_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

}

?>
