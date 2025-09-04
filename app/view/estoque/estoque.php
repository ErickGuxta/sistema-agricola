<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque - Sistema Agrícola (Corrigido)</title>
    <style>
        @import url("https://meyerweb.com/eric/tools/css/reset/reset.css");

        :root {
            --color-primary: #1e472d;
            --color-secondary: #42594c;
            --color-white: #ffffff;
            --color-gray-primary: #d9d9d9;
            --color-gray-secondary: #262626;
            --color-black: #000000;
            --color-button-red: #bf3f4a;
            --color-button-green: #1d4d33;
            --color-orange: #ff8c42;
            --color-light-orange: #ffe4d1;
            --color-light-red: #ffd1d6;
            --color-light-green: #d4f4dd;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--color-primary);
            min-height: 100vh;
        }

        .container {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        /* Sidebar */
        .header-sidebar {
            width: 240px;
            background-color: var(--color-primary);
            color: white;
            display: flex;
            flex-direction: column;
            gap: 30px;
            padding: 30px 20px;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 1000;
        }

        .perfil {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .perfil .logo-circle {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .perfil .logo-text {
            font-size: 24px;
            font-weight: bold;
        }

        .perfil .logo-subtext {
            font-size: 14px;
            opacity: 0.8;
            text-align: center;
        }

        .nav-menu {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .nav-item {
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.2s;
            text-align: center;
            color: white;
            text-decoration: none;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .nav-item.active {
            background: rgba(255, 255, 255, 0.2);
        }

        .weather {
            margin-top: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .weather-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Conteúdo principal */
        .main-content {
            flex: 1;
            background-color: var(--color-white);
            border-radius: 20px 0 0 20px;
            padding: 30px;
            margin-left: 240px;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .header-main {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .page-title {
            font-size: clamp(24px, 4vw, 32px);
            font-weight: bold;
            color: #333;
        }

        .year-selector {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: clamp(24px, 4vw, 32px);
            font-weight: bold;
            color: #333;
            cursor: pointer;
        }

        .year-selector select {
            font-size: clamp(18px, 3vw, 24px);
            font-weight: bold;
            color: #333;
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 5px;
            border-radius: 5px;
            transition: background 0.2s;
        }

        .year-selector select:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        .year-selector select:focus {
            outline: none;
            background: rgba(0, 0, 0, 0.1);
        }

        .divider {
            width: 2px;
            height: 40px;
            background: #ddd;
        }

        .new-product-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
            transition: background 0.2s;
        }

        .new-product-btn:hover {
            background: #c82333;
        }

        /* Cards informativos */
        .info-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-card {
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .info-card.warning {
            background: var(--color-light-orange);
        }

        .info-card.danger {
            background: var(--color-light-red);
        }

        .info-card.success {
            background: var(--color-light-green);
        }

        .info-card-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .warning .info-card-icon {
            background: var(--color-orange);
            color: white;
        }

        .danger .info-card-icon {
            background: var(--color-button-red);
            color: white;
        }

        .success .info-card-icon {
            background: var(--color-button-green);
            color: white;
        }

        .info-card-content h3 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .info-card-content p {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        /* Controles */
        .controls {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .category-select, .search-input {
            padding: 12px;
            border: 2px solid var(--color-primary);
            border-radius: 8px;
            background: var(--color-primary);
            color: white;
            font-size: 16px;
            min-width: 200px;
        }

        .category-select option {
            background: var(--color-primary);
            color: white;
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        /* Tabela */
        .table-container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
        }

        .products-table thead {
            background: var(--color-primary);
            color: white;
        }

        .products-table th,
        .products-table td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .products-table th {
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .products-table tbody tr:hover {
            background: #f8f9fa;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            transition: background 0.2s;
            font-size: 16px;
            text-decoration: none;
            color: inherit;
        }

        .action-btn:hover {
            background: #f0f0f0;
        }

        /* Modal */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 2000;
            justify-content: center;
            align-items: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-content {
            background: var(--color-gray-secondary);
            color: white;
            border-radius: 12px;
            padding: 30px;
            width: 100%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            box-sizing: border-box;
        }

        .modal-title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            color: white;
        }

        .form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            min-width: 0;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
            color: white;
            word-wrap: break-word;
            line-height: 1.2;
        }

        .form-group input,
        .form-group select {
            padding: 12px;
            border: 2px solid var(--color-primary);
            border-radius: 8px;
            background: var(--color-primary);
            color: white;
            font-size: 16px;
            min-width: 0;
            width: 100%;
            box-sizing: border-box;
        }

        .form-group input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--color-button-red);
        }

        .form-group select option {
            background: var(--color-primary);
            color: white;
        }

        .submit-btn {
            background: var(--color-button-red);
            color: white;
            border: none;
            padding: 16px 32px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
            transition: background 0.2s;
            width: 100%;
        }

        .submit-btn:hover {
            background: #a63540;
        }

        /* Botões de movimentação */
        .movement-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .movement-btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .movement-btn.entrada {
            background: var(--color-button-green);
            color: white;
        }

        .movement-btn.saida {
            background: var(--color-button-red);
            color: white;
        }

        .movement-btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .movement-btn.active {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        /* Debug info */
        .debug-info {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            font-family: monospace;
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                border-radius: 0;
                padding: 20px;
            }

            .header-sidebar {
                transform: translateX(-100%);
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .modal-content {
                padding: 20px;
                margin: 20px;
            }

            .table-container {
                overflow-x: auto;
            }

            .products-table {
                min-width: 800px;
            }

            .controls {
                flex-direction: column;
            }

            .category-select, .search-input {
                min-width: auto;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <header class="header-sidebar">
            <nav class="perfil">
                <div class="logo-circle">🌿</div>
                <div class="logo-text">
                    <?php
                        
                        $nomeCompleto = $_SESSION['usuario_nome'];
                        $primeiroNome = explode(' ', $nomeCompleto)[0];
                        echo htmlspecialchars($primeiroNome);

                    ?>
                </div>
                <div class="logo-subtext">Produtor Rural</div>
            </nav>

            <nav class="nav-menu">
                <a href="/sistema-agricola/app/dashboard" class="nav-item">Página Inicial</a>
                <a href="/sistema-agricola/app/safra" class="nav-item">Safras</a>
                <div class="nav-item active">Estoque</div>
                <a href="/sistema-agricola/app/faturamento" class="nav-item">Faturamento</a>            
            </nav>

            <div class="weather">
                <div class="weather-icon">☁️</div>
                <div>clima</div>
            </div>
        </header>

        <!-- Conteúdo principal -->
        <main class="main-content">
            <header class="header-main">
                <div class="header-left">
                    <h1 class="page-title">Estoque</h1>
                    <div class="divider"></div>
                    <div class="year-selector">
                        <form method="GET" action="/sistema-agricola/app/estoque" id="filtroSafraForm" style="display:inline;">
                            <select name="safra_id" id="yearSelector" onchange="document.getElementById('filtroSafraForm').submit()">
                                <option value="">Todas as Safras</option>
                                <?php 
                                $safraSelecionada = isset($_GET['safra_id']) ? intval($_GET['safra_id']) : '';
                                if (isset($safras) && is_array($safras)) {
                                    foreach ($safras as $safra) {
                                        $sel = ($safraSelecionada !== '' && $safraSelecionada == $safra->id_safra) ? 'selected' : '';
                                        echo '<option value="' . htmlspecialchars($safra->id_safra) . '" ' . $sel . '>' . htmlspecialchars($safra->nome) . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <!-- Mantém os outros filtros ao trocar safra -->
                            <?php if (isset($_GET['categoria'])) echo '<input type="hidden" name="categoria" value="'.htmlspecialchars($_GET['categoria']).'">'; ?>
                            <?php if (isset($_GET['busca'])) echo '<input type="hidden" name="busca" value="'.htmlspecialchars($_GET['busca']).'">'; ?>
                        </form>
                    </div>
                </div>

                <button class="new-product-btn" onclick="openCadastroModal()">
                    + cadastrar produto
                </button>
            </header>

            <!-- Debug Info -->
            <div class="debug-info" id="debug-info" style="display: none;">
                <strong>Debug - Informações do Formulário:</strong><br>
                Action: <span id="debug-action"></span><br>
                Method: <span id="debug-method"></span><br>
                Dados: <span id="debug-data"></span>
            </div>

            <!-- Cards informativos -->
            <div class="info-cards">
                <div class="info-card warning">
                    <div class="info-card-icon">⚠️</div>
                    <div class="info-card-content">
                        <h3>Alertas de Estoque Baixo</h3>
                        <p><?php echo isset($alertas_baixo) ? (int)$alertas_baixo : 0; ?></p>
                    </div>
                </div>
                <div class="info-card danger">
                    <div class="info-card-icon">⏰</div>
                    <div class="info-card-content">
                        <h3>Produtos Próximos do Vencimento</h3>
                        <p><?php echo isset($proximos_validade) ? (int)$proximos_validade : 0; ?></p>
                    </div>
                </div>
                <div class="info-card success">
                    <div class="info-card-icon">$</div>
                    <div class="info-card-content">
                        <h3>Valor Total do Estoque</h3>
                        <p>R$ <?php 
                            $valor = isset($valor_total_estoque) ? (float)$valor_total_estoque : 0;
                            echo number_format($valor, (floor($valor) == $valor ? 0 : 2), ',', '.');
                        ?></p>
                    </div>
                </div>
            </div>
            <?php if (!empty($_SESSION['erro_movimentacao'])) { ?>
            <div class="info-card danger" style="margin: 20px 0;">
                <div class="info-card-icon">⛔</div>
                <div class="info-card-content">
                    <h3><?php echo htmlspecialchars($_SESSION['erro_movimentacao']); ?></h3>
                </div>
            </div>
            <?php unset($_SESSION['erro_movimentacao']); } ?>
<?php if (!empty(
    $erro)) { ?>
    <div class="info-card danger" style="margin: 20px 0;">
        <div class="info-card-icon">⛔</div>
        <div class="info-card-content">
            <h3><?php echo $erro; ?></h3>
        </div>
    </div>
<?php } ?>
<?php if (isset(
    $propriedade) && !$propriedade) { ?>
    <div class="info-card danger" style="margin: 20px 0;">
        <div class="info-card-icon">⛔</div>
        <div class="info-card-content">
            <h3>Você precisa cadastrar uma propriedade antes de cadastrar itens no estoque.</h3>
            <a href="/sistema-agricola/app/registro-propriedade" style="color: #bf3f4a; text-decoration: underline;">Clique aqui para cadastrar propriedade</a>
        </div>
    </div>
<?php } ?>

            <!-- Controles de filtro -->
            <form method="GET" action="/sistema-agricola/app/estoque">
                <div class="controls">
                    <select class="category-select" name="categoria" onchange="this.form.submit()">
                        <option value="">Todas as Categorias</option>
                        <?php 
                        $categoriaSelecionada = isset($_GET['categoria']) ? trim($_GET['categoria']) : '';
                        if (isset($categorias) && is_array($categorias)) {
                            foreach ($categorias as $cat) {
                                $nomeCat = $cat->nome;
                                $sel = ($categoriaSelecionada !== '' && strtolower($categoriaSelecionada) === strtolower($nomeCat)) ? 'selected' : '';
                                echo '<option value="' . htmlspecialchars($nomeCat) . '" ' . $sel . '>' . htmlspecialchars($nomeCat) . '</option>';
                            }
                        }
                        ?>
                    </select>

                    <input type="text" class="search-input" name="busca" placeholder="🔍 pesquisar" value="<?php echo isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : ''; ?>" onchange="this.form.submit()">
                </div>
            </form>

            <!-- Tabela de produtos -->
            <div class="table-container">
                <table class="products-table">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Categoria</th>
                            <th>Quantidade</th>
                            <th>Estoque Mínimo</th>
                            <th>Data Validade</th>
                            <th>Preço Unitário</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
<?php if (isset($itens) && is_array($itens) && count($itens) > 0) {
    foreach ($itens as $item) { ?>
        <tr>
            <td><?php echo htmlspecialchars($item->nome); ?></td>
            <td><?php echo htmlspecialchars($item->categoria); ?></td>
            <td><?php 
                $qtd = (float)$item->estoque_atual; 
                echo htmlspecialchars( (floor($qtd)==$qtd) ? number_format($qtd,0,',','.') : number_format($qtd,2,',','.') );
            ?></td>
            <td><?php 
                $min = (float)$item->estoque_minimo; 
                echo htmlspecialchars( (floor($min)==$min) ? number_format($min,0,',','.') : number_format($min,2,',','.') );
            ?></td>
            <td><?php 
                $val = $item->validade ?? '';
                $fmt = '';
                if (!empty($val)) {
                    $dt = date_create($val);
                    if ($dt) {
                        $fmt = date_format($dt, 'd/m/Y');
                    }
                }
                echo htmlspecialchars($fmt !== '' ? $fmt : '');
            ?></td>
            <td>R$ <?php 
                $preco = (float)$item->valor_unitario; 
                echo (floor($preco)==$preco) ? number_format($preco,0,',','.') : number_format($preco,2,',','.'); 
            ?></td>
            <td class="actions">
                <button class="action-btn" onclick="openEditModal(<?php echo $item->id_item; ?>, '<?php echo htmlspecialchars($item->nome); ?>', '<?php echo htmlspecialchars($item->categoria); ?>', '<?php echo $item->estoque_atual; ?>', '<?php echo $item->estoque_minimo; ?>', '<?php echo $item->valor_unitario; ?>', '<?php echo $item->validade; ?>')" title="Editar">✏️</button>
                <button class="action-btn" onclick="openMovementModal(<?php echo $item->id_item; ?>, '<?php echo htmlspecialchars($item->nome); ?>', '<?php echo $item->estoque_atual; ?>')" title="Movimentar">📦</button>
                <form method="POST" action="/sistema-agricola/app/estoque/deletar" style="display:inline;" onsubmit="return confirm('Deseja excluir este produto?')">
                    <input type="hidden" name="id" value="<?php echo $item->id_item; ?>">
                    <button type="submit" class="action-btn" title="Excluir">🗑️</button>
                </form>
            </td>
        </tr>
<?php }
} else { ?>
    <tr><td colspan="7">Nenhum item encontrado.</td></tr>
<?php } ?>
</tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Modal de cadastro/edição -->
    <div id="modal-overlay" class="modal-overlay" onclick="closeModal()">
        <div class="modal-content" onclick="event.stopPropagation()">
            <h2 class="modal-title" id="modal-title">Cadastrar Produto</h2>

            <form class="form" method="POST" action="/sistema-agricola/app/estoque" id="product-form">
                
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" placeholder="Sementes de Milho" required <?php if (isset($propriedade) && !$propriedade) echo 'disabled'; ?>>
                </div>

                <div class="form-group">
                    <label for="categoria">Categoria</label>
                    <select id="categoria" name="categoria" required <?php if (isset($propriedade) && !$propriedade) echo 'disabled'; ?>>
                        <option value="">Selecione a categoria</option>
                        <?php if (isset($categorias) && is_array($categorias)) {
                            foreach ($categorias as $cat) {
                                echo '<option value="' . htmlspecialchars($cat->nome) . '">' . htmlspecialchars($cat->nome) . '</option>';
                            }
                        } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="safra_id">Safra</label>
                    <select id="safra_id" name="safra_id" required <?php if (isset($propriedade) && !$propriedade) echo 'disabled'; ?>>
                        <option value="">Selecione a safra</option>
                        <?php if (isset($safras) && is_array($safras)) {
                            foreach ($safras as $safra) {
                                echo '<option value="' . htmlspecialchars($safra->id_safra) . '">' . htmlspecialchars($safra->nome) . '</option>';
                            }
                        } ?>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="quantidade">Quantidade Atual</label>
                        <input type="number" id="quantidade" name="estoque_atual" min="0" step="0.01" placeholder="120" required <?php if (isset($propriedade) && !$propriedade) echo 'disabled'; ?>>
                    </div>
                    <div class="form-group">
                        <label for="estoque-minimo">Estoque Mínimo ⚠️</label>
                        <input type="number" id="estoque-minimo" name="estoque_minimo" min="0" step="0.01" placeholder="50" required <?php if (isset($propriedade) && !$propriedade) echo 'disabled'; ?>>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="preco">Preço Unitário</label>
                        <input type="number" id="preco" name="valor_unitario" min="0" step="0.01" placeholder="7.50" required <?php if (isset($propriedade) && !$propriedade) echo 'disabled'; ?>>
                    </div>
                    <div class="form-group">
                        <label for="data-validade">Data de Validade</label>
                        <input type="date" id="data-validade" name="validade" <?php if (isset($propriedade) && !$propriedade) echo 'disabled'; ?>>
                    </div>
                </div>

                <button type="submit" class="submit-btn" id="submit-btn" <?php if (isset($propriedade) && !$propriedade) echo 'disabled'; ?>>Cadastrar</button>
            </form>
        </div>
    </div>

    <!-- Modal de edição -->
    <div id="edit-modal-overlay" class="modal-overlay" onclick="closeEditModal()">
        <div class="modal-content" onclick="event.stopPropagation()">
            <h2 class="modal-title">Editar Produto</h2>

            <form class="form" method="POST" action="/sistema-agricola/app/estoque/atualizar" id="edit-form">
                <input type="hidden" id="edit-product-id" name="id" value="">
                
                <div class="form-group">
                    <label for="edit-nome">Nome</label>
                    <input type="text" id="edit-nome" name="nome" placeholder="Sementes de Milho" required>
                </div>

                <div class="form-group">
                    <label for="edit-categoria">Categoria</label>
                    <select id="edit-categoria" name="categoria" required>
                        <option value="">Selecione a categoria</option>
                        <?php if (isset($categorias) && is_array($categorias)) {
                            foreach ($categorias as $cat) {
                                echo '<option value="' . htmlspecialchars($cat->nome) . '">' . htmlspecialchars($cat->nome) . '</option>';
                            }
                        } ?>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="edit-quantidade">Quantidade Atual</label>
                        <input type="number" id="edit-quantidade" name="estoque_atual" min="0" step="0.01" placeholder="120" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-estoque-minimo">Estoque Mínimo ⚠️</label>
                        <input type="number" id="edit-estoque-minimo" name="estoque_minimo" min="0" step="0.01" placeholder="50" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="edit-preco">Preço Unitário</label>
                        <input type="number" id="edit-preco" name="valor_unitario" min="0" step="0.01" placeholder="7.50" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-data-validade">Data de Validade</label>
                        <input type="date" id="edit-data-validade" name="validade">
                    </div>
                </div>

                <button type="submit" class="submit-btn">Atualizar</button>
            </form>
        </div>
    </div>

    <!-- Modal de movimentação -->
    <div id="movement-modal-overlay" class="modal-overlay" onclick="closeMovementModal()">
        <div class="modal-content" onclick="event.stopPropagation()">
            <h2 class="modal-title">Movimentar Estoque</h2>

            <form class="form" method="POST" action="/sistema-agricola/app/estoque/movimentacao" id="movement-form">
                <input type="hidden" id="movement-product-id" name="produto_id">
                <input type="hidden" id="movement-type" name="tipo">
                
                <div class="form-group">
                    <label>Produto</label>
                    <input type="text" id="movement-product-name" readonly>
                </div>

                <div class="form-group">
                    <label>Quantidade Atual</label>
                    <input type="text" id="movement-current-quantity" readonly>
                </div>

                <div class="movement-buttons">
                    <button type="button" class="movement-btn entrada" onclick="selectMovementType('entrada')">
                        ⬆️ ENTRADA
                    </button>
                    <button type="button" class="movement-btn saida" onclick="selectMovementType('saida')">
                        ⬇️ SAÍDA
                    </button>
                </div>

                <div class="form-group">
                    <label for="movement-quantity">Quantidade</label>
                    <input type="number" id="movement-quantity" name="quantidade" min="0.01" step="0.01" placeholder="Digite a quantidade" required>
                </div>

                <div class="form-group">
                    <label for="movement-reason">Motivo</label>
                    <input type="text" id="movement-reason" name="motivo" placeholder="Ex: Compra, Venda, Perda, Ajuste" required>
                </div>

                <button type="submit" class="submit-btn" id="movement-submit-btn" disabled>Processar Movimentação</button>
            </form>
        </div>
    </div>

    <script>
        let currentMovementType = null;

        // Abrir modal de cadastro
        function openCadastroModal() {
            const modal = document.getElementById("modal-overlay");
            modal.classList.add("active");
            document.body.style.overflow = "hidden";
        }

        // Abrir modal de edição
        function openEditModal(id, nome, categoria, quantidade, estoque_minimo, preco, data_validade) {
            // Preencher os campos
            document.getElementById("edit-product-id").value = id;
            document.getElementById("edit-nome").value = nome;
            document.getElementById("edit-categoria").value = categoria;
            document.getElementById("edit-quantidade").value = quantidade;
            document.getElementById("edit-estoque-minimo").value = estoque_minimo;
            document.getElementById("edit-preco").value = preco;
            document.getElementById("edit-data-validade").value = data_validade;
            
            // Abrir modal
            const modal = document.getElementById("edit-modal-overlay");
            modal.classList.add("active");
            document.body.style.overflow = "hidden";
        }

        // Fechar modal de cadastro
        function closeModal() {
            const modal = document.getElementById("modal-overlay");
            modal.classList.remove("active");
            document.body.style.overflow = "auto";
            
            // Limpar formulário
            document.getElementById("product-form").reset();
        }

        // Fechar modal de edição
        function closeEditModal() {
            const modal = document.getElementById("edit-modal-overlay");
            modal.classList.remove("active");
            document.body.style.overflow = "auto";
        }

        // Abrir modal de movimentação
        function openMovementModal(productId, productName = '', currentQuantity = '') {
            document.getElementById("movement-product-id").value = productId;
            document.getElementById("movement-product-name").value = productName;
            document.getElementById("movement-current-quantity").value = currentQuantity;
            
            // Reset form
            document.getElementById("movement-form").reset();
            document.getElementById("movement-product-id").value = productId;
            document.getElementById("movement-product-name").value = productName;
            document.getElementById("movement-current-quantity").value = currentQuantity;
            
            // Reset buttons
            document.querySelectorAll('.movement-btn').forEach(btn => btn.classList.remove('active'));
            document.getElementById("movement-submit-btn").disabled = true;
            currentMovementType = null;

            const modal = document.getElementById("movement-modal-overlay");
            modal.classList.add("active");
            document.body.style.overflow = "hidden";
        }

        // Fechar modal de movimentação
        function closeMovementModal() {
            const modal = document.getElementById("movement-modal-overlay");
            modal.classList.remove("active");
            document.body.style.overflow = "auto";
        }

        // Selecionar tipo de movimentação
        function selectMovementType(type) {
            currentMovementType = type;
            document.getElementById("movement-type").value = type;
            
            // Update button states
            document.querySelectorAll('.movement-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelector(`.movement-btn.${type}`).classList.add('active');
            
            // Enable submit button
            document.getElementById("movement-submit-btn").disabled = false;
            document.getElementById("movement-submit-btn").textContent = 
                type === 'entrada' ? 'Processar Entrada' : 'Processar Saída';
        }

        // Fechar modals com ESC
        document.addEventListener("keydown", function(event) {
            if (event.key === "Escape") {
                closeModal();
                closeEditModal();
                closeMovementModal();
            }
        });
    </script>
</body>
</html>