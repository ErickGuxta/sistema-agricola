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
                <div class="logo-text">perfil</div>
                <div class="logo-subtext">Produtor Rural</div>
            </nav>

            <nav class="nav-menu">
                <div class="nav-item">Página Inicial</div>
                <div class="nav-item">Safras</div>
                <div class="nav-item">Estoque</div>
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
                        Milho 2025 <span>▼</span>
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
                        <h3>Faturamento total</h3>
                        <p>R$ 150.000,00</p>
                    </div>
                </div>
                <div class="info-card danger">
                    <div class="info-card-icon">💸</div>
                    <div class="info-card-content">
                        <h3>Custos</h3>
                        <p>-R$ 50.000,00</p>
                    </div>
                </div>
            </div>

            <!-- Tabela de receitas -->
            <div class="table-container">
                <table class="products-table">
                    <thead>
                        <tr>
                            <th>Receitas registradas</th>
                            <th>Valor Bruto</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Abril</td>
                            <td>R$ 80.000,00</td>
                            <td class="actions">
                                <button class="action-btn" onclick="editReceita('Abril', '80000')" title="Editar">✏️</button>
                                <button class="action-btn" onclick="deleteReceita('Abril')" title="Excluir">🗑️</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Maio</td>
                            <td>R$ 50.000,00</td>
                            <td class="actions">
                                <button class="action-btn" onclick="editReceita('Maio', '50000')" title="Editar">✏️</button>
                                <button class="action-btn" onclick="deleteReceita('Maio')" title="Excluir">🗑️</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Junho</td>
                            <td>R$ 100.000,00</td>
                            <td class="actions">
                                <button class="action-btn" onclick="editReceita('Junho', '100000')" title="Editar">✏️</button>
                                <button class="action-btn" onclick="deleteReceita('Junho')" title="Excluir">🗑️</button>
                            </td>
                        </tr>
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

    <!-- Modal de cadastro/edição -->
    <div id="modal-overlay" class="modal-overlay" onclick="closeModal()">
        <div class="modal-content" onclick="event.stopPropagation()">
            <h2 class="modal-title" id="modal-title">Adicionar Receita</h2>

            <form class="form" id="receita-form" onsubmit="handleSubmit(event)">
                <div class="form-group">
                    <label for="mes">Mês</label>
                    <select id="mes" name="mes" required>
                        <option value="">Selecione o mês</option>
                        <option value="Janeiro">Janeiro</option>
                        <option value="Fevereiro">Fevereiro</option>
                        <option value="Março">Março</option>
                        <option value="Abril">Abril</option>
                        <option value="Maio">Maio</option>
                        <option value="Junho">Junho</option>
                        <option value="Julho">Julho</option>
                        <option value="Agosto">Agosto</option>
                        <option value="Setembro">Setembro</option>
                        <option value="Outubro">Outubro</option>
                        <option value="Novembro">Novembro</option>
                        <option value="Dezembro">Dezembro</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="valor">Valor (R$)</label>
                    <input type="number" id="valor" name="valor" min="0" step="0.01" placeholder="50000.00" required>
                </div>

                <button type="submit" class="submit-btn" id="submit-btn">Adicionar</button>
            </form>
        </div>
    </div>

    <script>
        // // Dados do gráfico
        // const chartData = {
        //     labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai'],
        //     values: [10000, 15000, 25000, 30000, 35000]
        // };

        // // Desenhar gráfico
        // function drawChart() {
        //     const canvas = document.getElementById('faturamentoChart');
        //     const ctx = canvas.getContext('2d');
            
        //     // Configurar canvas
        //     canvas.width = canvas.offsetWidth;
        //     canvas.height = canvas.offsetHeight;
            
        //     const width = canvas.width;
        //     const height = canvas.height;
        //     const padding = 60;
            
        //     // Limpar canvas
        //     ctx.clearRect(0, 0, width, height);
            
        //     // Configurações do gráfico
        //     const chartWidth = width - 2 * padding;
        //     const chartHeight = height - 2 * padding;
        //     const maxValue = Math.max(...chartData.values);
        //     const minValue = 0;
        //     const valueRange = maxValue - minValue;
            
        //     // Desenhar eixos
        //     ctx.strokeStyle = '#333';
        //     ctx.lineWidth = 2;
        //     ctx.beginPath();
        //     ctx.moveTo(padding, padding);
        //     ctx.lineTo(padding, height - padding);
        //     ctx.lineTo(width - padding, height - padding);
        //     ctx.stroke();
            
        //     // Desenhar labels do eixo Y
        //     ctx.fillStyle = '#666';
        //     ctx.font = '12px Arial';
        //     ctx.textAlign = 'right';
        //     for (let i = 0; i <= 7; i++) {
        //         const value = (maxValue / 7) * i;
        //         const y = height - padding - (chartHeight / 7) * i;
        //         ctx.fillText(`R$ ${(value / 1000).toFixed(0)}.000`, padding - 10, y + 4);
                
        //         // Linhas de grade
        //         if (i > 0) {
        //             ctx.strokeStyle = '#eee';
        //             ctx.lineWidth = 1;
        //             ctx.beginPath();
        //             ctx.moveTo(padding, y);
        //             ctx.lineTo(width - padding, y);
        //             ctx.stroke();
        //         }
        //     }
            
        //     // Desenhar labels do eixo X
        //     ctx.textAlign = 'center';
        //     chartData.labels.forEach((label, index) => {
        //         const x = padding + (chartWidth / (chartData.labels.length - 1)) * index;
        //         ctx.fillText(label, x, height - padding + 20);
        //     });
            
        //     // Desenhar linha do gráfico
        //     ctx.strokeStyle = '#1e472d';
        //     ctx.lineWidth = 3;
        //     ctx.beginPath();
            
        //     chartData.values.forEach((value, index) => {
        //         const x = padding + (chartWidth / (chartData.labels.length - 1)) * index;
        //         const y = height - padding - ((value - minValue) / valueRange) * chartHeight;
                
        //         if (index === 0) {
        //             ctx.moveTo(x, y);
        //         } else {
        //             ctx.lineTo(x, y);
        //         }
                
        //         // Desenhar pontos
        //         ctx.fillStyle = '#1e472d';
        //         ctx.beginPath();
        //         ctx.arc(x, y, 4, 0, 2 * Math.PI);
        //         ctx.fill();
        //     });
            
        //     ctx.stroke();
            
        //     // Preencher área sob a curva
        //     ctx.fillStyle = 'rgba(30, 71, 45, 0.1)';
        //     ctx.beginPath();
        //     ctx.moveTo(padding, height - padding);
        //     chartData.values.forEach((value, index) => {
        //         const x = padding + (chartWidth / (chartData.labels.length - 1)) * index;
        //         const y = height - padding - ((value - minValue) / valueRange) * chartHeight;
        //         ctx.lineTo(x, y);
        //     });
        //     ctx.lineTo(width - padding, height - padding);
        //     ctx.closePath();
        //     ctx.fill();
        // }

        // Abrir modal de cadastro
        function openCadastroModal() {
            const modal = document.getElementById("modal-overlay");
            modal.classList.add("active");
            document.body.style.overflow = "hidden";
            document.getElementById("modal-title").textContent = "Adicionar Receita";
            document.getElementById("submit-btn").textContent = "Adicionar";
            document.getElementById("receita-form").reset();
        }

        // Editar receita
        function editReceita(mes, valor) {
            const modal = document.getElementById("modal-overlay");
            modal.classList.add("active");
            document.body.style.overflow = "hidden";
            document.getElementById("modal-title").textContent = "Editar Receita";
            document.getElementById("submit-btn").textContent = "Atualizar";
            document.getElementById("mes").value = mes;
            document.getElementById("valor").value = valor;
        }

        // Deletar receita
        function deleteReceita(mes) {
            if (confirm(`Deseja excluir a receita de ${mes}?`)) {
                alert(`Receita de ${mes} excluída com sucesso!`);
            }
        }

        // Fechar modal
        function closeModal() {
            const modal = document.getElementById("modal-overlay");
            modal.classList.remove("active");
            document.body.style.overflow = "auto";
            document.getElementById("receita-form").reset();
        }

        // Handle form submission
        function handleSubmit(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            const mes = formData.get('mes');
            const valor = parseFloat(formData.get('valor'));
            
            alert(`Receita de ${mes} no valor de R$ ${valor.toLocaleString('pt-BR', {minimumFractionDigits: 2})} salva com sucesso!`);
            closeModal();
        }

        // Fechar modal com ESC
        document.addEventListener("keydown", function(event) {
            if (event.key === "Escape") {
                closeModal();
            }
        });

        // Inicializar gráfico quando a página carregar
        window.addEventListener('load', drawChart);
        window.addEventListener('resize', drawChart);
    </script>
</body>
</html>
