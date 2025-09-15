# Pasta Scripts - Sistema Agrícola

Esta pasta contém todos os arquivos JavaScript separados dos arquivos PHP/HTML do sistema.

## Arquivos JavaScript

### Páginas Principais
- **home.js** - JavaScript para a página principal (dashboard)
- **home-chart.js** - JavaScript específico para o gráfico de faturamento na página principal
- **estoque.js** - JavaScript para a página de estoque
- **faturamento.js** - JavaScript para a página de faturamento
- **safras.js** - JavaScript para a página de safras

### Páginas de Autenticação
- **login.js** - JavaScript para a página de login
- **cadastro-user.js** - JavaScript para a página de cadastro de usuário
- **cadastro-propriedade.js** - JavaScript para a página de cadastro de propriedade

## Estrutura de Separação

### Antes
- JavaScript embutido diretamente nos arquivos PHP
- Código misturado com HTML e PHP
- Difícil manutenção e reutilização

### Depois
- JavaScript separado em arquivos dedicados
- Código organizado e modular
- Facilita manutenção e reutilização
- Melhor performance (cache dos arquivos JS)

## Variáveis PHP para JavaScript

Para manter a funcionalidade, algumas variáveis PHP são passadas para JavaScript através de objetos globais:

### home.php
```javascript
window.sessionData = {
    usuario_nome: "...",
    usuario_email: "...",
    propriedade_id: ...
};

window.propriedadesData = [...];
window.dadosGrafico = [...];
```

### faturamento.php
```javascript
window.dadosGraficoInicial = [...];
```

## Benefícios da Separação

1. **Organização**: Código mais limpo e organizado
2. **Manutenção**: Mais fácil de manter e debugar
3. **Reutilização**: JavaScript pode ser reutilizado em outras páginas
4. **Performance**: Arquivos JS podem ser cacheados pelo navegador
5. **Desenvolvimento**: Melhor experiência de desenvolvimento
6. **Debugging**: Ferramentas de debug mais eficazes

## Como Usar

Os arquivos JavaScript são carregados automaticamente nas respectivas páginas PHP através de tags `<script>`:

```html
<script src="/sistema-agricola/app/view/scripts/nome-do-arquivo.js"></script>
```

## Teste

Use o arquivo `test-references.html` para verificar se todos os arquivos JavaScript estão sendo carregados corretamente.
