<?php
namespace app\dao;

use app\model\MovimentacaoEstoque;

final class MovimentacaoEstoqueDAO extends DAO
{
    public function inserir(MovimentacaoEstoque $model) : ?MovimentacaoEstoque
    {
        $sql = "INSERT INTO Movimentacao_Estoque (item_id, usuario_id, tipo_movimentacao, quantidade, observacao) VALUES (?, ?, ?, ?, ?)";

        $stmt = parent::$conexao->prepare($sql);

        $stmt->bindValue(1, $model->item_id);
        $stmt->bindValue(2, $model->usuario_id);
        $stmt->bindValue(3, $model->tipo_movimentacao);
        $stmt->bindValue(4, $model->quantidade);
        $stmt->bindValue(5, $model->observacao);

        if ($stmt->execute()) {
            $model->id_movimentacao = parent::$conexao->lastInsertId();
            return $model;
        }

        return null;
    }

    public function getById(int $idMovimentacao) : ?MovimentacaoEstoque
    {
        $sql = "SELECT id_movimentacao, item_id, usuario_id, tipo_movimentacao, quantidade, valor_unitario, observacao, data_movimentacao, safra_id FROM Movimentacao_Estoque WHERE id_movimentacao = ?";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $idMovimentacao);
        $stmt->execute();

        $linha = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$linha) {
            return null;
        }
        return new MovimentacaoEstoque($linha);
    }

    public function atualizar(MovimentacaoEstoque $model) : ?MovimentacaoEstoque
    {
        $sql = "UPDATE Movimentacao_Estoque SET item_id = ?, usuario_id = ?, tipo_movimentacao = ?, quantidade = ?, valor_unitario = ?, observacao = ?, safra_id = ? WHERE id_movimentacao = ?";
        $stmt = parent::$conexao->prepare($sql);
        
        $stmt->bindValue(1, $model->item_id);
        $stmt->bindValue(2, $model->usuario_id);
        $stmt->bindValue(3, $model->tipo_movimentacao);
        $stmt->bindValue(4, $model->quantidade);
        $stmt->bindValue(5, $model->valor_unitario);
        $stmt->bindValue(6, $model->observacao);
        $stmt->bindValue(7, $model->safra_id);
        $stmt->bindValue(8, $model->id_movimentacao);

        if ($stmt->execute()) {
            return $model;
        }
        return null;
    }

    public function deletar(int $idMovimentacao) : bool
    {
        $sql = "DELETE FROM Movimentacao_Estoque WHERE id_movimentacao = ?";
        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $idMovimentacao);
        return $stmt->execute();
    }

    public function listarPorItem(int $itemId) : array
    {
        $sql = "SELECT id_movimentacao, item_id, usuario_id, tipo_movimentacao, quantidade, valor_unitario, observacao, data_movimentacao, safra_id FROM Movimentacao_Estoque WHERE item_id = ? ORDER BY data_movimentacao DESC";
        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $itemId);
        $stmt->execute();
        
        $movimentacoes = [];
        while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $movimentacoes[] = new MovimentacaoEstoque($linha);
        }
        return $movimentacoes;
    }

    public function listarPorSafra(int $safraId) : array
    {
        $sql = "SELECT id_movimentacao, item_id, usuario_id, tipo_movimentacao, quantidade, valor_unitario, observacao, data_movimentacao, safra_id FROM Movimentacao_Estoque WHERE safra_id = ? ORDER BY data_movimentacao DESC";
        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $safraId);
        $stmt->execute();
        
        $movimentacoes = [];
        while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $movimentacoes[] = new MovimentacaoEstoque($linha);
        }
        return $movimentacoes;
    }
}