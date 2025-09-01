# sistema-agricola
Claro! Vou criar um README.md detalhado e profissional para o seu projeto "Sistema Agrícola", com base na estrutura de pastas, arquivos e no modelo físico do banco de dados que você forneceu.

---

# Sistema Agrícola

Sistema web para gestão agrícola, focado no controle de propriedades, safras, estoque, faturamento e usuários. O objetivo é facilitar o gerenciamento das operações agrícolas, proporcionando uma visão clara dos recursos, movimentações e resultados financeiros.

## Sumário

- [Funcionalidades](#funcionalidades)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Estrutura do Projeto](#estrutura-do-projeto)
- [Modelagem do Banco de Dados](#modelagem-do-banco-de-dados)
- [Como Executar](#como-executar)
- [Autores](#autores)

---

## Funcionalidades

- **Gestão de Usuários:** Cadastro, autenticação e gerenciamento de produtores rurais.
- **Propriedades:** Cadastro e controle de propriedades agrícolas.
- **Safras:** Gerenciamento de safras, com informações detalhadas sobre cada ciclo produtivo.
- **Categorias:** Organização dos itens de estoque por categorias.
- **Estoque:** Controle de itens, movimentações (entrada/saída), estoque mínimo e validade.
- **Movimentações de Estoque:** Registro detalhado de todas as movimentações, associando itens, usuários e safras.
- **Faturamento:** Lançamento manual de faturamento mensal, com possibilidade de associação a safras.
- **Relatórios e Dashboard:** Visualização de dados consolidados para tomada de decisão.

---

## Tecnologias Utilizadas

- **Backend:** PHP (MVC simples)
- **Banco de Dados:** MySQL
- **Frontend:** HTML, CSS, JavaScript (básico)
- **Servidor Local:** XAMPP

---

## Estrutura do Projeto

```
sistema-agricola/
│
├── app/
│   ├── autoload.php
│   ├── config.php
│   ├── index.php
│   ├── routes.php
│   ├── controller/
│   ├── dao/
│   ├── model/
│   └── view/
│
├── modelagem/
│   ├── DER - SistemaAgricola.png
│   └── projetofisico.sql
│
├── .htaccess
└── README.md
```

- **app/controller/**: Controladores das regras de negócio.
- **app/dao/**: Objetos de acesso a dados (DAO) para cada entidade.
- **app/model/**: Modelos das entidades do sistema.
- **app/view/**: Telas do sistema (login, dashboard, estoque, etc).
- **modelagem/**: Modelagem do banco de dados (DER e script SQL).

---

## Modelagem do Banco de Dados

O sistema utiliza um banco de dados relacional com as seguintes principais tabelas:

- **Usuario:** Produtores rurais do sistema.
- **Propriedade:** Propriedades agrícolas vinculadas a usuários.
- **Categoria:** Categorias de itens de estoque.
- **Safra:** Ciclos produtivos de cada propriedade.
- **Item_Estoque:** Itens controlados no estoque.
- **Movimentacao_Estoque:** Entradas e saídas de itens.
- **Faturamento_Mes:** Lançamentos de faturamento mensal.
- **Tabelas de Associação:** Relacionam safras com movimentações e faturamento.

> Para detalhes, consulte o arquivo `modelagem/projetofisico.sql` e o DER em `modelagem/DER - SistemaAgricola.png`.

---

## Como Executar

1. **Pré-requisitos:**
   - PHP 7.4+
   - MySQL/MariaDB
   - XAMPP ou similar

2. **Configuração do Banco de Dados:**
   - Importe o arquivo `modelagem/projetofisico.sql` no seu MySQL para criar as tabelas e dados iniciais.

3. **Configuração do Projeto:**
   - Coloque a pasta do projeto em `htdocs` do XAMPP.
   - Ajuste as configurações de conexão com o banco em `app/config.php` conforme seu ambiente.

4. **Execução:**
   - Inicie o Apache e MySQL pelo XAMPP.
   - Acesse `http://localhost/sistema-agricola/app/index.php` no navegador.

---

## Autores


