<?php
namespace app\model;

use app\dao\CategoriaDAO;

class Categoria
{
    public $id_categoria, $nome, $ordem;

    public function __construct(array $dados = [])
    {
        if (!empty($dados)) {
            $this->id_categoria = isset($dados['id_categoria']) ? (int) $dados['id_categoria'] : null;
            $this->ordem        = isset($dados['ordem']) ? (int) $dados['ordem'] : 0;
            $this->nome         = $dados['nome'] ?? null;

        }
    }

    public static function listarTodos() : array
    {
        return (new CategoriaDAO())->listarTodos();
    }
}
