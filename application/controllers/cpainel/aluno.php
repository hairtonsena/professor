<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Aluno extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('cpainel/trabalho_model');
        $this->load->model('cpainel/turma_model');
        $this->load->model('cpainel/aluno_model');
        $this->load->model('cpainel/avaliacao_model');
//        $this->load->library('upload');
        date_default_timezone_set('UTC');
    }

    public function index() {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $alunos = $this->aluno_model->obter_todos_alunos()->result();

            $dados = array(
                "alunos" => $alunos
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/aluno/aluno_view', $dados);

            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    //Função para exibir o formulário cadastrar um novo aluno.
    public function novo() {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/aluno/forme_novo_aluno_view');
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para visualizar o aluno, as disciplinas e suas turmas
    public function ver() {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $id_aluno = $this->uri->segment(4);

            $aluno = $this->aluno_model->obter_aluno_id($id_aluno)->result();
            if (count($aluno) == 0) {
                redirect(base_url("cpainel/aluno"));
            }
            foreach ($aluno as $an) {
                if ($an->status_aluno == 0) {
                    redirect(base_url("cpainel/aluno"));
                }
            }

            $disciplina_turma_aluno = $this->aluno_model->obter_disciplina_turma_aluno($id_aluno)->result();


            $dados = array(
                "aluno" => $aluno,
                "disciplina_turma_aluno" => $disciplina_turma_aluno
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/aluno/ver_aluno_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para visualizar o aluno e seu dados
    public function disciplina_turma() {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            if (!$this->input->get("aluno", TRUE) && !$this->input->get("turma", TRUE)) {
                redirect(base_url("cpainel/aluno"));
            }
            $id_aluno = $this->input->get("aluno");
            $id_turma = $this->input->get("turma");

            $aluno = $this->aluno_model->obter_aluno_id($id_aluno)->result();
            if (count($aluno) == 0) {
                redirect(base_url("cpainel/aluno"));
            }
            foreach ($aluno as $an) {
                if ($an->status_aluno == 0) {
                    redirect(base_url("cpainel/aluno"));
                }
            }

            $disciplina_turma_aluno = $this->aluno_model->obter_disciplina_turma_aluno($id_aluno)->result();
            $disciplina_turma = array();
            foreach ($disciplina_turma_aluno as $dta) {
                if ($dta->id_turma == $id_turma)
                    $disciplina_turma[] = $dta;
            }

            $dados = array(
                "aluno" => $aluno,
                "disciplina_turma" => $disciplina_turma
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/aluno/disciplina_turma_aluno_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para visualizar as avaliações do aluno selecionado
    public function disciplina_turma_avaliacao() {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            // Validações 
            if (!$this->input->get("aluno", TRUE) && !$this->input->get("turma", TRUE)) {
                redirect(base_url("cpainel/aluno"));
            }
            $id_aluno = $this->input->get("aluno");
            $id_turma = $this->input->get("turma");

            $aluno = $this->aluno_model->obter_aluno_id($id_aluno)->result();
            if (count($aluno) == 0) {
                redirect(base_url("cpainel/aluno"));
            }
            foreach ($aluno as $an) {
                if ($an->status_aluno == 0) {
                    redirect(base_url("cpainel/aluno"));
                }
            }
            // Fim de validações 
            // Pegando apenas a disciplina e turma escolhida
            $disciplina_turma_aluno = $this->aluno_model->obter_disciplina_turma_aluno($id_aluno)->result();
            $disciplina_turma = array();
            foreach ($disciplina_turma_aluno as $dta) {
                if ($dta->id_turma == $id_turma)
                    $disciplina_turma[] = $dta;
            }

            // Adicionando a nota do aluno para cada avaliação.
            $avaliacao_turma = $this->avaliacao_model->obter_todas_avaliacoes_turma($id_turma)->result();
            foreach ($avaliacao_turma as $at) {

                $nota_aluno_avaliacao = $this->avaliacao_model->obter_nota_avaliacao_um_aluno($at->id_avaliacao, $id_aluno)->result();
                if (count($nota_aluno_avaliacao) == 0) {
                    $at->nota_aluno = 0;
                } else {
                    foreach ($nota_aluno_avaliacao as $naa) {
                        $at->nota_aluno = $naa->valor_nota;
                    }
                }
            }

            $dados = array(
                "aluno" => $aluno,
                "disciplina_turma" => $disciplina_turma,
                "avaliacoes_turma" => $avaliacao_turma,
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/aluno/disciplina_turma_avaliacao_aluno_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para visualizar os trabalhos do aluno selecionado.
    public function disciplina_turma_trabalho() {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            // Validações 
            if (!$this->input->get("aluno", TRUE) && !$this->input->get("turma", TRUE)) {
                redirect(base_url("cpainel/aluno"));
            }
            $id_aluno = $this->input->get("aluno");
            $id_turma = $this->input->get("turma");

            $aluno = $this->aluno_model->obter_aluno_id($id_aluno)->result();
            if (count($aluno) == 0) {
                redirect(base_url("cpainel/aluno"));
            }
            foreach ($aluno as $an) {
                if ($an->status_aluno == 0) {
                    redirect(base_url("cpainel/aluno"));
                }
            }
            // Fim de validações 
            // Pegando apenas a disciplina e turma escolhida
            $disciplina_turma_aluno = $this->aluno_model->obter_disciplina_turma_aluno($id_aluno)->result();
            $disciplina_turma = array();
            foreach ($disciplina_turma_aluno as $dta) {
                if ($dta->id_turma == $id_turma)
                    $disciplina_turma[] = $dta;
            }


            // Adicionando a nota do aluno para cada trabalho.
            $trabalhos_turma = $this->trabalho_model->obter_todos_trabalhos_turma($id_turma)->result();
            foreach ($trabalhos_turma as $tt) {

                $nota_aluno_trabalho = $this->trabalho_model->obter_nota_trabalho_um_aluno($tt->id_trabalho, $id_aluno)->result();
                if (count($nota_aluno_trabalho) == 0) {
                    $tt->nota_aluno = 0;
                } else {
                    foreach ($nota_aluno_trabalho as $nat) {
                        $tt->nota_aluno = $nat->valor_nota_trabalho;
                    }
                }
            }

            $dados = array(
                "aluno" => $aluno,
                "disciplina_turma" => $disciplina_turma,
                "trabalhos_turma" => $trabalhos_turma,
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/aluno/disciplina_turma_trabalho_aluno_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para visualizar as notas do aluno selecionado.
    public function disciplina_turma_nota() {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            // Validações 
            if (!$this->input->get("aluno", TRUE) && !$this->input->get("turma", TRUE)) {
                redirect(base_url("cpainel/aluno"));
            }
            $id_aluno = $this->input->get("aluno");
            $id_turma = $this->input->get("turma");

            $aluno = $this->aluno_model->obter_aluno_id($id_aluno)->result();
            if (count($aluno) == 0) {
                redirect(base_url("cpainel/aluno"));
            }
            foreach ($aluno as $an) {
                if ($an->status_aluno == 0) {
                    redirect(base_url("cpainel/aluno"));
                }
            }
            // Fim de validações 
            // Pegando apenas a disciplina e turma escolhida
            $disciplina_turma_aluno = $this->aluno_model->obter_disciplina_turma_aluno($id_aluno)->result();
            $disciplina_turma = array();
            foreach ($disciplina_turma_aluno as $dta) {
                if ($dta->id_turma == $id_turma)
                    $disciplina_turma[] = $dta;
            }






            // Adicionando a nota do aluno para cada avaliação.
            $avaliacao_turma = $this->avaliacao_model->obter_todas_avaliacoes_turma($id_turma)->result();
            foreach ($avaliacao_turma as $at) {

                $nota_aluno_avaliacao = $this->avaliacao_model->obter_nota_avaliacao_um_aluno($at->id_avaliacao, $id_aluno)->result();
                if (count($nota_aluno_avaliacao) == 0) {
                    $at->nota_aluno = 0;
                } else {
                    foreach ($nota_aluno_avaliacao as $naa) {
                        $at->nota_aluno = $naa->valor_nota;
                    }
                }
            }


            // Adicionando a nota do aluno para cada trabalho.
            $trabalho_turma = $this->trabalho_model->obter_todos_trabalhos_turma($id_turma)->result();
            foreach ($trabalho_turma as $tt) {

                $nota_aluno_trabalho = $this->trabalho_model->obter_nota_trabalho_um_aluno($tt->id_trabalho, $id_aluno)->result();
                if (count($nota_aluno_trabalho) == 0) {
                    $tt->nota_aluno = 0;
                } else {
                    foreach ($nota_aluno_trabalho as $nat) {
                        $tt->nota_aluno = $nat->valor_nota_trabalho;
                    }
                }
            }

            // Adicionando a nota de recuperação do aluno.
            $avaliacao_recuperacao_turma = $this->avaliacao_model->obter_avaliacao_recuperacao($id_turma)->result();
            foreach ($avaliacao_recuperacao_turma as $art) {
                $nota_aluno_recuperacao = $this->avaliacao_model->obter_nota_avaliacao_recuperacao_um_aluno($art->id_avaliacao_recuperacao, $id_aluno)->result();
                if (count($nota_aluno_recuperacao) == 0) {
                    $art->nota_aluno = null;
                } else {
                    foreach ($nota_aluno_recuperacao as $nar) {
                        $art->nota_aluno = $nar->valor_nota_avaliacao_recuperacao;
                    }
                }
            }


            $dados = array(
                "aluno" => $aluno,
                "disciplina_turma" => $disciplina_turma,
                "avaliacoes_turma" => $avaliacao_turma,
                "trabalhos_turma" => $trabalho_turma,
                "recuperacao_turma" => $avaliacao_recuperacao_turma,
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/aluno/disciplina_turma_nota_aluno_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para salvar aluno e adicionar em uma turma.
    public function salvar_novo_aluno() {
        // veirificando usuario logado
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $this->form_validation->set_rules('nome_aluno', 'Nome', 'required|trim|min_length[4]|max_length[45]');
            $this->form_validation->set_rules('matricula_aluno', 'Matricula', 'required|trim|min_length[5]|max_length[10]|callback_aluno_existe_check');
            $this->form_validation->set_rules('cpf_aluno', 'CPF', 'required|trim|min_length[11]|max_length[14]|callback_cpf_check|callback_aluno_existe_check');

            $id_turma = $this->input->post('turma');

            if ($this->form_validation->run() == FALSE) {
                $this->novo($id_turma);
            } else {

                $nome_aluno = $this->input->post('nome_aluno');
                $matricula_aluno = $this->input->post('matricula_aluno');
                $cpf_aluno = $this->input->post('cpf_aluno');

                $cpf_aluno = $this->add_mascara_cpf($cpf_aluno);

                $dados = array(
                    "nome_aluno" => $nome_aluno,
                    "matricula_aluno" => $matricula_aluno,
                    "cpf_aluno" => $cpf_aluno,
                    "senha_aluno" => md5($cpf_aluno),
                    "status_aluno" => 0
                );

                $this->aluno_model->salvar_novo_aluno($dados);

                redirect(base_url("cpainel/aluno"));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para o professor alterar a senha do aluno.
    public function alterar_senha_aluno() {
        // veirificando usuario logado
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $this->form_validation->set_rules('senha', 'Senha', 'required|trim|min_length[6]|max_length[45]');

            $id_aluno = $this->input->post('aluno');

            if ($this->form_validation->run() == FALSE) {
                echo "Senha muito curta";
            } else {

                $senha = $this->input->post('senha');
                $dados = array(
                    "senha_aluno" => md5($senha),
                );

                $this->aluno_model->alterar_dados_aluno($dados, $id_aluno);

                echo "1";
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    //Função para exibir o formulário de alterar aluno.
    public function alterar($id_aluno = null) {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            if ($id_aluno == null) {
                $id_aluno = $this->uri->segment(4);
            }
            $aluno = $this->aluno_model->obter_aluno_id($id_aluno)->result();

            $dados = array(
                "aluno" => $aluno
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/aluno/forme_alterar_aluno_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para salvar aluno e adicionar em uma turma.
    public function salvar_aluno_alterado() {
        // veirificando usuario logado
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $this->form_validation->set_rules('nome_aluno', 'Nome', 'required|trim|min_length[4]|max_length[45]');
            $this->form_validation->set_rules('matricula_aluno', 'Matricula', 'required|trim|min_length[5]|max_length[10]|callback_aluno_existe_alterar_check');
            $this->form_validation->set_rules('cpf_aluno', 'CPF', 'required|trim|min_length[11]|max_length[14]|callback_cpf_check|callback_aluno_existe_alterar_check');

            $id_aluno = $this->input->post('aluno');

            if ($this->form_validation->run() == FALSE) {
                $this->alterar($id_aluno);
            } else {

                $nome_aluno = $this->input->post('nome_aluno');
                $matricula_aluno = $this->input->post('matricula_aluno');
                $cpf_aluno = $this->input->post('cpf_aluno');

                $cpf_aluno = $this->add_mascara_cpf($cpf_aluno);

                $dados = array(
                    "nome_aluno" => $nome_aluno,
                    "matricula_aluno" => $matricula_aluno,
                    "cpf_aluno" => $cpf_aluno
                );

                $this->aluno_model->alterar_dados_aluno($dados, $id_aluno);

                redirect(base_url("cpainel/aluno"));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    //Função para cadastrar um novo aluno e adicionar na turma
    public function novo_turma($id_turma = null) {
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
            $this->load->view('cpainel/aluno/forme_novo_aluno_turma_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para salvar aluno e adicionar em uma turma.
    public function salvar_novo_aluno_turma() {
        // veirificando usuario logado
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $this->form_validation->set_rules('nome_aluno', 'Nome', 'required|trim|min_length[4]|max_length[45]');
            $this->form_validation->set_rules('matricula_aluno', 'Matricula', 'required|trim|min_length[5]|max_length[10]|callback_aluno_existe_check');
            $this->form_validation->set_rules('cpf_aluno', 'CPF', 'required|trim|min_length[11]|max_length[14]|callback_cpf_check|callback_aluno_existe_check');

            $id_turma = $this->input->post('turma');

            if ($this->form_validation->run() == FALSE) {
                $this->novo_turma($id_turma);
            } else {

                $nome_aluno = $this->input->post('nome_aluno');
                $matricula_aluno = $this->input->post('matricula_aluno');
                $cpf_aluno = $this->input->post('cpf_aluno');

                $cpf_aluno = $this->add_mascara_cpf($cpf_aluno);

                $dados = array(
                    "nome_aluno" => $nome_aluno,
                    "matricula_aluno" => $matricula_aluno,
                    "cpf_aluno" => $cpf_aluno,
                    "senha_aluno" => md5($cpf_aluno),
                    "status_aluno" => 0
                );

                $this->aluno_model->salvar_novo_aluno($dados);

                $aluno_salvo = $this->aluno_model->obter_aluno_salvo($cpf_aluno)->result();

                $id_aluno_salvo;
                foreach ($aluno_salvo as $as) {
                    $id_aluno_salvo = $as->id_aluno;
                }

                $dados_aluno_turma = array(
                    "aluno_id_aluno" => $id_aluno_salvo,
                    "turma_id_turma" => $id_turma
                );

                $this->aluno_model->salvar_aluno_turma($dados_aluno_turma);


                redirect(base_url("cpainel/turma/alunos/" . $id_turma));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    private function add_mascara_cpf($cpf) {
        $cpf_retorno = '';
        if (strlen($cpf) == 11) {
            $conte = 0;

            //echo strlen($cpf);

            for ($i = 0; $i < strlen($cpf); $i++) {
                if ($i == 2) {
                    $cpf_retorno = $cpf_retorno . $cpf[$i] . '.';
                } else if ($i == 5) {
                    $cpf_retorno = $cpf_retorno . $cpf[$i] . '.';
                } else if ($i == 8) {
                    $cpf_retorno = $cpf_retorno . $cpf[$i] . '-';
                } else {
                    $cpf_retorno = $cpf_retorno . $cpf[$i];
                }
            }
        } else {
            $cpf_retorno = $cpf;
        }
        return $cpf_retorno;
    }

    // Função para verificar se o aluno já está cadastrado pelo cpf.
    public function aluno_existe_check($campo) {
        $aluno_existe = 0;
        if (strlen($campo) >= 11 && strlen($campo) <= 14) {
            $cpf = $this->add_mascara_cpf($campo);
            $aluno = $this->aluno_model->obter_aluno_cpf($cpf)->result();
            if (count($aluno) > 0) {
                $aluno_existe = 1;
            }
        } else {
            $aluno = $this->aluno_model->obter_aluno_matricula($campo)->result();
            if (count($aluno) > 0) {
                $aluno_existe = 1;
            }
        }

        if ($aluno_existe === 1) {
            $this->form_validation->set_message('aluno_existe_check', 'Aluno já cadastra para %s : ' . $campo . '.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // Função para valiar  validar o CPF do aluno que está sendo cadastrado
    public function cpf_check($cpf) {

//Etapa 1: Cria um array com apenas os digitos numéricos, isso permite receber o cpf em diferentes formatos como "000.000.000-00", "00000000000", "000 000 000 00" etc...
        $j = 0;
        for ($i = 0; $i < (strlen($cpf)); $i++) {
            if (is_numeric($cpf[$i])) {
                $num[$j] = $cpf[$i];
                $j++;
            }
        }
//Etapa 2: Conta os dígitos, um cpf válido possui 11 dígitos numéricos.
        if (count($num) != 11) {
            $isCpfValid = false;
        }
//Etapa 3: Combinações como 00000000000 e 22222222222 embora não sejam cpfs reais resultariam em cpfs válidos após o calculo dos dígitos ve rificares e por isso precisam ser filtradas nesta parte.
        else {
            for ($i = 0; $i < 10; $i++) {
                if ($num[0] == $i && $num[1] == $i && $num[2] == $i && $num[3] == $i && $num[4] == $i && $num[5] == $i && $num[6] == $i && $num[7] == $i && $num[8] == $i) {
                    $isCpfValid = false;
                    break;
                }
            }
        }
//Etapa 4: Calcula e compara o primeiro dígito verificador.
        if (!isset($isCpfValid)) {
            $j = 10;
            for ($i = 0; $i < 9; $i++) {
                $multiplica[$i] = $num[$i] * $j;
                $j--;
            }
            $soma = array_sum($multiplica);
            $resto = $soma % 11;
            if ($resto < 2) {
                $dg = 0;
            } else {
                $dg = 11 - $resto;
            }
            if ($dg != $num[9]) {
                $isCpfValid = false;
            }
        }
//Etapa 5: Calcula e compara o segundo dígito verificador.
        if (!isset($isCpfValid)) {
            $j = 11;
            for ($i = 0; $i < 10; $i++) {
                $multiplica[$i] = $num[$i] * $j;
                $j--;
            }
            $soma = array_sum($multiplica);
            $resto = $soma % 11;
            if ($resto < 2) {
                $dg = 0;
            } else {
                $dg = 11 - $resto;
            }
            if ($dg != $num[10]) {
                $isCpfValid = false;
            } else {
                $isCpfValid = true;
            }
        }

//$isCpfValid;


        if ($isCpfValid == FALSE) {
            $this->form_validation->set_message('cpf_check', 'O %s é invalido, Verirfique se digitou corretamente!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // Função para verificar se o aluno já está cadastrado e se ele e diferente do que vai ser alterardo
    // Função presente nas regras de validação do alterar aluno.
    public function aluno_existe_alterar_check($campo) {
        $aluno_existe = 0;
        $id_aluno = $this->input->post('aluno');
        if (strlen($campo) >= 11 && strlen($campo) <= 14) {
            $cpf = $this->add_mascara_cpf($campo);
            $aluno = $this->aluno_model->obter_aluno_cpf($cpf)->result();
            if (count($aluno) > 0) {
                foreach ($aluno as $al) {
                    if ($al->id_aluno != $id_aluno)
                        $aluno_existe = 1;
                }
            }
        } else {
            $aluno = $this->aluno_model->obter_aluno_matricula($campo)->result();
            if (count($aluno) > 0) {
                foreach ($aluno as $al) {
                    if ($al->id_aluno != $id_aluno)
                        $aluno_existe = 1;
                }
            }
        }

        if ($aluno_existe === 1) {
            $this->form_validation->set_message('aluno_existe_alterar_check', 'Aluno já cadastra para %s : ' . $campo . '.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function obter_alunos_cadastrados() {
        // veirificando usuario logado
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $texto_pesquisa = $this->input->get('q');
            $id_turma = $this->input->get('turma');

            $alunos_da_turma = $this->aluno_model->alunos_na_turma($id_turma)->result();
            $alunos_pesquisado = $this->aluno_model->obter_alunos_pesquisa_nome($texto_pesquisa, $id_turma)->result();
            $alunos_nao_adicionado = array();

            foreach ($alunos_pesquisado as $ap) {
                $teste = TRUE;
                foreach ($alunos_da_turma as $adt) {
                    if ($ap->id_aluno == $adt->aluno_id_aluno) {
                        $teste = FALSE;
                        break;
                    }
                }
                if ($teste == TRUE) {
                    $alunos_nao_adicionado[] = $ap;
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

    // Função para ativar e desativar aluno
    public function ativar_desativar_aluno() {
        // verificando usuario logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            $id_aluno = $this->input->post('aluno');

            $retorno = '';

            $aluno = $this->aluno_model->obter_aluno_id($id_aluno)->result();
            if (count($aluno) != 0) {
                foreach ($aluno as $al) {
                    if ($al->status_aluno == 0) {
                        $dados = array(
                            "status_aluno" => 1,
                        );

                        $this->aluno_model->alterar_dados_aluno($dados, $id_aluno);

                        $retorno = '1';
                    } else {
                        $dados = array(
                            "status_aluno" => 0,
                        );
                        $this->aluno_model->alterar_dados_aluno($dados, $id_aluno);
                        $retorno = '0';
                    }
                }
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
