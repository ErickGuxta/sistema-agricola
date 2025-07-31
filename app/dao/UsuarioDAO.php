<?php

namespace app\dao;

use app\model\Usuario;

final class UsuarioDAO extends DAO
{
    public function inserir(Usuario $model) : ?Usuario
    {
        $sql = "INSERT INTO Usuario (nome_produtor, email, senha) VALUES (?, ?, sha1(?))";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $model->nome_produtor);
        $stmt->bindValue(2, $model->email);
        $stmt->bindValue(3, $model->senha);

        // CORREÇÃO: Executar a query primeiro
        if ($stmt->execute()) {
            // Se a inserção foi bem-sucedida, retornar o objeto com os dados
            $model->id = parent::$conexao->lastInsertId();
            return $model;
        }

        return null;
    }

    public function verificarEmail(string $email) : ?Usuario
    {
        $sql = "SELECT * FROM Usuario WHERE email = ?";
        
        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $email);
        $stmt->execute();
        
        $model = $stmt->fetchObject("app\model\Usuario");
        return is_object($model) ? $model : null;
    }
}