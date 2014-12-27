<?php

class trabalho_model extends CI_Model {

    function obter_notas_trabalho($id_turma) {
        $this->db->select('aluno.id_aluno, trabalho.id_trabalho, nota_trabalho.valor_nota_trabalho');
        $this->db->from('aluno');
        $this->db->join('nota_trabalho', 'nota_trabalho.aluno_id_aluno = aluno.id_aluno');
        $this->db->join('trabalho', 'trabalho.id_trabalho=nota_trabalho.trabalho_id_trabalho', 'right');
        $this->db->where('trabalho.turma_id_turma', $id_turma);
        return $this->db->get();
    }

    // função para pegar todos os trabalhos que estão cadatrados para uma determinada turma.
    function obter_todos_trabalhos_turma($id_turma) {
        return $this->db->get_where('trabalho', array('turma_id_turma' => $id_turma));
    }

    // Função para salvar um novo trabalho.
    function salvar_novo_trabalho($dados) {
        $this->db->insert('trabalho', $dados);
    }

    // Função para verificar se nota já foi criada.
    function verificar_nota_exite($id_avaliacao, $id_aluno) {
        return $this->db->get_where('nota_avaliacao', array('avaliacao_id_avaliacao' => $id_avaliacao, 'aluno_id_aluno' => $id_aluno));
    }

    // Savanda nota que não foi criada ainda
    function salvar_nota_avaliacao_aluno($dados) {
        $this->db->insert('nota_avaliacao', $dados);
    }

    // Alterando nota que já foi criada para o aluno e para a avaliação
    function alterando_nota_avaliacao_aluno($dados, $id_avaliacao, $id_aluno) {
        $this->db->where(array('aluno_id_aluno' => $id_aluno, 'avaliacao_id_avaliacao' => $id_avaliacao));
        $this->db->update('nota_avaliacao', $dados);
    }

    function excluirNoticia($id_noticia) {
        $this->db->delete('noticia_inicio', array('id_noticia' => $id_noticia));
    }

    //put your code here
}

?>
