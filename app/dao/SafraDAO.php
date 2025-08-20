<?php

namespace app\dao;

use app\model\Safra;

final class SafraDAO extends DAO
{
    public function inserir(Safra $model) : ?Safra
    {
        $sql = "INSERT INTO Safra (fk_Propriedade_id_propriedade, nome, descricao, data_inicio, data_fim, area_hectare, status) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = parent::$conexao->prepare($sql);

        $stmt->bindValue(1, $model->fk_Propriedade_id_propriedade);
        $stmt->bindValue(2, $model->nome);
        $stmt->bindValue(3, $model->descricao);
        $stmt->bindValue(4, $model->data_inicio);
        $stmt->bindValue(5, $model->data_fim);
        $stmt->bindValue(6, $model->area_hectare);
        $stmt->bindValue(7, $model->status);

        if ($stmt->execute()) {
            $model->id_safra = parent::$conexao->lastInsertId();
            return $model;
        }

        return null;
    }

    /**
     * Lista todas as safras de uma propriedade
     */
    public function listarPorPropriedade(int $propriedadeId) : array
    {
        $sql = "SELECT id_safra, fk_Propriedade_id_propriedade, nome, descricao, data_inicio, data_fim, area_hectare, status FROM Safra WHERE fk_Propriedade_id_propriedade = ? ORDER BY data_inicio DESC, id_safra DESC";

        $stmt = parent::$conexao->prepare($sql);

        $stmt->bindValue(1, $propriedadeId);
        $stmt->execute();

        $linhas = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $resultado = [];
        foreach ($linhas as $linha) {
            $resultado[] = $this->hidratarSafra($linha);
        }
        return $resultado;
    }

    /**
     * Busca uma safra por ID 
     */
    public function getById(int $idSafra, ?int $propriedadeId = null) : ?Safra
    {
        $sql = "SELECT id_safra, fk_Propriedade_id_propriedade, nome, descricao, data_inicio, data_fim, area_hectare, status FROM Safra WHERE id_safra = ?";
        if ($propriedadeId !== null) {
            $sql .= " AND fk_Propriedade_id_propriedade = ?";
        }
        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $idSafra);
        if ($propriedadeId !== null) {
            $stmt->bindValue(2, $propriedadeId);
        }
        $stmt->execute();

        $linha = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$linha) {
            return null;
        }
        return $this->hidratarSafra($linha);
    }

    /**
     * atualizar uma safra 
     */
    public function atualizar(Safra $model) : ?Safra
    {
        $sql = "UPDATE Safra SET nome = ?, descricao = ?, data_inicio = ?, data_fim = ?, area_hectare = ?, status = ? WHERE id_safra = ? AND fk_Propriedade_id_propriedade = ?";
        $stmt = parent::$conexao->prepare($sql);

        $stmt->bindValue(1, $model->nome);
        $stmt->bindValue(2, $model->descricao);
        $stmt->bindValue(3, $model->data_inicio);
        $stmt->bindValue(4, $model->data_fim);
        $stmt->bindValue(5, $model->area_hectare);
        $stmt->bindValue(6, $model->status);
        $stmt->bindValue(7, $model->id_safra);
        $stmt->bindValue(8, $model->fk_Propriedade_id_propriedade);

        if ($stmt->execute()) {
            return $model;
        }
        return null;
    }

    /**
     * deletar uma safra pelo ID 
     */
    public function deletar(int $idSafra, ?int $propriedadeId = null) : bool
    {
        $sql = "DELETE FROM Safra WHERE id_safra = ?";
        if ($propriedadeId !== null) {
            $sql .= " AND fk_Propriedade_id_propriedade = ?";
        }
        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $idSafra);
        if ($propriedadeId !== null) {
            $stmt->bindValue(2, $propriedadeId);
        }
        return $stmt->execute();
    }

    private function hidratarSafra(array $dados) : Safra
    {
        $s = new Safra();
        $s->id_safra = (int) $dados['id_safra'];
        $s->fk_Propriedade_id_propriedade = (int) $dados['fk_Propriedade_id_propriedade'];
        $s->nome = $dados['nome'];
        $s->descricao = $dados['descricao'];
        $s->data_inicio = $dados['data_inicio'];
        $s->data_fim = $dados['data_fim'];
        $s->area_hectare = $dados['area_hectare'];
        $s->status = $dados['status'];
        return $s;
    }
}