<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of prova_online
 *
 * @author hairton
 */
class prova_online extends CI_Controller {

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

    //put your code here

    protected $dados_conteudo = NULL;
    protected $pg_conteudo = '';

    protected function show_tela() {
        $this->load->view('cpainel/tela/titulo');
        $this->load->view('cpainel/tela/menu');
        $this->load->view($this->pg_conteudo, $this->dados_conteudo);
        $this->load->view('cpainel/tela/rodape');
    }

    protected function verificar_user_logado() {
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function index() {
        if ($this->verificar_user_logado() == FALSE) {
            redirect(base_url("cpainel/seguranca"));
        } else {

            $id_turma = $this->input->get('turma');


            $query = $this->turma_model->obter_turma_disciplina($id_turma)->result();
            if (count($query) == 0) {
                redirect(base_url("cpainel/disciplina"));
            }
            $prova_online_por_turma = $this->avaliacao_model->obter_todas_prova_on_matriz_turma($id_turma)->result();


            $this->dados_conteudo = array(
                "turma_disciplina" => $query,
                "prova_on_matriz_turma" => $prova_online_por_turma
            );

            $this->pg_conteudo = 'cpainel/avaliacao/prova_online/prova_online_view';

            $this->show_tela();
        }
    }

    public function ver_prova_online($id_prova_online = NULL) {
        if ($this->verificar_user_logado() == FALSE) {
            redirect(base_url("cpainel/seguranca"));
        } else {
            if ($id_prova_online == NULL) {
                $id_prova_online = $this->uri->segment(4);
            }

            $prova_online = $this->avaliacao_model->obter_uma_prova_online($id_prova_online)->result();

            if (count($prova_online) == 0) {
                redirect(base_url("cpainel/seguranca"));
            }

            if ($prova_online[0]->status_prova_on_matriz > 0 && $prova_online[0]->status_prova_on_matriz == 1) {
                redirect(base_url("cpainel/prova_online/ver_prova_ativa/" . $id_prova_online));
            }


            $questoes_provas = $this->avaliacao_model->obter_todas_questoes_prova_online($prova_online[0]->id_prova_on_matriz)->result();

            foreach ($questoes_provas as $ques_pro) {
                $ques_pro->alternativas = $this->avaliacao_model->obter_alternativas_questao($ques_pro->id_questao_matriz)->result();
            }

            $turma_disciplina = $this->turma_model->obter_turma_disciplina($prova_online[0]->turma_id_turma)->result();
            if (count($turma_disciplina) == 0) {
                redirect(base_url("cpainel/disciplina"));
            }


            $this->dados_conteudo = array(
                "turma_disciplina" => $turma_disciplina,
                'prova_online' => $prova_online,
                'questoes_prova' => $questoes_provas
            );


            $this->pg_conteudo = 'cpainel/avaliacao/prova_online/ver_prova_online_view';

            $this->show_tela();
        }
    }

    public function ver_prova_ativa($id_prova_online) {
        if (!$this->verificar_user_logado()) {
            redirect(base_url("cpainel/seguranca"));
        } else {
            if ($id_prova_online == NULL) {
                $id_prova_online = $this->uri->segment(4);
            }

            $prova_online = $this->avaliacao_model->obter_uma_prova_online($id_prova_online)->result();

            if (count($prova_online) == 0) {
                redirect(base_url("cpainel/inicio"));
            }

            $questoes_provas = $this->avaliacao_model->obter_todas_questoes_prova_online($prova_online[0]->id_prova_on_matriz)->result();

            foreach ($questoes_provas as $ques_pro) {
                $ques_pro->alternativas = $this->avaliacao_model->obter_alternativas_questao($ques_pro->id_questao_matriz)->result();
            }


            $turma_disciplina = $this->turma_model->obter_turma_disciplina($prova_online[0]->turma_id_turma)->result();
            if (count($turma_disciplina) == 0) {
                redirect(base_url("cpainel/disciplina"));
            }


            $this->dados_conteudo = array(
                "turma_disciplina" => $turma_disciplina,
                'prova_online' => $prova_online,
                'questoes_prova' => $questoes_provas
            );


            $this->pg_conteudo = 'cpainel/avaliacao/prova_online/ver_prova_ativa_view';

            $this->show_tela();
        }
    }

    public function nova_prova_online($id_turma = NULL) {
        if ($this->verificar_user_logado() == FALSE) {
            redirect(base_url("cpainel/seguranca"));
        } else {

            if ($id_turma == NULL) {
                $id_turma = $this->uri->segment(4);
            }
            $query = $this->turma_model->obter_turma_disciplina($id_turma)->result();
            if (count($query) == 0) {
                redirect(base_url("cpainel/disciplina"));
            }

            $this->dados_conteudo = array(
                "turma_disciplina" => $query
            );

            $this->pg_conteudo = 'cpainel/avaliacao/prova_online/forme_nova_prova_online_view';

            $this->show_tela();
        }
    }

    public function salvar_nova_prova_online() {
        if ($this->verificar_user_logado() == FALSE) {
            redirect(base_url("cpainel/seguranca"));
        } else {

            $this->form_validation->set_rules('nome_prova_online', 'Nome prova', 'required|trim|min_length[1]|max_length[45]');
            $this->form_validation->set_rules('data_realizacao_prova_online', 'Data realização', 'required|trim|min_length[8]|max_length[10]');
            $this->form_validation->set_rules('hora_realizacao_prova_online', 'Hora realização', 'required|trim|min_length[1]|max_length[8]');
            $this->form_validation->set_rules('tempo_duracao_prova_online', 'Tempo duração', 'required|trim|is_natural');
            $this->form_validation->set_rules('valor_ponto_prova_online', 'Valor ponto', 'required|trim|numeric|callback_varificar_total_notas_distribuidas_check');
            $this->form_validation->set_rules('informacao_prova_online', 'Informaçao', '');

            $id_turma = $this->input->post('turma');

            if ($this->form_validation->run() == FALSE) {
                $this->nova_prova_online($id_turma);
            } else {

                $nome_prova = $this->input->post('nome_prova_online');
                $informacao_prova = $this->input->post('informacao_prova_online');


                $data_realizacao = $this->input->post('data_realizacao_prova_online');
                $hora_realizacao = $this->input->post('hora_realizacao_prova_online');
                $tempo_duracao = $this->input->post('tempo_duracao_prova_online');
                $valor_ponto = $this->input->post('valor_ponto_prova_online');


                $dados = array(
                    "nome_prova_on_matriz" => $nome_prova,
                    "informacao_prova_on_matriz" => $informacao_prova,
                    "data_criacao_prova_on_matriz" => date("Y-m-d"),
                    "data_realizacao_prova_on_matriz" => $data_realizacao,
                    "hora_realizacao_prova_on_matriz" => $hora_realizacao,
                    "tempo_duracao_prova_on_matriz" => $tempo_duracao,
                    "valor_ponto_prova_on_matriz" => $valor_ponto,
                    "turma_id_turma" => $id_turma
                );





                $prova_online = $this->avaliacao_model->salvar_nova_prova_online($dados)->result();



                redirect(base_url("cpainel/prova_online/ver_prova_online/" . $id_turma));
            }
        }
    }

    public function val_numero_negativo_check($numero) {
        if ($numero < 0) {
            $this->form_validation->set_message('val_numero_negativo_check', 'O %s não pode ser negativo');
            return FALSE;
        } else {
            return TRUE;
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
        } else if ($this->input->post('id_prova_online', TRUE)) {
            $id_prova_online = $this->input->post('id_prova_online');
            $prova_online = $this->avaliacao_model->obter_uma_prova_online($id_prova_online)->result();
            $id_turma;
            foreach ($prova_online as $pro_on) {
                $id_turma = $pro_on->turma_id_turma;
            }

            $trabalho_por_turma = $this->trabalho_model->obter_todos_trabalhos_turma($id_turma)->result();
            $avaliacao_por_turma = $this->avaliacao_model->obter_todas_avaliacoes_turma($id_turma)->result();
            foreach ($trabalho_por_turma as $tpt) {
                $total_pontos_ja_distribuidos += $tpt->valor_nota_trabalho;
            }
            foreach ($avaliacao_por_turma as $apt) {
                if ($apt->id_avaliacao != $id_prova_online)
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
            if ($this->input->post('id_prova_online', TRUE)) {
                $id_prova_online = $this->input->post('id_prova_online');
                $questoes = $this->avaliacao_model->obter_todas_questoes_prova_online($id_prova_online)->result();
                $total_pontos_questoes = 0;
                foreach ($questoes as $ques) {
                    $total_pontos_questoes += $ques->valor_ponto_questao_matriz;
                }

                if ($total_pontos_questoes > $valor_nota_campo) {
                    $this->form_validation->set_message('varificar_total_notas_distribuidas_check', 'O valor do campo %s está menor que o total de pontos das questõs. Primeiro diminua os pontos das questões.');
                    return FALSE;
                } else {
                    return TRUE;
                }
            } else {
                return TRUE;
            }
        }
    }

    public function altera_prova_online($id_prova_online = NULL) {
        if ($this->verificar_user_logado() == FALSE) {
            redirect(base_url("cpainel/seguranca"));
        } else {

            if ($id_prova_online == NULL) {
                $id_prova_online = $this->uri->segment(4);
            }

            $prova = $this->avaliacao_model->obter_uma_prova_online($id_prova_online)->result();

            $id_turma;
            foreach ($prova as $pro) {
                $id_turma = $pro->turma_id_turma;
            }



            $query = $this->turma_model->obter_turma_disciplina($id_turma)->result();
            if (count($query) == 0) {
                redirect(base_url("cpainel/disciplina"));
            }

            $this->dados_conteudo = array(
                "turma_disciplina" => $query,
                "prova_online" => $prova
            );

            $this->pg_conteudo = 'cpainel/avaliacao/prova_online/forme_alterar_prova_online_view';

            $this->show_tela();
        }
    }

    public function salvar_prova_online_alterarda() {
        if ($this->verificar_user_logado() == FALSE) {
            redirect(base_url("cpainel/seguranca"));
        } else {

            $this->form_validation->set_rules('nome_prova_online', 'Nome prova', 'required|trim|min_length[1]|max_length[45]');
            $this->form_validation->set_rules('data_realizacao_prova_online', 'Data realização', 'required|trim|min_length[8]|max_length[10]');
            $this->form_validation->set_rules('hora_realizacao_prova_online', 'Hora realização', 'required|trim|min_length[1]|max_length[8]');
            $this->form_validation->set_rules('tempo_duracao_prova_online', 'Tempo duração', 'required|trim|is_natural');
            $this->form_validation->set_rules('valor_ponto_prova_online', 'Valor ponto', 'required|trim|numeric|callback_varificar_total_notas_distribuidas_check');
            $this->form_validation->set_rules('informacao_prova_online', 'Informaçao', '');

            $id_prova_onlie = $this->input->post('id_prova_online');

            if ($this->form_validation->run() == FALSE) {
                $this->altera_prova_online($id_prova_onlie);
            } else {

                $nome_prova = $this->input->post('nome_prova_online');
                $informacao_prova = $this->input->post('informacao_prova_online');


                $data_realizacao = $this->input->post('data_realizacao_prova_online');
                $hora_realizacao = $this->input->post('hora_realizacao_prova_online');
                $tempo_duracao = $this->input->post('tempo_duracao_prova_online');
                $valor_ponto = $this->input->post('valor_ponto_prova_online');


                $dados = array(
                    "nome_prova_on_matriz" => $nome_prova,
                    "informacao_prova_on_matriz" => $informacao_prova,
                    "data_realizacao_prova_on_matriz" => $data_realizacao,
                    "hora_realizacao_prova_on_matriz" => $hora_realizacao,
                    "tempo_duracao_prova_on_matriz" => $tempo_duracao,
                    "valor_ponto_prova_on_matriz" => $valor_ponto,
                );



                print_r($dados);


                $prova_online = $this->avaliacao_model->alterar_prova_online($dados, $id_prova_onlie)->result();

                $id_turma;
                foreach ($prova_online as $pro_on) {
                    $id_turma = $pro_on->turma_id_turma;
                }

                redirect(base_url("cpainel/prova_online/ver_prova_online/" . $id_turma));
            }
        }
    }

    public function excluir_prova_online() {
        if (!$this->verificar_user_logado()) {
            redirect("cpainel/seguranca");
        } else {

            $id_prova_online = $this->uri->segment(4);

            $prova_online = $this->avaliacao_model->obter_uma_prova_online($id_prova_online)->result();
            if (count($prova_online) == 0) {
                redirect(base_url("cpainel/seguranca"));
                exit();
            }

            $questoes = $this->avaliacao_model->obter_todas_questoes_prova_online($id_prova_online)->result();

            if (count($questoes) > 0) {
                $this->session->set_flashdata("erro_excluir", "Não é possivel excluir está prova antes de excluir as questões");
                redirect(base_url("cpainel/prova_online/ver_prova_online/" . $id_prova_online));
                exit();
            }

            $this->avaliacao_model->excluir_prova_online($id_prova_online);

            $id_turma;
            foreach ($prova_online as $pro_on) {
                $id_turma = $pro_on->turma_id_turma;
            }

            redirect(base_url("cpainel/prova_online/?turma=" . $id_turma));
        }
    }

    public function add_questao_prova_online($id_prova_online = NULL) {
        if ($this->verificar_user_logado() == FALSE) {
            redirect(base_url("cpainel/seguranca"));
        } else {
            if ($id_prova_online == NULL) {
                $id_prova_online = $this->uri->segment(4);
            }

            $prova_online = $this->avaliacao_model->obter_uma_prova_online($id_prova_online)->result();

            $id_turma;
            foreach ($prova_online as $pro_on) {
                $id_turma = $pro_on->turma_id_turma;
            }

            $turma_disciplina = $this->turma_model->obter_turma_disciplina($id_turma)->result();
            if (count($turma_disciplina) == 0) {
                redirect(base_url("cpainel/disciplina"));
            }

            $todas_questoes = $this->avaliacao_model->obter_todas_questoes_prova_online($id_prova_online)->result();

            $numero_questao = 1;
            if (count($todas_questoes) != 0) {
                foreach ($todas_questoes as $to_que) {
                    $numero_questao = $to_que->numero_questao_matriz + 1;
                }
            }



            $this->dados_conteudo = array(
                "turma_disciplina" => $turma_disciplina,
                'prova_online' => $prova_online,
                'numero_questao' => $numero_questao
            );


            $this->pg_conteudo = 'cpainel/avaliacao/prova_online/forme_add_questao_prova_online_view';

            $this->show_tela();
        }
    }

    public function salvar_questao_prova_online() {
        if ($this->verificar_user_logado() == FALSE) {
            redirect(base_url("cpainel/seguranca"));
        } else {

            $this->form_validation->set_rules("numero_questao", "Numero Questão", "required|integer|is_unique[questao_matriz.id_questao_matriz]");
            $this->form_validation->set_rules("valor_questao", "Valor", "required|numeric|callback_val_valor_ponto_questao_check");
            $this->form_validation->set_rules("enunciado_questao", "Enunciado", "required|min_legth[4]");


            $id_prova_online = $this->input->post('id_prova_online');

            if (!$this->form_validation->run()) {
                $this->add_questao_prova_online($id_prova_online);
            } else {

                $numero_questao = $this->input->post('numero_questao');
                $valor_questao = $this->input->post('valor_questao');
                $enunciado_questao = $this->input->post('enunciado_questao');


                $dados = array(
                    'numero_questao_matriz' => $numero_questao,
                    'valor_ponto_questao_matriz' => $valor_questao,
                    'enunciado_questao_matriz' => $enunciado_questao,
                    'prova_on_matriz_id_prova_on_matriz' => $id_prova_online,
                    'token_questao_matriz' => uniqid(rand(), TRUE)
                );


                $questao = $this->avaliacao_model->salvar_questao_online($dados)->result();

                $id_questao;
                foreach ($questao as $ques) {
                    $id_questao = $ques->id_questao_matriz;
                }

                $this->ver_questao_prova($id_questao);
            }
        }
    }

    public function val_valor_ponto_questao_check() {
        $id_prova_online;
        if (!empty($this->input->post('id_prova_online'))) {
            $id_prova_online = $this->input->post('id_prova_online');
        } else {
            $id_questao = $this->input->post('id_questao');

            $questao = $this->avaliacao_model->obter_uma_questao($id_questao)->result();

            foreach ($questao as $ques) {
                $id_prova_online = $ques->prova_on_matriz_id_prova_on_matriz;
            }
        }



        $valor_questao = $this->input->post('valor_questao');

        $validar = 0;
        if ($valor_questao < 0) {
            $this->form_validation->set_message("val_valor_ponto_questao_check", "A pontuação da questão não pode ser negativa");

            $validar = 1;
        }

        if ($validar == 0) {

            $prova_onlinte = $this->avaliacao_model->obter_uma_prova_online($id_prova_online)->result();
            $questoes = $this->avaliacao_model->obter_todas_questoes_prova_online($id_prova_online)->result();

            $prova;
            foreach ($prova_onlinte as $pro_on) {
                $prova = $pro_on;
            }

            $valor_total_questao = 0;
            foreach ($questoes as $questao) {
                $valor_total_questao += $questao->valor_ponto_questao_matriz;
            }

            if ($prova->valor_ponto_prova_on_matriz < $valor_total_questao + $valor_questao) {

                $pontos_restantes = $prova->valor_ponto_prova_on_matriz - $valor_total_questao;


                $this->form_validation->set_message("val_valor_ponto_questao_check", "Os pontos da questão ultrapassou o valor da pontuação da prova. o máximo de ponto para esta questão é: " . number_format($pontos_restantes, 2));

                $validar = 1;
            }
        }

        if ($validar == 1) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function alterar_questao_prova_online($id_questao = NULL) {
        if ($this->verificar_user_logado() == FALSE) {
            redirect(base_url("cpainel/seguranca"));
        } else {
            if ($id_questao == NULL) {
                $id_questao = $this->uri->segment(4);
            }

            $questao = $this->avaliacao_model->obter_uma_questao($id_questao)->result();

            $id_prova_online;
            foreach ($questao as $ques) {
                $id_prova_online = $ques->prova_on_matriz_id_prova_on_matriz;
            }

            $prova_online = $this->avaliacao_model->obter_uma_prova_online($id_prova_online)->result();

            $id_turma;
            foreach ($prova_online as $pro_on) {
                $id_turma = $pro_on->turma_id_turma;
            }

            $turma_disciplina = $this->turma_model->obter_turma_disciplina($id_turma)->result();
            if (count($turma_disciplina) == 0) {
                //redirect(base_url("cpainel/disciplina"));
            }


            $this->dados_conteudo = array(
                "turma_disciplina" => $turma_disciplina,
                'prova_online' => $prova_online,
                'questao' => $questao
            );


            $this->pg_conteudo = 'cpainel/avaliacao/prova_online/forme_alterar_questao_prova_online_view';

            $this->show_tela();
        }
    }

    public function salvar_questao_alterarda() {
        if ($this->verificar_user_logado() == FALSE) {
            redirect(base_url("cpainel/seguranca"));
        } else {

            $this->form_validation->set_rules("numero_questao", "Numero Questão", "required|integer");
            $this->form_validation->set_rules("valor_questao", "Valor", "required|numeric|callback_val_valor_ponto_questao_check");
            $this->form_validation->set_rules("enunciado_questao", "Enunciado", "required|min_legth[4]");

            $id_questao = $this->input->post('id_questao');

            if (!$this->form_validation->run()) {
                $this->alterar_questao_prova_online($id_questao);
            } else {
                $numero_questao = $this->input->post('numero_questao');
                $valor_questao = $this->input->post('valor_questao');
                $enunciado_questao = $this->input->post('enunciado_questao');


                $dados = array(
                    'numero_questao_matriz' => $numero_questao,
                    'valor_ponto_questao_matriz' => $valor_questao,
                    'enunciado_questao_matriz' => $enunciado_questao,
                );

                $questao = $this->avaliacao_model->alterar_questao_online($dados, $id_questao)->result();

                $id_questao;
                foreach ($questao as $ques) {
                    $id_questao = $ques->id_questao_matriz;
                }


                $this->ver_questao_prova($id_questao);
            }
        }
    }

    public function ver_questao_prova($id_questao = NULL) {
        if ($this->verificar_user_logado() == FALSE) {
            redirect(base_url("cpainel/seguranca"));
        } else {

            if ($id_questao == NULL) {
                $id_questao = $this->uri->segment(4);
            }


            $questao = $this->avaliacao_model->obter_uma_questao($id_questao)->result();

            $id_prova_matriz;
            foreach ($questao as $ques) {
                $ques->alternativas = $this->avaliacao_model->obter_alternativas_questao($ques->id_questao_matriz)->result();
                $id_prova_matriz = $ques->prova_on_matriz_id_prova_on_matriz;
            }


            $prova_online = $this->avaliacao_model->obter_uma_prova_online($id_prova_matriz)->result();

            $id_turma;
            foreach ($prova_online as $pro_on) {
                $id_turma = $pro_on->turma_id_turma;
            }


            //print_r($pro_on);

            $turma_disciplina = $this->turma_model->obter_turma_disciplina($id_turma)->result();
            if (count($turma_disciplina) == 0) {
//                redirect(base_url("cpainel/disciplina"));
            }

            $this->dados_conteudo = array(
                'questao' => $ques,
                'prova_online' => $prova_online,
                'turma_disciplina' => $turma_disciplina
            );

            $this->pg_conteudo = "cpainel/avaliacao/prova_online/ver_questao_online_view";

            $this->show_tela();
        }
    }

    public function add_alternativa_questao() {
        if ($this->verificar_user_logado() == FALSE) {
            redirect(base_url("cpainel/seguranca"));
        } else {

            $this->form_validation->set_rules("texto_alternativa_questao", "Alternativa", "required|trim|min_length[4]|callback_validar_alternativa_check");

            $id_questao_prova = $this->input->post("id_questao");

            if (!$this->form_validation->run()) {
                $this->ver_questao_prova($id_questao_prova);
            } else {
                //       $alternativas = $this->avaliacao_model->obter_alternativas_questao($id_questao_prova)->result();



                $texto_alternativa_questao = $this->input->post("texto_alternativa_questao");
                $opcao_correta = $this->input->post("opcao_correta");
                $opcao_correta_alternativa = 0;
                if ($opcao_correta) {
                    $opcao_correta_alternativa = 1;
                }

//            $id_questao_prova = $this->input->post("id_questao_prova");


                $dados = array(
                    "texto_alternativa_questao" => $texto_alternativa_questao,
                    "opcao_correta_alternativa_questao" => $opcao_correta_alternativa,
                    "token_alternativa_questao" => uniqid(),
                    "questao_matriz_id_questao_matriz" => $id_questao_prova,
                );


                $alternativa_questao = $this->avaliacao_model->salva_alternativa_questao($dados)->result();



                $this->ver_questao_prova($id_questao_prova);
            }
        }
    }

    public function validar_alternativa_check() {
        $opcao_correta = $this->input->post("opcao_correta");

        if ($opcao_correta) {
            $id_questao_prova;
            if (!empty($this->input->post("id_questao"))) {
                $id_questao_prova = $this->input->post("id_questao");
            } else {
                $id_alternativa = $this->input->post("id_alternativa");

                $alternativa = $this->avaliacao_model->obter_uma_alternativa($id_alternativa)->result();

                foreach ($alternativa as $alte) {
                    $id_questao_prova = $alte->questao_matriz_id_questao_matriz;
                }
            }

            $alternativas = $this->avaliacao_model->obter_alternativas_questao($id_questao_prova)->result();

            $valida = 0;
            foreach ($alternativas as $alte) {
                if ($alte->opcao_correta_alternativa_questao == 1) {
                    $valida = 1;
                }
            }

            if ($valida == 1) {

                $this->form_validation->set_message('validar_alternativa_check', 'já existe uma alternativa correta.');
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function alterar_alternativa($id_alternativa = NULL) {
        if ($this->verificar_user_logado() == FALSE) {
            redirect(base_url("cpainel/seguranca"));
        } else {
            if ($id_alternativa == NULL) {
                $id_alternativa = $this->uri->segment(4);
            }

            $alternativa = $this->avaliacao_model->obter_uma_alternativa($id_alternativa)->result();

            $id_questao;
            foreach ($alternativa as $alte) {
                $id_questao = $alte->questao_matriz_id_questao_matriz;
            }

            $questao = $this->avaliacao_model->obter_uma_questao($id_questao)->result();

            $id_prova_online;
            foreach ($questao as $ques) {
                $id_prova_online = $ques->prova_on_matriz_id_prova_on_matriz;
            }

            $prova_online = $this->avaliacao_model->obter_uma_prova_online($id_prova_online)->result();

            $id_turma;
            foreach ($prova_online as $pro_on) {
                $id_turma = $pro_on->turma_id_turma;
            }

            $turma_disciplina = $this->turma_model->obter_turma_disciplina($id_turma)->result();
            if (count($turma_disciplina) == 0) {
                //redirect(base_url("cpainel/disciplina"));
            }


            $this->dados_conteudo = array(
                "turma_disciplina" => $turma_disciplina,
                'prova_online' => $prova_online,
                'questao' => $questao,
                'alternativa' => $alternativa
            );


            $this->pg_conteudo = 'cpainel/avaliacao/prova_online/forme_alterar_alternativa_view';

            $this->show_tela();
        }
    }

    public function salvar_alternativa_questao_alterada() {
        if ($this->verificar_user_logado() == FALSE) {
            redirect(base_url("cpainel/seguranca"));
        } else {
            $this->form_validation->set_rules("texto_alternativa_questao", "Alternativa", "required|trim|min_length[4]|callback_validar_alternativa_check");

            $id_alternativa = $this->input->post("id_alternativa");

            if (!$this->form_validation->run()) {
                $this->alterar_alternativa($id_alternativa);
            } else {

                $texto_alternativa_questao = $this->input->post("texto_alternativa_questao");
                $opcao_correta = $this->input->post("opcao_correta");
                $opcao_correta_alternativa = 0;
                if ($opcao_correta) {
                    $opcao_correta_alternativa = 1;
                }


                $dados = array(
                    "texto_alternativa_questao" => $texto_alternativa_questao,
                    "opcao_correta_alternativa_questao" => $opcao_correta_alternativa,
                );


                $alternativa_questao = $this->avaliacao_model->alterar_alternativa_questao($dados, $id_alternativa)->result();

                $id_questao;
                foreach ($alternativa_questao as $alte) {
                    $id_questao = $alte->questao_matriz_id_questao_matriz;
                }

                $this->ver_questao_prova($id_questao);
            }
        }
    }

    public function excluir_alternativa() {
        if (!$this->verificar_user_logado()) {
            redirect(base_url("cpainel/seguranca"));
        } else {

            $id_alternativa = $this->uri->segment(4);

            $alternativa = $this->avaliacao_model->obter_uma_alternativa($id_alternativa)->result();

            if (count($alternativa) == 0) {
                redirect(base_url("cpainel/inicio"));
                exit();
            }

            $this->avaliacao_model->excluir_alternativa($id_alternativa);

            $id_questao;
            foreach ($alternativa as $alte) {
                $id_questao = $alte->questao_matriz_id_questao_matriz;
            }

            $this->ver_questao_prova($id_questao);
        }
    }

    public function excluir_questao() {
        if (!$this->verificar_user_logado()) {
            redirect("cpainel/seguranca");
            exit();
        }

        $id_questao = $this->uri->segment(4);

        $questao = $this->avaliacao_model->obter_uma_questao($id_questao)->result();

        if (count($questao) == 0) {
            redirect(base_url("cpainel/inicio"));
            exit();
        }

        $alternativas = $this->avaliacao_model->obter_alternativas_questao($id_questao)->result();

        if (count($alternativas) > 0) {
            $msg_erro = "Questão não pode ser excluida porque exite alternativas. primeiro exclua as alternativas.";
            $this->session->set_flashdata("erro_exclusao", $msg_erro);
            //$this->ver_questao_prova($id_questao);
            redirect(base_url("cpainel/prova_online/ver_questao_prova/" . $id_questao));
            exit();
        }

        $this->avaliacao_model->excluir_questao($id_questao);

        $id_prova;
        foreach ($questao as $ques) {
            $id_prova = $ques->prova_on_matriz_id_prova_on_matriz;
        }

        redirect(base_url("cpainel/prova_online/ver_prova_online/" . $id_prova));
    }

    public function publicar_prova_online($id_prova_online = NULL) {
        if (!$this->verificar_user_logado()) {
            redirect(base_url("cpainel/cpainel"));
        } else {
            if ($id_prova_online == NULL) {
                $id_prova_online = $this->uri->segment(4);
            }

            $prova_online = $this->avaliacao_model->obter_uma_prova_online($id_prova_online)->result();

            if (count($prova_online) == 0) {
                redirect(base_url("cpainel/inicio"));
            }


            $dados = array();
            if ($prova_online[0]->status_prova_on_matriz == 0) {
                $dados['status_prova_on_matriz'] = 1;


                $prova = $this->avaliacao_model->alterar_prova_online($dados, $prova_online[0]->id_prova_on_matriz)->result();
            }

            $this->ver_prova_online($prova_online[0]->id_prova_on_matriz);
        }
    }

    public function editar_prova_online($id_prova_online = NULL) {
        if (!$this->verificar_user_logado()) {
            redirect(base_url("cpainel/cpainel"));
        } else {
            if ($id_prova_online == NULL) {
                $id_prova_online = $this->uri->segment(4);
            }

            $prova_online = $this->avaliacao_model->obter_uma_prova_online($id_prova_online)->result();

            if (count($prova_online) == 0) {
                redirect(base_url("cpainel/inicio"));
            }


            $dados = array();
            if ($prova_online[0]->status_prova_on_matriz == 1) {
                $dados['status_prova_on_matriz'] = 0;


                $prova = $this->avaliacao_model->alterar_prova_online($dados, $prova_online[0]->id_prova_on_matriz)->result();
            }

            $this->ver_prova_online($prova_online[0]->id_prova_on_matriz);
        }
    }

}
