<?php

class turma_model extends CI_Model {

    // Obter turma ativa por disciplina.
    function obter_turma_ativa_por_disciplina($id_disciplina) {
        $this->db->where(['disciplina_id_disciplina' => $id_disciplina, 'status_turma =' => 1]);
        return $this->db->get('turma');
    }

    // Obter turma arquivada por disciplina.
    function obter_turmas_arquivadas_por_disciplina($id_disciplina) {
        $this->db->where(array('disciplina_id_disciplina' => $id_disciplina, 'status_turma ' => 2));
        return $this->db->get('turma');
    }

    // Obter turma e disciplina pelo inner join
    function obter_turma_disciplina($id_turma) {
        $this->db->select('*');
        $this->db->from('turma');
        $this->db->join('disciplina', 'disciplina.id_disciplina=turma.disciplina_id_disciplina');
        $this->db->where(array('turma.id_turma'=> $id_turma,'turma.status_turma'=>1));
        return $this->db->get();
    }

}

?>
