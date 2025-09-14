-- ============================================
-- DADOS SIMULADOS PARA SISTEMA AGRÍCOLA
-- 5 conjuntos completos de dados para:
-- - Safras
-- - Itens de Estoque
-- - Faturamento
-- - Movimentações de Estoque (Entrada e Saída)
-- ============================================

-- ============================================
-- CONJUNTO 1: PRODUÇÃO DE MILHO
-- ============================================

-- Safra de Milho
INSERT INTO Safra (propriedade_id, nome, descricao, data_inicio, data_fim, area_hectare, status) VALUES
(1, 'Milho Safra 2024/25 - Alta Produtividade', 'Plantio de milho híbrido com tecnologia de ponta para máxima produtividade', '2024-10-15', '2025-03-20', 85.50, 'EM_ANDAMENTO');

-- Itens de Estoque para Milho
INSERT INTO Item_Estoque (usuario_id, categoria_id, safra_id, nome, estoque_atual, estoque_minimo, valor_unitario, unidade_medida, validade) VALUES
(1, 1, 23, 'Sementes Milho Pioneer P3646', 45.000, 8.000, 520.00, 'SACA', '2025-09-15'),
(1, 2, 23, 'Fertilizante NPK 20-10-10', 120.000, 20.000, 95.50, 'SACA', '2026-12-31'),
(1, 3, 23, 'Herbicida Atrazina 500g/L', 35.000, 6.000, 32.80, 'L', '2025-08-20'),
(1, 4, 23, 'Pulverizador Costal 20L', 8.000, 2.000, 285.00, 'UNIDADE', NULL),
(1, 5, 23, 'Diesel S10 Agrícola', 800.000, 100.000, 4.15, 'L', NULL);

-- Movimentações de Estoque - Entradas
INSERT INTO Movimentacao_Estoque (item_id, usuario_id, tipo_movimentacao, quantidade, observacao, data_movimentacao) VALUES
(23, 1, 'ENTRADA', 50.000, 'Compra inicial sementes milho', '2024-09-20 09:30:00'),
(24, 1, 'ENTRADA', 150.000, 'Adubação base NPK', '2024-09-25 14:15:00'),
(25, 1, 'ENTRADA', 45.000, 'Herbicida pré-emergente', '2024-10-01 11:45:00'),
(26, 1, 'ENTRADA', 10.000, 'Equipamentos pulverização', '2024-09-15 16:20:00'),
(27, 1, 'ENTRADA', 1000.000, 'Combustível safra', '2024-10-05 08:10:00');

-- Movimentações de Estoque - Saídas
INSERT INTO Movimentacao_Estoque (item_id, usuario_id, tipo_movimentacao, quantidade, observacao, data_movimentacao) VALUES
(23, 1, 'SAIDA', 5.000, 'Plantio área norte', '2024-10-15 07:30:00'),
(24, 1, 'SAIDA', 30.000, 'Adubação plantio', '2024-10-16 09:45:00'),
(25, 1, 'SAIDA', 10.000, 'Aplicação herbicida', '2024-10-20 14:20:00'),
(27, 1, 'SAIDA', 200.000, 'Consumo tratores plantio', '2024-10-15 18:00:00');

-- Faturamento Milho
INSERT INTO Faturamento_Mes (usuario_id, safra_id, mes, valor, descricao) VALUES
(1, 23, '2025-02-01', 85000.00, 'Venda milho primeira colheita'),
(1, 23, '2025-03-01', 125000.50, 'Venda milho segunda colheita'),
(1, 23, '2025-04-01', 95000.75, 'Venda milho terceira colheita');

-- ============================================
-- CONJUNTO 2: PRODUÇÃO DE SOJA
-- ============================================

-- Safra de Soja
INSERT INTO Safra (propriedade_id, nome, descricao, data_inicio, data_fim, area_hectare, status) VALUES
(2, 'Soja Verão 2024/25 - Transgênica', 'Soja RR2 PRO com alta produtividade e resistência a herbicidas', '2024-11-01', '2025-04-15', 120.75, 'EM_ANDAMENTO');

