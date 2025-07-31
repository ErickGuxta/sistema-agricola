<?php

spl_autoload_register(function ($nome_da_classe) {
    /**
     * Defidindo o caminho absoluto até o arquivo que será incluído pelo PHP.
     * A constante BASEDIR está definida no arquivo config.php. Também é
     * importante observar que na variável $nome_da_classe temos, além do nome
     * da classe buscada, o namespace que também deve ser o caminho de diretórios
     * até o arquivo que contém a classe.
     */
    $arquivo =  BASE_DIR . "/" . $nome_da_classe . ".php";

    if(file_exists($arquivo))
    {
        include $arquivo;
    } else{
        throw new Exception("Arquivo não encontrado");
    }
});