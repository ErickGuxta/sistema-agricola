<?php

use app\controller\{
    UsuarioController,
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
    case 'registro-propriedade':
        PropriedadeController::index();
        break;
    default:
        echo "Pagina não encontrada - 404";
        break;
}