-- Itens de Estoque para Soja
INSERT INTO Item_Estoque (usuario_id, categoria_id, safra_id, nome, estoque_atual, estoque_minimo, valor_unitario, unidade_medida, validade) VALUES
(2, 1, 24, 'Sementes Soja TMG 7262', 35.000, 6.000, 420.00, 'SACA', '2025-07-30'),
(2, 2, 24, 'Fertilizante Superfosfato Simples', 180.000, 25.000, 78.90, 'SACA', '2026-11-20'),
(2, 3, 24, 'Inseticida Lambda Cialotrina', 28.000, 5.000, 45.60, 'L', '2025-10-15'),
(2, 6, 24, 'Semeadora 8 Linhas', 1.000, 1.000, 18500.00, 'UNIDADE', NULL),
(2, 5, 24, 'Óleo Hidráulico AW46', 150.000, 20.000, 13.50, 'L', '2026-08-30');

-- Movimentações de Estoque - Entradas
INSERT INTO Movimentacao_Estoque (item_id, usuario_id, tipo_movimentacao, quantidade, observacao, data_movimentacao) VALUES
(28, 2, 'ENTRADA', 40.000, 'Sementes soja transgênica', '2024-10-15 10:20:00'),
(29, 2, 'ENTRADA', 200.000, 'Fosfato plantio soja', '2024-10-20 15:30:00'),
(30, 2, 'ENTRADA', 35.000, 'Inseticida controle lagarta', '2024-10-25 12:45:00'),
(31, 2, 'ENTRADA', 1.000, 'Semeadora nova', '2024-09-30 14:00:00'),
(32, 2, 'ENTRADA', 180.000, 'Óleo equipamentos', '2024-10-10 09:15:00');

-- Movimentações de Estoque - Saídas
INSERT INTO Movimentacao_Estoque (item_id, usuario_id, tipo_movimentacao, quantidade, observacao, data_movimentacao) VALUES
(28, 2, 'SAIDA', 5.000, 'Plantio área sul', '2024-11-01 08:00:00'),
(29, 2, 'SAIDA', 20.000, 'Adubação fosfatada', '2024-11-02 10:30:00'),
(30, 2, 'SAIDA', 7.000, 'Controle lagarta falsa-medideira', '2024-12-15 16:45:00'),
(32, 2, 'SAIDA', 30.000, 'Manutenção semeadora', '2024-11-05 11:20:00');

-- Faturamento Soja
INSERT INTO Faturamento_Mes (usuario_id, safra_id, mes, valor, descricao) VALUES
(2, 24, '2025-03-01', 180000.00, 'Venda soja primeira colheita'),
(2, 24, '2025-04-01', 220000.50, 'Venda soja segunda colheita'),
(2, 24, '2025-05-01', 195000.75, 'Venda soja terceira colheita');

-- ============================================
-- CONJUNTO 3: PRODUÇÃO DE CAFÉ
-- ============================================

-- Safra de Café
INSERT INTO Safra (propriedade_id, nome, descricao, data_inicio, data_fim, area_hectare, status) VALUES
(3, 'Café Arábica 2024/25 - Especial', 'Café arábica de alta qualidade para mercado premium e exportação', '2024-01-15', NULL, 65.80, 'EM_ANDAMENTO');

-- Itens de Estoque para Café
INSERT INTO Item_Estoque (usuario_id, categoria_id, safra_id, nome, estoque_atual, estoque_minimo, valor_unitario, unidade_medida, validade) VALUES
(3, 1, 25, 'Mudas Café Catuaí Vermelho', 2500.000, 500.000, 8.50, 'UNIDADE', NULL),
(3, 2, 25, 'Fertilizante Orgânico Composto', 80.000, 15.000, 45.00, 'SACA', '2025-12-31'),
(3, 3, 25, 'Fungicida Cobre Oxicloreto', 25.000, 4.000, 28.90, 'KG', '2025-09-30'),
(3, 4, 25, 'Colheitadeira Manual', 15.000, 3.000, 85.00, 'UNIDADE', NULL),
(3, 6, 25, 'Secador de Café', 2.000, 1.000, 12500.00, 'UNIDADE', NULL);

