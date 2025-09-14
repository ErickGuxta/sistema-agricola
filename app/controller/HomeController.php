<?php

namespace app\controller;

use app\dao\PropriedadeDAO;
use app\dao\RelatorioDAO;

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

        // Buscar nome da propriedade do usuário e guardar na sessão para uso no dashboard
        if (isset($_SESSION['usuario_id'])) {
            $propriedadeDao = new PropriedadeDAO();
            $propriedade = $propriedadeDao->buscarPorUsuario((int) $_SESSION['usuario_id']);
            if ($propriedade) {
                $_SESSION['nome_propriedade'] = $propriedade->nome_propriedade;
            }
        }

        // Carregar dados dos relatórios para o dashboard
        // Dashboard vinculado a UMA propriedade específica
        $propriedadeId = (int) $_SESSION['propriedade_id'];
        $relatorioDAO = new RelatorioDAO();
        
        // Dados dos cards principais (3 cards sem ruptura)
        $resumoCards = $relatorioDAO->resumoCards($propriedadeId);
        
        // Dados para o gráfico de faturamento
        $dadosGrafico = $relatorioDAO->dadosGraficoFaturamento($propriedadeId, 6);
        
        // Valor em estoque por categoria
        $estoqueCategoria = $relatorioDAO->valorEstoquePorCategoria($propriedadeId);
        
        // Safras da propriedade
        $safrasPropriedade = $relatorioDAO->safrasPropriedade($propriedadeId);
        
        // Movimentações recentes
        $movimentacoes = $relatorioDAO->movimentacoes($propriedadeId, 30);
        
        // Informações gerais da propriedade
        $infoGerais = $relatorioDAO->informacoesGerais($propriedadeId);
        
        // Histórico simples de entradas e saídas
        $historicoEntradasSaidas = $relatorioDAO->historicoEntradasSaidas($propriedadeId);
        
        // Contagem simples de entradas e saídas
        $contagemEntradasSaidas = $relatorioDAO->contagemEntradasSaidas($propriedadeId);
        
        include VIEWS . '/dashboard/home.php';
    }

    public static function setSafra() : void
    {
        if (isset($_GET['safr-id'])) {
            $_SESSION['safr-id'] = (int)$_GET['safr-id'];
            $_SESSION['sucesso'] = "Safra selecionada com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro: Safra não especificada.";
        }
        header('Location: /estoque');
        exit();
    }

    public static function setPropriedade() : void
    {
        if (isset($_POST['propriedade_id'])) {
            $_SESSION['propriedade_id'] = (int)$_POST['propriedade_id'];
            // Atualiza nome da propriedade na sessão
            $propriedadeDao = new PropriedadeDAO();
            $propriedades = $propriedadeDao->listarPorUsuario((int) $_SESSION['usuario_id']);
            foreach ($propriedades as $p) {
                if ($p->id_propriedade == $_SESSION['propriedade_id']) {
                    $_SESSION['nome_propriedade'] = $p->nome_propriedade;
                    break;
                }
            }
        }
        header('Location: /sistema-agricola/app/dashboard');
        exit();
    }
}
