<?php

class avaliacao_model extends CI_Model {

    function obter_notas_avaliacao($id_turma) {
        $this->db->select('aluno.id_aluno, avaliacao.id_avaliacao, nota_avaliacao.valor_nota');
        $this->db->from('aluno');
        $this->db->join('nota_avaliacao', 'nota_avaliacao.aluno_id_aluno = aluno.id_aluno');
        $this->db->join('avaliacao', 'avaliacao.id_avaliacao=nota_avaliacao.avaliacao_id_avaliacao', 'right');
        $this->db->where('avaliacao.turma_id_turma', $id_turma);
        return $this->db->get();
    }

    // Função para pegar as notas do aluno de uma determinada avaliação
    function obter_nota_avaliacao_aluno($id_avaliacao) {
        return $this->db->get_where('nota_avaliacao', array('avaliacao_id_avaliacao' => $id_avaliacao));
    }

    // Função para pegar a nota de um aluno de uma determinada avaliação
    function obter_nota_avaliacao_um_aluno($id_avaliacao, $id_aluno) {
        return $this->db->get_where('nota_avaliacao', array('avaliacao_id_avaliacao' => $id_avaliacao, 'aluno_id_aluno' => $id_aluno));
    }

    // Função para salvar as notas dos alunos de uma determinada avaliação
    function alterar_nota_avaliacao_aluno($dados, $id_nota) {
        $this->db->where(array('id_nota' => $id_nota));
        $this->db->update('nota_avaliacao', $dados);
    }

    // função para pegar todas as avaliações que estão cadatradas para uma determinada turma.
    function obter_todas_avaliacoes_turma($id_turma) {
        return $this->db->get_where('avaliacao', array('turma_id_turma' => $id_turma));
    }

    function obter_uma_avaliacao($id_avaliacao) {
        return $this->db->get_where('avaliacao', array('id_avaliacao' => $id_avaliacao));
    }

    // Função para salvar uma nova avaliação.
    function salvar_nova_avaliacao($dados) {
        $this->db->insert('avaliacao', $dados);
    }

