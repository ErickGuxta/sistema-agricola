
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safras - Sistema Agrícola</title>
    <!-- <link rel="stylesheet" href="/sistema-agricola/app/view/styles/style-safra.css"> -->
    <style>
        @import url("https://meyerweb.com/eric/tools/css/reset/reset.css");

        :root {
            /* Sistema geral */
            --color-primary: #1e472d;
            --color-secondary: #42594c;

            /* Páginas de registro */
            --color-white: #ffffff;
            --color-gray-primary: #d9d9d9;
            --color-gray-secondary: #262626;
            --color-black: #000000;

            /* Botões */
            --color-button-red: #bf3f4a;
            --color-button-green: #1d4d33;
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
            transition: background 0.2s;
        }

        .new-safra-btn:hover {
            background: #c82333;
        }

        .new-safra-btn:disabled {
            background: #6c757d;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .new-safra-btn:disabled:hover {
            background: #6c757d;
        }

        /* Tabela de safras */
        .table-container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .safras-table {
            width: 100%;
            border-collapse: collapse;
        }

        .safras-table thead {
            background: var(--color-primary);
            color: white;
        }

        .safras-table th,
        .safras-table td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .safras-table th {
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .safras-table tbody tr:hover {
            background: #f8f9fa;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-concluida {
            background: #d4edda;
            color: #155724;
        }

        .status-andamento {
            background: #d1ecf1;
            color: #0c5460;
        }

        .status-encerrada {
            background: #f8d7da;
            color: #721c24;
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
        }

        .action-btn:hover {
            background: #f0f0f0;
        }

        /* Cards informativos */
        .info-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .info-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .info-value {
            font-size: 36px;
            font-weight: bold;
            color: var(--color-primary);
            margin-bottom: 8px;
        }

        .info-label {
            font-size: 16px;
            color: #666;
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
        }

        .modal-overlay.active {
            display: flex;
        }

        /* Modal de edição específico */
        #edit-modal-overlay.active {
            display: flex;
        }

        .modal-content {
            background: var(--color-gray-secondary);
            color: white;
            border-radius: 12px;
            padding: 40px;
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-title {
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            color: white;
        }

        .safra-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            font-size: 16px;
            font-weight: 600;
            color: white;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 12px;
            border: 2px solid var(--color-primary);
            border-radius: 8px;
            background: var(--color-primary);
            color: white;
            font-size: 16px;
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--color-button-red);
        }

        .submit-btn {
            background: var(--color-button-red);
            color: white;
            border: none;
            padding: 16px 32px;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
            transition: background 0.2s;
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

            .safras-table {
                min-width: 600px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <header class="header-sidebar">
            <!-- Perfil -->
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

            <!-- Menu lateral -->
            <nav class="nav-menu">
                <div class="nav-item">    <a href="/sistema-agricola/app/dashboard">Página Inicial</a></div>
                <div class="nav-item active">Safras</div>
                <div class="nav-item">    <a href="/sistema-agricola/app/estoque">Estoque</a></div>
                <div class="nav-item">Faturamento</div>
            </nav>

            <!-- Clima -->
            <div class="weather">
                <div class="weather-icon">☁️</div>
                <div>clima</div>
            </div>
        </header>

        <!-- Conteúdo principal -->
        <main class="main-content">
            <header class="header-main">
                <div class="header-left">
                    <h1 class="page-title">Safras</h1>
                    <div class="divider"></div>
                    <div class="year-selector">
                        2025 <span>▼</span>
                    </div>
                </div>

                <button class="new-safra-btn" onclick="openModal()" <?= !isset($_SESSION['propriedade_id']) ? 'disabled' : '' ?>>
                    + nova safra
                </button>
            </header>

            <?php if (!isset($_SESSION['propriedade_id'])): ?>
                <div style="background: #fff3cd; border: 1px solid #ffeaa7; color: #856404; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                    <strong>⚠️ Atenção:</strong> Você precisa cadastrar uma propriedade antes de cadastrar safras. 
                    <a href="/sistema-agricola/app/registro-propriedade" style="color: #1f5b3c; text-decoration: underline;">Clique aqui para cadastrar sua propriedade</a>.
                </div>
            <?php endif; ?>

            <!-- Tabela de safras -->
            <div class="table-container">
                <table class="safras-table">
                    <thead>
                        <tr>
                            <th>Safra </th>
                            <th>Início</th>
                            <th>Término</th>
                            <th>Status</th>
                            <th>Área(ha)</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($safras) && is_array($safras) && count($safras) > 0): ?>
                            <?php foreach ($safras as $safra): ?>
                                <tr>
                                    <td><?= htmlspecialchars($safra->nome)           ?> </td>
                                    <td><?= htmlspecialchars($safra->data_inicio)    ?> </td>
                                    <td><?= htmlspecialchars($safra->data_fim ?? '') ?> </td>
                                    <td>
                                        <span class="status-badge 
   
                                            <?= $safra->status === 'concluida' ? 'status-concluida' : ($safra->status === 'encerrada' ? 'status-encerrada' : 'status-andamento') ?>"><?= htmlspecialchars($safra->status) ?>
                                            
                                        </span>
                                    </td>

                                    <td><?= htmlspecialchars($safra->area_hectare ?? '-') ?></td>
                                    <td class="actions">
                                        <button class="action-btn edit" onclick="openEditModal(<?= (int) $safra->id_safra ?>, 

                                            '<?= htmlspecialchars($safra->nome)               ?>', 
                                            '<?= htmlspecialchars($safra->data_inicio)        ?>', 
                                            '<?= htmlspecialchars($safra->data_fim ?? '')     ?>', 
                                            '<?= htmlspecialchars($safra->area_hectare ?? '') ?>', 
                                            '<?= htmlspecialchars($safra->status)             ?>', 
                                            '<?= htmlspecialchars($safra->descricao ?? '')    ?>')">

                                        ✏️</button>

                                        <form method="POST" action="/sistema-agricola/app/safra/deletar" style="display:inline">
                                            <input type="hidden" name="id_safra" value="<?= (int) $safra->id_safra ?>">
                                            <button class="action-btn delete" onclick="return confirm('Deseja excluir esta safra?')">🗑️</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="7">Nenhuma safra cadastrada.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Cards informativos -->
            <div class="info-cards">
                <div class="info-card">
                    <div class="info-value">—</div>
                    <div class="info-label">Temperatura</div>
                </div>
                <div class="info-card">
                    <div class="info-value"><?php 
                        $hect = isset($total_hectares) ? (float)$total_hectares : 0;
                        $fmt = (floor($hect) == $hect) ? number_format($hect, 0, ',', '.') : number_format($hect, 2, ',', '.');
                        echo $fmt . ' ha';
                    ?></div>
                    <div class="info-label">Total Hectares</div>
                </div>
                <div class="info-card">
                    <div class="info-value"><?php echo isset($safras_ativas) ? (int)$safras_ativas : 0; ?></div>
                    <div class="info-label">Safras Ativas</div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal de cadastro -->
    <div id="modal-overlay" class="modal-overlay" onclick="closeModal()">
        <div class="modal-content" onclick="event.stopPropagation()">
            <h2 class="modal-title">Cadastrar Safra</h2>

            <form class="safra-form" method="POST" action="/sistema-agricola/app/safra">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" placeholder="Milho 2025" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="dataInicio">Data de Início</label>
                        <input type="date" id="dataInicio" name="dataInicio" required>
                    </div>
                    <div class="form-group">
                        <label for="dataTermino">Data de Término</label>
                        <input type="date" id="dataTermino" name="dataTermino" placeholder="Opcional">
                    </div>
                </div>

                <div class="form-group">
                    <label for="area_hectare">Área (ha)</label>
                    <input type="number" id="area_hectare" name="area_hectare" step="0.01" min="0" placeholder="Ex: 55.5">
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" required>
                        <option value="">Selecione o status</option>
                        <option value="planejada">Planejada</option>
                        <option value="andamento">Em andamento</option>
                        <option value="concluida">Concluída</option>
                        <option value="encerrada">Encerrada</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea id="descricao" name="descricao" rows="4" placeholder="Safra de milho para rotação de cultura. 3 hectares plantadas."></textarea>
                </div>

                <button type="submit" class="submit-btn">Cadastrar</button>
            </form>
        </div>
    </div>

    <!-- Modal de edição -->
    <div id="edit-modal-overlay" class="modal-overlay" onclick="closeEditModal()">
        <div class="modal-content" onclick="event.stopPropagation()">
            <h2 class="modal-title">Editar Safra</h2>

            <form class="safra-form edit-form" method="POST" action="/sistema-agricola/app/safra/atualizar">
                <input type="hidden" id="edit_id_safra" name="id_safra">
                
                <div class="form-group">
                    <label for="edit_nome">Nome</label>
                    <input type="text" id="edit_nome" name="nome" placeholder="Milho 2025" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="edit_dataInicio">Data de Início</label>
                        <input type="date" id="edit_dataInicio" name="dataInicio" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_dataTermino">Data de Término</label>
                        <input type="date" id="edit_dataTermino" name="dataTermino" placeholder="Opcional">
                    </div>
                </div>

                <div class="form-group">
                    <label for="edit_area_hectare">Área (ha)</label>
                    <input type="number" id="edit_area_hectare" name="area_hectare" step="0.01" min="0" placeholder="Ex: 55.5">
                </div>

                <div class="form-group">
                    <label for="edit_status">Status</label>
                    <select id="edit_status" name="status" required>
                        <option value="">Selecione o status</option>
                        <option value="planejada">Planejada</option>
                        <option value="andamento">Em andamento</option>
                        <option value="concluida">Concluída</option>
                        <option value="encerrada">Encerrada</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="edit_descricao">Descrição</label>
                    <textarea id="edit_descricao" name="descricao" rows="4" placeholder="Safra de milho para rotação de cultura. 3 hectares plantadas."></textarea>
                </div>

                <button type="submit" class="submit-btn">Atualizar</button>
            </form>
        </div>
    </div>

    <script>
        // Função para abrir o modal
        function openModal() {
            const modal = document.getElementById("modal-overlay")
            modal.classList.add("active")
            document.body.style.overflow = "hidden"
        }

        // Função para fechar o modal
        function closeModal() {
            const modal = document.getElementById("modal-overlay")
            modal.classList.remove("active")
            document.body.style.overflow = "auto"

            // Limpar o formulário
            document.querySelector(".safra-form").reset()
        }

        // Fechar modal com ESC
        document.addEventListener("keydown", (event) => {
            if (event.key === "Escape") {
                closeModal()
            }
        })

        // Função para formatar data no padrão brasileiro
        function formatDate(dateString) {
            if (!dateString) return ""
            const date = new Date(dateString)
            return date.toLocaleDateString("pt-BR")
        }

        // Função para abrir o modal de edição
        function openEditModal(id, nome, dataInicio, dataFim, areaHectare, status, descricao) {
            // Preencher os campos do formulário de edição
            document.getElementById('edit_id_safra').value = id
            document.getElementById('edit_nome').value = nome
            document.getElementById('edit_dataInicio').value = dataInicio
            document.getElementById('edit_dataTermino').value = dataFim
            document.getElementById('edit_area_hectare').value = areaHectare
            document.getElementById('edit_status').value = status
            document.getElementById('edit_descricao').value = descricao

            // Abrir o modal
            const modal = document.getElementById("edit-modal-overlay")
            modal.classList.add("active")
            document.body.style.overflow = "hidden"
        }

        // Função para fechar o modal de edição
        function closeEditModal() {
            const modal = document.getElementById("edit-modal-overlay")
            modal.classList.remove("active")
            document.body.style.overflow = "auto"

            // Limpar o formulário
            document.querySelector("#edit-modal-overlay .edit-form").reset()
        }

        // Fechar modal de edição com ESC
        document.addEventListener("keydown", (event) => {
            if (event.key === "Escape") {
                closeEditModal()
            }
        })
    </script>
</body>

</html>