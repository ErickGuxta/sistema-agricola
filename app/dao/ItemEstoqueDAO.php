<?php
namespace app\dao;

use app\model\ItemEstoque;

final class ItemEstoqueDAO extends DAO
{
    // inserir item
    public function inserir(ItemEstoque $model) : ?ItemEstoque
    {
        $sql = "INSERT INTO Item_Estoque (usuario_id, categoria_id, safra_id, nome, estoque_atual, estoque_minimo, validade, valor_unitario) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = parent::$conexao->prepare($sql);

        $stmt->bindValue(1, $model->usuario_id);
        $stmt->bindValue(2, $model->categoria_id);
        $stmt->bindValue(3, $model->safra_id); // safra_id obrigatório
        $stmt->bindValue(4, $model->nome);
        $stmt->bindValue(5, $model->estoque_atual);
        $stmt->bindValue(6, $model->estoque_minimo);
        $stmt->bindValue(7, $model->validade);
        $stmt->bindValue(8, $model->valor_unitario);

        if ($stmt->execute()) {
            $model->id_item = parent::$conexao->lastInsertId();
            return $model;
        }

        return null;
    }

    // getById
    public function getById(int $idItem, ?int $safraId = null) : ?ItemEstoque
    {
        $sql = 
            " SELECT id_item, usuario_id, categoria_id, safra_id, nome, categoria, estoque_atual, estoque_minimo, validade, valor_unitario
            FROM Item_Estoque WHERE id_item = ? ";

        $params = [$idItem];
        
        if ($safraId !== null) {
            $sql .= " AND safra_id = ?";
            $params[] = $safraId;
        }

        $stmt = parent::$conexao->prepare($sql);
        foreach ($params as $i => $param) {
            $stmt->bindValue($i + 1, $param);
        }
        $stmt->execute();

        $linha = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$linha) {
            return null;
        }
        return new ItemEstoque($linha);
    }

    // atualizar apenas o estoque atual do item
    public function atualizarEstoque(int $idItem, $novoEstoque) : bool
    {
        $sql = "UPDATE Item_Estoque SET estoque_atual = ? WHERE id_item = ?";
        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $novoEstoque);
        $stmt->bindValue(2, $idItem);
        return $stmt->execute();
    }

    // atualizar Item
    public function atualizar(ItemEstoque $model) : ?ItemEstoque
    {
        $sql = 
            " UPDATE Item_Estoque 
              SET nome = ?, categoria = ?, estoque_atual = ?, estoque_minimo = ?, valor_unitario = ?, validade = ?
              WHERE id_item = ?";

        $stmt = parent::$conexao->prepare($sql);
        
        $stmt->bindValue(1, $model->nome);
        $stmt->bindValue(2, $model->categoria);
        $stmt->bindValue(3, $model->estoque_atual);
        $stmt->bindValue(4, $model->estoque_minimo);
        $stmt->bindValue(5, $model->valor_unitario);
        $stmt->bindValue(6, $model->validade);
        $stmt->bindValue(7, $model->id_item);
        
        if ($stmt->execute()) {
            return $model;
        }
        return null;
    }

    // deletar Item
    public function deletar(int $id_item) : bool
    {
        // Deletar movimentações relacionadas ao item
        $stmtMov = parent::$conexao->prepare("DELETE FROM Movimentacao_Estoque WHERE item_id = ?");
        $stmtMov->bindValue(1, $id_item);
        $stmtMov->execute();

        // Agora deletar o item
        $sql = "DELETE FROM Item_Estoque WHERE id_item = ?";
        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $id_item);
        return $stmt->execute();
    }

    // listar por categoria e por safra
    public function listarPorCategoria(int $categoriaId, ?int $safraId = null) : array
    {
        $sql = 
            " SELECT id_item, usuario_id, categoria_id, safra_id, nome, estoque_atual, estoque_minimo, validade
            FROM Item_Estoque WHERE categoria_id = ?";

        $params = [$categoriaId];
        
        if ($safraId !== null) {
            $sql .= " AND safra_id = ?";
            $params[] = $safraId;
        }
        
        $sql .= " ORDER BY nome";
        
        $stmt = parent::$conexao->prepare($sql);
        foreach ($params as $i => $param) {
            $stmt->bindValue($i + 1, $param);
        }
        $stmt->execute();
        
        $itens = [];
        while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $itens[] = new ItemEstoque($linha);
        }
        return $itens;
    }

    public function listarTodosPorSafra(int $usuarioId, int $safraId) : array
    {
        $sql = 
            " SELECT id_item, usuario_id, categoria_id, safra_id, nome, estoque_atual, estoque_minimo, validade
            FROM Item_Estoque WHERE usuario_id = ? 
            AND safra_id = ? ORDER BY nome";
            
        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $usuarioId);
        $stmt->bindValue(2, $safraId);
        $stmt->execute();
        
        $itens = [];
        while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $itens[] = new ItemEstoque($linha);
        }
        return $itens;
    }

    // listar todos por usuario
    public static function listarTodosPorUsuario($usuarioId) : array
    {
        $sql = "SELECT * FROM Item_Estoque WHERE usuario_id = ? ORDER BY nome";
        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $usuarioId);
        $stmt->execute();
        $itens = [];
        while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $itens[] = new \app\model\ItemEstoque($linha);
        }
        return $itens;
    }

    public function buscarPorUsuarioNomeCategoria($usuarioId, $nome = '', $categoria = '') : array
    {
        $sql = "SELECT ie.* FROM Item_Estoque ie JOIN Categoria c ON ie.categoria_id = c.id_categoria WHERE ie.usuario_id = ?";
        $params = [$usuarioId];
        if ($nome !== '') {
            $sql .= " AND ie.nome LIKE ?";
            $params[] = "%$nome%";
        }
        if ($categoria !== '') {
            $sql .= " AND c.nome = ?";
            $params[] = $categoria;
        }
        $sql .= " ORDER BY ie.nome";
        $stmt = parent::$conexao->prepare($sql);
        foreach ($params as $i => $param) {
            $stmt->bindValue($i + 1, $param);
        }
        $stmt->execute();
        $itens = [];
        while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $itens[] = new \app\model\ItemEstoque($linha);
        }
        return $itens;
    }
}