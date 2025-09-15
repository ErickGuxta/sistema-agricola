-- ============================================
-- TRABALHO INTERDISCIPLINAR – BANCO DE DADOS
-- Nome do(s) aluno(s): Erick Gustavo Costa de Souza / Gabrielly Dias da Silva / Paulo Gabriel Wisniewski Puga Silva / Cinthia Nunes dos Anjos / Gustavo Oliveira Tolentino / Gleimerson Rodrigo Santos Guimarães / Lara Vitória Almeida Ferreira
-- Turma: 2AII
-- Título do projeto: Sistema Agrícola
-- ============================================

-- ============================================
-- INSERÇÕES DE DADOS
-- ============================================

-- Inserções na tabela Usuario (20+ registros)
INSERT INTO Usuario (nome_produtor, email, senha, foto_perfil) VALUES
('João Silva Santos', 'joao.silva@email.com', 'senha12345', 'perfil001.jpg'),
('Maria Oliveira Costa', 'maria.oliveira@email.com', 'minhasenha123', 'perfil002.jpg'),
('Pedro Henrique Lima', 'pedro.lima@email.com', 'pedro2024!', 'perfil003.jpg'),
('Ana Carolina Souza', 'ana.souza@email.com', 'anacaro456', 'perfil004.jpg'),
('Carlos Eduardo Ferreira', 'carlos.ferreira@email.com', 'carlos789@', 'perfil005.jpg'),
('Luciana Ribeiro Alves', 'luciana.alves@email.com', 'luciana321', 'perfil006.jpg'),
('Roberto da Silva Junior', 'roberto.junior@email.com', 'roberto999', 'perfil007.jpg'),
('Fernanda Santos Pereira', 'fernanda.pereira@email.com', 'fernanda2025', 'perfil008.jpg'),
('Marcos Antonio Lopes', 'marcos.lopes@email.com', 'marcos147*', 'perfil009.jpg'),
('Patricia Gonçalves', 'patricia.goncalves@email.com', 'patty8520', 'perfil010.jpg'),
('Ricardo Mendes Silva', 'ricardo.mendes@email.com', 'ricardo753', 'perfil011.jpg'),
('Juliana Castro Rocha', 'juliana.castro@email.com', 'juli951357', 'perfil012.jpg'),
('Anderson Barbosa Lima', 'anderson.barbosa@email.com', 'anderson456', 'perfil013.jpg'),
('Simone Cristina Santos', 'simone.santos@email.com', 'simone789@', 'perfil014.jpg'),
('Diego Fernandes Costa', 'diego.costa@email.com', 'diego2024!', 'perfil015.jpg'),
('Vanessa Almeida Silva', 'vanessa.silva@email.com', 'vanessa123', 'perfil016.jpg'),
('Thiago Rodrigues Souza', 'thiago.souza@email.com', 'thiago852', 'perfil017.jpg'),
('Camila Ferreira Santos', 'camila.santos@email.com', 'camila741', 'perfil018.jpg'),
('Bruno Henrique Oliveira', 'bruno.oliveira@email.com', 'bruno963*', 'perfil019.jpg'),
('Gabriela Lima Costa', 'gabriela.lima@email.com', 'gabi159753', 'perfil020.jpg'),
('Eduardo Santos Silva', 'eduardo.silva@email.com', 'edu357951', 'perfil021.jpg'),
('Larissa Pereira Alves', 'larissa.alves@email.com', 'lari789456', 'perfil022.jpg');

