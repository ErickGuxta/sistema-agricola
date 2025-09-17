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

    public static function atualizar() : void
    {
        // Log para debug
        error_log("PropriedadeController::atualizar() chamado");
        error_log("REQUEST_METHOD: " . $_SERVER['REQUEST_METHOD']);
        error_log("POST data: " . print_r($_POST, true));
        
        // verificando se o usuario já está logado/registrado
        if(!isset($_SESSION['logado']) || $_SESSION['logado'] !== true )
        {
            error_log("Usuário não logado, redirecionando para login");
            header("Location: /sistema-agricola/app/view/login/cadastro_user.php");
            exit;
        }

        // verificando se a sessão não expirou
        if (time() - $_SESSION['ultimo_acesso'] > 3600) {
            error_log("Sessão expirada");
            session_destroy();
            header("Location: /sistema-agricola/app/view/login/cadastro_user.php");
            exit;
        }

        // atualizada acesso
        $_SESSION['ultimo_acesso'] = time();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            error_log("Processando POST request");
            
            // Validar se os campos estão preenchidos
            if(empty($_POST['nome_propriedade']) || empty($_POST['area_total']) || empty($_POST['estado']) || empty($_POST['cidade'])) 
            {
                error_log("Campos obrigatórios não preenchidos");
                $_SESSION['erro'] = "Todos os campos são obrigatórios";
            } else {
                error_log("Todos os campos preenchidos, processando atualização");
                
                $model = new Propriedade();
                $model->id_propriedade = (int) $_SESSION['propriedade_id'];
                $model->usuario_id = (int) $_SESSION['usuario_id'];
                $model->nome_propriedade = $_POST['nome_propriedade'];
                $model->area_total = $_POST['area_total'];
                $model->localizacao = $_POST['estado'] . ' - ' . $_POST['cidade'];

                error_log("Modelo criado: " . print_r($model, true));

                $propriedadeDAO = new PropriedadeDAO();
                $atualizado = $propriedadeDAO->atualizar($model);

                error_log("Resultado da atualização: " . ($atualizado ? 'true' : 'false'));

                if ($atualizado) {
                    // Atualizar dados na sessão
                    $_SESSION['propriedade_nome'] = $model->nome_propriedade;
                    $_SESSION['sucesso'] = "Propriedade atualizada com sucesso!";
                    error_log("Propriedade atualizada com sucesso");
                } else {
                    $_SESSION['erro'] = "Erro ao atualizar propriedade. Tente novamente.";
                    error_log("Erro ao atualizar propriedade");
                }
            }
        } else {
            error_log("Método não é POST: " . $_SERVER['REQUEST_METHOD']);
        }
        
        error_log("Redirecionando para dashboard");
        header("Location: /sistema-agricola/app/dashboard");
        exit;
    }
}
