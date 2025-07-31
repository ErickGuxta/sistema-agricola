<?php

// Remover o var_dump que está causando a exibição da string
define('BASE_DIR', dirname(__FILE__, 2));
define('VIEWS', BASE_DIR . '/app/view');

//conectando com BD
$_ENV['db']['host'] = "localhost:3307";
$_ENV['db']['user'] = "root";
$_ENV['db']['pass'] = "Erick*2025";
$_ENV['db']['database'] = "sistema_agricola";