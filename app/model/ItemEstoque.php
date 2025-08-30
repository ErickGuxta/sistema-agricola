<?php
namespace app\model;

use app\dao\ItemEstoqueDAO;

class ItemEstoque
{
    public $id_item, $usuario_id, $categoria_id, $safra_id, $nome, $categoria, $estoque_atual, $estoque_minimo, $validade, $valor_unitario;

    public function __construct(array $dados = [])
    {
        if (!empty($dados)) {
            $this->id_item          = $dados['id_item']        ?? null;

            $this->usuario_id       = $dados['usuario_id']     ?? null;
            $this->categoria_id     = $dados['categoria_id']   ?? null;
            $this->safra_id         = $dados['safra_id']       ?? null;

            $this->nome             = $dados['nome']           ?? null;
            $this->categoria        = $dados['categoria']      ?? null;
            $this->estoque_atual    = $dados['estoque_atual']  ?? 0;
            $this->estoque_minimo   = $dados['estoque_minimo'] ?? 0;
            $this->validade         = $dados['validade']       ?? null;
            $this->valor_unitario   = $dados['valor_unitario'] ?? null;
        }
    }

    public function registrar() : ?ItemEstoque
    {
        return (new ItemEstoqueDAO())->inserir($this);
    }

    public static function getById(int $idItem, ?int $safraId = null) : ?ItemEstoque
    {
        return (new ItemEstoqueDAO())->getById($idItem, $safraId);
    }

    public function atualizar() : ?ItemEstoque
    {
        return (new ItemEstoqueDAO())->atualizar($this);
    }

    public static function deletar(int $id_item) : bool
    {
        return (new ItemEstoqueDAO())->deletar($id_item);
    }

    public static function atualizarEstoque(int $idItem, $novoEstoque) : bool
    {
        return (new ItemEstoqueDAO())->atualizarEstoque($idItem, $novoEstoque);
    }

    // --------- MÉTODOS PARA LISTAGEM -----------
    public static function listarPorCategoria(int $categoriaId,  ?int $safraId = null) : array
    {
        return (new ItemEstoqueDAO())->listarPorCategoria($categoriaId, $safraId);
    }

    public static function listarTodosPorSafra(int $usuarioId, int $safraId) : array
    {
        return (new ItemEstoqueDAO())->listarTodosPorSafra($usuarioId, $safraId);
    }

    public static function listarTodosPorUsuario(int $usuarioId) : array
    {
        return (new ItemEstoqueDAO())->listarTodosPorUsuario($usuarioId);
    }
}

