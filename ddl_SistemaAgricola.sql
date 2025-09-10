-- ============================================
-- MODELO FÍSICO  - SISTEMA AGRÍCOLA (SIMPLIFICADO)

    -- Trabalho Interdisciplinar – Banco de Dados
    -- Nome do(s) aluno(s): Erick Gustavo Costa de Souza / Gabrielly Dias da Silva / Paulo Gabriel Wisniewski Puga Silva / Cinthia Nunes dos Anjos / Gustavo Oliveira Tolentino / Gleimerson Rodrigo Santos Guimarães / Lara Vitória Almeida Ferreira
    -- Turma: 2AII
    -- Título do projeto: Sistema Agrícola
-- ======================================================================================
CREATE DATABASE sistema_agricola;
USE sistema_agricola;

-- ============================================
-- TABELAS BÁSICAS
-- ============================================

CREATE TABLE Usuario (
    id_usuario      INT UNSIGNED AUTO_INCREMENT,
    nome_produtor   VARCHAR(100) NOT NULL,
    email           VARCHAR(100) NOT NULL,
    senha           VARCHAR(255) NOT NULL,
    foto_perfil     VARCHAR(255) NOT NULL,
    
    PRIMARY KEY(id_usuario),
    CONSTRAINT uk_usuario_email UNIQUE (email),
    CONSTRAINT ck_usuario_nome CHECK (LENGTH(TRIM(nome_produtor)) > 0),
    CONSTRAINT ck_usuario_senha CHECK (LENGTH(senha) >= 8)
);

CREATE TABLE Propriedade (
    id_propriedade   INT UNSIGNED AUTO_INCREMENT,
    usuario_id       INT UNSIGNED NOT NULL,
    nome_propriedade VARCHAR(100) NOT NULL,
    area_total       DECIMAL(10,2) NOT NULL,
    localizacao      VARCHAR(200) NOT NULL,
    
    PRIMARY KEY (id_propriedade),
    CONSTRAINT fk_propriedade_usuario FOREIGN KEY (usuario_id) 
        REFERENCES Usuario(id_usuario),
    CONSTRAINT ck_propriedade_area CHECK (area_total > 0),
    CONSTRAINT ck_propriedade_nome CHECK (LENGTH(TRIM(nome_propriedade)) > 0)
);

-- ============================================
-- SISTEMA DE CATEGORIA (MOVIDO PARA CÁ)
-- ============================================

CREATE TABLE Categoria (
    id_categoria INT UNSIGNED AUTO_INCREMENT,
    nome        VARCHAR(100) NOT NULL,
    ordem       INT DEFAULT 0,
    
    PRIMARY KEY(id_categoria),
    CONSTRAINT uk_categoria_nome UNIQUE (nome),
    CONSTRAINT ck_categoria_nome CHECK (LENGTH(TRIM(nome)) > 0),
    CONSTRAINT ck_categoria_ordem CHECK (ordem >= 0)
);

-- ============================================
-- SAFRA
-- ============================================

CREATE TABLE Safra (
    id_safra       INT UNSIGNED AUTO_INCREMENT,
    propriedade_id INT UNSIGNED NOT NULL,
    nome           VARCHAR(100) NOT NULL,
    descricao      TEXT,
    data_inicio    DATE NOT NULL,
    data_fim       DATE NULL,
    area_hectare   DECIMAL(10,2) NOT NULL,
    status         ENUM('PLANEJADA', 'EM_ANDAMENTO', 'FINALIZADA', 'CANCELADA') DEFAULT 'PLANEJADA',
    
    PRIMARY KEY(id_safra),
    CONSTRAINT fk_safra_propriedade FOREIGN KEY (propriedade_id) 
        REFERENCES Propriedade(id_propriedade),
    CONSTRAINT ck_safra_area CHECK (area_hectare > 0),
    CONSTRAINT ck_safra_datas CHECK (data_fim IS NULL OR data_fim >= data_inicio),
    CONSTRAINT ck_safra_nome CHECK (LENGTH(TRIM(nome)) > 0)
);

-- ============================================
-- SISTEMA DE ESTOQUE
-- ============================================