    // Função para alterar os dados da avaliação.
    function alterar_avaliacao($dados, $id_avaliacao) {
        $this->db->where(array('id_avaliacao' => $id_avaliacao));
        $this->db->update('avaliacao', $dados);
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

    // Função para excluir a nota da avaliaçao de determinado aluno. 
    function excluir_nota_avaliacao_aluno($id_avaliacao, $id_aluno) {
        $this->db->delete('nota_avaliacao', array('avaliacao_id_avaliacao' => $id_avaliacao, "aluno_id_aluno" => $id_aluno));
    }

    // Função para excluir avaliacao e as notas dos alunos que fizerão a avaliaçõa.
    function excluir_uma_avaliacao($id_avaliacao) {
        $this->db->delete('nota_avaliacao', array('avaliacao_id_avaliacao' => $id_avaliacao));
        $this->db->delete('avaliacao', array('id_avaliacao' => $id_avaliacao));
    }

    //------------------------------------------//
    // Trabalhando com avaliação de recuperação //
    //------------------------------------------//

    function obter_avaliacao_recuperacao($id_turma) {
        return $this->db->get_where('avaliacao_recuperacao', array('turma_id_turma' => $id_turma));
    }

    // Função para excluir recuperacao da turma.
    function excluir_avaliacao_recuperacao_turma($id_turma) {
        $this->db->delete('avaliacao_recuperacao', array('turma_id_turma' => $id_turma));
    }

    // Função para pegar a nota de um aluno da avaliação de recuperação
    function obter_nota_avaliacao_recuperacao_um_aluno($id_avaliacao_recuperacao, $id_aluno) {
        return $this->db->get_where('nota_avaliacao_recuperacao', array('avaliacao_recuperacao_id_avaliacao_recuperacao' => $id_avaliacao_recuperacao, 'aluno_id_aluno' => $id_aluno));
    }

    function obter_notas_avaliacao_recuperacao($id_turma) {
        $this->db->select('aluno.id_aluno, avaliacao_recuperacao.id_avaliacao_recuperacao, nota_avaliacao_recuperacao.valor_nota_avaliacao_recuperacao');
        $this->db->from('aluno');
        $this->db->join('nota_avaliacao_recuperacao', 'nota_avaliacao_recuperacao.aluno_id_aluno = aluno.id_aluno');
        $this->db->join('avaliacao_recuperacao', 'avaliacao_recuperacao.id_avaliacao_recuperacao=nota_avaliacao_recuperacao.avaliacao_recuperacao_id_avaliacao_recuperacao', 'right');
        $this->db->where('avaliacao_recuperacao.turma_id_turma', $id_turma);
        return $this->db->get();
    }

    // Função para verificar se nota já foi criada.
    function verificar_nota_avaliacao_recuperacao_exite($id_avaliacao_recuperacao, $id_aluno) {
        return $this->db->get_where('nota_avaliacao_recuperacao', array('avaliacao_recuperacao_id_avaliacao_recuperacao' => $id_avaliacao_recuperacao, 'aluno_id_aluno' => $id_aluno));
    }

    // Savanda nota que não foi criada ainda para avaliacao de recuperação
    function salvar_nota_avaliacao_recuperacao_aluno($dados) {
        $this->db->insert('nota_avaliacao_recuperacao', $dados);
    }

    // Alterando nota que já foi criada para o aluno e para a avaliação recuperação
    function alterando_nota_avaliacao_recuperacao_aluno($dados, $id_avaliacao_recuperacao, $id_aluno) {
        $this->db->where(array('aluno_id_aluno' => $id_aluno, 'avaliacao_recuperacao_id_avaliacao_recuperacao' => $id_avaliacao_recuperacao));
        $this->db->update('nota_avaliacao_recuperacao', $dados);
    }

    // Função para excluir a nota de recuperacao de determinado aluno.
    function excluir_nota_avaliacao_recuperacao_aluno($id_avaliacao_recuperacao, $id_aluno) {
        $this->db->delete('nota_avaliacao_recuperacao', array('avaliacao_recuperacao_id_avaliacao_recuperacao' => $id_avaliacao_recuperacao, 'aluno_id_aluno' => $id_aluno));
    }

    // Função para excluir a nota de recuperacao de todos alunos.
    function excluir_nota_avaliacao_recuperacao_todos_aluno($id_avaliacao_recuperacao) {
        $this->db->delete('nota_avaliacao_recuperacao', array('avaliacao_recuperacao_id_avaliacao_recuperacao' => $id_avaliacao_recuperacao));
    }

    // Alterando dadas da avaliacao de recuperação.
    function alterando_dados_avaliacao_recuperacao($dados, $id_avaliacao_recuperacao) {
        $this->db->where(array('id_avaliacao_recuperacao' => $id_avaliacao_recuperacao));
        $this->db->update('avaliacao_recuperacao', $dados);
    }

    /*
     * Trabalhando com prova online
     */

    public function salvar_nova_prova_online($dados) {
        $this->db->insert('prova_on_matriz', $dados);
        return $this->db->get_where('prova_on_matriz', $dados);
    }

    public function alterar_prova_online($dados, $id_prova_online) {
        $this->db->where("id_prova_on_matriz", $id_prova_online);
        $this->db->update('prova_on_matriz', $dados);
        return $this->db->get_where('prova_on_matriz', array("id_prova_on_matriz" => $id_prova_online));
    }

    public function obter_uma_prova_online($id_prova_on) {
        return $this->db->get_where('prova_on_matriz', array('id_prova_on_matriz' => $id_prova_on));
    }

    // função para pegar todas as provas on-line que estão cadatradas para uma determinada turma.
    function obter_todas_prova_on_matriz_turma($id_turma) {
        return $this->db->get_where('prova_on_matriz', array('turma_id_turma' => $id_turma));
    }

    
    public function excluir_prova_online($id_prova_online){
        $this->db->delete("prova_on_matriz",array("id_prova_on_matriz"=>$id_prova_online));
    }
            
    function obter_todas_questoes_prova_online($id_prova_online) {
        return $this->db->get_where('questao_matriz', array('prova_on_matriz_id_prova_on_matriz' => $id_prova_online));
    }

    function salvar_questao_online($dados) {
        $this->db->insert('questao_matriz', $dados);
        return $this->db->get_where('questao_matriz', $dados);
    }

    function alterar_questao_online($dados, $id_questao) {
        $this->db->where("id_questao_matriz", $id_questao);
        $this->db->update('questao_matriz', $dados);
        return $this->db->get_where('questao_matriz', array("id_questao_matriz" => $id_questao));
    }

    function obter_uma_questao($id_questao) {
        return $this->db->get_where('questao_matriz', array('id_questao_matriz' => $id_questao));
    }
    
    public function excluir_questao($id_questao){
        $this->db->delete("questao_matriz",array("id_questao_matriz"=>$id_questao));
    }
            
    
    
    
    function salva_alternativa_questao($dados) {
        $this->db->insert('alternativa_questao', $dados);
        return $this->db->get_where('alternativa_questao', $dados);
    }

    function obter_alternativas_questao($id_questao) {
        return $this->db->get_where('alternativa_questao', array("questao_matriz_id_questao_matriz" => $id_questao));
    }

    function obter_uma_alternativa($id_alternativa){
        return $this->db->get_where("alternativa_questao",array("id_alternativa_questao"=>$id_alternativa));
    }
    
    function alterar_alternativa_questao($dados,$id_alternativa){
        $this->db->where("id_alternativa_questao",$id_alternativa);
        $this->db->update('alternativa_questao', $dados);
        return $this->db->get_where('alternativa_questao', array("id_alternativa_questao"=>$id_alternativa));
    }

    public function excluir_alternativa($id_alternativa){
        $this->db->delete('alternativa_questao',array("id_alternativa_questao"=>$id_alternativa));
    }
}

?>
