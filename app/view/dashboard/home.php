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
            background: rgba(0, 0, 0, 0.6);
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

        /* Classes para limpeza de estilos inline */
        .logo-circle {
            cursor: pointer;
            overflow: hidden;
            position: relative;
        }

        .logo-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .variacao-positiva {
            color: #28a745;
        }

        .variacao-negativa {
            color: #dc3545;
        }

        .info-text {
            color: #666;
        }

        .chart-canvas {
            max-height: 180px;
        }

        .chart-no-data {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: #999;
        }

        .scrollable-container {
            width: 100%;
            max-height: 200px;
            overflow-y: auto;
        }

        .category-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .text-right {
            text-align: right;
        }

        .no-data-message {
            color: #999;
            text-align: center;
            padding: 20px;
        }

        .safra-item {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .safra-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .safra-success {
            color: #28a745;
        }

        .movimentacoes-container {
            margin-top: 20px;
        }

        .movimentacoes-scroll {
            max-height: 250px;
            overflow-y: auto;
        }

        .movimentacao-item {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .movimentacao-content {
            flex: 1;
        }

        .movimentacao-header {
            margin-bottom: 4px;
        }

        .movimentacao-badge {
            padding: 2px 6px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 500;
        }

        .badge-entrada {
            background: #d4edda;
            color: #155724;
        }

        .badge-saida {
            background: #fff3cd;
            color: #856404;
        }

        .movimentacao-date {
            color: #666;
            font-size: 11px;
            margin-left: 8px;
        }

        .movimentacao-details {
            color: #666;
        }

        .movimentacao-observacao {
            color: #666;
            font-style: italic;
        }

        .movimentacao-quantidade {
            font-weight: bold;
        }

        .quantidade-entrada {
            color: #28a745;
        }

        .quantidade-saida {
            color: #dc3545;
        }

        .movimentacao-valor {
            color: #1e472d;
            font-weight: 500;
        }

        .historico-container {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
            border-left: 4px solid #1e472d;
        }

        .historico-title {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 15px;
            color: #1e472d;
        }

        .historico-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .historico-card {
            border-radius: 8px;
            padding: 15px;
            text-align: center;
        }

        .card-entradas {
            background: #e8f5e8;
        }

        .card-saidas {
            background: #fff3cd;
        }

        .card-lucro {
            background: #d1ecf1;
        }

        .card-total {
            background: #f8d7da;
        }

        .historico-number {
            font-size: 24px;
            font-weight: bold;
        }

        .historico-label {
            font-size: 12px;
            color: #666;
        }

        .number-entradas {
            color: #28a745;
        }

        .number-saidas {
            color: #856404;
        }

        .number-lucro {
            color: #0c5460;
        }

        .number-total {
            color: #721c24;
        }

        .table-overflow {
            overflow-x: auto;
        }

        .historico-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .historico-table thead tr {
            background: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }

        .historico-table th {
            padding: 12px;
            text-align: left;
            font-size: 13px;
            color: #495057;
            font-weight: 600;
        }

        .historico-table th:nth-child(2),
        .historico-table th:nth-child(3),
        .historico-table th:nth-child(4) {
            text-align: center;
        }

        .historico-table tbody tr {
            border-bottom: 1px solid #dee2e6;
        }

        .historico-table td {
            padding: 10px;
            font-size: 13px;
        }

        .historico-table td:first-child {
            color: #1e472d;
            font-weight: 500;
        }

        .historico-table td:nth-child(2),
        .historico-table td:nth-child(3),
        .historico-table td:nth-child(4) {
            text-align: center;
            font-weight: 500;
        }

        .historico-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }

        .empty-state {
            color: #999;
            text-align: center;
            padding: 40px;
        }

        .empty-state-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .form-group-center {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .hidden-input {
            display: none;
        }

        .button-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            margin-top: 24px;
        }

        .btn-delete {
            background: #bf3f4a;
            border: none;
            width: 100%;
        }
    </style>

</head>

<body>
    <div class="container">
        <!-- header -->
        <header class="header-sidebar">
            <!-- perfil -->
            <nav class="perfil">
                <div class="logo-circle profile-pic-preview" onclick="openProfileModal()">
                    <?php
                    $fotoPerfil = isset($_SESSION['usuario_foto']) && $_SESSION['usuario_foto'] ? $_SESSION['usuario_foto'] : '/sistema-agricola/app/view/img/image5.png';
                    ?>
                    <img src="<?= htmlspecialchars($fotoPerfil) ?>" alt="Perfil" />
                    <span class="edit-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 20h9" />
                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19.5 3 21l1.5-4L16.5 3.5z" />
                        </svg>
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
                            $propriedades   = $propriedadeDAO->listarPorUsuario($_SESSION['usuario_id']);
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

            <!-- CARDS PRINCIPAIS COM DADOS REAIS -->
            <div class="metrics-row">
                <div class="metric-card">
                    <div class="metric-icon blue">💰</div>
                    <div class="metric-info">
                        <h3>R$ <?= number_format($resumoCards['faturamento_atual'] ?? 0, 2, ',', '.') ?></h3>
                        <p>
                            <?php
                            $faturamentoAtual    = $resumoCards['faturamento_atual']    ?? 0;
                            $faturamentoAnterior = $resumoCards['faturamento_anterior'] ?? 0;
                            if ($faturamentoAnterior > 0) {
                                $variacao = (($faturamentoAtual - $faturamentoAnterior) / $faturamentoAnterior) * 100;
                                $sinal = $variacao >= 0 ? '+' : '';
                                $cor = $variacao >= 0 ? '#28a745' : '#dc3545';
                                echo '<span class="' . ($variacao >= 0 ? 'variacao-positiva' : 'variacao-negativa') . '">' . $sinal . number_format($variacao, 1) . '%</span> vs. ano anterior';
                            } else {
                                echo 'Faturamento do ano';
                            }
                            ?>
                        </p>
                    </div>
                </div>
                <div class="metric-card">
                    <div class="metric-icon green">📦</div>
                    <div class="metric-info">
                        <h3>R$ <?= number_format($resumoCards['valor_estoque_total'] ?? 0, 2, ',', '.') ?></h3>
                        <p>Valor em estoque</p>
                    </div>
                </div>
                <div class="metric-card">
                    <div class="metric-icon blue">🌱</div>
                    <div class="metric-info">
                        <h3><?= $infoGerais['safras_ativas'] ?? 0 ?>/<?= $infoGerais['total_safras'] ?? 0 ?></h3>
                        <p>Safras ativas</p>
                        <small class="info-text">
                            <?= $infoGerais['total_itens'] ?? 0 ?> itens no estoque
                        </small>
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
                        <?php if (!empty($dadosGrafico)): ?>
                            <canvas id="graficoFaturamento" class="chart-canvas"></canvas>
                        <?php else: ?>
                            <div class="chart-no-data">
                                Nenhum dado de faturamento disponível
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- SEÇÃO DE RELATÓRIOS COM DADOS REAIS -->
            <div class="bottom-section">
                <!-- ESTOQUE POR CATEGORIA -->
                <div class="bottom-card">
                    <h3>📦 Estoque por Categoria</h3>

                    <?php if (!empty($estoqueCategoria)): ?>

                        <div class="scrollable-container">
                            <?php foreach ($estoqueCategoria as $categoria): ?>

                                <div class="category-item">
                                    <div>
                                        <strong><?= htmlspecialchars($categoria['categoria']) ?></strong>
                                        <br>
                                        <small>
                                            <?= $categoria['total_itens'] ?> itens • <?= number_format($categoria['quantidade_total'], 1) ?> unidades
                                        </small>
                                    </div>
                                    <div class="text-right">
                                        <strong>
                                            R$ <?= number_format($categoria['valor_total'] ?? 0, 2, ',', '.') ?>
                                        </strong>

                                        <?php if ($categoria['menor_preco'] > 0 && $categoria['maior_preco'] > 0): ?>

                                            <br><small class="info-text">R$ <?= number_format($categoria['menor_preco'], 2, ',', '.') ?> - R$ <?= number_format($categoria['maior_preco'], 2, ',', '.') ?></small>

                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="no-data-message">
                            Nenhum item em estoque
                        </div>
                    <?php endif; ?>
                </div>

                <!-- SAFRAS DA PROPRIEDADE -->
                <div class="bottom-card">
                    <h3>🌱 Safras da Propriedade</h3>
                    <?php if (!empty($safrasPropriedade)): ?>
                        <div class="scrollable-container">
                            <?php foreach (array_slice($safrasPropriedade, 0, 5) as $safra): ?>
                                <div class="safra-item">
                                    <div class="safra-content">
                                        <div>
                                            <strong><?= htmlspecialchars($safra['safra_nome']) ?></strong>
                                            <br>

                                            <small>
                                                <?= htmlspecialchars($safra['status_descricao']) ?> - <?= number_format($safra['area_hectare'] ?? 0, 1) ?> ha
                                            </small>

                                            <?php if ($safra['itens_estoque'] > 0): ?>
                                                <br>
                                                <small class="safra-success">📦 <?= $safra['itens_estoque'] ?> itens em estoque</small>
                                            <?php endif; ?>

                                        </div>
                                        <div class="text-right">

                                            <strong>R$ <?= number_format($safra['receita_por_hectare'] ?? 0, 0, ',', '.') ?> /ha</strong>
                                            <br>
                                            <small>R$ <?= number_format($safra['receita_total']    ?? 0, 0, ',', '.')     ?> total</small>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="no-data-message">
                            Nenhuma safra encontrada
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- MOVIMENTAÇÕES RECENTES -->
            <?php if (!empty($movimentacoes)): ?>
                <div class="bottom-card movimentacoes-container">
                    <h3>📋 Movimentações Recentes (30 dias)</h3>
                    <div class="movimentacoes-scroll">
                        <?php foreach (array_slice($movimentacoes, 0, 8) as $mov): ?>
                            <div class="movimentacao-item">
                                <div class="movimentacao-content">
                                    <div class="movimentacao-header">
                                        <span class="movimentacao-badge <?= $mov['tipo_movimentacao'] == 'ENTRADA' ? 'badge-entrada' : 'badge-saida' ?>">
                                            <?= $mov['tipo_movimentacao'] ?>
                                        </span>
                                        <span class="movimentacao-date">
                                            <?= $mov['data_formatada'] ?> (<?= $mov['dias_atras'] ?> dias)
                                        </span>
                                    </div>
                                    <strong><?= htmlspecialchars($mov['item_nome']) ?></strong>
                                    <br><small class="movimentacao-details">
                                        <?= htmlspecialchars($mov['categoria']) ?> • <?= htmlspecialchars($mov['safra_nome']) ?>
                                    </small>
                                    <?php if (!empty($mov['observacao'])): ?>
                                        <br><small class="movimentacao-observacao">
                                            "<?= htmlspecialchars($mov['observacao']) ?>"
                                        </small>
                                    <?php endif; ?>
                                </div>
                                <div class="text-right">
                                    <div class="movimentacao-quantidade <?= $mov['tipo_movimentacao'] == 'ENTRADA' ? 'quantidade-entrada' : 'quantidade-saida' ?>">
                                        <?= $mov['tipo_movimentacao'] == 'ENTRADA' ? '+' : '-' ?><?= number_format($mov['quantidade'], 2) ?> <?= $mov['unidade_medida'] ?>
                                    </div>
                                    <small class="movimentacao-details">
                                        Estoque: <?= number_format($mov['estoque_atual'], 2) ?>
                                    </small>
                                    <?php if ($mov['valor_movimentacao'] > 0): ?>
                                        <br><small class="movimentacao-valor">
                                            R$ <?= number_format($mov['valor_movimentacao'], 2, ',', '.') ?>
                                        </small>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- HISTÓRICO SIMPLES DE ENTRADAS E SAÍDAS -->
            <div class="historico-container">
                <h3 class="historico-title">📊 Histórico de Entradas e Saídas</h3>

                <!-- CARDS SIMPLES -->
                <div class="historico-grid">
                    <div class="historico-card card-entradas">
                        <div class="historico-number number-entradas">
                            <?= $contagemEntradasSaidas['entradas_mes'] ?? 0 ?>
                        </div>
                        <div class="historico-label">Entradas este mês</div>
                    </div>

                    <div class="historico-card card-saidas">
                        <div class="historico-number number-saidas">
                            <?= $contagemEntradasSaidas['saidas_mes'] ?? 0 ?>
                        </div>
                        <div class="historico-label">Saídas este mês</div>
                    </div>

                    <div class="historico-card card-lucro">
                        <div class="historico-number number-lucro">
                            <?= $contagemEntradasSaidas['total_entradas'] ?? 0 ?>
                        </div>
                        <div class="historico-label">Total entradas (30 dias)</div>
                    </div>

                    <div class="historico-card card-total">
                        <div class="historico-number number-total">
                            <?= $contagemEntradasSaidas['total_saidas'] ?? 0 ?>
                        </div>
                        <div class="historico-label">Total saídas (30 dias)</div>
                    </div>
                </div>

                <!-- TABELA SIMPLES DO HISTÓRICO -->
                <?php if (!empty($historicoEntradasSaidas)): ?>
                    <div class="table-overflow">
                        <table class="historico-table">
                            <thead>
                                <tr>
                                    <th>Período</th>
                                    <th>Tipo</th>
                                    <th>Movimentações</th>
                                    <th>Quantidade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($historicoEntradasSaidas as $historico): ?>
                                    <tr>
                                        <td>
                                            <?= htmlspecialchars($historico['periodo_nome']) ?>
                                        </td>
                                        <td>
                                            <span class="historico-badge <?= $historico['tipo_movimentacao'] == 'ENTRADA' ? 'badge-entrada' : 'badge-saida' ?>">
                                                <?= $historico['tipo_movimentacao'] == 'ENTRADA' ? '📈 ENTRADA' : '📉 SAÍDA' ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?= $historico['total_movimentacoes'] ?>
                                        </td>
                                        <td>
                                            <?= number_format($historico['quantidade_total'], 1) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <div class="empty-state-icon">📊</div>
                        <div>Nenhuma movimentação encontrada</div>
                    </div>
                <?php endif; ?>
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
                            <div class="form-group form-group-center">
                                <label class="form-label">Foto de Perfil</label>
                                <div class="profile-pic-preview" id="editProfilePicPreview">
                                    <img src="<?= htmlspecialchars(isset($_SESSION['usuario_foto']) ? $_SESSION['usuario_foto'] : '/sistema-agricola/app/view/img/image5.png') ?>" alt="Pré-visualização" id="editProfilePicImg" />
                                    <span class="edit-icon">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 20h9" />
                                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19.5 3 21l1.5-4L16.5 3.5z" />
                                        </svg>
                                    </span>
                                </div>
                                <input type="file" name="image" id="editProfileImage" accept="image/*" class="hidden-input">
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
                        <div class="button-group">
                            <form id="deleteUserForm" method="POST" action="/sistema-agricola/app/usuario/deletar" onsubmit="return confirm('Tem certeza que deseja deletar sua conta? Todos os dados vinculados serão excluídos de forma permanente!');">
                                <button type="submit" class="btn-primary btn-delete">Deletar Conta</button>
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
        // Dados da sessão para JavaScript
        window.sessionData = {
            usuario_nome: "<?= htmlspecialchars($_SESSION['usuario_nome']) ?>",
            usuario_email: "<?= htmlspecialchars($_SESSION['usuario_email']) ?>",
            propriedade_id: <?= isset($_SESSION['propriedade_id']) ? $_SESSION['propriedade_id'] : 'null' ?>
        };

        // Dados das propriedades para JavaScript
        window.propriedadesData = <?php
                                    $propriedades = [];
                                    if (isset($_SESSION['usuario_id'])) {
                                        $propriedadeDAO = new \app\dao\PropriedadeDAO();
                                        $propriedades = $propriedadeDAO->listarPorUsuario($_SESSION['usuario_id']);
                                    }
                                    echo json_encode($propriedades);
                                    ?>;
    </script>

    <script src="/sistema-agricola/app/view/scripts/home.js"></script>

    <!-- Chart.js para o gráfico de faturamento -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <?php if (!empty($dadosGrafico)): ?>

        <script>
            // Dados do gráfico para JavaScript
            window.dadosGrafico = <?= json_encode($dadosGrafico) ?>;
        </script>

        <script src="/sistema-agricola/app/view/scripts/home-chart.js"></script>

    <?php endif; ?>
</body>

</html>