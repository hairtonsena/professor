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
        $this->load->model('cpainel/trabalho_model');
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
            $todos_trabalhos_turma = $this->trabalho_model->obter_todos_trabalhos_turma($id_turma)->result();

            $avaliacao_recuperacao_turma = $this->avaliacao_model->obter_avaliacao_recuperacao($id_turma)->result();

            $notas_aluno_avaliacao = $this->avaliacao_model->obter_notas_avaliacao($id_turma)->result();
            $notas_aluno_trabalho = $this->trabalho_model->obter_notas_trabalho($id_turma)->result();

            $nota_aluno_avaliacao_recuperacao = $this->avaliacao_model->obter_notas_avaliacao_recuperacao($id_turma)->result();


            // capturando as notas dos alunos de avaliação, trabalho, recuperação.
            $notas_avaliacoes = array();
            foreach ($notas_aluno_avaliacao as $naa) {
                $notas_avaliacoes[$naa->id_aluno][$naa->id_avaliacao] = $naa->valor_nota;
            }

            $notas_trabalhos = array();
            foreach ($notas_aluno_trabalho as $nat) {
                $notas_trabalhos[$nat->id_aluno][$nat->id_trabalho] = $nat->valor_nota_trabalho;
            }

            $nota_recuperacao = array();
            foreach ($nota_aluno_avaliacao_recuperacao as $naar) {
                $nota_recuperacao[$naar->id_aluno][$naar->id_avaliacao_recuperacao] = $naar->valor_nota_avaliacao_recuperacao;
            }
            // final da capitura

            $dados = array(
                "turma_disciplina" => $turma_disciplina,
                "alunos_turma" => $alunos_por_turma,
                "avaliacoes_turma" => $todas_avaliacoes,
                "notas_avaliacoes" => $notas_avaliacoes,
                "todos_trabalhos_turma" => $todos_trabalhos_turma,
                "notas_trabalhos" => $notas_trabalhos,
                "avaliacao_recuperacao" => $avaliacao_recuperacao_turma,
                "nota_recuperacao" => $nota_recuperacao
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/notas/notas_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

//Função para mostra o formulário de alterar notas dos alunos para um avaliação.
    public function alterar_notas($id_turma = NULL, $id_avaliacao = NULL) {
// verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            $verificar_requisicao_get = FALSE;
            if ($id_turma == null) {
                $verificar_requisicao_get = TRUE;
                $id_turma = $this->input->get('turma');
                $id_avaliacao = $this->input->get('avaliacao');
            }

            $turma_disciplina = $this->turma_model->obter_turma_disciplina($id_turma)->result();
            $alunos_por_turma = $this->turma_model->obter_todos_alunos_turma($id_turma)->result();
            $avaliacao = $this->avaliacao_model->obter_uma_avaliacao($id_avaliacao)->result();
            $notas_aluno_avaliacao = $this->avaliacao_model->obter_notas_avaliacao($id_turma)->result();


            $notas_avaliacoes = array();
            foreach ($notas_aluno_avaliacao as $naa) {
                $notas_avaliacoes[$naa->id_aluno][$naa->id_avaliacao] = $naa->valor_nota;
            }

            // Campos dinamicos para o formulário de alterar nota dos alunos
            $campo_nota = array();
            foreach ($alunos_por_turma as $apt) {
                $valor_campo = 0;
                if (!empty($notas_avaliacoes[$apt->id_aluno][$id_avaliacao])) {
                    $valor_campo = $notas_avaliacoes[$apt->id_aluno][$id_avaliacao];
                }
                if ($verificar_requisicao_get === FALSE) {
                    $valor_campo = set_value('aluno_' . $apt->id_aluno);
                }

                $data = array(
                    'name' => 'aluno_' . $apt->id_aluno,
                    'id' => 'aluno_' . $apt->id_aluno,
                    'value' => $valor_campo,
                    'maxlength' => '20',
                    'size' => '50',
                    'class' => 'form-control',
                    'required' => 'TRUE'
                );
                $campo_nota[$apt->id_aluno] = $data;
            }

            $dados = array(
                "turma_disciplina" => $turma_disciplina,
                "alunos_turma" => $alunos_por_turma,
                "campo_nota" => $campo_nota,
                "id_avaliacao" => $id_avaliacao,
                "avaliacao" => $avaliacao
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/notas/alterar_notas_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

// Função para salvar notas das avaliações dos aluno
    public function salvar_nota_alunos() {
// veirificando usuario logado
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $id_turma = $this->input->post('turma');
            $id_avaliacao = $this->input->post('avaliacao');

            $alunos_por_turma = $this->turma_model->obter_todos_alunos_turma($id_turma)->result();



            foreach ($alunos_por_turma as $apt) {
                $input_name = 'aluno_' . $apt->id_aluno;
                $this->form_validation->set_rules($input_name, $apt->nome_aluno, 'required|trim|min_length[1]|max_length[10]|numeric|callback_nota_maxima_e_minima_para_avaliacao_check');
            }

            if ($this->form_validation->run() == FALSE) {
                $this->alterar_notas($id_turma, $id_avaliacao);
            } else {


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
                }

                redirect(base_url("cpainel/notas?turma=" . $id_turma));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para validação de nota máxima e mínima permitida das avaliações.
    public function nota_maxima_e_minima_para_avaliacao_check($valor_nota) {
        $id_avaliacao = $this->input->post('avaliacao');

        $avaliacao = $this->avaliacao_model->obter_uma_avaliacao($id_avaliacao)->result();

        $nota_avaliacao = 0;
        foreach ($avaliacao as $av) {
            $nota_avaliacao = $av->valor_avaliacao;
        }

        if ($nota_avaliacao < $valor_nota) {
            $this->form_validation->set_message('nota_maxima_e_minima_para_avaliacao_check', 'O valor do campo %s ultrapassou o limite da nota. (Valor máximo: ' . $nota_avaliacao . ').');
            return FALSE;
        } else if ($valor_nota < 0) {
            $this->form_validation->set_message('nota_maxima_e_minima_para_avaliacao_check', 'O valor do campo %s não pode ser menor que 0 (zero).');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    //
//Função para alterar as notas do trabalhos dos alunos.
    public function alterar_notas_trabalho($id_turma = NULL, $id_trabalho = NULL) {
// verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            $verificar_requisicao_get = FALSE;
            if ($id_turma == null) {
                $verificar_requisicao_get = TRUE;
                $id_turma = $this->input->get('turma');
                $id_trabalho = $this->input->get('trabalho');
            }

            $turma_disciplina = $this->turma_model->obter_turma_disciplina($id_turma)->result();
            $alunos_por_turma = $this->turma_model->obter_todos_alunos_turma($id_turma)->result();
            $trabalho = $this->trabalho_model->obter_um_trabalho($id_trabalho)->result();

            $notas_aluno_trabalho = $this->trabalho_model->obter_notas_trabalho($id_turma)->result();


            $titulo_trabalho = '';
            foreach ($trabalho as $tr) {
                $titulo_trabalho = $tr->titulo_trabalho;
            }

            $notas_trabalho = array();
            foreach ($notas_aluno_trabalho as $nat) {
                $notas_trabalho[$nat->id_aluno][$nat->id_trabalho] = $nat->valor_nota_trabalho;
            }

            $campo_nota = array();
            foreach ($alunos_por_turma as $apt) {
                $valor_campo = 0;
                if (!empty($notas_trabalho[$apt->id_aluno][$id_trabalho])) {
                    $valor_campo = $notas_trabalho[$apt->id_aluno][$id_trabalho];
                }
                if ($verificar_requisicao_get !== TRUE) {
                    $valor_campo = set_value('aluno_' . $apt->id_aluno);
                }

                $data = array(
                    'name' => 'aluno_' . $apt->id_aluno,
                    'id' => 'aluno_' . $apt->id_aluno,
                    'value' => $valor_campo,
                    'maxlength' => '20',
                    'size' => '50',
                    'class' => 'form-control'
                );
                $campo_nota[$apt->id_aluno] = $data;
            }


            $dados = array(
                "turma_disciplina" => $turma_disciplina,
                "alunos_turma" => $alunos_por_turma,
                "campo_nota" => $campo_nota,
                "id_trabalho" => $id_trabalho,
                "trabalho" => $trabalho
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/notas/alterar_notas_trabalho_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

// Função para salvar notas dos trabalhos dos aluno
    public function salvar_nota_trabalho_alunos() {
// veirificando usuario logado
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            $id_turma = $this->input->post('turma');
            $id_trabalho = $this->input->post('trabalho');
            $alunos_por_turma = $this->turma_model->obter_todos_alunos_turma($id_turma)->result();

            foreach ($alunos_por_turma as $apt) {
                $input_name = 'aluno_' . $apt->id_aluno;
                // $valor_nota_aluno = $this->input->post($input_name);
                $this->form_validation->set_rules($input_name, $apt->nome_aluno, 'required|trim|min_length[1]|max_length[20]|callback_nota_maxima_e_minima_para_trabalho_check');
            }
            if ($this->form_validation->run() == FALSE) {
                $this->alterar_notas_trabalho($id_turma, $id_trabalho);
            } else {


                foreach ($alunos_por_turma as $apt) {
                    $input_name = 'aluno_' . $apt->id_aluno;
                    $valor_nota_aluno = $this->input->post($input_name);

                    $nota_exite = $this->trabalho_model->verificar_nota_exite($id_trabalho, $apt->id_aluno)->result();

                    if (count($nota_exite) == 0) {
                        $dados = array(
                            "valor_nota_trabalho" => $valor_nota_aluno,
                            "aluno_id_aluno" => $apt->id_aluno,
                            "trabalho_id_trabalho" => $id_trabalho
                        );
//                        $this->trabalho_model->salvar_nota_trabalho_aluno($dados);
                    } else {

                        $dados = array(
                            "valor_nota_trabalho" => $valor_nota_aluno
                        );
//                        $this->trabalho_model->alterando_nota_trabalho_aluno($dados, $id_trabalho, $apt->id_aluno);
                    }
                }

                redirect(base_url("cpainel/notas?turma=" . $id_turma));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para validação de nota máxima permitida dos trabalos.
    public function nota_maxima_e_minima_para_trabalho_check($valor_nota) {
        $id_trabalho = $this->input->post('trabalho');

        $trabalho = $this->trabalho_model->obter_um_trabalho($id_trabalho)->result();

        $nota_trabalho = 0;
        foreach ($trabalho as $tr) {
            $nota_trabalho = $tr->valor_nota_trabalho;
        }

        if ($nota_trabalho < $valor_nota) {
            $this->form_validation->set_message('nota_maxima_e_minima_para_trabalho_check', 'O valor do campo %s ultrapassou o limite da nota. (Valor máximo: ' . $nota_trabalho . ').');
            return FALSE;
        } else if ($valor_nota < 0) {
            $this->form_validation->set_message('nota_maxima_e_minima_para_trabalho_check', 'O valor do campo %s não pode ser menor que 0 (zero).');
            return FALSE;
        } else {
            return TRUE;
        }
    }

//Função para alterar as notas da avaliação de recuperaçao dos alunos.
    public function alterar_notas_avaliacao_recuperacao($id_turma = NULL, $id_trabalho = NULL) {
// verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            if ($id_turma == null) {
                $id_turma = $this->input->get('turma');
//$id_trabalho = $this->input->get('trabalho');
            }

            $id_alunos_recuperacao = $this->session->userdata("alunos_recuperacao");
            if (count($id_alunos_recuperacao) == 0) {
                redirect(base_url("cpainel/notas?turma=" . $id_turma));
            }


            $turma_disciplina = $this->turma_model->obter_turma_disciplina($id_turma)->result();
            $alunos_por_turma = $this->turma_model->obter_todos_alunos_turma($id_turma)->result();

            $alunos_recuperacao = array();
            foreach ($alunos_por_turma as $apt) {
                for ($i = 0; $i < count($id_alunos_recuperacao); $i++) {
                    if ($apt->id_aluno == $id_alunos_recuperacao[$i]) {
                        $alunos_recuperacao[] = $apt;
                    }
                }
            }



            $avaliacao_recuperacao_turma = $this->avaliacao_model->obter_avaliacao_recuperacao($id_turma)->result();
            $nota_aluno_avaliacao_recuperacao = $this->avaliacao_model->obter_notas_avaliacao_recuperacao($id_turma)->result();



            $id_avaliacao_recuperacao = '';
            foreach ($avaliacao_recuperacao_turma as $art) {
                $id_avaliacao_recuperacao = $art->id_avaliacao_recuperacao;
            }


            $notas_avaliacao_recuperacao = array();
            foreach ($nota_aluno_avaliacao_recuperacao as $nat) {
                $notas_avaliacao_recuperacao[$nat->id_aluno][$id_avaliacao_recuperacao] = $nat->valor_nota_avaliacao_recuperacao;
            }




            $campo_nota = array();
            foreach ($alunos_recuperacao as $ar) {
                $valor_campo = 0;
                if (!empty($notas_avaliacao_recuperacao[$ar->id_aluno][$id_avaliacao_recuperacao])) {
                    $valor_campo = $notas_avaliacao_recuperacao[$ar->id_aluno][$id_avaliacao_recuperacao];
                }


                $data = array(
                    'name' => 'aluno_' . $ar->id_aluno,
                    'id' => 'aluno_' . $ar->id_aluno,
                    'value' => $valor_campo,
                    'maxlength' => '20',
                    'size' => '50',
//                    'style' => 'width:50%',
                    'class' => 'form-control'
                );
                $campo_nota[$ar->id_aluno] = $data;
            }





            $dados = array(
                "turma_disciplina" => $turma_disciplina,
                "alunos_turma" => $alunos_recuperacao,
                "campo_nota" => $campo_nota,
                "id_avaliacao_recuperacao" => $id_avaliacao_recuperacao,
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/notas/alterar_notas_avaliacao_recuperacao_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

// Função para salvar notas da avaliacao de recuperacao
    public function salvar_nota_avaliacao_recuperacao_alunos() {
// veirificando usuario logado
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {



//           $this->form_validation->set_rules('nome_aluno', 'Nome', 'required|trim|min_length[4]|max_length[45]');
//            $this->form_validation->set_rules('matricula_aluno', 'Matricula', 'required|trim|min_length[2]|max_length[45]');
//            $this->form_validation->set_rules('cpf_aluno', 'CPF', 'required|trim|min_length[2]|max_length[45]');

            $id_turma = $this->input->post('turma');
            $id_avaliacao_recuperacao = $this->input->post('avaliacao_recuperacao');


// $alunos_por_turma = $this->turma_model->obter_todos_alunos_turma($id_turma)->result();

            $id_alunos_recuperacao = $this->session->userdata("alunos_recuperacao");

            for ($i = 0; $i < count($id_alunos_recuperacao); $i++) {

                $input_name = 'aluno_' . $id_alunos_recuperacao[$i];
                $valor_nota_aluno = $this->input->post($input_name);

                $nota_exite = $this->avaliacao_model->verificar_nota_avaliacao_recuperacao_exite($id_avaliacao_recuperacao, $id_alunos_recuperacao[$i])->result();

                if (count($nota_exite) == 0) {
                    $dados = array(
                        "valor_nota_avaliacao_recuperacao" => $valor_nota_aluno,
                        "aluno_id_aluno" => $id_alunos_recuperacao[$i],
                        "avaliacao_recuperacao_id_avaliacao_recuperacao" => $id_avaliacao_recuperacao
                    );
                    $this->avaliacao_model->salvar_nota_avaliacao_recuperacao_aluno($dados);
                } else {

                    $dados = array(
                        "valor_nota_avaliacao_recuperacao" => $valor_nota_aluno
                    );
                    $this->avaliacao_model->alterando_nota_avaliacao_recuperacao_aluno($dados, $id_avaliacao_recuperacao, $id_alunos_recuperacao[$i]);
                }
            }

            redirect(base_url("cpainel/notas?turma=" . $id_turma));
// }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

//put your code here
}