-- Inserções na tabela Propriedade (20+ registros)
INSERT INTO Propriedade (usuario_id, nome_propriedade, area_total, localizacao) VALUES
(1, 'Fazenda São João', 150.50, 'Rural de Campinas, SP'),
(2, 'Sítio Boa Vista', 75.25, 'Zona Rural de Ribeirão Preto, SP'),
(3, 'Propriedade Lima Verde', 200.00, 'Interior de Piracicaba, SP'),
(4, 'Fazenda Santa Ana', 120.75, 'Região de Araraquara, SP'),
(5, 'Rancho do Carlos', 95.50, 'Vale do Paraíba, SP'),
(6, 'Sítio das Flores', 65.80, 'Interior de Sorocaba, SP'),
(7, 'Fazenda Nova Esperança', 180.25, 'Centro-Oeste Paulista'),
(8, 'Propriedade Fernanda', 110.00, 'Região de Bauru, SP'),
(9, 'Fazenda Três Marcos', 250.75, 'Interior de Presidente Prudente, SP'),
(10, 'Sítio da Patrícia', 85.30, 'Vale do Ribeira, SP'),
(11, 'Fazenda São Ricardo', 160.90, 'Região de São José do Rio Preto, SP'),
(12, 'Propriedade Castro', 135.60, 'Interior de Franca, SP'),
(13, 'Rancho Anderson', 90.45, 'Zona Rural de Botucatu, SP'),
(14, 'Sítio Simone', 70.20, 'Região de Marília, SP'),
(15, 'Fazenda Diego Fernandes', 190.80, 'Interior de Jaú, SP'),
(16, 'Propriedade Vanessa', 105.75, 'Vale do Tietê, SP'),
(17, 'Sítio Thiago', 80.60, 'Região de Limeira, SP'),
(18, 'Fazenda Camila', 140.85, 'Interior de Ourinhos, SP'),
(19, 'Propriedade Bruno', 125.40, 'Zona Rural de Araçatuba, SP'),
(20, 'Sítio Gabriela', 95.15, 'Interior de Assis, SP'),
(21, 'Fazenda Eduardo', 175.30, 'Região de Catanduva, SP'),
(22, 'Propriedade Larissa', 115.25, 'Vale do Paranapanema, SP');

-- Inserções na tabela Safra (20+ registros)
INSERT INTO Safra (propriedade_id, nome, descricao, data_inicio, data_fim, area_hectare, status) VALUES
(1, 'Milho Safra 2024/25', 'Plantio de milho híbrido alta produtividade', '2024-10-15', '2025-03-20', 50.25, 'EM_ANDAMENTO'),
(2, 'Soja Verão 2024', 'Soja transgênica resistente a herbicida', '2024-11-01', '2025-04-15', 35.80, 'EM_ANDAMENTO'),
(3, 'Algodão 2025', 'Algodão BT para exportação', '2024-12-01', NULL, 75.50, 'PLANEJADA'),
(4, 'Feijão das Águas', 'Feijão carioca tradicional', '2024-10-20', '2025-01-30', 25.30, 'EM_ANDAMENTO'),
(5, 'Trigo Inverno 2024', 'Trigo para panificação', '2024-05-15', '2024-10-10', 45.75, 'FINALIZADA'),
(6, 'Cana-de-açúcar', 'Renovação do canavial', '2024-03-01', NULL, 60.90, 'EM_ANDAMENTO'),
(7, 'Café Arábica', 'Café especial alta qualidade', '2024-01-15', NULL, 35.60, 'EM_ANDAMENTO'),
(8, 'Sorgo Granífero', 'Sorgo para ração animal', '2024-09-10', '2025-01-25', 40.25, 'EM_ANDAMENTO'),
(9, 'Girassol 2025', 'Girassol para óleo comestível', '2025-01-20', NULL, 30.80, 'PLANEJADA'),
(10, 'Amendoim das Secas', 'Amendoim vermelho alta oleosidade', '2024-04-01', '2024-08-15', 20.50, 'FINALIZADA'),
(11, 'Mandioca Industrial', 'Mandioca para fécula', '2024-06-01', NULL, 25.75, 'EM_ANDAMENTO'),
(12, 'Tomate Rasteiro', 'Tomate para indústria', '2024-08-15', '2024-12-20', 15.60, 'FINALIZADA'),
(13, 'Batata Inglesa', 'Batata para consumo in natura', '2024-07-01', '2024-11-30', 18.90, 'FINALIZADA'),
(14, 'Cebola Roxa', 'Cebola para mercado interno', '2024-03-15', '2024-09-10', 12.25, 'FINALIZADA'),
(15, 'Alface Americana', 'Hortaliça folhosa hidropônica', '2024-11-15', NULL, 8.75, 'EM_ANDAMENTO'),
(16, 'Cenoura Baby', 'Cenoura especial premium', '2024-10-01', NULL, 10.50, 'EM_ANDAMENTO'),
(17, 'Abóbora Cabotiá', 'Abóbora orgânica certificada', '2024-09-20', NULL, 22.30, 'EM_ANDAMENTO'),
(18, 'Melancia Crimson', 'Melancia sem sementes', '2024-11-10', NULL, 28.60, 'EM_ANDAMENTO'),
(19, 'Banana Nanica', 'Banana irrigada alta produtividade', '2024-01-01', NULL, 15.80, 'EM_ANDAMENTO'),
(20, 'Laranja Pêra', 'Citros para suco concentrado', '2024-02-01', NULL, 45.90, 'EM_ANDAMENTO'),
(21, 'Uva Itália', 'Uva de mesa para exportação', '2024-08-01', NULL, 20.70, 'EM_ANDAMENTO'),
(22, 'Morango Albion', 'Morango hidropônico estufa', '2024-12-01', NULL, 5.25, 'PLANEJADA');

