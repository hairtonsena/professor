<?php

class aluno_model extends CI_Model {

//    // Obter um aluno por ID;
//    function obter_aluno_id($id_aluno) {
//        return $this->db->get_where('aluno', array('id_aluno' => $id_aluno));
//    }
//
    // Obter um aluno por cpf;
    function obter_aluno_cpf($cpf) {
        return $this->db->get_where('aluno', array('cpf_aluno' => $cpf));
    }

    // Obter um aluno por matricula 
    function obter_aluno_matricula($matricula) {
        return $this->db->get_where('aluno', array('matricula_aluno' => $matricula));
    }

//    // alterando os dados do aluno pelo id;
//    function alterar_dados_aluno($dados, $id_aluno) {
//        $this->db->where('id_aluno', $id_aluno);
//        $this->db->update('aluno', $dados);
//    }



    // Obter as disciplinas e turmas do aluno.
    function obter_disciplina_turma_aluno($id_aluno) {
        $this->db->select('*');
        $this->db->from('aluno');
        $this->db->join('aluno_has_turma', 'aluno_has_turma.aluno_id_aluno=aluno.id_aluno');
        $this->db->join('turma', 'aluno_has_turma.turma_id_turma=turma.id_turma');
        $this->db->join('disciplina', 'disciplina.id_disciplina=turma.disciplina_id_disciplina');
        $this->db->where(array('aluno.id_aluno' => $id_aluno,'turma.status_turma'=>1));
        return $this->db->get();
    }

    
    
//    // Obter as disciplinas e turmas do aluno.
//    function obter_disciplina_turma_ativa_arquivada_aluno($id_aluno) {
//        $this->db->select('*');
//        $this->db->from('aluno');
//        $this->db->join('aluno_has_turma', 'aluno_has_turma.aluno_id_aluno=aluno.id_aluno');
//        $this->db->join('turma', 'aluno_has_turma.turma_id_turma=turma.id_turma');
//        $this->db->join('disciplina', 'disciplina.id_disciplina=turma.disciplina_id_disciplina');
//        $this->db->where(array('aluno.id_aluno' => $id_aluno,'turma.status_turma >'=>0));
//        return $this->db->get();
//    }
//
//    // obter todos aluno já cadastrado  nesta turma.
//    function alunos_na_turma($id_turma) {
//        return $this->db->get_where('aluno_has_turma', array('turma_id_turma' => $id_turma));
//    }
//
//    // verificar se alunos esta cadastrado na turma.
//    function aluno_em_turma($id_aluno, $id_turma) {
//        return $this->db->get_where('aluno_has_turma', array('aluno_id_aluno' => $id_aluno, 'turma_id_turma' => $id_turma));
//    }
//
//    function excluir_aluno_em_tuma($id_aluno, $id_turma) {
//        $this->db->delete('aluno_has_turma', array('aluno_id_aluno' => $id_aluno, 'turma_id_turma' => $id_turma));
//    }

    //put your code here
}

?>
