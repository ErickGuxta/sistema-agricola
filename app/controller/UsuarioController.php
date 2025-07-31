<?php

namespace app\controller;

use app\model\Usuario;
use app\dao\UsuarioDAO;

final class UsuarioController
{
    public static function index() : void
    {
        $model = new Usuario();
        $erro = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            // Validar se os campos estão preenchidos
            if (empty($_POST['nome_produtor']) || empty($_POST['email']) || empty($_POST['senha'])) {
                $erro = "Todos os campos são obrigatórios";
            } else {
                // Verificar se o email já existe
                $usuarioDAO = new UsuarioDAO();
                $emailExiste = $usuarioDAO->verificarEmail($_POST['email']);
                
                if ($emailExiste) {
                    $erro = "Este email já está cadastrado";
                } else {
                    $model->nome_produtor = $_POST['nome_produtor'];
                    $model->email = $_POST['email'];
                    $model->senha = $_POST['senha'];
                    
                    $usuarioRegistrado = $model->registrar();

                    if($usuarioRegistrado !== null)
                    {
                        // Redirecionar para página de cadastro de propriedade
                        header("Location: /sistema-agricola/app/view/propriedade/cadastro_propriedade.php");
                        exit;
                    } else {
                        $erro = "Erro ao cadastrar usuário. Tente novamente.";
                    }
                }
            }
        }

        // Passar as variáveis para a view
        include VIEWS . '/login/cadastro_user.php';
    }
}