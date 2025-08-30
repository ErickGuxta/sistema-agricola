<?php
namespace app\model;

use app\dao\MovimentacaoEstoqueDAO;

class MovimentacaoEstoque
{
    public $id_movimentacao, $item_id, $usuario_id, $tipo_movimentacao, $quantidade, $valor_unitario, $observacao, $data_movimentacao, $safra_id;

    public function __construct($data = [])
    {
        $this->id_movimentacao   = $data['id_movimentacao']   ?? null;
        $this->item_id           = $data['item_id']           ?? null;
        $this->usuario_id        = $data['usuario_id']        ?? null;
        $this->tipo_movimentacao = $data['tipo_movimentacao'] ?? null;
        
        $this->quantidade        = $data['quantidade']        ?? null;
        $this->valor_unitario    = $data['valor_unitario']    ?? null;
        $this->observacao        = $data['observacao']        ?? null;
        $this->data_movimentacao = $data['data_movimentacao'] ?? null;
        $this->safra_id          = $data['safra_id']          ?? null;
    }

    public function registrar() : ?MovimentacaoEstoque
    {
        return (new \app\dao\MovimentacaoEstoqueDAO())->inserir($this);
    }

    public static function getById(int $idMovimentacao) : ?MovimentacaoEstoque
    {
        return (new MovimentacaoEstoqueDAO())->getById($idMovimentacao);
    }

    public function atualizar() : ?MovimentacaoEstoque
    {
        return (new MovimentacaoEstoqueDAO())->atualizar($this);
    }

    public static function deletar(int $idMovimentacao) : bool
    {
        return (new MovimentacaoEstoqueDAO())->deletar($idMovimentacao);
    }

    public static function listarPorItem(int $itemId) : array
    {
        return (new MovimentacaoEstoqueDAO())->listarPorItem($itemId);
    }

    public static function listarPorSafra(int $safraId) : array
    {
        return (new MovimentacaoEstoqueDAO())->listarPorSafra($safraId);
    }
}
