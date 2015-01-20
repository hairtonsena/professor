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
        $this->load->model('cpainel/avaliacao_model');
        $this->load->library('upload');
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

// Função para mostra o trabalho e anexos.
    public function ver_trabalho($id_trabalho = NULL) {
// verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            if ($id_trabalho == null) {
                $id_trabalho = $this->uri->segment(4);
            }


            $trabalho = $this->trabalho_model->obter_um_trabalho($id_trabalho)->result();
            $anexos_trabalho = $this->trabalho_model->obeter_anexos_trabalho($id_trabalho)->result();
            $trabalhos_alunos = $this->trabalho_model->obeter_trabalho_dos_alunos($id_trabalho)->result();
            
            
            $id_turma;
            foreach ($trabalho as $tr) {
                $id_turma = $tr->turma_id_turma;
            }


            $turma_disciplina = $this->turma_model->obter_turma_disciplina($id_turma)->result();

            $dados = array(
                "turma_disciplina" => $turma_disciplina,
                "trabalho" => $trabalho,
                "anexo_trabalho" => $anexos_trabalho,
                "trabalhos_alunos" => $trabalhos_alunos
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/trabalho/ver_trabalho_view', $dados);
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
            $this->form_validation->set_rules('valor_trabalho', 'Valor nota', 'required|trim|min_length[0]|max_length[45]|callback_varificar_total_notas_distribuidas_check');

            $id_turma = $this->input->post('turma');

            if ($this->form_validation->run() == FALSE) {
                $this->novo($id_turma);
            } else {

                $titulo_trabalho = $this->input->post('titulo_trabalho');
                $descricao_trabalho = $this->input->post('descricao_trabalho');
                $data_entrega_trabalho = $this->input->post('data_entrega_trabalho');
                $valor_nota_trabalho = $this->input->post('valor_trabalho');
                $abilitar_upload = 0;
                if ($this->input->post('abilitar_upload_trabalho', TRUE)) {
                    $abilitar_upload = 1;
                }

                $pasta = "pas_" . uniqid();

                mkdir("trabalho/" . $pasta, 0777, TRUE);


                $dados = array(
                    "titulo_trabalho" => $titulo_trabalho,
                    "descricao_trabalho" => $descricao_trabalho,
                    "data_entrega_trabalho" => $data_entrega_trabalho,
                    "valor_nota_trabalho" => $valor_nota_trabalho,
                    "abilitar_upload_trabalho" => $abilitar_upload,
                    "pasta_upload_trabalho" => $pasta,
                    "turma_id_turma" => $id_turma
                );

                $this->trabalho_model->salvar_novo_trabalho($dados);
                $trabalho_salvo = $this->trabalho_model->obter_trabalho_salvo($dados)->result();
                $id_trabalho;
                foreach ($trabalho_salvo as $ts) {
                    $id_trabalho = $ts->id_trabalho;
                }

                redirect(base_url("cpainel/trabalho/ver_trabalho/" . $id_trabalho));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    function varificar_total_notas_distribuidas_check($valor_nota_campo = NULL) {
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

            $id_trabalho = $this->input->post('trabalho');
            $trabalho = $this->trabalho_model->obter_um_trabalho($id_trabalho)->result();
            $id_turma;
            foreach ($trabalho as $tr) {
                $id_turma = $tr->turma_id_turma;
            }

            $trabalho_por_turma = $this->trabalho_model->obter_todos_trabalhos_turma($id_turma)->result();
            $avaliacao_por_turma = $this->avaliacao_model->obter_todas_avaliacoes_turma($id_turma)->result();
            foreach ($trabalho_por_turma as $tpt) {
                if ($tpt->id_trabalho != $id_trabalho)
                    $total_pontos_ja_distribuidos += $tpt->valor_nota_trabalho;
            }
            foreach ($avaliacao_por_turma as $apt) {
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

// Função para mostra o formulário de alterar trabalho
    public function alterar_trabalho($id_trabalho = NULL) {
// verificando se o usuário está logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {
            if ($id_trabalho == null) {
                $id_trabalho = $this->uri->segment(4);
            }

            $trabalho = $this->trabalho_model->obter_um_trabalho($id_trabalho)->result();
            $id_turma;
            foreach ($trabalho as $tr) {
                $id_turma = $tr->turma_id_turma;
            }


            $turma_disciplina = $this->turma_model->obter_turma_disciplina($id_turma)->result();

            $dados = array(
                "turma_disciplina" => $turma_disciplina,
                "trabalho" => $trabalho
            );

            $this->load->view('cpainel/tela/titulo');
            $this->load->view('cpainel/tela/menu');
            $this->load->view('cpainel/trabalho/forme_alterar_trabalho_view', $dados);
            $this->load->view('cpainel/tela/rodape');
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

// Função para salvar os dados alterados do trabalho.
    public function salvar_trabalho_alterada() {
// verificando usuário logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $this->form_validation->set_rules('titulo_trabalho', 'Titulo', 'required|trim|min_length[4]|max_length[45]');
            $this->form_validation->set_rules('descricao_trabalho', 'Descrição', 'required|trim|min_length[4]');
            $this->form_validation->set_rules('data_entrega_trabalho', 'Data entrega', 'required|trim|min_length[2]|max_length[45]');
            $this->form_validation->set_rules('valor_trabalho', 'Valor nota', 'required|trim|min_length[0]|max_length[45]|callback_varificar_total_notas_distribuidas_check');


            $id_trabalho = $this->input->post('trabalho');

            if ($this->form_validation->run() == FALSE) {
                $this->alterar_trabalho($id_trabalho);
            } else {

                $titulo_trabalho = $this->input->post('titulo_trabalho');
                $descricao_trabalho = $this->input->post('descricao_trabalho');
                $data_entrega_trabalho = $this->input->post('data_entrega_trabalho');
                $valor_nota_trabalho = $this->input->post('valor_trabalho');
                $abilitar_upload = 0;
                if ($this->input->post('abilitar_upload_trabalho', TRUE)) {
                    $abilitar_upload = 1;
                }

                $trabalho_atual = $this->trabalho_model->obter_um_trabalho($id_trabalho)->result();
                $valor_atual;
                $id_turma;
                foreach ($trabalho_atual as $ta) {
                    $valor_atual = $ta->valor_nota_trabalho;
                    $id_turma = $ta->turma_id_turma;
                }

                if ($valor_atual == $valor_nota_trabalho) {
                    $dados = array(
                        "titulo_trabalho" => $titulo_trabalho,
                        "descricao_trabalho" => $descricao_trabalho,
                        "data_entrega_trabalho" => $data_entrega_trabalho,
                        "abilitar_upload_trabalho" => $abilitar_upload,
                    );

                    $this->trabalho_model->alterar_trabalho($dados, $id_trabalho);
                } else {
                    $porcentagem = ($valor_nota_trabalho / $valor_atual) * 100;
                    $nota_aluno_trabalho = $this->trabalho_model->obter_nota_trabalho_aluno($id_trabalho)->result();
                    if (count($nota_aluno_trabalho) != 0) {
                        foreach ($nota_aluno_trabalho as $nat) {
                            $dados_nota = array(
                                "valor_nota_trabalho" => ($porcentagem / 100) * $nat->valor_nota_trabalho,
                            );
                            $this->trabalho_model->alterar_nota_trabalho_aluno($dados_nota, $nat->id_nota_trabalho);
                        }
                    }

                    $dados = array(
                        "titulo_trabalho" => $titulo_trabalho,
                        "descricao_trabalho" => $descricao_trabalho,
                        "data_entrega_trabalho" => $data_entrega_trabalho,
                        "valor_nota_trabalho" => $valor_nota_trabalho,
                        "abilitar_upload_trabalho" => $abilitar_upload,
                    );

                    $this->trabalho_model->alterar_trabalho($dados, $id_trabalho);
                }

                redirect(base_url("cpainel/trabalho/?turma=" . $id_turma));
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

// Função para excluir trabalho e as nota se já estive dada;
    public function excluir_trabalho() {
// verificando usuario logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $id_trabalho = $this->input->post('trabalho');

            $retorno = '';
            $trabalho = $this->trabalho_model->obter_um_trabalho($id_trabalho)->result();

            if (count($trabalho) != 0) {
                $pasta;
                foreach ($trabalho as $qr) {
                    $pasta = $qr->pasta_upload_trabalho;
                    break;
                }
                // apagando anexo do professor.
                $anexo_trabalho = $this->trabalho_model->obeter_anexos_trabalho($id_trabalho)->result();
                foreach ($anexo_trabalho as $at) {
                    if (file_exists("trabalho/" . $pasta . "/" . $at->arquivo_anexo_trabalho)) {
                        unlink("trabalho/" . $pasta . "/" . $at->arquivo_anexo_trabalho);
                    }
                    $this->trabalho_model->excluir_anexo_trabalho($at->id_anexo_trabalho);
                }


                $dir = 'trabalho/' . $pasta;
                if (is_dir($dir)) {
                    if ($handle = opendir($dir)) {
                        while (($file = readdir($handle)) !== false) {
                            if ($file != '.' && $file != '..') {
                                unlink($dir . "/" . $file);
                            }
                        }
                    }
                    rmdir($dir);
                }


                $this->trabalho_model->excluir_trabalho($id_trabalho);
                $retorno = '1';
            } else {
                $retorno = 'Trabalho não foi encontrada!';
            }
            echo $retorno;
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    //-----------------------------------//
    // Trabalhando com anexo de trabalho // 
    //-----------------------------------//
    // Função para pegar todos os anexo dos trabalho;
    public function obter_anexos_trabalho_json() {
        // veirificando usuario logado
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $id_trabalho = $this->input->get('trabalho');

            $anexo_trabalho = $this->trabalho_model->obeter_anexos_trabalho($id_trabalho)->result();

            $anexos = array();
            foreach ($anexo_trabalho as $at) {
                $anexos[] = $at;
            }
            echo json_encode($anexos);
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    public function salvar_anexo_trabalho() {
        // verificando usuario logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $id_trabalho = $this->input->post('trabalho');

            $trabalho = $this->trabalho_model->obter_um_trabalho($id_trabalho)->result();
            $pasta;
            if (count($trabalho) > 0) {
                foreach ($trabalho as $tr) {
                    $pasta = $tr->pasta_upload_trabalho;
                }
            }

            $diretorio_anexo = 'trabalho/' . $pasta;

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

                $dados = array(
                    'nome_anexo_trabalho' => $dadosImagem['file_name'],
                    'arquivo_anexo_trabalho' => $dadosImagem['file_name'],
                    'trabalho_id_trabalho' => $id_trabalho,
                );

                $this->trabalho_model->add_anexo_trabalho($dados);
                echo "sucesso";
            }
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

    // Função para excluir anexo de trabalho.
    public function excluir_anexo_trabalho() {
        // verificando usuario logado.
        if (($this->session->userdata('id_professor')) && ($this->session->userdata('nome_professor')) && ($this->session->userdata('email_professor')) && ($this->session->userdata('senha_professor'))) {

            $id_anexo = $this->input->post('anexo');

            $retorno = '';
            $anexo = $this->trabalho_model->obeter_um_anexo_trabalho($id_anexo)->result();

            if (count($anexo) != 0) {
                $pasta;
                $nome_arquivo;
                foreach ($anexo as $an) {
                    $pasta = $an->pasta_upload_trabalho;
                    $nome_arquivo = $an->arquivo_anexo_trabalho;
                }

                if (file_exists("trabalho/" . $pasta . "/" . $nome_arquivo)) {
                    unlink("trabalho/" . $pasta . "/" . $nome_arquivo);
                }

                $this->trabalho_model->excluir_anexo_trabalho($id_anexo);
                $retorno = '1';
            } else {
                $retorno = 'Trabalho não foi encontrada!';
            }
            echo $retorno;
        } else {
            redirect(base_url("cpainel/seguranca"));
        }
    }

}

?>
