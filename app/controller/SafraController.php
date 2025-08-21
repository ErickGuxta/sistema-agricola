<?php

namespace app\controller;

use app\model\Safra;

final class SafraController
{
    public static function index() : void
    {
        // requer login e sessão válida
        if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
            header("Location: /sistema-agricola/app/view/login/cadastro_user.php");
            exit;
        }

        if (time() - $_SESSION['ultimo_acesso'] > 3600) {
            session_destroy();
            header("Location: /sistema-agricola/app/view/login/cadastro_user.php");
            exit;
        }

        $_SESSION['ultimo_acesso'] = time();

        $erro = "";
        $propriedadeId = $_SESSION['propriedade_id'] ?? null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verificar se o usuário tem uma propriedade cadastrada
            if (!$propriedadeId) {
                $erro = 'Você precisa cadastrar uma propriedade antes de cadastrar safras. <a href="/sistema-agricola/app/registro-propriedade">Clique aqui para cadastrar</a>.';
            } else {
                // validar campos mínimos
                $nome = trim($_POST['nome'] ?? '');
                $dataInicio = trim($_POST['dataInicio'] ?? '');
                $dataTermino = trim($_POST['dataTermino'] ?? '');
                $status = trim($_POST['status'] ?? '');
                $descricao = trim($_POST['descricao'] ?? '');
                $areaHectare = trim($_POST['area_hectare'] ?? '');

                if ($nome === '' || $dataInicio === '' || $status === '') {
                    $erro = 'Preencha os campos obrigatórios';
                } else {
                    $model = new Safra();
                    $model->nome = $nome;
                    $model->descricao = $descricao;
                    $model->data_inicio = $dataInicio;
                    $model->data_fim = $dataTermino !== '' ? $dataTermino : null;
                    $model->status = $status;
                    $model->area_hectare = $areaHectare !== '' ? $areaHectare : null;

                    // propriedade atual do usuário (precisa existir na sessão após cadastro de propriedade)
                    $model->fk_Propriedade_id_propriedade = $propriedadeId;

                    $safraRegistrada = $model->registrar();
                    if ($safraRegistrada !== null) {
                        header("Location: /sistema-agricola/app/safra");
                        exit;
                    } else {
                        $erro = 'Erro ao cadastrar safra. Tente novamente.';
                    }
                }
            }
        }
        // Dados para listagem na view
        $safras = [];
        if ($propriedadeId) {
            $safras = Safra::listarPorPropriedade($propriedadeId);
        }

        include VIEWS . '/safra/safras.php';
    }

    public static function buscar() : void
    {
        if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
            http_response_code(401);
            echo json_encode(['erro' => 'não autenticado']);
            return;
        }
        header('Content-Type: application/json; charset=utf-8');
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $propriedadeId = $_SESSION['propriedade_id'] ?? null;
        if ($id <= 0 || !$propriedadeId) {
            http_response_code(400);
            echo json_encode(['erro' => 'parâmetros inválidos']);
            return;
        }
        $safra = Safra::getById($id, $propriedadeId);
        if (!$safra) {
            http_response_code(404);
            echo json_encode(['erro' => 'safra não encontrada']);
            return;
        }
        echo json_encode($safra);
    }

    public static function atualizar() : void
    {
        if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
            header("Location: /sistema-agricola/app/view/login/cadastro_user.php");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /sistema-agricola/app/safra");
            exit;
        }
        $propriedadeId = $_SESSION['propriedade_id'] ?? null;
        $idSafra = (int) ($_POST['id_safra'] ?? 0);
        if (!$propriedadeId || $idSafra <= 0) {
            header("Location: /sistema-agricola/app/safra");
            exit;
        }

        $existente = Safra::getById($idSafra, $propriedadeId);
        if (!$existente) {
            header("Location: /sistema-agricola/app/safra");
            exit;
        }

        $model = new Safra();
        $model->id_safra = $idSafra;
        $model->fk_Propriedade_id_propriedade = $propriedadeId;
        $model->nome = trim($_POST['nome'] ?? $existente->nome);
        $model->descricao = trim($_POST['descricao'] ?? $existente->descricao);
        $model->data_inicio = trim($_POST['dataInicio'] ?? $existente->data_inicio);
        $model->data_fim = trim($_POST['dataTermino'] ?? '') ?: $existente->data_fim;
        $model->area_hectare = trim($_POST['area_hectare'] ?? '') ?: $existente->area_hectare;
        $model->status = trim($_POST['status'] ?? $existente->status);

        $ok = $model->atualizar();
        header("Location: /sistema-agricola/app/safra");
        exit;
    }

    public static function deletar() : void
    {
        if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
            header("Location: /sistema-agricola/app/view/login/cadastro_user.php");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /sistema-agricola/app/safra");
            exit;
        }
        $propriedadeId = $_SESSION['propriedade_id'] ?? null;
        $idSafra = (int) ($_POST['id_safra'] ?? 0);
        if ($idSafra > 0 && $propriedadeId) {
            Safra::deletar($idSafra, $propriedadeId);
        }
        header("Location: /sistema-agricola/app/safra");
        exit;
    }
}
