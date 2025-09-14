<?php

namespace app\controller;

use app\model\Faturamento;
use app\model\Safra;
use app\model\Usuario;
use app\dao\ItemEstoqueDAO;
use app\dao\RelatorioDAO;

class FaturamentoController
{
    // Exibe a tela de faturamento
    public static function index()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $usuarioId = $_SESSION['usuario_id'] ?? null;
        $propriedadeId = $_SESSION['propriedade_id'] ?? null;
        if (!$usuarioId || !$propriedadeId) {
            header('Location: /sistema-agricola/app/login');
            exit;
        }
        $safras       = Safra::listarPorPropriedade($propriedadeId);
        $todasSafras  = Safra::listarTodas();
        $faturamentos = Faturamento::listarPorPropriedade($propriedadeId);
        $receitaTotal = Faturamento::receitaTotalPropriedade($propriedadeId);
        
        // Buscar custos do estoque (valor total do estoque)
        $itemDao = new ItemEstoqueDAO();
        $custoTotal = $itemDao->valorTotalEstoque($propriedadeId, null);
        
        // Calcular lucro
        $lucro = $receitaTotal - $custoTotal;
        
        // Dados para o gráfico de faturamento
        $relatorioDAO = new RelatorioDAO();
        $dadosGrafico = $relatorioDAO->dadosGraficoFaturamentoPorSafra($propriedadeId, null, 12);
        
        require __DIR__ . '/../view/faturamento/faturamento.php';
    }

    // Buscar dados do gráfico por safra (AJAX)
    public static function dadosGrafico()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $usuarioId = $_SESSION['usuario_id'] ?? null;
        $propriedadeId = $_SESSION['propriedade_id'] ?? null;
        
        if (!$usuarioId || !$propriedadeId) {
            http_response_code(401);
            echo json_encode(['error' => 'Não autorizado']);
            return;
        }

        $safraId = $_GET['safra_id'] ?? null;
        $meses = $_GET['meses'] ?? 12;
        
        $relatorioDAO = new RelatorioDAO();
        $dadosGrafico = $relatorioDAO->dadosGraficoFaturamentoPorSafra($propriedadeId, $safraId, (int)$meses);
        
        header('Content-Type: application/json');
        echo json_encode($dadosGrafico);
    }

    // Buscar faturamento por safra (AJAX)
    public static function buscar()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $usuarioId = $_SESSION['usuario_id'] ?? null;
        $propriedadeId = $_SESSION['propriedade_id'] ?? null;
        
        if (!$usuarioId || !$propriedadeId) {
            http_response_code(401);
            echo json_encode(['error' => 'Não autorizado']);
            return;
        }

        $safraId = $_GET['safra_id'] ?? null;
        
        if ($safraId && $safraId !== '') {
            $faturamentos = Faturamento::getBySafra((int)$safraId, $propriedadeId);
        } else {
            $faturamentos = Faturamento::listarPorPropriedade($propriedadeId);
            $safraId = null;
        }
        
        // Calcular receita total
        $receitaTotal = 0;
        foreach ($faturamentos as $fat) {
            $receitaTotal += (float)$fat->valor;
        }
        
        // Calcular custo (valor total do estoque) possivelmente filtrado pela safra
        $itemDao = new ItemEstoqueDAO();
        $custoTotal = $itemDao->valorTotalEstoque($propriedadeId, $safraId ? (int)$safraId : null);
        
        // Calcular lucro
        $lucro = $receitaTotal - $custoTotal;
        
        // Buscar nomes das safras para exibição
        $safras = Safra::listarPorPropriedade($propriedadeId);
        $safrasMap = [];
        foreach ($safras as $safra) {
            $safrasMap[$safra->id_safra] = $safra->nome;
        }
        
        foreach ($faturamentos as $fat) {
            $fat->safra_nome = $safrasMap[$fat->safra_id] ?? 'N/A';
        }
        
        echo json_encode([
            'faturamentos' => $faturamentos,
            'receitaTotal' => $receitaTotal,
            'custoTotal' => $custoTotal,
            'lucro' => $lucro,
        ]);
    }

    // Atualizar ou cadastrar faturamento
    public static function atualizar()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $usuarioId = $_SESSION['usuario_id'] ?? null;
        if (!$usuarioId) {
            header('Location: /sistema-agricola/app/login');
            exit;
        }
        
        // Converter mês para data
        $mes = $_POST['mes'] ?? null;
        $data = self::mesParaData($mes);

        $dados = [
            'id_faturamento' => $_POST['id_faturamento'] ?? null,
            'usuario_id'     => $usuarioId,
            'safra_id'       => $_POST['safra_id'] ?? null,
            'mes'            => $data,
            'valor'          => $_POST['valor'] ?? null,
            'descricao'      => $_POST['descricao'] ?? null,
        ];
        $faturamento = new Faturamento($dados);
        if ($faturamento->id_faturamento) {
            $faturamento->atualizar();
        } else {
            $faturamento->registrar();
        }
        header('Location: /sistema-agricola/app/faturamento');
        exit;
    }

    // Deletar faturamento
    public static function deletar()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $usuarioId = $_SESSION['usuario_id'] ?? null;
        if (!$usuarioId) {
            header('Location: /sistema-agricola/app/login');
            exit;
        }
        $idFaturamento = $_POST['id_faturamento'] ?? null;
        if ($idFaturamento) {
            Faturamento::deletar($idFaturamento, $usuarioId);
        }
        header('Location: /sistema-agricola/app/faturamento');
        exit;
    }

    // Método para calcular custos do estoque
    private static function calcularCustoEstoque($propriedadeId)
    {
        // Mantido para compatibilidade, mas usando o DAO novo
        $itemDao = new ItemEstoqueDAO();
        return $itemDao->valorTotalEstoque($propriedadeId, null);
    }

    // Método simples para converter mês em data
    private static function mesParaData($mes)
    {
        $ano = date('Y');
        $meses = [
            '01' => '01', '02' => '02', '03' => '03', '04' => '04',
            '05' => '05', '06' => '06', '07' => '07', '08' => '08',
            '09' => '09', '10' => '10', '11' => '11', '12' => '12'
        ];
        
        if (isset($meses[$mes])) {
            return $ano . '-' . $mes . '-01';
        }
        
        return $ano . '-01-01';
    }
}
