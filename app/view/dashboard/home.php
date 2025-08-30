<?php
// Processar logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: /sistema-agricola/app/view/login/cadastro_user.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Agricola</title>
    <!-- <link rel="stylesheet" href="/sistema-agricola/app/view/styles/style-home.css"> -->
    <style>
        @import url('https://meyerweb.com/eric/tools/css/reset/reset.css');

        :root {
            /* sistema geral */
            --color-primary: #1e472d;
            --color-secondary: #42594C;

            /* páginas de registro */
            --color-white: #FFFFFF;
            --color-gray-primary: #D9D9D9;
            --color-gray-secondary: #262626;
            --color-black: #000000;

            /* botoes */
            --color-button-red: #BF3F4A;
            --color-button-green: #1D4D33;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--color-primary);
            min-height: 100vh;
        }

        .container {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        /* sidebar */
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


            border: 2px solid salmon;
        }

        .perfil {
            border: 1px solid #BF3F4A;

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

        .perfil .logo-subtitle {
            font-size: 14px;
            opacity: 0.8;
            text-align: center;
        }

        .nav-menu {
            display: flex;
            flex-direction: column;
            gap: 5px;

            border: 1px solid #BF3F4A;

        }

        .nav-item {
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.2s;
            text-align: center;

            border: 1px solid #bb3fbf;

        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .nav-item.active {
            background: rgba(255, 255, 255, 0.2);
        }

        .nav-item a {
            list-style: none;
            text-decoration: none;
            color: white;

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



        /* conteudo principal */
        .main-content {
            flex: 1;
            background-color: var(--color-white);
            border-radius: 20px 0 0 20px;
            padding: 30px;
            margin-left: 240px;
            min-height: 100vh;
            overflow-x: hidden;


            border: 2px solid rgb(0, 75, 136);
        }

        .header-main {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 20px;

            border: 1px solid rgb(0, 26, 255);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .farm-name {
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

        .new-safra-btn {
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
        }

        .new-safra-btn:hover {
            background: #c82333;
        }

        /* Cards de Métricas */
        .metrics-row {
            border: 1px solid rgb(0, 26, 255);

            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .metric-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            min-height: 80px;
        }

        .metric-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            flex-shrink: 0;
        }

        .metric-icon.blue {
            background: #007bff;
        }

        .metric-icon.green {
            background: #28a745;
        }

        .metric-icon.red {
            background: #dc3545;
        }

        .metric-info {
            flex: 1;
        }

        .metric-info h3 {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 4px;
            line-height: 1.2;
        }

        .metric-info p {
            font-size: 14px;
            color: #666;
        }

        /* dashboard */
        .dashboard-section {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
            margin-bottom: 30px;

            border: 2px solid salmon;

        }

        .dashboard-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            min-height: 250px;
        }

        .dashboard-illustration {
            width: 120px;
            height: 120px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><rect x="50" y="100" width="40" height="40" fill="%23deb887"/><rect x="100" y="80" width="40" height="40" fill="%23deb887"/><rect x="50" y="60" width="40" height="40" fill="%23deb887"/><circle cx="120" cy="40" r="15" fill="%23ff6b6b"/><rect x="110" y="55" width="20" height="40" fill="%23ff6b6b"/><rect x="105" y="95" width="30" height="20" fill="%234169e1"/><circle cx="115" cy="35" r="8" fill="%23fdbcb4"/><rect x="95" y="110" width="8" height="30" fill="%23666"/><rect x="135" y="110" width="8" height="30" fill="%23666"/></svg>') center/contain no-repeat;
            margin-bottom: 20px;
        }

        .dashboard-title {
            font-size: clamp(20px, 3vw, 24px);
            font-weight: bold;
            color: #333;
            letter-spacing: 2px;
            margin-bottom: 5px;
        }

        .dashboard-subtitle {
            font-size: 16px;
            color: #666;
        }

        .faturamento-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 30px;
            min-height: 250px;
        }

        .faturamento-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        .faturamento-grafico {
            height: 180px;
            background: #e9ecef;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            text-align: center;
        }

        /* Bottom Section */
        .bottom-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;

            border: 2px solid salmon;

        }

        .bottom-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 200px;
            text-align: center;
        }

        .bottom-card h3 {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 30px;
        }

        .box-icon {
            width: 60px;
            height: 60px;
            border: 3px solid #333;
            border-radius: 8px;
            position: relative;
        }

        .box-icon::before {
            content: '';
            position: absolute;
            top: -8px;
            left: 8px;
            right: -8px;
            height: 8px;
            background: #333;
            transform: skewX(-45deg);
        }

        .box-icon::after {
            content: '';
            position: absolute;
            top: -8px;
            right: -8px;
            bottom: 8px;
            width: 8px;
            background: #333;
            transform: skewY(-45deg);
        }

        /* Overlay for mobile menu */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .overlay.active {
            display: block;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .dashboard-section {
                grid-template-columns: 1fr;
            }

            .metrics-row {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .mobile-menu-toggle {
                display: block;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                border-radius: 0;
                padding: 80px 20px 20px;
            }

            .header {
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
            }

            .header-left {
                justify-content: center;
                gap: 15px;
            }

            .divider {
                display: none;
            }

            .new-safra-btn {
                align-self: center;
                padding: 15px 30px;
            }

            .metrics-row {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .metric-card {
                padding: 15px;
            }

            .dashboard-card,
            .revenue-card {
                padding: 20px;
                min-height: 200px;
            }

            .dashboard-illustration {
                width: 100px;
                height: 100px;
            }

            .bottom-section {
                grid-template-columns: 1fr;
            }

            .bottom-card {
                padding: 20px;
                min-height: 150px;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 70px 15px 15px;
            }

            .dashboard-card,
            .revenue-card,
            .bottom-card {
                padding: 15px;
            }

            .metric-card {
                padding: 12px;
                gap: 10px;
            }

            .metric-icon {
                width: 40px;
                height: 40px;
                font-size: 20px;
            }

            .metric-info h3 {
                font-size: 14px;
            }

            .metric-info p {
                font-size: 12px;
            }

            .farm-name {
                font-size: 20px;
            }

            .year-selector {
                font-size: 20px;
            }
        }

        @media (min-width: 1200px) {
            .dashboard-section {
                grid-template-columns: 1fr 2fr;
            }
        }

        /* Estilos para informações do usuário */


        .user-name {
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .logout-btn {
            display: inline-block;
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: linear-gradient(135deg,rgb(248, 104, 104),rgb(197, 63, 63));
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 107, 107, 0.4);
        }

        .logout-btn:active {
            transform: translateY(0);
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- header -->
        <header class="header-sidebar">
            <!-- perfil -->
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

                <!-- BOTÃO DE LOGOUT -->
                <div class="user-info">
                    <a href="?logout=1" class="logout-btn">Deslogar</a>
                </div>
            </nav>

            <!-- menu lateral -->
            <nav class="nav-menu">
                <div class="nav-item active">Página Inicial</div>
                <div class="nav-item"><a href="/sistema-agricola/app/safra">Safras</a></div>
                <div class="nav-item"><a href="/sistema-agricola/app/estoque">Estoque</a></div>
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
                    <h1 class="farm-name">
                    <?php
                        
                        $nomeProprie = $_SESSION['nome_propriedade'];
                        echo htmlspecialchars($nomeProprie);

                    ?>
                    </h1>
                    <div class="divider"></div>
                    <div class="year-selector">
                        2025 <span>▼</span>
                    </div>
                </div>

                <button class="new-safra-btn" onclick="openModal()">
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