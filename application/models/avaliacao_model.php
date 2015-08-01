<?php

class avaliacao_model extends CI_Model {

    // função para pegar todas as avaliações que estão cadatradas para uma determinada turma.
    function obter_todas_avaliacoes_turma($id_turma) {
        return $this->db->get_where('avaliacao', array('turma_id_turma' => $id_turma));
    }

    // Função para pegar a nota de um aluno de uma determinada avaliação
    function obter_nota_avaliacao_um_aluno($id_avaliacao, $id_aluno) {
        return $this->db->get_where('nota_avaliacao', array('avaliacao_id_avaliacao' => $id_avaliacao, 'aluno_id_aluno' => $id_aluno));
    }

//    -----Trabalhando cam as nota de recuperação-----

    function obter_avaliacao_recuperacao($id_turma) {
        return $this->db->get_where('avaliacao_recuperacao', array('turma_id_turma' => $id_turma));
    }

    // Função para pegar a nota de um aluno da avaliação de recuperação
    function obter_nota_avaliacao_recuperacao_um_aluno($id_avaliacao_recuperacao, $id_aluno) {
        return $this->db->get_where('nota_avaliacao_recuperacao', array('avaliacao_recuperacao_id_avaliacao_recuperacao' => $id_avaliacao_recuperacao, 'aluno_id_aluno' => $id_aluno));
    }

}

?>
