<?php

namespace app\model;

use app\dao\PropriedadeDAO;

class Propriedade
{
    public $id_propriedade, $fk_Usuario_id_usuario, $nome_propriedade, $area_total, $localizacao;

    //cadastrar propriedade
    public function registrar() : ?Propriedade
    {
        return (new PropriedadeDAO()) -> inserir($this);
    }

    // listar propriedades do usuário
    // Buscar propriedade por ID
    // Atualizar propriedade
    // Deletar propriedade


}