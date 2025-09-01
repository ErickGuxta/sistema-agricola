<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faturamento - Sistema Agrícola</title>
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

        .info-card.success {
            background: var(--color-light-green);
        }

        .info-card.danger {
            background: var(--color-light-red);
        }

        .info-card.info {
            background: var(--color-light-orange);
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

        .success .info-card-icon {
            background: var(--color-button-green);
            color: white;
        }

        .danger .info-card-icon {
            background: var(--color-button-red);
            color: white;
        }

        .info .info-card-icon {
            background: var(--color-orange);
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

        /* Gráfico */
        .chart-section {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .chart-title {
            background: var(--color-primary);
            color: white;
            padding: 15px;
            margin: -20px -20px 20px -20px;
            border-radius: 12px 12px 0 0;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }

        .chart-container {
            height: 300px;
            position: relative;
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
        }

        #faturamentoChart {
            width: 100%;
            height: 100%;
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
                min-width: 600px;
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
                <a href="/sistema-agricola/app/estoque" class="nav-item">Estoque</a>
                <div class="nav-item active">Faturamento</div>
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
                    <h1 class="page-title">Faturamento</h1>
                    <div class="divider"></div>
                    <div class="year-selector">
                        <select id="yearSelector">
                            <option value="">Todas as Safras</option>
                            <?php if (isset($todasSafras) && is_array($todasSafras)) {
                                foreach ($todasSafras as $safra) {
                                    echo '<option value="' . htmlspecialchars($safra->id_safra) . '">' . htmlspecialchars($safra->nome) . '</option>';
                                }
                            } ?>
                        </select>
                    </div>
                </div>

                <button class="new-product-btn" onclick="openCadastroModal()">
                    + adicionar receita
                </button>
            </header>

            <!-- Cards informativos -->
            <div class="info-cards">
                <div class="info-card success">
                    <div class="info-card-icon">💰</div>
                    <div class="info-card-content">
                        <h3>Lucro</h3>
                        <p id="receitaTotal">R$ <?php echo isset($lucro) ? number_format($lucro, 2, ',', '.') : '0,00'; ?></p>
                    </div>
                </div>
                <div class="info-card danger">
                    <div class="info-card-icon">💸</div>
                    <div class="info-card-content">
                        <h3>Custos</h3>
                        <p>-R$ <?php echo isset($custoTotal) ? number_format($custoTotal, 2, ',', '.') : '0,00'; ?></p>
                    </div>
                </div>
                <div class="info-card info">
                    <div class="info-card-icon">📊</div>
                    <div class="info-card-content">
                        <h3>Faturamento Bruto</h3>
                        <p>R$ <?php echo isset($receitaTotal) ? number_format($receitaTotal, 2, ',', '.') : '0,00'; ?></p>
                    </div>
                </div>
            </div>

            <!-- Tabela de receitas -->
            <div class="table-container">
                <table class="products-table">
                    <thead>
                        <tr>
                            <th>Mês</th>
                            <th>Safra</th>
                            <th>Valor Bruto</th>
                            <th>Descrição</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($faturamentos) && is_array($faturamentos) && count($faturamentos) > 0) {
                            foreach ($faturamentos as $fat) {
                                $safraNome = '';
                                if (isset($safras) && is_array($safras)) {
                                    foreach ($safras as $safra) {
                                        if ($safra->id_safra == $fat->safra_id) {
                                            $safraNome = $safra->nome;
                                            break;
                                        }
                                    }
                                }
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($fat->mes); ?></td>
                            <td><?php echo htmlspecialchars($safraNome); ?></td>
                            <td>R$ <?php echo number_format($fat->valor, 2, ',', '.'); ?></td>
                            <td><?php echo htmlspecialchars($fat->descricao); ?></td>
                            <td class="actions">
                                <button class="action-btn" onclick="openEditModal(<?php echo $fat->id_faturamento; ?>, '<?php echo htmlspecialchars($fat->mes); ?>', '<?php echo htmlspecialchars($fat->valor); ?>', '<?php echo htmlspecialchars($fat->descricao); ?>', '<?php echo htmlspecialchars($fat->safra_id); ?>')" title="Editar">✏️</button>
                                <form method="POST" action="/sistema-agricola/app/faturamento/deletar" style="display:inline;" onsubmit="return confirm('Deseja excluir este faturamento?')">
                                    <input type="hidden" name="id_faturamento" value="<?php echo $fat->id_faturamento; ?>">
                                    <button type="submit" class="action-btn" title="Excluir">🗑️</button>
                                </form>
                            </td>
                        </tr>
                        <?php }
                        } else { ?>
                        <tr><td colspan="5">Nenhum faturamento registrado.</td></tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- Gráfico de Faturamento Mensal -->
            <div class="chart-section">
                <div class="chart-title">Faturamento Mensal</div>
                <div class="chart-container">
                    <canvas id="faturamentoChart"></canvas>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal de cadastro -->
    <div id="modal-cadastro" class="modal-overlay" onclick="closeCadastroModal()">
        <div class="modal-content" onclick="event.stopPropagation()">
            <h2 class="modal-title">Adicionar Receita</h2>
            <form class="form" method="POST" action="/sistema-agricola/app/faturamento/atualizar">
                <div class="form-group">
                    <label for="cadastro-mes">Mês</label>
                    <select id="cadastro-mes" name="mes" required>
                        <option value="">Selecione o mês</option>
                        <option value="01">Janeiro</option>
                        <option value="02">Fevereiro</option>
                        <option value="03">Março</option>
                        <option value="04">Abril</option>
                        <option value="05">Maio</option>
                        <option value="06">Junho</option>
                        <option value="07">Julho</option>
                        <option value="08">Agosto</option>
                        <option value="09">Setembro</option>
                        <option value="10">Outubro</option>
                        <option value="11">Novembro</option>
                        <option value="12">Dezembro</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="cadastro-valor">Valor (R$)</label>
                    <input type="number" id="cadastro-valor" name="valor" min="0" step="0.01" placeholder="50000.00" required>
                </div>
                <div class="form-group">
                    <label for="cadastro-descricao">Descrição</label>
                    <input type="text" id="cadastro-descricao" name="descricao" placeholder="Descrição opcional">
                </div>
                <div class="form-group">
                    <label for="cadastro-safra">Safra</label>
                    <select id="cadastro-safra" name="safra_id" required>
                        <option value="">Selecione a safra</option>
                        <?php if (isset($safras) && is_array($safras)) {
                            foreach ($safras as $safra) {
                                echo '<option value="' . htmlspecialchars($safra->id_safra) . '">' . htmlspecialchars($safra->nome) . '</option>';
                            }
                        } ?>
                    </select>
                </div>
                <button type="submit" class="submit-btn">Adicionar</button>
            </form>
        </div>
    </div>
    <!-- Modal de edição -->
    <div id="modal-editar" class="modal-overlay" onclick="closeEditModal()">
        <div class="modal-content" onclick="event.stopPropagation()">
            <h2 class="modal-title">Editar Receita</h2>
            <form class="form" method="POST" action="/sistema-agricola/app/faturamento/atualizar">
                <input type="hidden" id="edit-id-faturamento" name="id_faturamento">
                <div class="form-group">
                    <label for="edit-mes">Mês</label>
                    <select id="edit-mes" name="mes" required>
                        <option value="">Selecione o mês</option>
                        <option value="01">Janeiro</option>
                        <option value="02">Fevereiro</option>
                        <option value="03">Março</option>
                        <option value="04">Abril</option>
                        <option value="05">Maio</option>
                        <option value="06">Junho</option>
                        <option value="07">Julho</option>
                        <option value="08">Agosto</option>
                        <option value="09">Setembro</option>
                        <option value="10">Outubro</option>
                        <option value="11">Novembro</option>
                        <option value="12">Dezembro</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit-valor">Valor (R$)</label>
                    <input type="number" id="edit-valor" name="valor" min="0" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="edit-descricao">Descrição</label>
                    <input type="text" id="edit-descricao" name="descricao">
                </div>
                <div class="form-group">
                    <label for="edit-safra">Safra</label>
                    <select id="edit-safra" name="safra_id" required>
                        <option value="">Selecione a safra</option>
                        <?php if (isset($safras) && is_array($safras)) {
                            foreach ($safras as $safra) {
                                echo '<option value="' . htmlspecialchars($safra->id_safra) . '">' . htmlspecialchars($safra->nome) . '</option>';
                            }
                        } ?>
                    </select>
                </div>
                <button type="submit" class="submit-btn">Atualizar</button>
            </form>
        </div>
    </div>

    <script>
        function openCadastroModal() {
            document.getElementById("modal-cadastro").classList.add("active");
            document.body.style.overflow = "hidden";
        }
        function closeCadastroModal() {
            document.getElementById("modal-cadastro").classList.remove("active");
            document.body.style.overflow = "auto";
        }
        function openEditModal(id, mes, valor, descricao, safra_id) {
            document.getElementById("edit-id-faturamento").value = id;
            document.getElementById("edit-mes").value = mes;
            document.getElementById("edit-valor").value = valor;
            document.getElementById("edit-descricao").value = descricao;
            document.getElementById("edit-safra").value = safra_id;
            document.getElementById("modal-editar").classList.add("active");
            document.body.style.overflow = "hidden";
        }
        function closeEditModal() {
            document.getElementById("modal-editar").classList.remove("active");
            document.body.style.overflow = "auto";
        }
        document.addEventListener("keydown", function(event) {
            if (event.key === "Escape") {
                closeCadastroModal();
                closeEditModal();
            }
        });

        // Função para filtrar faturamentos por safra
        function filtrarPorSafra(safraId) {
            const url = safraId ? `/sistema-agricola/app/faturamento/buscar?safra_id=${safraId}` : `/sistema-agricola/app/faturamento/buscar`;
            
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        console.error('Erro:', data.error);
                        return;
                    }
                    
                    // Atualizar a tabela
                    atualizarTabela(data.faturamentos);
                    
                    // Atualizar o valor total
                    atualizarValorTotal(data.receitaTotal);
                })
                .catch(error => {
                    console.error('Erro ao buscar dados:', error);
                });
        }

        // Função para atualizar a tabela
        function atualizarTabela(faturamentos) {
            const tbody = document.querySelector('.products-table tbody');
            if (!tbody) return;

            let html = '';
            if (faturamentos && faturamentos.length > 0) {
                faturamentos.forEach(fat => {
                    // Buscar o nome da safra
                    const safraSelect = document.getElementById('yearSelector');
                    let safraNome = 'N/A';
                    if (fat.safra_id && safraSelect) {
                        const option = safraSelect.querySelector(`option[value="${fat.safra_id}"]`);
                        if (option) {
                            safraNome = option.textContent;
                        }
                    }
                    
                    html += `
                        <tr>
                            <td>${fat.mes}</td>
                            <td>${safraNome}</td>
                            <td>R$ ${parseFloat(fat.valor).toLocaleString('pt-BR', {minimumFractionDigits: 2})}</td>
                            <td>${fat.descricao || ''}</td>
                            <td class="actions">
                                <button class="action-btn" onclick="openEditModal(${fat.id_faturamento}, '${fat.mes}', '${fat.valor}', '${fat.descricao || ''}', '${fat.safra_id}')" title="Editar">✏️</button>
                                <form method="POST" action="/sistema-agricola/app/faturamento/deletar" style="display:inline;" onsubmit="return confirm('Deseja excluir este faturamento?')">
                                    <input type="hidden" name="id_faturamento" value="${fat.id_faturamento}">
                                    <button type="submit" class="action-btn" title="Excluir">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    `;
                });
            } else {
                html = '<tr><td colspan="5">Nenhum faturamento registrado.</td></tr>';
            }
            
            tbody.innerHTML = html;
        }

        // Função para atualizar o valor total
        function atualizarValorTotal(receitaTotal) {
            const valorElement = document.getElementById('receitaTotal');
            if (valorElement) {
                valorElement.textContent = `R$ ${parseFloat(receitaTotal).toLocaleString('pt-BR', {minimumFractionDigits: 2})}`;
            }
        }

        // Event listener para o seletor de safras
        document.addEventListener('DOMContentLoaded', function() {
            const yearSelector = document.getElementById('yearSelector');
            if (yearSelector) {
                yearSelector.addEventListener('change', function() {
                    filtrarPorSafra(this.value);
                });
            }
        });
    </script>
</body>
</html>
