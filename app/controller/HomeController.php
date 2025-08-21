<?php

namespace app\controller;

final class HomeController
{
    public static function index() : void
    {
        // verificando se o usuario já está logado/registrado
        if(!isset($_SESSION['logado']) || $_SESSION['logado'] !== true )
        {
            header("Location: /sistema-agricola/app/view/login/cadastro_user.php");
            exit;
        }

        // verificando se a sessão não expirou
        if (time() - $_SESSION['ultimo_acesso'] > 3600) {
            session_destroy();
            header("Location: /sistema-agricola/app/view/login/cadastro_user.php");
            exit;
        }

        // atualizada acesso
        $_SESSION['ultimo_acesso'] = time();
        
        // Verificar se o usuário tem propriedade cadastrada
        if (!isset($_SESSION['propriedade_id'])) {
            header("Location: /sistema-agricola/app/registro-propriedade");
            exit;
        }
        
        include VIEWS . '/dashboard/home.php';
    }
}
