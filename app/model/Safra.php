<?php

namespace app\model;

use app\dao\SafraDAO;

class Safra
{
    public $id_safra, $propriedade_id, $nome, $descricao, $data_inicio, $data_fim, $area_hectare, $status ;

    // Construtor que aceita array de dados
    public function __construct(array $dados = [])
    {

        // a ideia aqui é criar um objeto já com atributos(geralmente chamam de hidratar), vindo, nesse caso, valores retornados do banco de dados.
        if (!empty($dados)) {
            $this->id_safra       = isset($dados['id_safra'])       ? (int) $dados['id_safra']       : null;
            $this->propriedade_id = isset($dados['propriedade_id']) ? (int) $dados['propriedade_id'] : null;
            $this->nome           = $dados['nome']         ?? null;
            $this->descricao      = $dados['descricao']    ?? null;
            $this->data_inicio    = $dados['data_inicio']  ?? null;
            $this->data_fim       = $dados['data_fim']     ?? null;
            $this->area_hectare   = $dados['area_hectare'] ?? null;
            $this->status         = $dados['status']       ?? null;
        }
    }

    //cadastrar safra
    public function registrar() : ?Safra
    {
        return (new SafraDAO()) -> inserir($this);
    }

    // listar safras por propriedade
    public static function listarPorPropriedade(int $propriedadeId) : array
    {
        return (new SafraDAO())->listarPorPropriedade($propriedadeId);
    }

    // Buscar safra por ID 
    public static function getById(int $idSafra, ?int $propriedadeId = null) : ?Safra
    {
        return (new SafraDAO())->getById($idSafra, $propriedadeId);
    }

    // Atualizar safra
    public function atualizar() : ?Safra
    {
        return (new SafraDAO())->atualizar($this);
    }

    // Deletar safra
    public static function deletar(int $idSafra, ?int $propriedadeId = null) : bool
    {
        return (new SafraDAO())->deletar($idSafra, $propriedadeId);
    }

    public static function listarPorUsuario(int $usuarioId) : array
    {
        return (new SafraDAO())->listarPorUsuario($usuarioId);
    }
}
