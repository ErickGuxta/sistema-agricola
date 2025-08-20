<?php

namespace app\model;

use app\dao\SafraDAO;

class Safra
{
    public $id_safra, $fk_Propriedade_id_propriedade, $nome, $descricao, $data_inicio, $data_fim, $area_hectare, $status ;

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


}
