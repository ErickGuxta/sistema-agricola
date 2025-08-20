<?php

namespace app\controller;

use app\model\Usuario;
use app\dao\UsuarioDAO;

final class UsuarioController
{
    // Declarar propriedades ou métodos de uma classe como estáticos faz deles acessíveis sem a necessidade de instanciar a classe
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
                        // CRIAR SESSÃO DO USUÁRIO
                        $_SESSION['usuario_id'] = $usuarioRegistrado->id_usuario;
                        $_SESSION['usuario_nome'] = $usuarioRegistrado->nome_produtor;
                        $_SESSION['usuario_email'] = $usuarioRegistrado->email;
                        $_SESSION['logado'] = true;
                        $_SESSION['ultimo_acesso'] = time();
                        
                        // Redirecionar para página de cadastro de propriedade
                        header("Location: /sistema-agricola/app/registro-propriedade");
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

    public static function logout() : void
    {
        session_destroy();
        header("Location: /sistema-agricola/app/view/login/cadastro_user.php");
        exit;
    }
}