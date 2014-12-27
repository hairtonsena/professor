<?php

class avaliacao_model extends CI_Model {

    function obter_notas_avaliacao($id_turma) {
        $this->db->select('aluno.id_aluno, avaliacao.id_avaliacao, nota_avaliacao.valor_nota');
        $this->db->from('aluno');
        $this->db->join('nota_avaliacao', 'nota_avaliacao.aluno_id_aluno = aluno.id_aluno');
        $this->db->join('avaliacao', 'avaliacao.id_avaliacao=nota_avaliacao.avaliacao_id_avaliacao','right');
        $this->db->where('avaliacao.turma_id_turma', $id_turma);
        return $this->db->get();
    }
    // função para pegar todas as avaliações que estão cadatradas para uma determinada turma.
    function obter_todas_avaliacoes_turma($id_turma) {
        return $this->db->get_where('avaliacao', array('turma_id_turma' => $id_turma));
    }

    // Função para salvar uma nova avaliação.
    function salvar_nova_avaliacao($dados) {
        $this->db->insert('avaliacao', $dados);
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
        $this->db->where(array('aluno_id_aluno' => $id_aluno,'avaliacao_id_avaliacao'=>$id_avaliacao));
        $this->db->update('nota_avaliacao', $dados);
    }

    function excluirNoticia($id_noticia) {
        $this->db->delete('noticia_inicio', array('id_noticia' => $id_noticia));
    }

    //put your code here
}

?>
