-- ============================================
-- MODELO FÍSICO  - SISTEMA AGRÍCOLA
-- ============================================

CREATE DATABASE sistema_agricola;
USE sistema_agricola;

-- ============================================
-- CRIAÇÃO DAS TABELAS COM FK INLINE
-- ============================================

CREATE TABLE Usuario (
    id_usuario INT UNSIGNED AUTO_INCREMENT,
    nome_produtor VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,

    PRIMARY KEY(id_usuario)
);

CREATE TABLE Categoria (
    id_categoria INT UNSIGNED AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,

    PRIMARY KEY(id_categoria)
);

CREATE TABLE Propriedade (
    id_propriedade INT UNSIGNED AUTO_INCREMENT,
    nome_propriedade VARCHAR(100) NOT NULL,
    area_total DECIMAL(10,2) NOT NULL,
    localizacao VARCHAR(200) NOT NULL,
    fk_Usuario_id_usuario INT UNSIGNED NOT NULL,

    PRIMARY KEY(id_propriedade),
    FOREIGN KEY (fk_Usuario_id_usuario) REFERENCES Usuario(id_usuario)
);

CREATE TABLE Safra (
    id_safra INT UNSIGNED AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    data_inicio DATE NOT NULL,
    data_fim DATE,
    area_hectare DECIMAL(10,2) NOT NULL,
    status VARCHAR(20) DEFAULT 'PLANEJADA',
    fk_Propriedade_id_propriedade INT UNSIGNED NOT NULL,

    PRIMARY KEY(id_safra),
    FOREIGN KEY (fk_Propriedade_id_propriedade) REFERENCES Propriedade(id_propriedade)
);

CREATE TABLE Faturamento_Mes (
    id_faturamento INT UNSIGNED AUTO_INCREMENT,
    mes DATE NOT NULL,
    valor DECIMAL(12,2) NOT NULL,
    fk_Usuario_id_usuario INT UNSIGNED NOT NULL,

    PRIMARY KEY(id_faturamento),
    FOREIGN KEY (fk_Usuario_id_usuario) REFERENCES Usuario(id_usuario)
);

CREATE TABLE Baixa_Estoque (
    id_estoque INT UNSIGNED AUTO_INCREMENT,
    quantidade DECIMAL(10,2) NOT NULL,
    data_baixa DATE NOT NULL,

    PRIMARY KEY(id_estoque)
);

CREATE TABLE Item_Estoque (
    id_item INT UNSIGNED AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    quantidade DECIMAL(10,2) NOT NULL,
    estoque_minimo DECIMAL(10,2) DEFAULT 0,
    validade DATE,
    preco_unitario DECIMAL(10,2) NOT NULL,
    fk_Categoria_id_categoria INT UNSIGNED NOT NULL,
    fk_Baixa_Estoque_id_estoque INT UNSIGNED NOT NULL,
    
    PRIMARY KEY(id_item),
    FOREIGN KEY (fk_Categoria_id_categoria) REFERENCES Categoria(id_categoria),
    FOREIGN KEY (fk_Baixa_Estoque_id_estoque) REFERENCES Baixa_Estoque(id_estoque)
);

CREATE TABLE Safra_Faturamento_Assoc (
    fk_Safra_id_safra INT UNSIGNED,
    fk_Faturamento_Mes_id_faturamento INT UNSIGNED,

    PRIMARY KEY (fk_Safra_id_safra, fk_Faturamento_Mes_id_faturamento),
    FOREIGN KEY (fk_Safra_id_safra) REFERENCES Safra(id_safra),
    FOREIGN KEY (fk_Faturamento_Mes_id_faturamento) REFERENCES Faturamento_Mes(id_faturamento)
);

CREATE TABLE Safra_Baixa_Assoc (
    fk_Safra_id_safra INT UNSIGNED,
    fk_Baixa_Estoque_id_estoque INT UNSIGNED,

    PRIMARY KEY (fk_Safra_id_safra, fk_Baixa_Estoque_id_estoque),
    FOREIGN KEY (fk_Safra_id_safra) REFERENCES Safra(id_safra),
    FOREIGN KEY (fk_Baixa_Estoque_id_estoque) REFERENCES Baixa_Estoque(id_estoque)
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
('Outros');