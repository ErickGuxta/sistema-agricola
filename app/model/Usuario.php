<?php

namespace app\model;

use app\dao\UsuarioDAO;

class Usuario
{
    public $id_usuario, $nome_produtor, $email, $senha;

    //cadastrar o usuario
    public function registrar() : ?Usuario
    {
        return (new UsuarioDAO()) -> inserir($this);
    }

    //buscar por email
    public function verificarEmail(string $email) : ?Usuario
    {
        return (new UsuarioDAO()) -> verificarEmail($email);
    }
}