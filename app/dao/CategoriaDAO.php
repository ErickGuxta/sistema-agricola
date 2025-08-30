<?php
namespace app\dao;

use app\model\Categoria;

final class CategoriaDAO extends DAO
{
    public function listarTodos() : array
    {
        $sql = "SELECT id_categoria, nome, ordem FROM Categoria ORDER BY ordem, nome";
        $stmt = parent::$conexao->query($sql);
        $categorias = [];
        while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $categorias[] = new Categoria($linha);
        }
        return $categorias;
    }
}