-- Inserções na tabela Item_Estoque (20+ registros)
INSERT INTO Item_Estoque (usuario_id, categoria_id, safra_id, nome, estoque_atual, estoque_minimo, valor_unitario, unidade_medida, validade) VALUES
(1, 1, 1, 'Sementes Milho AG1051', 25.500, 5.000, 450.00, 'SACA', '2025-08-15'),
(2, 1, 2, 'Sementes Soja TMG7262', 18.750, 3.000, 380.00, 'SACA', '2025-06-30'),
(3, 1, 3, 'Sementes Algodão FM940', 12.250, 2.500, 520.00, 'SACA', '2025-09-20'),
(4, 1, 4, 'Sementes Feijão BRS Estilo', 8.500, 1.500, 320.00, 'SACA', '2025-05-10'),
(5, 2, 5, 'Fertilizante NPK 04-14-08', 150.750, 20.000, 85.50, 'SACA', '2026-12-31'),
(6, 2, 6, 'Ureia 46% Nitrogênio', 200.250, 30.000, 95.75, 'SACA', '2027-03-15'),
(7, 2, 7, 'Superfosfato Simples', 180.500, 25.000, 72.30, 'SACA', '2026-11-20'),
(8, 2, 8, 'Cloreto de Potássio 60%', 165.125, 22.000, 88.90, 'SACA', '2027-01-10'),
(9, 3, 9, 'Herbicida Glifosato 480g/L', 45.750, 8.000, 28.50, 'L', '2025-07-25'),
(10, 3, 10, 'Inseticida Lambda 25g/L', 32.500, 5.000, 42.80, 'L', '2025-09-30'),
(11, 3, 11, 'Fungicida Tebuconazol', 28.250, 4.500, 65.20, 'L', '2025-11-15'),
(12, 3, 12, 'Acaricida Abamectina', 15.750, 2.500, 85.60, 'L', '2025-08-05'),
(13, 4, 13, 'Enxada Cabo Longo', 25.000, 5.000, 35.90, 'UNIDADE', NULL),
(14, 4, 14, 'Pá Reta Cabo Madeira', 18.000, 3.000, 28.75, 'UNIDADE', NULL),
(15, 4, 15, 'Foice Curva Aço Carbono', 12.000, 2.000, 22.40, 'UNIDADE', NULL),
(16, 4, 16, 'Rastelo 14 Dentes', 15.000, 3.000, 31.20, 'UNIDADE', NULL),
(17, 5, 17, 'Diesel S10 Agrícola', 500.750, 50.000, 4.25, 'L', NULL),
(18, 5, 18, 'Gasolina Aditivada', 250.500, 25.000, 5.80, 'L', NULL),
(19, 5, 19, 'Óleo Hidráulico AW46', 180.250, 20.000, 12.90, 'L', '2026-06-30'),
(20, 5, 20, 'Graxa Multiuso EP2', 45.500, 8.000, 15.60, 'KG', '2027-04-15'),
(21, 6, 21, 'Pulverizador 600L', 3.000, 1.000, 2850.00, 'UNIDADE', NULL),
(22, 6, 22, 'Semeadora 5 Linhas', 2.000, 1.000, 15500.00, 'UNIDADE', NULL);

