-- ============================================
-- MODELO FÍSICO  - SISTEMA AGRÍCOLA
-- ============================================

CREATE DATABASE sistema_agricola;
USE sistema_agricola;

-- ============================================
-- TABELAS BÁSICAS
-- ============================================

CREATE TABLE Usuario (
    id_usuario      INT UNSIGNED AUTO_INCREMENT,

    nome_produtor VARCHAR(100) NOT NULL,
    email         VARCHAR(100) UNIQUE NOT NULL,
    senha         VARCHAR(255) NOT NULL,

    PRIMARY KEY(id_usuario)
);

CREATE TABLE Propriedade (
    id_propriedade   INT UNSIGNED AUTO_INCREMENT,
    usuario_id       INT UNSIGNED NOT NULL,

    nome_propriedade VARCHAR(100) NOT NULL,
    area_total       DECIMAL(10,2) NOT NULL,
    localizacao      VARCHAR(200) NOT NULL,

    PRIMARY KEY (id_propriedade),
    FOREIGN KEY (usuario_id) REFERENCES Usuario(id_usuario)
);

-- ============================================
-- SISTEMA DE CATEGORIA
-- ============================================

CREATE TABLE Categoria (
    id_categoria INT UNSIGNED AUTO_INCREMENT,

    nome  VARCHAR(100) NOT NULL,
    ordem INT DEFAULT 0, -- Para ordenação na listagem

    PRIMARY KEY(id_categoria)
);

-- ============================================
-- SAFRA
-- ============================================

CREATE TABLE Safra (
    id_safra         INT UNSIGNED AUTO_INCREMENT,
    propriedade_id   INT UNSIGNED NOT NULL,

    nome           VARCHAR(100) NOT NULL,
    descricao      TEXT,
    data_inicio    DATE NOT NULL,
    data_fim       DATE,
    area_hectare   DECIMAL(10,2) NOT NULL,
    status         VARCHAR(20) DEFAULT 'PLANEJADA',

    PRIMARY KEY(id_safra),
    FOREIGN KEY (propriedade_id) REFERENCES Propriedade(id_propriedade)
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
    -- Coluna 'categoria' removida por ser redundante
    estoque_atual    DECIMAL(10,3) DEFAULT 0,
    estoque_minimo   DECIMAL(10,3) DEFAULT 0,
    valor_unitario   DECIMAL(10,2),
    validade         DATE,

    PRIMARY KEY (id_item),
    FOREIGN KEY (usuario_id)     REFERENCES Usuario(id_usuario),
    FOREIGN KEY (categoria_id)   REFERENCES Categoria(id_categoria),
    FOREIGN KEY (safra_id)       REFERENCES Safra(id_safra) 
);

-- ============================================
-- MOVIMENTAÇÕES DE ESTOQUE
-- ============================================

CREATE TABLE Movimentacao_Estoque (
    id_movimentacao      INT UNSIGNED AUTO_INCREMENT,
    item_id              INT UNSIGNED NOT NULL,
    usuario_id           INT UNSIGNED NOT NULL,

    tipo_movimentacao ENUM('ENTRADA', 'SAIDA') NOT NULL,
    quantidade         DECIMAL(10,3) NOT NULL,
    observacao         TEXT,
    data_movimentacao  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY(id_movimentacao),
    FOREIGN KEY (item_id)      REFERENCES Item_Estoque(id_item),
    FOREIGN KEY (usuario_id) REFERENCES Usuario(id_usuario)
);

-- ============================================
-- ASSOCIAÇÃO SAFRA COM MOVIMENTAÇÕES (n:n)
-- ============================================

CREATE TABLE Safra_Movimentacao_Assoc (
    id_associacao    INT UNSIGNED AUTO_INCREMENT,
    safra_id         INT UNSIGNED NOT NULL,
    movimentacao_id  INT UNSIGNED NOT NULL, -- Corrigido de 'bINT UNSIGNED' para 'INT UNSIGNED'

    PRIMARY KEY(id_associacao),
    FOREIGN KEY (safra_id)         REFERENCES Safra(id_safra),
    FOREIGN KEY (movimentacao_id)  REFERENCES Movimentacao_Estoque(id_movimentacao)
);

-- ============================================
-- FATURAMENTO (MANUAL PELO USUÁRIO)
-- ============================================

CREATE TABLE Faturamento_Mes (
    id_faturamento INT UNSIGNED AUTO_INCREMENT,
    usuario_id     INT UNSIGNED NOT NULL,

    mes          DATE NOT NULL,
    valor        DECIMAL(12,2) NOT NULL,
    descricao    VARCHAR(200),

    PRIMARY KEY(id_faturamento),
    FOREIGN KEY (usuario_id) REFERENCES Usuario(id_usuario)
);

-- ============================================
-- ASSOCIAÇÃO SAFRA COM FATURAMENTO (OPCIONAL)
-- ============================================

CREATE TABLE Safra_Faturamento_Assoc (
    safra_id         INT UNSIGNED,
    faturamento_id INT UNSIGNED,

    PRIMARY KEY (safra_id, faturamento_id),
    FOREIGN KEY (safra_id)         REFERENCES Safra(id_safra),
    FOREIGN KEY (faturamento_id)   REFERENCES Faturamento_Mes(id_faturamento)
);

-- ============================================
-- DADOS INICIAIS
-- ============================================

INSERT INTO Categoria (nome) VALUES
('Sementes'),
('Fertilizantes'),
('Defensivos'),
('Ferramentas'),
('Combustíveis'),
('Equipamentos'),
('Outros');