-- Movimentações de Estoque - Entradas
INSERT INTO Movimentacao_Estoque (item_id, usuario_id, tipo_movimentacao, quantidade, observacao, data_movimentacao) VALUES
(33, 3, 'ENTRADA', 3000.000, 'Mudas café catuaí', '2023-12-20 14:30:00'),
(34, 3, 'ENTRADA', 100.000, 'Adubo orgânico plantio', '2024-01-10 11:15:00'),
(35, 3, 'ENTRADA', 30.000, 'Fungicida cobre', '2024-02-15 16:45:00'),
(36, 3, 'ENTRADA', 20.000, 'Equipamentos colheita', '2024-01-05 09:20:00'),
(37, 3, 'ENTRADA', 2.000, 'Secador café', '2024-01-20 13:00:00');

-- Movimentações de Estoque - Saídas
INSERT INTO Movimentacao_Estoque (item_id, usuario_id, tipo_movimentacao, quantidade, observacao, data_movimentacao) VALUES
(33, 3, 'SAIDA', 500.000, 'Plantio área nova', '2024-01-15 08:30:00'),
(34, 3, 'SAIDA', 20.000, 'Adubação pós-plantio', '2024-02-01 10:45:00'),
(35, 3, 'SAIDA', 5.000, 'Aplicação preventiva', '2024-03-10 15:20:00'),
(36, 3, 'SAIDA', 5.000, 'Colheita café cereja', '2024-06-15 07:00:00');

-- Faturamento Café
INSERT INTO Faturamento_Mes (usuario_id, safra_id, mes, valor, descricao) VALUES
(3, 25, '2024-06-01', 125000.00, 'Venda café cereja'),
(3, 25, '2024-07-01', 98000.50, 'Venda café beneficiado'),
(3, 25, '2024-08-01', 110000.75, 'Venda café especial');

-- ============================================
-- CONJUNTO 4: PRODUÇÃO DE HORTALIÇAS
-- ============================================

-- Safra de Hortaliças
INSERT INTO Safra (propriedade_id, nome, descricao, data_inicio, data_fim, area_hectare, status) VALUES
(4, 'Hortaliças 2024/25 - Hidropônicas', 'Produção de hortaliças em sistema hidropônico para mercado premium', '2024-11-15', NULL, 25.30, 'EM_ANDAMENTO');

-- Itens de Estoque para Hortaliças
INSERT INTO Item_Estoque (usuario_id, categoria_id, safra_id, nome, estoque_atual, estoque_minimo, valor_unitario, unidade_medida, validade) VALUES
(4, 1, 26, 'Sementes Alface Americana', 2.500, 500.000, 0.15, 'UNIDADE', '2025-12-31'),
(4, 2, 26, 'Solução Nutritiva Hidropônica', 500.000, 100.000, 12.50, 'L', '2025-06-30'),
(4, 3, 26, 'Fungicida Biológico Trichoderma', 15.000, 3.000, 35.80, 'L', '2025-08-15'),
(4, 4, 26, 'Sistema Hidropônico NFT', 50.000, 10.000, 125.00, 'M', NULL),
(4, 6, 26, 'Estufa 500m²', 1.000, 1.000, 45000.00, 'UNIDADE', NULL);

-- Movimentações de Estoque - Entradas
INSERT INTO Movimentacao_Estoque (item_id, usuario_id, tipo_movimentacao, quantidade, observacao, data_movimentacao) VALUES
(38, 4, 'ENTRADA', 3000.000, 'Sementes alface premium', '2024-11-01 10:30:00'),
(39, 4, 'ENTRADA', 600.000, 'Solução nutritiva', '2024-11-05 14:20:00'),
(40, 4, 'ENTRADA', 20.000, 'Fungicida biológico', '2024-11-10 16:45:00'),
(41, 4, 'ENTRADA', 60.000, 'Sistema hidropônico', '2024-10-25 12:15:00'),
(42, 4, 'ENTRADA', 1.000, 'Estufa climatizada', '2024-10-20 09:00:00');