-- Inserções na tabela Movimentacao_Estoque (20+ registros)
INSERT INTO Movimentacao_Estoque (item_id, usuario_id, tipo_movimentacao, quantidade, observacao, data_movimentacao) VALUES
(1, 1, 'ENTRADA', 30.000, 'Compra inicial para safra', '2024-10-01 08:30:00'),
(1, 1, 'SAIDA', 4.500, 'Plantio primeira etapa', '2024-10-15 14:15:00'),
(2, 2, 'ENTRADA', 25.000, 'Aquisição sementes soja', '2024-10-20 09:45:00'),
(2, 2, 'SAIDA', 6.250, 'Plantio área norte', '2024-11-01 07:20:00'),
(3, 3, 'ENTRADA', 15.000, 'Estoque algodão 2025', '2024-11-15 10:30:00'),
(4, 4, 'ENTRADA', 12.000, 'Sementes feijão carioca', '2024-10-10 16:45:00'),
(4, 4, 'SAIDA', 3.500, 'Plantio das águas', '2024-10-20 08:10:00'),
(5, 5, 'ENTRADA', 200.000, 'NPK para adubação', '2024-09-25 11:20:00'),
(5, 5, 'SAIDA', 49.250, 'Aplicação plantio trigo', '2024-10-05 13:40:00'),
(6, 6, 'ENTRADA', 250.000, 'Ureia cobertura', '2024-11-01 08:15:00'),
(6, 6, 'SAIDA', 49.750, 'Adubação de cobertura', '2024-12-10 09:30:00'),
(7, 7, 'ENTRADA', 220.000, 'Superfosfato plantio', '2024-08-15 14:25:00'),
(7, 7, 'SAIDA', 39.500, 'Aplicação café', '2024-09-01 10:45:00'),
(8, 8, 'ENTRADA', 200.000, 'Cloreto potássio', '2024-09-10 07:50:00'),
(8, 8, 'SAIDA', 34.875, 'Adubação sorgo', '2024-10-15 15:20:00'),
(9, 9, 'ENTRADA', 60.000, 'Glifosato dessecação', '2024-10-05 12:10:00'),
(9, 9, 'SAIDA', 14.250, 'Controle plantas daninhas', '2024-11-20 08:35:00'),
(10, 10, 'ENTRADA', 40.000, 'Lambda inseticida', '2024-09-20 16:15:00'),
(10, 10, 'SAIDA', 7.500, 'Controle lagarta', '2024-11-05 11:25:00'),
(11, 11, 'ENTRADA', 35.000, 'Tebuconazol fungicida', '2024-08-30 09:40:00'),
(11, 11, 'SAIDA', 6.750, 'Aplicação preventiva', '2024-10-25 14:55:00'),
(12, 12, 'ENTRADA', 20.000, 'Abamectina ácaros', '2024-07-15 13:30:00'),
(12, 12, 'SAIDA', 4.250, 'Controle ácaros tomate', '2024-08-20 10:15:00');

