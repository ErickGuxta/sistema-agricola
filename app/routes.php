<?php

use app\controller\{
    UsuarioController,
    PropriedadeController,
    HomeController,
    SafraController,
    ItemEstoqueController,
    FaturamentoController
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
    case 'estoque':
        ItemEstoqueController::index();
        break;
    case 'estoque/buscar':
        ItemEstoqueController::index();
        break;
    case 'estoque/atualizar':
        ItemEstoqueController::atualizar();
        break;
    case 'estoque/deletar':
        ItemEstoqueController::deletar();
        break;
    case 'estoque/movimentacao':
        ItemEstoqueController::movimentacao();
        break;
    case 'faturamento':
        FaturamentoController::index();
        break;
    case 'faturamento/buscar':
        FaturamentoController::buscar();
        break;
    case 'faturamento/atualizar':
        FaturamentoController::atualizar();
        break;
    case 'faturamento/deletar':
        FaturamentoController::deletar();
        break;
    case 'dashboard/setSafra':
        HomeController::setSafra();
        break;
    default:
        echo "Pagina não encontrada - 404";
        break;
}