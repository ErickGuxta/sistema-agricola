<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Agricola</title>
    <link rel="stylesheet" href="/sistema-agricola/app/view/styles/style-home.css">
</head>
<body>
    <div class="container">
        <!-- header -->
        <header class="header-sidebar">
            <!-- perfil -->
            <nav class="perfil">
                <div class="logo-circle">🌿</div>
                <div class="logo-text">perfil</div>
                <div class="logo-subtext">Produtor Rural</div>
            </nav>

            <!-- menu lateral -->
            <nav class="nav-menu">
                <div class="nav-item active">Página Inicial</div>
                <div class="nav-item"><a href="safras.html">Safras</a></div>
                <div class="nav-item">Estoque</div>
                <div class="nav-item">Faturamento</div> 
            </nav>

            <!-- clima -->
            <div class="weather">
                <div class="weather-icon">☁️</div>
                <div>clima</div>
            </div>

        </header>

        <!-- conteudo principal -->
        <main class="main-content">
            <header class="header-main">
                <div class="header-left">
                    <h1 class="farm-name">Fazenda Silva</h1>
                    <div class="divider"></div>
                    <div class="year-selector">
                        2025 <span>▼</span>
                    </div>
                </div>
                
                <button class="new-safra-btn">
                    + nova safra
                </button>
            </header>

            <div class="metrics-row">
                <div class="metric-card">
                    <div class="metric-icon blue">💳</div>
                    <div class="metric-info">
                        <h3>Faturamento</h3>
                        <p>vs. ano anterior</p>
                    </div>
                </div>
                <div class="metric-card">
                    <div class="metric-icon green">$</div>
                    <div class="metric-info">
                        <h3>Valor em estoque</h3>
                    </div>
                </div>
                <div class="metric-card">
                    <div class="metric-icon red">✕</div>
                    <div class="metric-info">
                        <h3>Ruptura de Estoque</h3>
                    </div>
                </div>
            </div>

            <!-- dashboard -->
            <div class="dashboard-section">
                <div class="dashboard-card">
                    <div class="dashboard-illustration"></div>
                    <div class="dashboard-title">DASHBOARD</div>
                    <div class="dashboard-subtitle">Controle de Estoque</div>
                </div>
                <div class="faturamento-card">
                    <h3 class="faturamento-title">Faturamento ao longo do tempo</h3>
                    <div class="faturamento-grafico">
                        Gráfico de faturamento
                    </div>
                </div>
            </div>

            <div class="bottom-section">
                <div class="bottom-card">
                    <h3>Valor em estoque por categoria</h3>
                    <div class="box-icon"></div>
                </div>
                <div class="bottom-card">
                    <h3>Detalhamento</h3>
                    <div style="color: #999;">Detalhes do estoque</div>
                </div>
            </div>

        </main>

    </div>
</body>
    <script src="js/script.js"></script>
</html>