-- Inserções na tabela Safra_Movimentacao_Assoc (20+ registros)
INSERT INTO Safra_Movimentacao_Assoc (safra_id, movimentacao_id) VALUES
(1, 1), (1, 2), (2, 3), (2, 4), (3, 5), (4, 6), (4, 7), (5, 8), (5, 9),
(6, 10), (6, 11), (7, 12), (7, 13), (8, 14), (8, 15), (9, 16), (9, 17),
(10, 18), (10, 19), (11, 20), (11, 21), (12, 22), (12, 23);

-- Inserções na tabela Faturamento_Mes (20+ registros)
INSERT INTO Faturamento_Mes (usuario_id, safra_id, mes, valor, descricao) VALUES
(1, 1, '2024-11-01', 45000.00, 'Venda milho primeira etapa'),
(2, 2, '2024-12-01', 38500.50, 'Comercialização soja grão'),
(3, 3, '2024-10-01', 52000.75, 'Contrato algodão pluma'),
(4, 4, '2025-01-01', 28750.25, 'Venda feijão cooperativa'),
(5, 5, '2024-09-01', 41200.80, 'Trigo moinho regional'),
(6, 6, '2024-11-01', 67500.00, 'Cana usina açúcar'),
(7, 7, '2024-12-01', 89000.50, 'Café especial exportação'),
(8, 8, '2024-12-01', 22800.75, 'Sorgo fábrica ração'),
(9, 9, '2025-02-01', 31500.00, 'Girassol óleo comestível'),
(10, 10, '2024-07-01', 19750.25, 'Amendoim indústria'),
(11, 11, '2024-10-01', 26400.80, 'Mandioca fecularia'),
(12, 12, '2024-11-01', 35800.50, 'Tomate indústria conserva'),
(13, 13, '2024-10-01', 42300.75, 'Batata atacado ceasa'),
(14, 14, '2024-08-01', 18950.25, 'Cebola mercado local'),
(15, 15, '2024-12-01', 15600.00, 'Alface restaurantes'),
(16, 16, '2024-11-01', 21750.50, 'Cenoura supermercados'),
(17, 17, '2024-11-01', 28900.75, 'Abóbora orgânica premium'),
(18, 18, '2024-12-01', 33200.25, 'Melancia atacado regional'),
(19, 19, '2024-12-01', 48500.80, 'Banana distribuidora'),
(20, 20, '2024-11-01', 78900.50, 'Laranja indústria suco'),
(21, 21, '2024-10-01', 95600.75, 'Uva exportação mesa'),
(22, 22, '2024-12-01', 12400.25, 'Morango mercado gourmet');

-- ============================================
-- PARTE 2 - CONSULTAS SQL OBRIGATÓRIAS
-- ============================================

-- ============================================
-- 1. FILTROS E ORDENAÇÕES
-- ============================================

-- Consulta usando BETWEEN - Faturamentos entre R$ 20.000 e R$ 50.000
SELECT 
    f.id_faturamento,
    u.nome_produtor,
    s.nome AS safra_nome,
    f.valor,
    f.mes,
    f.descricao
FROM Faturamento_Mes f
INNER JOIN Usuario u ON f.usuario_id = u.id_usuario
INNER JOIN Safra s ON f.safra_id = s.id_safra
WHERE f.valor BETWEEN 20000.00 AND 50000.00
ORDER BY f.valor DESC;

-- Consulta usando LIKE - Buscar produtores cujo nome contenha 'Silva'
SELECT 
    id_usuario,
    nome_produtor,
    email
FROM Usuario 
WHERE nome_produtor LIKE '%Silva%'
ORDER BY nome_produtor ASC;

-- Consulta usando ORDER BY - Propriedades ordenadas por área (maior para menor)
SELECT 
    p.nome_propriedade,
    u.nome_produtor,
    p.area_total,
    p.localizacao
FROM Propriedade p
INNER JOIN Usuario u ON p.usuario_id = u.id_usuario
ORDER BY p.area_total DESC, p.nome_propriedade ASC;

-- Consulta usando IN - Itens de categorias específicas
SELECT 
    i.nome,
    c.nome AS categoria,
    i.estoque_atual,
    i.valor_unitario,
    i.unidade_medida