CREATE TABLE Item_Estoque (
    id_item          INT UNSIGNED AUTO_INCREMENT,
    usuario_id       INT UNSIGNED NOT NULL,
    categoria_id     INT UNSIGNED NOT NULL,
    safra_id         INT UNSIGNED NOT NULL,
    nome             VARCHAR(100) NOT NULL,
    estoque_atual    DECIMAL(10,3) DEFAULT 0,
    estoque_minimo   DECIMAL(10,3) DEFAULT 0,
    valor_unitario   DECIMAL(10,2) NULL,
    unidade_medida   ENUM('UNIDADE', 'KG', 'L', 'M', 'SACA') NOT NULL,
    validade         DATE NULL,
    
    PRIMARY KEY(id_item),

    CONSTRAINT fk_item_usuario   FOREIGN KEY (usuario_id) 
        REFERENCES Usuario(id_usuario),

    CONSTRAINT fk_item_categoria FOREIGN KEY (categoria_id) 
        REFERENCES Categoria(id_categoria),

    CONSTRAINT fk_item_safra     FOREIGN KEY (safra_id) 
        REFERENCES Safra(id_safra),

    CONSTRAINT ck_item_estoque CHECK (estoque_atual >= 0),
    CONSTRAINT ck_item_minimo  CHECK (estoque_minimo >= 0),
    CONSTRAINT ck_item_valor   CHECK (valor_unitario IS NULL OR valor_unitario >= 0),
    CONSTRAINT ck_item_nome    CHECK (LENGTH(TRIM(nome)) > 0)
);

-- ============================================
-- MOVIMENTAÇÕES DE ESTOQUE
-- ============================================

CREATE TABLE Movimentacao_Estoque (
    id_movimentacao    INT UNSIGNED AUTO_INCREMENT,
    item_id            INT UNSIGNED NOT NULL,
    usuario_id         INT UNSIGNED NOT NULL,
    tipo_movimentacao  ENUM('ENTRADA', 'SAIDA') NOT NULL,
    quantidade         DECIMAL(10,3) NOT NULL,
    observacao         TEXT NULL,
    data_movimentacao  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    PRIMARY KEY(id_movimentacao),

    CONSTRAINT fk_mov_item       FOREIGN KEY (item_id) 
        REFERENCES Item_Estoque(id_item),

    CONSTRAINT fk_mov_usuario    FOREIGN KEY (usuario_id) 
        REFERENCES Usuario(id_usuario),

    CONSTRAINT ck_mov_quantidade CHECK (quantidade > 0)
);

-- ============================================
-- ASSOCIAÇÃO SAFRA COM MOVIMENTAÇÕES (n:n)
-- ============================================

CREATE TABLE Safra_Movimentacao_Assoc (
    id_associacao    INT UNSIGNED AUTO_INCREMENT,
    safra_id         INT UNSIGNED NOT NULL,
    movimentacao_id  INT UNSIGNED NOT NULL,
    
    PRIMARY KEY(id_associacao),

    CONSTRAINT fk_assoc_safra FOREIGN KEY (safra_id) 
        REFERENCES Safra(id_safra),

    CONSTRAINT fk_assoc_mov   FOREIGN KEY (movimentacao_id) 
        REFERENCES Movimentacao_Estoque(id_movimentacao)
);

-- ============================================
-- FATURAMENTO (MANUAL PELO USUÁRIO)
-- ============================================

CREATE TABLE Faturamento_Mes (
    id_faturamento INT UNSIGNED AUTO_INCREMENT,
    usuario_id     INT UNSIGNED NOT NULL,
    safra_id       INT UNSIGNED NOT NULL,
    mes            DATE NOT NULL,
    valor          DECIMAL(12,2) NOT NULL,
    descricao      VARCHAR(200) NULL,
    
    PRIMARY KEY(id_faturamento), 

    CONSTRAINT fk_fat_usuario FOREIGN KEY (usuario_id) 
        REFERENCES Usuario(id_usuario),

    CONSTRAINT fk_fat_safra   FOREIGN KEY (safra_id) 
        REFERENCES Safra(id_safra),

    CONSTRAINT ck_fat_valor   CHECK (valor >= 0)
);

-- ============================================
-- DADOS INICIAIS
-- ============================================

INSERT INTO Categoria (nome, ordem) VALUES
('Sementes', 1),
('Fertilizantes', 2),
('Defensivos', 3),
('Ferramentas', 4),
('Combustíveis', 5),
('Equipamentos', 6),
('Outros', 7);