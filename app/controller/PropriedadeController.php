<?php

namespace app\controller;

use app\model\Propriedade;
use app\dao\PropriedadeDAO;

final class PropriedadeController
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
        
        $model = new Propriedade();
        $erro = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // Validar se os campos estão preenchidos
            if(empty($_POST['nome_propriedade']) || empty($_POST['area_total']) || empty($_POST['estado']) || empty($_POST['cidade'])) 
            {
                $erro = "Todos os campos são obrigatórios";
            } else{
                $model->nome_propriedade = $_POST['nome_propriedade'];
                $model->area_total = $_POST['area_total'];
                $model->localizacao = $_POST['estado'] . ' - ' . $_POST['cidade'];

                //id do usario da sessão
                $model->usuario_id = $_SESSION['usuario_id']; 

                $propriedadeRegistrado = $model->registrar();

                if ($propriedadeRegistrado !== null) {
                    // guardar a propriedade atual na sessão
                    $_SESSION['propriedade_id'] = $propriedadeRegistrado->id_propriedade;
                    $_SESSION['propriedade_nome'] = $propriedadeRegistrado->nome_propriedade;
                    // Redirecionar para dashboard 
                    header("Location: /sistema-agricola/app/dashboard");
                    exit;
                } else{
                    $erro = "Erro ao cadastrar propriedade. Tente novamente.";
                }

            }
        }
        include VIEWS . '/propriedade/cadastro_propriedade.php';

    }
}
