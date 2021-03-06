<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class turma extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('cpainel/disciplina_model');
        $this->load->model('cpainel/turma_model');
        $this->load->model('cpainel/aluno_model');
        $this->load->model('cpainel/avaliacao_model');
        $this->load->model('cpainel/trabalho_model');
        $this->load->library('upload');
        date_default_timezone_set('UTC');
    }

    // Função iniciol da classe
    public function index() {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            if (!$this->input->get('disciplina', TRUE)) {
                redirect(base_url('cpainel/disciplina'));
            }
            $id_disciplina = $this->input->get('disciplina');
            $discipliana = $this->disciplina_model->obter_uma_disciplina($id_disciplina)->result();
            if (count($discipliana) == 0) {
                redirect(base_url('cpainel/disciplina'));
            }
            $turma = $this->turma_model->obter_turma_ativa_por_disciplina($id_disciplina)->result();

            $dados = array(
                'disciplina' => $discipliana,
                'turma' => $turma
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/turma/turma_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para mestrar apenas as turma arquivadas.
    public function arquivada() {
        // verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            // verificando se o request disciplina foi criando
            if (!$this->input->get('disciplina', TRUE)) {
                redirect(base_url('cpainel/disciplina'));
            }
            $id_disciplina = $this->input->get('disciplina');
            $discipliana = $this->disciplina_model->obter_uma_disciplina($id_disciplina)->result();
            if (count($discipliana) == 0) {
                redirect(base_url('cpainel/disciplina'));
            }
            // buscando as turmas ativas por categorias
            $turma = $this->turma_model->obter_turmas_arquivadas_por_disciplina($id_disciplina)->result();


            $dados = array(
                'disciplina' => $discipliana,
                'turma' => $turma
            );
            // mestrando a tela.
            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/turma/turma_arquivada_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para abrir o formulário de nova turma
    public function nova($id_disciplina = null) {
        // verificando usuario logado
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            // verificando se o id_disciplina já exite
            if ($id_disciplina == null) {
                // se não pega do quarto seguimento da url
                $id_disciplina = $this->uri->segment(4);
            }
            // buscando a disciplina no banco de dados
            $discipliana = $this->disciplina_model->obter_uma_disciplina($id_disciplina)->result();
            // verificando se a disciplina existe
            if (count($discipliana) == 0) {
                // se não exite rediteciona para disciplina.
                redirect(base_url('cpainel/disciplina'));
            }

            $dados = array(
                "disciplina" => $discipliana
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/turma/forme_nova_turma_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para salvar uma nova turma
    public function salvar_nova_turma() {
        // veirificando usuario logado
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            // validando campo nome turma
            $this->form_validation->set_rules('nome_turma', 'Nome', 'required|trim|min_length[2]|max_length[45]');
            // peganda id discipina
            $id_disciplina = $this->input->post('disciplina');
            // testando validação
            if ($this->form_validation->run() == FALSE) {
                $this->nova($id_disciplina);
            } else {
                $nome_turma = $this->input->post("nome_turma");
                // pegando a descrição da nova disciplina
                $dados = array(
                    "nome_turma" => $nome_turma,
                    "disciplina_id_disciplina" => $id_disciplina,
                    "status_turma" => 1
                );
                // enviando os dados para ser salvos 
                $this->turma_model->salvar_nova_turma($dados);

                $turma_cadastrada = $this->turma_model->obter_ultimo_id_turma()->result();
                foreach ($turma_cadastrada as $tc) {
                    $dados = array(
                        "turma_id_turma" => $tc->id_turma,
                        "descricao_avaliacao_recuperacao" => "Avaliação de Recuperação",
                        "valor_avaliacao_recuperacao" => 100
                    );

                    $this->turma_model->salvar_avaliacao_recuperacao($dados);
                }

                redirect(base_url("cpainel/turma?disciplina=" . $id_disciplina));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para ativar e desativar turma. Requisição AJAX.
    public function ativar_desativar_turma() {
        // verificando usuário logado
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            $reterno = '';
            $id_turma = $this->input->post('turma');
            $query = $this->turma_model->obter_uma_turma($id_turma)->result();
            if (count($query) > 0) {
                foreach ($query as $qr) {
                    if ($qr->status_turma == 0) {
                        $dados = array(
                            'status_turma' => 1
                        );
                        $reterno = '1';
                    } else {
                        $dados = array(
                            'status_turma' => 0
                        );
                        $reterno = '0';
                    }
                    $this->turma_model->alterar_dados_turma($dados, $id_turma);
                }
            } else {
                $reterno = "Turma não encontrada!";
            }
            echo $reterno;
        } else {
            echo "Acesso negado!";
        }
    }

    // Função para exibir o formulário de alterar turma.
    public function alterar($id_turma = NULL) {
        // Verificando usuário logado
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            // Verificando se $id_turma já existe.
            if ($id_turma == NULL) {
                // Se não exite pegar do quarto seguimento da url.
                $id_turma = $this->uri->segment(4);
            }
            // buscando a turma no banco de dados
            $turma = $this->turma_model->obter_uma_turma($id_turma)->result();
            // Verificando se a turma existe.
            if (count($turma) == 0) {
                // Se não existe redireciona para discipina
                redirect(base_url("cpainel/disciplina"));
            }

            $id_disciplina = '';
            foreach ($turma as $tm) {
                $id_disciplina = $tm->disciplina_id_disciplina;
            }


            // Buscando a disciplina da turma
            $disciplina = $this->disciplina_model->obter_uma_disciplina($id_disciplina)->result();
            // Verificando se a disciplina existe.
            if (count($disciplina) == 0) {
                // Se não redireciona para disciplina.
                redirect(base_url("cpainel/disciplina"));
            }
            // criando dados para a tela
            $dados = array(
                'turma' => $turma,
                'disciplina' => $disciplina
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/turma/forme_editar_turma_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para salvar dados da alterados
    public function salvar_turma_alterada() {
        // verificando usuário logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            // funçõa do codeigniter para validar campos do formulário de alterar turma.
            $this->form_validation->set_rules('nome_turma', 'Nome', 'required|trim|min_length[2]|max_length[45]');
            //pegando o id da turma que será alterada
            $id_turma = $this->input->post('turma');
            // verificando se a validação foi aceita.
            if ($this->form_validation->run() == FALSE) {
                // Se a validação não passou retorne para o formulário de alteração com as mensagens de erro.
                $this->alterar($id_turma);
            } else {
                // pegando o nome da turma que veio do formulário alterar
                $nome_turma = $this->input->post('nome_turma');
                // criando um array de dados para salvar a alteração no banco.
                $dados = array(
                    'nome_turma' => $nome_turma,
                    'id_turma' => $id_turma
                );
                // enviando os dados alterados para o banco de dados.
                $this->turma_model->alterar_dados_turma($dados, $id_turma);
                // buscando a turma no banco de dados
                $turma = $this->turma_model->obter_uma_turma($id_turma)->result();
                // Criando uma variavel para armazenar o id disciplina.
                $id_disciplina = '';
                // Percorrendo o arrar.
                foreach ($turma as $tm) {
                    // Pegando o id_disciplina presente na turma;
                    $id_disciplina = $tm->disciplina_id_disciplina;
                }

                redirect(base_url("cpainel/turma?disciplina=" . $id_disciplina));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para excluir um turma. Requisição ajax.
    public function excluir() {
        // verificando usuario logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $id_turma = $this->input->post('turma');

            $retorno = '';
            $query = $this->turma_model->obter_uma_turma($id_turma)->result();

            if (count($query) != 0) {
                // Função verifica se existe algum dados gadastrado de aluno, avaliação e trabalho.
                if ($this->verificar_avaliacao_trabalho_aluno_na_turma($id_turma) == TRUE) {

                    $avaliacao_recuperacao = $this->avaliacao_model->obter_avaliacao_recuperacao($id_turma)->result();
                    foreach ($avaliacao_recuperacao as $ar) {
                        $this->avaliacao_model->excluir_nota_avaliacao_recuperacao_todos_aluno($ar->id_avaliacao_recuperacao);
                    }
                    $this->avaliacao_model->excluir_avaliacao_recuperacao_turma($id_turma);

                    $this->turma_model->excluir_turma($id_turma);
                    $retorno = '1';
                } else {
                    $retorno = "A turma não pode ser excluida!<br/>Exclua primeiro os alunos, as avaliações e os trabalhos";
                }
            } else {
                $retorno = 'Turma não foi encontrada!';
            }
            echo $retorno;
        } else {
            echo "Acesso negado!";
        }
    }

    // Função para verificar de existe aluno, avaliação ou trabalho cadastrada na turma.
    protected function verificar_avaliacao_trabalho_aluno_na_turma($id_turma) {

        $retorno = TRUE;

        $aluno_turma = $this->aluno_model->alunos_na_turma($id_turma)->result();
        if (count($aluno_turma) > 0) {
            $retorno = FALSE;
        }

        $avaliacao_turma = $this->avaliacao_model->obter_todas_avaliacoes_turma($id_turma)->result();
        if (count($avaliacao_turma) > 0) {
            $retorno = FALSE;
        }

        $trabalho_turma = $this->trabalho_model->obter_todos_trabalhos_turma($id_turma)->result();
        if (count($trabalho_turma) > 0) {
            $retorno = FALSE;
        }

        return $retorno;
    }

    // Função para arquivar um turma. Requisição ajax.
    public function arquivar() {
        // verificando usuario logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $id_turma = $this->input->post('turma');

            $retorno = '';
            $query = $this->turma_model->obter_uma_turma($id_turma)->result();

            if (count($query) != 0) {

                $dados = array(
                    "status_turma" => 2
                );

                $this->turma_model->alterar_dados_turma($dados, $id_turma);
                $retorno = '1';
            } else {
                $retorno = 'Turma não foi encontrada!';
            }
            echo $retorno;
        } else {
            echo "Acesso negado!";
        }
    }

    // Função para desarquiva um turma e retornar o valor para requisição ajax.
    public function desarquivar() {
        // verificando usuario logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $id_turma = $this->input->post('turma');

            $retorno = '';
            $query = $this->turma_model->obter_uma_turma($id_turma)->result();

            if (count($query) != 0) {

                $dados = array(
                    "status_turma" => 1
                );

                $this->turma_model->alterar_dados_turma($dados, $id_turma);
                $retorno = '1';
            } else {
                $retorno = 'Turma não foi encontrada!';
            }
            echo $retorno;
        } else {
            echo "Acesso negado!";
        }
    }

    // função para mostra a turma e disciplina juntas
    public function alunos() {
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            $id_turma = $this->uri->segment(4);

            $turma_disciplina = $this->turma_model->obter_turma_disciplina($id_turma)->result();
            if (count($turma_disciplina) == 0) {
                redirect(base_url("cpainel/disciplina"));
            }
            $alunos_por_turma = $this->turma_model->obter_todos_alunos_turma($id_turma)->result();

            $dados = array(
                "turma_disciplina" => $turma_disciplina,
                "alunos_turma" => $alunos_por_turma
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/turma/turma_selecionada_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    //----------------------------------//
    // Trabalho com o harário da turma  //
    //----------------------------------//
    // função para mostra a turma, disciplina e o horário da turma
    public function horario() {
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            $id_turma = $this->uri->segment(4);
            $turma_disciplina = $this->turma_model->obter_turma_disciplina($id_turma)->result();
            if (count($turma_disciplina) == 0) {
                redirect(base_url("cpainel/disciplina"));
            }

            $dados = array(
                "turma_disciplina" => $turma_disciplina,
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/turma/horario_turma_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para mostra o formulário de alterar horário da turma.
    public function alterar_horario() {
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            $id_turma = $this->uri->segment(4);

            $turma_disciplina = $this->turma_model->obter_turma_disciplina($id_turma)->result();
            if (count($turma_disciplina) == 0) {
                redirect(base_url("cpainel/disciplina"));
            }

            $dados = array(
                "turma_disciplina" => $turma_disciplina,
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/turma/forme_alterar_horario_turma_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function salvar_horario() {
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            if (!$this->input->post("turma", TRUE)) {
                redirect(base_url("cpainel/"));
            }

            $id_turma = $this->input->post("turma");
            $horario_turma = $this->input->post("horario_turma");

            $turma_disciplina = $this->turma_model->obter_turma_disciplina($id_turma)->result();
            if (count($turma_disciplina) == 0) {
                redirect(base_url("cpainel/"));
            }

            $dados = array(
                "horario_turma" => $horario_turma
            );

            $this->turma_model->alterar_dados_turma($dados, $id_turma);

            redirect(base_url("cpainel/turma/horario/" . $id_turma));
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

}

?>
