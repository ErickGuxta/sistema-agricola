<?php

namespace app\dao;

use app\model\Safra;

final class SafraDAO extends DAO
{
    public function inserir(Safra $model) : ?Safra
    {
        $sql = "INSERT INTO Safra (propriedade_id, nome, descricao, data_inicio, data_fim, area_hectare, status) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = parent::$conexao->prepare($sql);

        $stmt->bindValue(1, $model->propriedade_id);
        
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
        $sql = "SELECT id_safra, propriedade_id, nome, descricao, data_inicio, data_fim, area_hectare, status FROM Safra WHERE propriedade_id = ? ORDER BY data_inicio DESC, id_safra DESC";

        $stmt = parent::$conexao->prepare($sql);

        $stmt->bindValue(1, $propriedadeId);
        $stmt->execute();

        $linhas = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $resultado = [];
        foreach ($linhas as $linha) {
            $resultado[] = new Safra($linha);
        }
        return $resultado;
    }

    /**
     * Busca uma safra por ID 
     */
    public function getById(int $idSafra, ?int $propriedadeId = null) : ?Safra
    {
        $sql = "SELECT id_safra, propriedade_id, nome, descricao, data_inicio, data_fim, area_hectare, status FROM Safra WHERE id_safra = ?";
        
        if ($propriedadeId !== null) {
            $sql .= " AND propriedade_id = ?";
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
        return new Safra($linha);
    }

    /**
     * atualizar uma safra 
     */
    public function atualizar(Safra $model) : ?Safra
    {
        $sql = "UPDATE Safra SET nome = ?, descricao = ?, data_inicio = ?, data_fim = ?, area_hectare = ?, status = ? WHERE id_safra = ? AND propriedade_id = ?";
        $stmt = parent::$conexao->prepare($sql);

        $stmt->bindValue(1, $model->nome);
        $stmt->bindValue(2, $model->descricao);
        $stmt->bindValue(3, $model->data_inicio);
        $stmt->bindValue(4, $model->data_fim);
        $stmt->bindValue(5, $model->area_hectare);
        $stmt->bindValue(6, $model->status);
        $stmt->bindValue(7, $model->id_safra);
        $stmt->bindValue(8, $model->propriedade_id);

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
            $sql .= " AND propriedade_id = ?";
        }
        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $idSafra);
        if ($propriedadeId !== null) {
            $stmt->bindValue(2, $propriedadeId);
        }
        return $stmt->execute();
    }

    public function listarPorUsuario(int $usuarioId) : array
    {
        $sql = "SELECT s.id_safra, s.propriedade_id, s.nome, s.descricao, s.data_inicio, s.data_fim, s.area_hectare, s.status FROM Safra s JOIN Propriedade p ON s.propriedade_id = p.id_propriedade WHERE p.usuario_id = ? ORDER BY s.data_inicio DESC";
        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $usuarioId);
        $stmt->execute();
        
        $safras = [];
        while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $safras[] = new Safra($linha);
        }
        return $safras;
    }
}