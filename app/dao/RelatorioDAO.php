<?php

namespace app\dao;

/**
 * DAO simplificado para relatórios do dashboard
 * Contém 8 tipos diferentes de consultas SQL para requisitos acadêmicos
 */
final class RelatorioDAO extends DAO
{
    /**
     * 1. CONSULTA COM SUBCONSULTAS ESCALARES
     * Busca dados dos cards principais usando múltiplas subconsultas
     */
    public function resumoCards(int $propriedadeId): array
    {
        $sql = "SELECT 
                    -- Subconsulta 1: Faturamento do ano atual
                    (SELECT COALESCE(SUM(f.valor), 0)
                     FROM Faturamento_Mes f
                     INNER JOIN Safra s ON f.safra_id = s.id_safra
                     WHERE s.propriedade_id = ?
                     AND YEAR(f.mes) = YEAR(CURDATE())) as faturamento_atual,
                     
                    -- Subconsulta 2: Faturamento do ano anterior
                    (SELECT COALESCE(SUM(f.valor), 0)
                     FROM Faturamento_Mes f
                     INNER JOIN Safra s ON f.safra_id = s.id_safra
                     WHERE s.propriedade_id = ?
                     AND YEAR(f.mes) = YEAR(CURDATE()) - 1) as faturamento_anterior,
                     
                    -- Subconsulta 3: Valor total em estoque
                    (SELECT COALESCE(SUM(ie.estoque_atual * COALESCE(ie.valor_unitario, 0)), 0)
                     FROM Item_Estoque ie
                     INNER JOIN Safra s ON ie.safra_id = s.id_safra
                     WHERE s.propriedade_id = ?) as valor_estoque_total";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $propriedadeId);
        $stmt->bindValue(2, $propriedadeId);
        $stmt->bindValue(3, $propriedadeId);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: [];
    }

