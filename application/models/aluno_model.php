<?php

class aluno_model extends CI_Model {

    // Obter um aluno por cpf;
    function obter_aluno_cpf($cpf) {
        return $this->db->get_where('aluno', array('cpf_aluno' => $cpf));
    }

    // Obter um aluno por matricula 
    function obter_aluno_matricula($matricula) {
        return $this->db->get_where('aluno', array('matricula_aluno' => $matricula));
    }

    // Obter as disciplinas e turmas do aluno.
    function obter_disciplina_turma_aluno($id_aluno) {
        $this->db->select('*');
        $this->db->from('aluno');
        $this->db->join('aluno_has_turma', 'aluno_has_turma.aluno_id_aluno=aluno.id_aluno');
        $this->db->join('turma', 'aluno_has_turma.turma_id_turma=turma.id_turma');
        $this->db->join('disciplina', 'disciplina.id_disciplina=turma.disciplina_id_disciplina');
        $this->db->where(array('aluno.id_aluno' => $id_aluno, 'turma.status_turma' => 1,'disciplina.status_disciplina'=>1));
        return $this->db->get();
    }

    // Obter turma e disciplina do aluno logado
    function obter_turma_disciplina_aluno($id_turma,$id_aluno) {
        $this->db->select('*');
        $this->db->from('turma');
        $this->db->join('disciplina', 'disciplina.id_disciplina=turma.disciplina_id_disciplina');
        $this->db->join('aluno_has_turma', 'aluno_has_turma.turma_id_turma=turma.id_turma');
        $this->db->where(array('turma.id_turma'=> $id_turma,'aluno_has_turma.aluno_id_aluno'=>$id_aluno));
        return $this->db->get();
    }

    function alterar_dados_aluno($dados,$cpf_aluno){
        $this->db->where(array("cpf_aluno"=>$cpf_aluno));
        $this->db->update("aluno",$dados);
    }
    
}

?>
