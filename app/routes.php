<?php

use app\controller\{
    UsuarioController,
    PropriedadeController,
    HomeController,
    SafraController
};

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

//remover a base path do projeto
$url = str_replace('/sistema-agricola/app/', '', $url);

//remover barras extras no inicio e fim (trim)
$url = trim($url, '/');

//rotas
switch ($url) {
    case '':
    case 'registro': // Adicionada a rota register
        UsuarioController::index();
        break;
    case 'login':
        UsuarioController::login();
        break;
    case 'registro-propriedade':
        PropriedadeController::index();
        break;
    case 'dashboard':
        HomeController::index();
        break;
    case 'safra':
        SafraController::index();
        break;
    case 'safra/buscar':
        SafraController::buscar();
        break;
    case 'safra/atualizar':
        SafraController::atualizar();
        break;
    case 'safra/deletar':
        SafraController::deletar();
        break;
    // case 'estoque':
    //     EstoqueController::index();
    //     break;
    // case 'faturamento':
    //     FaturamentoController::index();
    //     break;
    default:
        echo "Pagina não encontrada - 404";
        break;
}