    /**
     * 2. CONSULTA COM GROUP BY + FUNÇÕES AGREGADAS + FUNÇÕES DE DATA
     * Agrupa faturamento por mês usando DATE_FORMAT e SUM
     */
    public function dadosGraficoFaturamento(int $propriedadeId, int $meses = 6): array
    {
        $sql = "SELECT 
                    DATE_FORMAT(f.mes, '%b %Y') as periodo_nome,
                    SUM(f.valor) as faturamento_total,
                    COUNT(f.id_faturamento) as total_registros,
                    AVG(f.valor) as valor_medio,
                    f.mes
                FROM Faturamento_Mes f
                INNER JOIN Safra s ON f.safra_id = s.id_safra
                WHERE s.propriedade_id = ?
                    AND f.mes >= DATE_SUB(CURDATE(), INTERVAL ? MONTH)
                GROUP BY YEAR(f.mes), MONTH(f.mes), f.mes, DATE_FORMAT(f.mes, '%b %Y')
                HAVING SUM(f.valor) > 0
                ORDER BY f.mes ASC";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $propriedadeId);
        $stmt->bindValue(2, $meses);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function dadosGraficoFaturamentoPorSafra(int $propriedadeId, ?int $safraId = null, int $meses = 6): array
    {
        $sql = "SELECT 
                    DATE_FORMAT(f.mes, '%b %Y') as periodo_nome,
                    SUM(f.valor) as faturamento_total,
                    COUNT(f.id_faturamento) as total_registros,
                    AVG(f.valor) as valor_medio,
                    f.mes,
                    s.nome as safra_nome
                FROM Faturamento_Mes f
                INNER JOIN Safra s ON f.safra_id = s.id_safra
                WHERE s.propriedade_id = ?
                    AND f.mes >= DATE_SUB(CURDATE(), INTERVAL ? MONTH)";
        
        $params = [$propriedadeId, $meses];
        
        if ($safraId !== null) {
            $sql .= " AND s.id_safra = ?";
            $params[] = $safraId;
        }
        
        $sql .= " GROUP BY YEAR(f.mes), MONTH(f.mes), f.mes, DATE_FORMAT(f.mes, '%b %Y'), s.nome
                HAVING SUM(f.valor) > 0
                ORDER BY f.mes ASC";

        $stmt = parent::$conexao->prepare($sql);
        foreach ($params as $i => $param) {
            $stmt->bindValue($i + 1, $param);
        }
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * 3. CONSULTA COM MÚLTIPLOS JOINS + GROUP BY + ORDER BY
     * Junta 3 tabelas para agrupar estoque por categoria e unidade
     */
    public function valorEstoquePorCategoria(int $propriedadeId): array
    {
        $sql = "SELECT 
                    c.nome as categoria,
                    ie.unidade_medida,
                    COUNT(ie.id_item) as total_itens,
                    SUM(ie.estoque_atual) as quantidade_total,
                    SUM(ie.estoque_atual * COALESCE(ie.valor_unitario, 0)) as valor_total,
                    MIN(ie.valor_unitario) as menor_preco,
                    MAX(ie.valor_unitario) as maior_preco
                FROM Item_Estoque ie
                INNER JOIN Categoria c ON ie.categoria_id = c.id_categoria
                INNER JOIN Safra s ON ie.safra_id = s.id_safra
                WHERE s.propriedade_id = ?
                    AND ie.estoque_atual > 0
                GROUP BY c.id_categoria, c.nome, ie.unidade_medida
                ORDER BY valor_total DESC, c.nome ASC, ie.unidade_medida ASC";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $propriedadeId);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    /**
     * Busca safras de uma propriedade com cálculos complexos e métricas de performance
     * 
     * Esta consulta combina múltiplas técnicas SQL avançadas:
     * - Subconsultas correlacionadas para calcular receita total por safra
     * - CASE WHEN para cálculos condicionais (receita por hectare)
     * - CASE WHEN para traduzir status do banco para descrições amigáveis
     * - Subconsulta para contar itens em estoque por safra
     * - ORDER BY complexo com priorização por status e performance
     * 
     * @param int $propriedadeId ID da propriedade
     * @return array Array associativo com dados das safras:
     *   - safra_nome: Nome da safra
     *   - area_hectare: Área em hectares
     *   - status: Status original (EM_ANDAMENTO, FINALIZADA, etc.)
     *   - data_inicio/data_fim: Datas da safra
     *   - receita_total: Soma de todos os faturamentos da safra
     *   - receita_por_hectare: Receita dividida pela área (métrica de eficiência)
     *   - status_descricao: Status traduzido para português
     *   - itens_estoque: Quantidade de itens com estoque > 0
     */
    public function safrasPropriedade(int $propriedadeId): array
    {
        $sql = "SELECT 
                    s.nome as safra_nome,
                    s.area_hectare,
                    s.status,
                    s.data_inicio,
                    s.data_fim,
                    
                    -- Subconsulta correlacionada: Receita total da safra
                    -- Calcula soma de todos os faturamentos vinculados à safra
                    (SELECT COALESCE(SUM(f.valor), 0) 
                     FROM Faturamento_Mes f 
                     WHERE f.safra_id = s.id_safra) as receita_total,
                     
                    -- Cálculo de eficiência: receita por hectare
                    -- Evita divisão por zero usando CASE WHEN
                    CASE 
                        WHEN s.area_hectare > 0 THEN 
                            ROUND((SELECT COALESCE(SUM(f.valor), 0) 
                                   FROM Faturamento_Mes f 
                                   WHERE f.safra_id = s.id_safra) / s.area_hectare, 2)
                        ELSE 0
                    END as receita_por_hectare,
                    
                    -- Tradução de status para interface amigável
                    CASE s.status
                        WHEN 'EM_ANDAMENTO' THEN 'Ativa'
                        WHEN 'FINALIZADA' THEN 'Concluída'
                        WHEN 'PLANEJADA' THEN 'Planejamento'
                        ELSE 'Outro'
                    END as status_descricao,
                    
                    -- Contagem de itens com estoque disponível
                    (SELECT COUNT(*) 
                     FROM Item_Estoque ie 
                     WHERE ie.safra_id = s.id_safra 
                     AND ie.estoque_atual > 0) as itens_estoque
                     
                FROM Safra s
                WHERE s.propriedade_id = ?
                ORDER BY 
                    -- Priorização: safras ativas primeiro, depois planejadas, depois finalizadas
                    CASE s.status
                        WHEN 'EM_ANDAMENTO' THEN 1
                        WHEN 'PLANEJADA' THEN 2
                        WHEN 'FINALIZADA' THEN 3
                        ELSE 4
                    END,
                    -- Ordenação secundária: maior receita por hectare primeiro
                    receita_por_hectare DESC";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $propriedadeId);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * 5. CONSULTA COM MÚLTIPLOS JOINS + FILTROS DE DATA + ORDER BY COMPLEXO
     * Busca movimentações com joins em 4 tabelas e filtros temporais
     */
    public function movimentacoes(int $propriedadeId, int $dias = 30): array
    {
        $sql = "SELECT 
                    me.tipo_movimentacao,
                    me.quantidade,
                    me.data_movimentacao,
                    DATE_FORMAT(me.data_movimentacao, '%d/%m/%Y %H:%i') as data_formatada,
                    DATEDIFF(CURDATE(), me.data_movimentacao) as dias_atras,
                    ie.nome as item_nome,
                    ie.unidade_medida,
                    ie.estoque_atual,
                    ie.valor_unitario,
                    c.nome as categoria,
                    s.nome as safra_nome,
                    me.observacao,
                    -- Cálculo do valor da movimentação
                    (me.quantidade * COALESCE(ie.valor_unitario, 0)) as valor_movimentacao
                FROM Movimentacao_Estoque me
                INNER JOIN Item_Estoque ie ON me.item_id = ie.id_item
                INNER JOIN Categoria c ON ie.categoria_id = c.id_categoria
                INNER JOIN Safra s ON ie.safra_id = s.id_safra
                WHERE s.propriedade_id = ?
                    AND me.data_movimentacao >= DATE_SUB(CURDATE(), INTERVAL ? DAY)
                    AND me.data_movimentacao <= CURDATE()
                ORDER BY 
                    me.data_movimentacao DESC,
                    me.tipo_movimentacao ASC,
                    valor_movimentacao DESC
                LIMIT 50";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $propriedadeId);
        $stmt->bindValue(2, $dias);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * 6. CONSULTA COM SUBCONSULTAS + FUNÇÕES AGREGADAS (BÔNUS)
     * Informações gerais da propriedade com múltiplas subconsultas
     */
    public function informacoesGerais(int $propriedadeId): array
    {
        $sql = "SELECT 
                    p.nome_propriedade,
                    p.area_total,
                    p.localizacao,
                    -- Contagem de safras por status
                    (SELECT COUNT(*) 
                     FROM Safra s 
                     WHERE s.propriedade_id = p.id_propriedade) as total_safras,
                     
                    (SELECT COUNT(*) 
                     FROM Safra s 
                     WHERE s.propriedade_id = p.id_propriedade 
                     AND s.status = 'EM_ANDAMENTO') as safras_ativas,
                     
                    (SELECT COUNT(*) 
                     FROM Safra s 
                     WHERE s.propriedade_id = p.id_propriedade 
                     AND s.status = 'FINALIZADA') as safras_finalizadas,
                     
                    -- Total de itens em estoque
                    (SELECT COUNT(*) 
                     FROM Item_Estoque ie 
                     INNER JOIN Safra s ON ie.safra_id = s.id_safra 
                     WHERE s.propriedade_id = p.id_propriedade
                     AND ie.estoque_atual > 0) as total_itens,
                     
                    -- Última movimentação
                    (SELECT MAX(me.data_movimentacao)
                     FROM Movimentacao_Estoque me
                     INNER JOIN Item_Estoque ie ON me.item_id = ie.id_item
                     INNER JOIN Safra s ON ie.safra_id = s.id_safra
                     WHERE s.propriedade_id = p.id_propriedade) as ultima_movimentacao
                     
                FROM Propriedade p
                WHERE p.id_propriedade = ?";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $propriedadeId);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: [];
    }

    /**
     * 7. HISTÓRICO SIMPLES DE ENTRADAS E SAÍDAS
     * GROUP BY básico + COUNT + SUM
     */
    public function historicoEntradasSaidas(int $propriedadeId): array
    {
        $sql = "SELECT 
                    DATE_FORMAT(me.data_movimentacao, '%b %Y') as periodo_nome,
                    me.tipo_movimentacao,
                    COUNT(*) as total_movimentacoes,
                    SUM(me.quantidade) as quantidade_total
                FROM Movimentacao_Estoque me
                INNER JOIN Item_Estoque ie ON me.item_id = ie.id_item
                INNER JOIN Safra s ON ie.safra_id = s.id_safra
                WHERE s.propriedade_id = ?
                    AND me.data_movimentacao >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
                GROUP BY DATE_FORMAT(me.data_movimentacao, '%b %Y'), me.tipo_movimentacao
                ORDER BY DATE_FORMAT(me.data_movimentacao, '%b %Y') DESC";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $propriedadeId);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * 8. CONTAGEM SIMPLES DE ENTRADAS E SAÍDAS
     * COUNT básico com filtros simples
     */
    public function contagemEntradasSaidas(int $propriedadeId): array
    {
        $sql = "SELECT 
                    -- Entradas do mês atual
                    (SELECT COUNT(*) 
                     FROM Movimentacao_Estoque me
                     INNER JOIN Item_Estoque ie ON me.item_id = ie.id_item
                     INNER JOIN Safra s ON ie.safra_id = s.id_safra
                     WHERE s.propriedade_id = ?
                     AND me.tipo_movimentacao = 'ENTRADA'
                     AND MONTH(me.data_movimentacao) = MONTH(CURDATE())
                     AND YEAR(me.data_movimentacao) = YEAR(CURDATE())) as entradas_mes,
                     
                    -- Saídas do mês atual
                    (SELECT COUNT(*) 
                     FROM Movimentacao_Estoque me
                     INNER JOIN Item_Estoque ie ON me.item_id = ie.id_item
                     INNER JOIN Safra s ON ie.safra_id = s.id_safra
                     WHERE s.propriedade_id = ?
                     AND me.tipo_movimentacao = 'SAIDA'
                     AND MONTH(me.data_movimentacao) = MONTH(CURDATE())
                     AND YEAR(me.data_movimentacao) = YEAR(CURDATE())) as saidas_mes,
                     
                    -- Total de entradas (últimos 30 dias)
                    (SELECT COUNT(*) 
                     FROM Movimentacao_Estoque me
                     INNER JOIN Item_Estoque ie ON me.item_id = ie.id_item
                     INNER JOIN Safra s ON ie.safra_id = s.id_safra
                     WHERE s.propriedade_id = ?
                     AND me.tipo_movimentacao = 'ENTRADA'
                     AND me.data_movimentacao >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)) as total_entradas,
                     
                    -- Total de saídas (últimos 30 dias)
                    (SELECT COUNT(*) 
                     FROM Movimentacao_Estoque me
                     INNER JOIN Item_Estoque ie ON me.item_id = ie.id_item
                     INNER JOIN Safra s ON ie.safra_id = s.id_safra
                     WHERE s.propriedade_id = ?
                     AND me.tipo_movimentacao = 'SAIDA'
                     AND me.data_movimentacao >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)) as total_saidas";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $propriedadeId);
        $stmt->bindValue(2, $propriedadeId);
        $stmt->bindValue(3, $propriedadeId);
        $stmt->bindValue(4, $propriedadeId);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: [];
    }

    /**
     * 9. HISTÓRICO DETALHADO DE MOVIMENTAÇÕES COM DESCRIÇÕES
     * Busca movimentações com informações completas incluindo observações
     */
    public function historicoDetalhadoMovimentacoes(int $propriedadeId, int $dias = 30): array
    {
        // Consulta simplificada sem filtro de data para garantir que todas as movimentações apareçam
        $sql = "SELECT 
                    me.id_movimentacao,
                    me.tipo_movimentacao,
                    me.quantidade,
                    me.data_movimentacao,
                    DATE_FORMAT(me.data_movimentacao, '%d/%m/%Y %H:%i') as data_formatada,
                    DATEDIFF(CURDATE(), me.data_movimentacao) as dias_atras,
                    me.observacao,
                    ie.nome as item_nome,
                    ie.unidade_medida,
                    ie.estoque_atual,
                    ie.valor_unitario,
                    c.nome as categoria,
                    s.nome as safra_nome,
                    p.nome_propriedade,
                    -- Cálculo do valor da movimentação
                    (me.quantidade * COALESCE(ie.valor_unitario, 0)) as valor_movimentacao,
                    -- Descrição formatada da movimentação
                    CONCAT(
                        me.tipo_movimentacao, ' de ', me.quantidade, ' ', ie.unidade_medida, 
                        ' de ', ie.nome, ' (', c.nome, ')',
                        CASE 
                            WHEN me.observacao IS NOT NULL AND me.observacao != '' 
                            THEN CONCAT(' - Motivo: ', me.observacao)
                            ELSE ''
                        END
                    ) as descricao_completa
                FROM Movimentacao_Estoque me
                INNER JOIN Item_Estoque ie ON me.item_id = ie.id_item
                INNER JOIN Categoria c ON ie.categoria_id = c.id_categoria
                INNER JOIN Safra s ON ie.safra_id = s.id_safra
                INNER JOIN Propriedade p ON s.propriedade_id = p.id_propriedade
                WHERE s.propriedade_id = ?
                ORDER BY 
                    me.data_movimentacao DESC,
                    me.tipo_movimentacao ASC,
                    valor_movimentacao DESC
                LIMIT 100";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $propriedadeId);
        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


}