<?php

namespace app\dao;

use app\model\Usuario;

final class UsuarioDAO extends DAO
{
    public function inserir(Usuario $model) : ?Usuario
    {
        $sql = "INSERT INTO Usuario (nome_produtor, email, senha, foto_perfil) VALUES (?, ?, sha1(?), ?)";

        $stmt = parent::$conexao->prepare($sql);

        $stmt->bindValue(1, $model->nome_produtor);
        $stmt->bindValue(2, $model->email);
        $stmt->bindValue(3, $model->senha);
        $stmt->bindValue(4, $model->foto_perfil);

        if ($stmt->execute()) {
            // Se a inserção foi bem-sucedida, retornar o objeto com os dados
            $model->id_usuario = parent::$conexao->lastInsertId();
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

    public function verificarLogin(string $email, string $senha) : ?Usuario
    {
        $sql = "SELECT * FROM Usuario WHERE email = ? AND senha = sha1(?)";
        
        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $email);
        $stmt->bindValue(2, $senha);
        $stmt->execute();
        
        $model = $stmt->fetchObject("app\model\Usuario");
        return is_object($model) ? $model : null;
    }

    public function atualizar(Usuario $model) : bool
    {
        if (!empty($model->senha)) {
            $sql = "UPDATE Usuario SET nome_produtor = ?, email = ?, senha = sha1(?), foto_perfil = ? WHERE id_usuario = ?";
        } else {
            $sql = "UPDATE Usuario SET nome_produtor = ?, email = ?, foto_perfil = ? WHERE id_usuario = ?";
        }
        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $model->nome_produtor);
        $stmt->bindValue(2, $model->email);
        if (!empty($model->senha)) {
            $stmt->bindValue(3, $model->senha);
            $stmt->bindValue(4, $model->foto_perfil);
            $stmt->bindValue(5, $model->id_usuario);
        } else {
            $stmt->bindValue(3, $model->foto_perfil);
            $stmt->bindValue(4, $model->id_usuario);
        }
        return $stmt->execute();
    }

    public function deletarCascata(int $usuarioId) : bool
    {
        // Excluir movimentações de estoque vinculadas aos itens do usuário
        $sqlMov = "DELETE FROM Movimentacao_Estoque WHERE usuario_id = ?";
        $stmtMov = parent::$conexao->prepare($sqlMov);
        $stmtMov->bindValue(1, $usuarioId);
        $stmtMov->execute();

        // Excluir faturamentos do usuário
        $sqlFat = "DELETE FROM Faturamento_Mes WHERE usuario_id = ?";
        $stmtFat = parent::$conexao->prepare($sqlFat);
        $stmtFat->bindValue(1, $usuarioId);
        $stmtFat->execute();

        // Excluir itens de estoque do usuário
        $sqlItem = "DELETE FROM Item_Estoque WHERE usuario_id = ?";
        $stmtItem = parent::$conexao->prepare($sqlItem);
        $stmtItem->bindValue(1, $usuarioId);
        $stmtItem->execute();

        // Excluir propriedades do usuário
        $sqlProp = "DELETE FROM Propriedade WHERE usuario_id = ?";
        $stmtProp = parent::$conexao->prepare($sqlProp);
        $stmtProp->bindValue(1, $usuarioId);
        $stmtProp->execute();

        // Excluir usuário
        $sqlUser = "DELETE FROM Usuario WHERE id_usuario = ?";
        $stmtUser = parent::$conexao->prepare($sqlUser);
        $stmtUser->bindValue(1, $usuarioId);
        return $stmtUser->execute();
    }
}