FROM Item_Estoque i
INNER JOIN Categoria c ON i.categoria_id = c.id_categoria
WHERE c.nome IN ('Sementes', 'Fertilizantes', 'Defensivos')
ORDER BY c.nome, i.nome;

-- Consulta usando NOT - Safras que NÃO estão finalizadas
SELECT 
    s.nome,
    p.nome_propriedade,
    u.nome_produtor,
    s.status,
    s.data_inicio
FROM Safra s
INNER JOIN Propriedade p ON s.propriedade_id = p.id_propriedade
INNER JOIN Usuario u ON p.usuario_id = u.id_usuario
WHERE s.status NOT IN ('FINALIZADA', 'CANCELADA')
ORDER BY s.data_inicio DESC;

-- ============================================
-- 2. FUNÇÕES AGREGADAS + GROUP BY
-- ============================================

-- COUNT - Contagem de safras por status
SELECT 
    status,
    COUNT(*) as total_safras
FROM Safra
GROUP BY status
ORDER BY total_safras DESC;

-- SUM - Total de faturamento por usuário
SELECT 
    u.nome_produtor,
    SUM(f.valor) as faturamento_total,
    COUNT(f.id_faturamento) as qtd_vendas
FROM Usuario u
INNER JOIN Faturamento_Mes f ON u.id_usuario = f.usuario_id
GROUP BY u.id_usuario, u.nome_produtor
ORDER BY faturamento_total DESC;

-- AVG - Média de área por propriedade de cada usuário
SELECT 
    u.nome_produtor,
    COUNT(p.id_propriedade) as qtd_propriedades,
    AVG(p.area_total) as area_media,
    SUM(p.area_total) as area_total
FROM Usuario u
INNER JOIN Propriedade p ON u.id_usuario = p.usuario_id
GROUP BY u.id_usuario, u.nome_produtor
HAVING COUNT(p.id_propriedade) >= 1
ORDER BY area_media DESC;

-- MAX e MIN - Maior e menor valor unitário por categoria
SELECT 
    c.nome as categoria,
    COUNT(i.id_item) as qtd_itens,
    MAX(i.valor_unitario) as maior_valor,
    MIN(i.valor_unitario) as menor_valor,
    AVG(i.valor_unitario) as valor_medio
FROM Categoria c
INNER JOIN Item_Estoque i ON c.id_categoria = i.categoria_id
WHERE i.valor_unitario IS NOT NULL
GROUP BY c.id_categoria, c.nome
ORDER BY valor_medio DESC;

-- ============================================
-- 3. JOIN (JUNÇÕES)
-- ============================================

-- INNER JOIN - Movimentações com detalhes completos
SELECT 
    m.id_movimentacao,
    u.nome_produtor,
    i.nome as item_nome,
    c.nome as categoria,
    m.tipo_movimentacao,
    m.quantidade,
    i.unidade_medida,
    m.data_movimentacao
FROM Movimentacao_Estoque m
INNER JOIN Usuario u ON m.usuario_id = u.id_usuario
INNER JOIN Item_Estoque i ON m.item_id = i.id_item
INNER JOIN Categoria c ON i.categoria_id = c.id_categoria
ORDER BY m.data_movimentacao DESC
LIMIT 20;

-- LEFT JOIN - Todos usuários com suas propriedades (mesmo sem propriedade)
SELECT 
    u.nome_produtor,
    u.email,
    p.nome_propriedade,
    p.area_total,
    p.localizacao
FROM Usuario u
LEFT JOIN Propriedade p ON u.id_usuario = p.usuario_id
ORDER BY u.nome_produtor;

-- RIGHT JOIN - Todas propriedades com seus usuários
SELECT 
    p.nome_propriedade,
    p.area_total,
    p.localizacao,
    u.nome_produtor,
    u.email
FROM Usuario u
RIGHT JOIN Propriedade p ON u.id_usuario = p.usuario_id
ORDER BY p.area_total DESC;