-- Movimentações de Estoque - Saídas
INSERT INTO Movimentacao_Estoque (item_id, usuario_id, tipo_movimentacao, quantidade, observacao, data_movimentacao) VALUES
(38, 4, 'SAIDA', 500.000, 'Plantio primeira leva', '2024-11-15 08:00:00'),
(39, 4, 'SAIDA', 100.000, 'Preparação solução', '2024-11-16 10:30:00'),
(40, 4, 'SAIDA', 5.000, 'Aplicação preventiva', '2024-11-20 15:45:00'),
(41, 4, 'SAIDA', 10.000, 'Instalação sistema', '2024-11-10 11:20:00');

-- Faturamento Hortaliças
INSERT INTO Faturamento_Mes (usuario_id, safra_id, mes, valor, descricao) VALUES
(4, 26, '2024-12-01', 25000.00, 'Venda alface restaurantes'),
(4, 26, '2025-01-01', 32000.50, 'Venda hortaliças supermercados'),
(4, 26, '2025-02-01', 28000.75, 'Venda hortaliças feiras');

-- ============================================
-- CONJUNTO 5: PRODUÇÃO DE CANA-DE-AÇÚCAR
-- ============================================

-- Safra de Cana-de-açúcar
INSERT INTO Safra (propriedade_id, nome, descricao, data_inicio, data_fim, area_hectare, status) VALUES
(5, 'Cana-de-açúcar 2024/25 - Renovação', 'Renovação do canavial com variedades de alta produtividade', '2024-03-01', NULL, 180.25, 'EM_ANDAMENTO');

-- Itens de Estoque para Cana-de-açúcar
INSERT INTO Item_Estoque (usuario_id, categoria_id, safra_id, nome, estoque_atual, estoque_minimo, valor_unitario, unidade_medida, validade) VALUES
(5, 1, 27, 'Mudas Cana RB867515', 15000.000, 3000.000, 0.85, 'UNIDADE', NULL),
(5, 2, 27, 'Fertilizante NPK 20-05-20', 300.000, 50.000, 88.50, 'SACA', '2026-12-31'),
(5, 3, 27, 'Herbicida 2,4-D Amine', 40.000, 8.000, 25.60, 'L', '2025-07-20'),
(5, 4, 27, 'Plantadora Cana 4 Linhas', 1.000, 1.000, 8500.00, 'UNIDADE', NULL),
(5, 5, 27, 'Diesel S10 Agrícola', 1200.000, 150.000, 4.10, 'L', NULL);

-- Movimentações de Estoque - Entradas
INSERT INTO Movimentacao_Estoque (item_id, usuario_id, tipo_movimentacao, quantidade, observacao, data_movimentacao) VALUES
(43, 5, 'ENTRADA', 18000.000, 'Mudas cana renovação', '2024-02-15 13:30:00'),
(44, 5, 'ENTRADA', 350.000, 'Adubação canavial', '2024-02-20 15:45:00'),
(45, 5, 'ENTRADA', 50.000, 'Herbicida pós-plantio', '2024-02-25 11:20:00'),
(46, 5, 'ENTRADA', 1.000, 'Plantadora cana', '2024-02-10 09:15:00'),
(47, 5, 'ENTRADA', 1500.000, 'Combustível safra', '2024-02-28 14:00:00');

-- Movimentações de Estoque - Saídas
INSERT INTO Movimentacao_Estoque (item_id, usuario_id, tipo_movimentacao, quantidade, observacao, data_movimentacao) VALUES
(43, 5, 'SAIDA', 3000.000, 'Plantio área renovação', '2024-03-01 07:30:00'),
(44, 5, 'SAIDA', 50.000, 'Adubação plantio', '2024-03-05 10:45:00'),
(45, 5, 'SAIDA', 10.000, 'Controle plantas daninhas', '2024-03-15 16:20:00'),
(47, 5, 'SAIDA', 300.000, 'Consumo plantadora', '2024-03-01 18:00:00');

