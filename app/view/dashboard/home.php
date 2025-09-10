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
            cursor: pointer;
            overflow: hidden;
            transition: filter 0.2s, box-shadow 0.2s;
        }
        .perfil .logo-circle:hover {
            filter: brightness(0.7);
            box-shadow: 0 0 0 3px #1e472d44;
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

        .property-selector {
            font-size: clamp(24px, 4vw, 32px);
            font-weight: bold;
            color: #333;
            background: transparent;
            border: none;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right center;
            background-size: 16px;
            padding-right: 24px;
        }

        .property-selector:focus {
            outline: none;
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
            background: linear-gradient(135deg, rgb(248, 104, 104), rgb(197, 63, 63));
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 107, 107, 0.4);
        }

        .logout-btn:active {
            transform: translateY(0);
        }

        /* Modal styles for profile and property editing */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 0;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            background-color: var(--color-primary);
            color: white;
            padding: 20px;
            border-radius: 12px 12px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 20px;
            font-weight: bold;
            margin: 0;
        }

        .close {
            color: white;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            line-height: 1;
        }

        .close:hover {
            opacity: 0.7;
        }

        .modal-body {
            padding: 20px;
        }

        .tab-buttons {
            display: flex;
            margin-bottom: 20px;
            border-bottom: 2px solid #eee;
        }

        .tab-button {
            flex: 1;
            padding: 12px 20px;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            color: #666;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .tab-button.active {
            color: var(--color-primary);
            border-bottom-color: var(--color-primary);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .form-input {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--color-primary);
        }

        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-row .form-group {
            flex: 1;
        }

        .btn-primary {
            background-color: var(--color-primary);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: var(--color-secondary);
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            margin-top: 10px;
            width: 100%;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        @media (max-width: 768px) {
            .modal-content {
                margin: 10% auto;
                width: 95%;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
        /* Centralizar e destacar o ícone de edição da foto de perfil */
        .profile-pic-preview {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            background: #f0f0f0;
            border: 2px dashed #b2b2b2;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin-bottom: 8px;
            cursor: pointer;
            position: relative;
        }
        .profile-pic-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            border-radius: 50%;
        }
        .profile-pic-preview .edit-icon {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0,0,0,0.6);
            border-radius: 50%;
            padding: 8px;
            align-items: center;
            justify-content: center;
            z-index: 2;
            display: none;
        }
        .profile-pic-preview:hover .edit-icon {
            display: flex;
        }
    </style>

</head>

<body>
    <div class="container">
        <!-- header -->
        <header class="header-sidebar">
            <!-- perfil -->
            <nav class="perfil">
                <div class="logo-circle profile-pic-preview" onclick="openProfileModal()" style="cursor: pointer; overflow: hidden; position: relative;">
                    <?php
                        $fotoPerfil = isset($_SESSION['usuario_foto']) && $_SESSION['usuario_foto'] ? $_SESSION['usuario_foto'] : '/sistema-agricola/app/view/img/image5.png';
                    ?>
                    <img src="<?= htmlspecialchars($fotoPerfil) ?>" alt="Perfil" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;" />
                    <span class="edit-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19.5 3 21l1.5-4L16.5 3.5z"/></svg>
                    </span>
                </div>
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
                <div class="nav-item"><a href="/sistema-agricola/app/faturamento">Faturamento</a></div>
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
                    <select class="property-selector" onchange="changeProperty(this.value)">
                        <?php
                        // Buscar todas as propriedades do usuário
                        if (isset($_SESSION['usuario_id'])) {
                            $propriedadeDAO = new \app\dao\PropriedadeDAO();
                            $propriedades = $propriedadeDAO->listarPorUsuario($_SESSION['usuario_id']);
                            foreach ($propriedades as $propriedade) {
                                $selected = ($propriedade->id_propriedade == $_SESSION['propriedade_id']) ? 'selected' : '';
                                echo '<option value="' . $propriedade->id_propriedade . '" ' . $selected . '>' . htmlspecialchars($propriedade->nome_propriedade) . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <div class="divider"></div>
                    <div class="year-selector">
                        2025
                    </div>
                </div>

                <button class="new-safra-btn" onclick="openNewPropertyModal()">
                    + nova propriedade
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

        <!-- Modal for profile and property editing -->
        <div id="profileModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Editar Perfil e Propriedade</h2>
                    <span class="close" onclick="closeProfileModal()">&times;</span>
                </div>
                <div class="modal-body">
                    <div class="tab-buttons">
                        <button class="tab-button active" onclick="showTab('profile')">Perfil</button>
                        <button class="tab-button" onclick="showTab('property')">Propriedade</button>
                    </div>

                    <!-- Profile Tab -->
                    <div id="profile-tab" class="tab-content active">
                        <form id="profileForm" method="POST" action="/sistema-agricola/app/usuario/atualizar" enctype="multipart/form-data">
                            <div class="form-group" style="display: flex; flex-direction: column; align-items: center;">
                                <label class="form-label">Foto de Perfil</label>
                                <div class="profile-pic-preview" id="editProfilePicPreview">
                                    <img src="<?= htmlspecialchars(isset($_SESSION['usuario_foto']) ? $_SESSION['usuario_foto'] : '/sistema-agricola/app/view/img/image5.png') ?>" alt="Pré-visualização" id="editProfilePicImg" />
                                    <span class="edit-icon">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19.5 3 21l1.5-4L16.5 3.5z"/></svg>
                                    </span>
                                </div>
                                <input type="file" name="image" id="editProfileImage" accept="image/*" style="display: none;">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nome Completo</label>
                                <input type="text" class="form-input" id="userName" name="nome_produtor" placeholder="Digite seu nome completo" value="<?= htmlspecialchars($_SESSION['usuario_nome']) ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-input" id="userEmail" name="email" placeholder="Digite seu email" value="<?= htmlspecialchars($_SESSION['usuario_email']) ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nova Senha</label>
                                <input type="password" class="form-input" id="newPassword" name="senha" placeholder="Digite a nova senha (opcional)">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Confirmar Nova Senha</label>
                                <input type="password" class="form-input" id="confirmPassword" placeholder="Confirme a nova senha">
                            </div>
                            <button type="submit" class="btn-primary">Salvar Alterações do Perfil</button>
                        </form>
                        <div style="display: flex; flex-direction: column; align-items: center; gap: 12px; margin-top: 24px;">
                            <form id="deleteUserForm" method="POST" action="/sistema-agricola/app/usuario/deletar" onsubmit="return confirm('Tem certeza que deseja deletar sua conta? Todos os dados vinculados serão excluídos de forma permanente!');">
                                <button type="submit" class="btn-primary" style="background: #bf3f4a; border: none; width: 100%;">Deletar Conta</button>
                            </form>
                        </div>
                    </div>

                    <!-- Property Tab -->
                    <div id="property-tab" class="tab-content">
                        <form id="propertyForm">
                            <div class="form-group">
                                <label class="form-label">Nome da Propriedade</label>
                                <input type="text" class="form-input" id="propertyName" name="nome_propriedade" placeholder="Digite o nome da propriedade">
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Estado</label>
                                    <select class="form-input" id="propertyState" name="estado">
                                        <option value="">Selecione o estado</option>
                                        <option value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="AP">Amapá</option>
                                        <option value="AM">Amazonas</option>
                                        <option value="BA">Bahia</option>
                                        <option value="CE">Ceará</option>
                                        <option value="DF">Distrito Federal</option>
                                        <option value="ES">Espírito Santo</option>
                                        <option value="GO">Goiás</option>
                                        <option value="MA">Maranhão</option>
                                        <option value="MT">Mato Grosso</option>
                                        <option value="MS">Mato Grosso do Sul</option>
                                        <option value="MG">Minas Gerais</option>
                                        <option value="PA">Pará</option>
                                        <option value="PB">Paraíba</option>
                                        <option value="PR">Paraná</option>
                                        <option value="PE">Pernambuco</option>
                                        <option value="PI">Piauí</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="RN">Rio Grande do Norte</option>
                                        <option value="RS">Rio Grande do Sul</option>
                                        <option value="RO">Rondônia</option>
                                        <option value="RR">Roraima</option>
                                        <option value="SC">Santa Catarina</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="SE">Sergipe</option>
                                        <option value="TO">Tocantins</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Cidade</label>
                                    <input type="text" class="form-input" id="propertyCity" name="cidade" placeholder="Digite a cidade">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Área (hectares)</label>
                                <input type="number" class="form-input" id="propertyArea" name="area_total" placeholder="Digite a área em hectares" step="0.01" min="0">
                            </div>
                            <button type="submit" class="btn-primary">Salvar Alterações da Propriedade</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de cadastro de nova propriedade -->
        <div id="newPropertyModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Cadastrar Nova Propriedade</h2>
                    <span class="close" onclick="closeNewPropertyModal()">&times;</span>
                </div>
                <div class="modal-body">
                    <form id="newPropertyForm" method="POST" action="/sistema-agricola/app/registro-propriedade">
                        <div class="form-group">
                            <label class="form-label">Nome da Propriedade*</label>
                            <input type="text" class="form-input" id="newPropertyName" name="nome_propriedade" placeholder="Digite o nome da propriedade" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Estado*</label>
                                <select class="form-input" id="newPropertyState" name="estado" required>
                                    <option value="">Selecione o estado</option>
                                    <option value="AC">Acre</option>
                                    <option value="AL">Alagoas</option>
                                    <option value="AP">Amapá</option>
                                    <option value="AM">Amazonas</option>
                                    <option value="BA">Bahia</option>
                                    <option value="CE">Ceará</option>
                                    <option value="DF">Distrito Federal</option>
                                    <option value="ES">Espírito Santo</option>
                                    <option value="GO">Goiás</option>
                                    <option value="MA">Maranhão</option>
                                    <option value="MT">Mato Grosso</option>
                                    <option value="MS">Mato Grosso do Sul</option>
                                    <option value="MG">Minas Gerais</option>
                                    <option value="PA">Pará</option>
                                    <option value="PB">Paraíba</option>
                                    <option value="PR">Paraná</option>
                                    <option value="PE">Pernambuco</option>
                                    <option value="PI">Piauí</option>
                                    <option value="RJ">Rio de Janeiro</option>
                                    <option value="RN">Rio Grande do Norte</option>
                                    <option value="RS">Rio Grande do Sul</option>
                                    <option value="RO">Rondônia</option>
                                    <option value="RR">Roraima</option>
                                    <option value="SC">Santa Catarina</option>
                                    <option value="SP">São Paulo</option>
                                    <option value="SE">Sergipe</option>
                                    <option value="TO">Tocantins</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Cidade*</label>
                                <input type="text" class="form-input" id="newPropertyCity" name="cidade" placeholder="Digite a cidade" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Área (hectares)*</label>
                            <input type="number" class="form-input" id="newPropertyArea" name="area_total" placeholder="Digite a área em hectares" step="0.01" min="0" required>
                        </div>
                        <button type="submit" class="btn-primary">Cadastrar Propriedade</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- JavaScript for modal functionality -->
    <script>
        // Modal functions
        function openProfileModal() {
            document.getElementById('profileModal').style.display = 'block';
            // Load current data (in a real application, this would come from the server)
            loadCurrentData();
        }

        function closeProfileModal() {
            document.getElementById('profileModal').style.display = 'none';
        }

        // Tab switching
        function showTab(tabName) {
            // Hide all tabs
            const tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(tab => tab.classList.remove('active'));

            // Remove active class from all buttons
            const buttons = document.querySelectorAll('.tab-button');
            buttons.forEach(button => button.classList.remove('active'));

            // Show selected tab
            document.getElementById(tabName + '-tab').classList.add('active');

            // Add active class to clicked button
            event.target.classList.add('active');
        }

        // Load current data (placeholder function)
        function loadCurrentData() {
            // In a real application, you would fetch this data from the server
            // For now, we'll use placeholder values
            document.getElementById('userName').value = "<?= htmlspecialchars($_SESSION['usuario_nome']) ?>";
            document.getElementById('userEmail').value = "<?= htmlspecialchars($_SESSION['usuario_email']) ?>";
            // Propriedade (busca via PHP para o usuário logado)
            <?php
            $propriedade = null;
            if (isset($_SESSION['usuario_id'])) {
                $propriedadeDAO = new \app\dao\PropriedadeDAO();
                $propriedade = $propriedadeDAO->buscarPorUsuario($_SESSION['usuario_id']);
            }
            if ($propriedade) {
                $estado = '';
                $cidade = '';
                if (strpos($propriedade->localizacao, ' - ') !== false) {
                    list($estado, $cidade) = explode(' - ', $propriedade->localizacao, 2);
                }
                echo 'document.getElementById("propertyName").value = "' . htmlspecialchars($propriedade->nome_propriedade) . '";';
                echo 'document.getElementById("propertyArea").value = "' . htmlspecialchars($propriedade->area_total) . '";';
                echo 'document.getElementById("propertyState").value = "' . htmlspecialchars($estado) . '";';
                echo 'document.getElementById("propertyCity").value = "' . htmlspecialchars($cidade) . '";';
            } else {
                echo 'document.getElementById("propertyName").value = "";';
                echo 'document.getElementById("propertyArea").value = "";';
                echo 'document.getElementById("propertyState").value = "";';
                echo 'document.getElementById("propertyCity").value = "";';
            }
            ?>
        }

        // Preview da imagem de perfil no modal de edição + hover do ícone
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('editProfileImage');
            const preview = document.getElementById('editProfilePicPreview');
            const img = document.getElementById('editProfilePicImg');
            const editIcon = preview.querySelector('.edit-icon');
            preview.addEventListener('mouseenter', function() {
                editIcon.style.display = 'flex';
            });
            preview.addEventListener('mouseleave', function() {
                editIcon.style.display = 'none';
            });
            preview.addEventListener('click', function() {
                input.click();
            });
            input.addEventListener('change', function(e) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(ev) {
                        img.src = ev.target.result;
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
        // Validação de senha no modal de edição
        document.getElementById('profileForm').addEventListener('submit', function(e) {
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            if (newPassword && newPassword !== confirmPassword) {
                alert('As senhas não coincidem!');
                e.preventDefault();
                return false;
            }
        });

        document.getElementById('propertyForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const area = document.getElementById('propertyArea').value;
            if (area && area < 0) {
                alert('A área deve ser um valor positivo!');
                return;
            }

            // Here you would send the data to the server
            alert('Propriedade atualizada com sucesso!');
            closeProfileModal();
        });

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('profileModal');
            if (event.target === modal) {
                closeProfileModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeProfileModal();
            }
        });

        // Modal Nova Propriedade
        function openNewPropertyModal() {
            document.getElementById('newPropertyModal').style.display = 'block';
        }
        function closeNewPropertyModal() {
            document.getElementById('newPropertyModal').style.display = 'none';
        }
        // Fechar modal ao clicar fora
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('newPropertyModal');
            if (event.target === modal) {
                closeNewPropertyModal();
            }
        });
        // Fechar modal com ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeNewPropertyModal();
            }
        });
        // Validação simples do formulário
        document.getElementById('newPropertyForm').addEventListener('submit', function(e) {
            const area = document.getElementById('newPropertyArea').value;
            if (area && area < 0) {
                alert('A área deve ser um valor positivo!');
                e.preventDefault();
                return;
            }
        });

        // Função para trocar propriedade
        function changeProperty(propriedadeId) {
            if (propriedadeId) {
                // Criar formulário temporário para enviar POST
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/sistema-agricola/app/dashboard/setPropriedade';
                
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'propriedade_id';
                input.value = propriedadeId;
                
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>

</html>
