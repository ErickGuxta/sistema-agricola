<?php

namespace app\model;

use app\dao\FaturamentoDAO;

class Faturamento
{
    public $id_faturamento, $usuario_id, $safra_id, $mes, $valor, $descricao;

    // Construtor que aceita array de dados
    public function __construct(array $dados = [])
    {
        if (!empty($dados)) {
            $this->id_faturamento = isset($dados['id_faturamento']) ? (int)$dados['id_faturamento'] : null;
            $this->usuario_id     = isset($dados['usuario_id'])     ? (int)$dados['usuario_id']     : null;
            $this->safra_id       = isset($dados['safra_id'])       ? (int)$dados['safra_id']       : null;
            $this->mes            = $dados['mes']        ?? null;
            $this->valor          = $dados['valor']      ?? null;
            $this->descricao      = $dados['descricao']  ?? null;
        }
    }

    // Cadastrar faturamento
    public function registrar() : ?Faturamento
    {
        return (new FaturamentoDAO())->inserir($this);
    }

    // Atualizar faturamento
    public function atualizar() : ?Faturamento
    {
        return (new FaturamentoDAO())->atualizar($this);
    }

    // Deletar faturamento
    public static function deletar(int $idFaturamento, ?int $usuarioId = null) : bool
    {
        return (new FaturamentoDAO())->deletar($idFaturamento, $usuarioId);
    }

    // Buscar faturamento por safra
    public static function getBySafra(int $safraId, int $propriedadeId) : array
    {
        return (new FaturamentoDAO())->getBySafra($safraId, $propriedadeId);
    }

    // Listar faturamentos por usuário
    public static function listarPorUsuario(int $usuarioId) : array
    {
        return (new FaturamentoDAO())->listarPorUsuario($usuarioId);
    }

    // Listar faturamentos por propriedade
    public static function listarPorPropriedade(int $propriedadeId) : array
    {
        return (new FaturamentoDAO())->listarPorPropriedade($propriedadeId);
    }

    // Calcular receita total da propriedade
    public static function receitaTotalPropriedade(int $propriedadeId) : float
    {
        return (new FaturamentoDAO())->receitaTotalPropriedade($propriedadeId);
    }
}