-- Faturamento Cana-de-açúcar
INSERT INTO Faturamento_Mes (usuario_id, safra_id, mes, valor, descricao) VALUES
(5, 27, '2024-12-01', 180000.00, 'Venda cana usina açúcar'),
(5, 27, '2025-01-01', 195000.50, 'Venda cana usina etanol'),
(5, 27, '2025-02-01', 210000.75, 'Venda cana usina açúcar');

-- ============================================
-- ASSOCIAÇÕES SAFRA-MOVIMENTAÇÃO
-- ============================================

-- Associações para Conjunto 1 (Milho)
INSERT INTO Safra_Movimentacao_Assoc (safra_id, movimentacao_id) VALUES
(23, 24), (23, 25), (23, 26), (23, 27), (23, 28), (23, 29), (23, 30), (23, 31), (23, 32);

-- Associações para Conjunto 2 (Soja)
INSERT INTO Safra_Movimentacao_Assoc (safra_id, movimentacao_id) VALUES
(24, 33), (24, 34), (24, 35), (24, 36), (24, 37), (24, 38), (24, 39), (24, 40), (24, 41);

-- Associações para Conjunto 3 (Café)
INSERT INTO Safra_Movimentacao_Assoc (safra_id, movimentacao_id) VALUES
(25, 42), (25, 43), (25, 44), (25, 45), (25, 46), (25, 47), (25, 48), (25, 49), (25, 50);

-- Associações para Conjunto 4 (Hortaliças)
INSERT INTO Safra_Movimentacao_Assoc (safra_id, movimentacao_id) VALUES
(26, 51), (26, 52), (26, 53), (26, 54), (26, 55), (26, 56), (26, 57), (26, 58), (26, 59);

-- Associações para Conjunto 5 (Cana-de-açúcar)
INSERT INTO Safra_Movimentacao_Assoc (safra_id, movimentacao_id) VALUES
(27, 60), (27, 61), (27, 62), (27, 63), (27, 64), (27, 65), (27, 66), (27, 67), (27, 68);

-- ============================================
-- RESUMO DOS DADOS INSERIDOS
-- ============================================

/*
CONJUNTO 1 - MILHO:
- 1 Safra: Milho Safra 2024/25 (85.5 hectares)
- 5 Itens: Sementes, Fertilizante, Herbicida, Pulverizador, Diesel
- 9 Movimentações: 5 entradas + 4 saídas
- 3 Faturamentos: Total R$ 305.000,25

CONJUNTO 2 - SOJA:
- 1 Safra: Soja Verão 2024/25 (120.75 hectares)
- 5 Itens: Sementes, Superfosfato, Inseticida, Semeadora, Óleo
- 9 Movimentações: 5 entradas + 4 saídas
- 3 Faturamentos: Total R$ 595.001,25

CONJUNTO 3 - CAFÉ:
- 1 Safra: Café Arábica 2024/25 (65.8 hectares)
- 5 Itens: Mudas, Fertilizante Orgânico, Fungicida, Colheitadeira, Secador
- 9 Movimentações: 5 entradas + 4 saídas
- 3 Faturamentos: Total R$ 333.001,25

CONJUNTO 4 - HORTALIÇAS:
- 1 Safra: Hortaliças Hidropônicas 2024/25 (25.3 hectares)
- 5 Itens: Sementes, Solução Nutritiva, Fungicida Biológico, Sistema NFT, Estufa
- 9 Movimentações: 5 entradas + 4 saídas
- 3 Faturamentos: Total R$ 85.001,25

CONJUNTO 5 - CANA-DE-AÇÚCAR:
- 1 Safra: Cana-de-açúcar 2024/25 (180.25 hectares)
- 5 Itens: Mudas, Fertilizante, Herbicida, Plantadora, Diesel
- 9 Movimentações: 5 entradas + 4 saídas
- 3 Faturamentos: Total R$ 585.001,25

TOTAL GERAL:
- 5 Safras
- 25 Itens de Estoque
- 45 Movimentações (25 entradas + 20 saídas)
- 15 Faturamentos
- 45 Associações Safra-Movimentação
*/