-- FULL OUTER JOIN (simulado com UNION) - Todos usuários e propriedades
SELECT 
    u.nome_produtor,
    p.nome_propriedade,
    p.area_total,
    'Com Propriedade' as tipo
FROM Usuario u
LEFT JOIN Propriedade p ON u.id_usuario = p.usuario_id
WHERE p.id_propriedade IS NOT NULL

UNION

SELECT 
    u.nome_produtor,
    'Sem Propriedade' as nome_propriedade,
    0.00 as area_total,
    'Sem Propriedade' as tipo
FROM Usuario u
LEFT JOIN Propriedade p ON u.id_usuario = p.usuario_id
WHERE p.id_propriedade IS NULL

ORDER BY tipo DESC, nome_produtor;

-- ============================================
-- 4. SUBCONSULTAS
-- ============================================

-- Subconsulta Escalar - Usuário com maior faturamento total
SELECT 
    u.nome_produtor,
    u.email,
    (SELECT SUM(f.valor) 
     FROM Faturamento_Mes f 
     WHERE f.usuario_id = u.id_usuario) as faturamento_total
FROM Usuario u
WHERE u.id_usuario = (
    SELECT f.usuario_id
    FROM Faturamento_Mes f
    GROUP BY f.usuario_id
    ORDER BY SUM(f.valor) DESC
    LIMIT 1
);

-- Subconsulta de Linha - Safra com maior área de um usuário específico
SELECT 
    s.nome,
    s.area_hectare,
    s.status,
    p.nome_propriedade
FROM Safra s
INNER JOIN Propriedade p ON s.propriedade_id = p.id_propriedade
WHERE (s.propriedade_id, s.area_hectare) = (
    SELECT s2.propriedade_id, MAX(s2.area_hectare)
    FROM Safra s2
    INNER JOIN Propriedade p2 ON s2.propriedade_id = p2.id_propriedade
    WHERE p2.usuario_id = 1
    GROUP BY s2.propriedade_id
    LIMIT 1
);

-- Subconsulta em Tabela (FROM) - Resumo de faturamento por categoria de produto
SELECT 
    resumo_categoria.categoria,
    resumo_categoria.total_faturamento,
    resumo_categoria.qtd_vendas,
    resumo_categoria.media_por_venda
FROM (
    SELECT 
        c.nome as categoria,
        SUM(f.valor) as total_faturamento,
        COUNT(f.id_faturamento) as qtd_vendas,
        AVG(f.valor) as media_por_venda
    FROM Faturamento_Mes f
    INNER JOIN Safra s ON f.safra_id = s.id_safra
    INNER JOIN Propriedade p ON s.propriedade_id = p.id_propriedade
    INNER JOIN Item_Estoque i ON p.usuario_id = i.usuario_id
    INNER JOIN Categoria c ON i.categoria_id = c.id_categoria
    GROUP BY c.id_categoria, c.nome
) as resumo_categoria
WHERE resumo_categoria.total_faturamento > 50000
ORDER BY resumo_categoria.total_faturamento DESC;

-- Subconsulta Correlacionada - Itens com estoque abaixo do mínimo para cada usuário
SELECT 
    u.nome_produtor,
    i.nome as item_nome,
    i.estoque_atual,
    i.estoque_minimo,
    c.nome as categoria
FROM Usuario u
INNER JOIN Item_Estoque i ON u.id_usuario = i.usuario_id
INNER JOIN Categoria c ON i.categoria_id = c.id_categoria
WHERE i.estoque_atual < i.estoque_minimo
AND EXISTS (
    SELECT 1 
    FROM Movimentacao_Estoque m 
    WHERE m.item_id = i.id_item 
    AND m.usuario_id = u.id_usuario
    AND m.data_movimentacao >= DATE_SUB(NOW(), INTERVAL 30 DAY)
)
ORDER BY u.nome_produtor, i.nome;

