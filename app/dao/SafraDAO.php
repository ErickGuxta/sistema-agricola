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
     * deletar uma safra pelo ID com deleção em cascata
     */
    public function deletar(int $idSafra, ?int $propriedadeId = null) : bool
    {
        try {
            // Verificar se a safra existe e pertence à propriedade (se especificada)
            $safra = $this->getById($idSafra, $propriedadeId);
            if (!$safra) {
                return false;
            }

            // 1. Deletar faturamentos associados à safra
            $sqlFat = "DELETE FROM Faturamento_Mes WHERE safra_id = ?";
            $stmtFat = parent::$conexao->prepare($sqlFat);
            $stmtFat->bindValue(1, $idSafra);
            $stmtFat->execute();

            // 2. Deletar movimentações de estoque dos itens da safra
            $sqlMov = "DELETE FROM Movimentacao_Estoque WHERE item_id IN (SELECT id_item FROM Item_Estoque WHERE safra_id = ?)";
            $stmtMov = parent::$conexao->prepare($sqlMov);
            $stmtMov->bindValue(1, $idSafra);
            $stmtMov->execute();

            // 3. Deletar associações safra-movimentação (se existir)
            $sqlAssoc = "DELETE FROM Safra_Movimentacao_Assoc WHERE safra_id = ?";
            $stmtAssoc = parent::$conexao->prepare($sqlAssoc);
            $stmtAssoc->bindValue(1, $idSafra);
            $stmtAssoc->execute();

            // 4. Deletar itens de estoque da safra
            $sqlItem = "DELETE FROM Item_Estoque WHERE safra_id = ?";
            $stmtItem = parent::$conexao->prepare($sqlItem);
            $stmtItem->bindValue(1, $idSafra);
            $stmtItem->execute();

            // 5. Deletar a safra
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
        } catch (\Exception $e) {
            error_log("Erro ao deletar safra: " . $e->getMessage());
            return false;
        }
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


    /**
     * Lista todas as safras disponíveis
     */
    public function listarTodas() : array
    {
        $sql = "SELECT id_safra, propriedade_id, nome, descricao, data_inicio, data_fim, area_hectare, status FROM Safra ORDER BY data_inicio DESC, id_safra DESC";
        
        $stmt = parent::$conexao->prepare($sql);
        $stmt->execute();

        $linhas = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $resultado = [];
        foreach ($linhas as $linha) {
            $resultado[] = new Safra($linha);
        }
        return $resultado;
    }

    /**
     * Conta safras ativas de uma propriedade
     */
    public function contarSafrasAtivas(int $propriedadeId) : int
    {
        $sql = "SELECT COUNT(*) as total FROM Safra WHERE propriedade_id = ? AND status = 'em_andamento'";
        
        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $propriedadeId);
        $stmt->execute();
        
        $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);
        return (int) $resultado['total'];
    }

    /**
     * Conta total de hectares de safras ativas de uma propriedade
     */
    public function totalHectaresAtivos(int $propriedadeId) : float
    {
        $sql = "SELECT COALESCE(SUM(area_hectare), 0) as total FROM Safra WHERE propriedade_id = ? AND status = 'em_andamento' AND area_hectare IS NOT NULL";
        
        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $propriedadeId);
        $stmt->execute();
        
        $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);
        return (float) $resultado['total'];
    }
}