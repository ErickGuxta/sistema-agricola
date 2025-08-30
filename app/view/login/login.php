<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="/sistema-agricola/app/view/styles/style-register.css"> -->
  <title>AgroMiz - Login</title>
  <style>
    /* RESET E ESTILOS GERAIS */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: "Segoe UI", sans-serif;
    }

    body {
      background-color: #f9f9f9;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
    }

    /* CONTAINER PRINCIPAL */
    .container {
      background: #fff;
      border-top: 8px solid #1f5b3c;
      border-bottom: 8px solid #1f5b3c;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      display: flex;
      max-width: 900px;
      width: 100%;
      overflow: hidden;
    }

    /* SEÇÃO DO FORMULÁRIO */
    .form-section {
      flex: 1;
      padding: 40px;
    }

    /* LOGO */
    .logo-box {
      margin-bottom: 20px;
      margin-top: -20px;
    }

    .logo-row {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .logo-img {
      height: 60px;
      width: auto;
    }

    .logo-title {
      color: #065a14ee;
      font-size: 35px;
      font-weight: bold;
    }

    .subtitle {
      font-size: 14px;
      color: #000;
      font-weight: bold;
      margin-left: 15px;
    }

    /* FORMULÁRIO */
    h2 {
      font-size: 24px;
      margin-bottom: 30px;
      color: #333;
    }

    .pagina-propriedade h2 {
      font-size: 18px;
      margin-bottom: 20px;
    }

    /* Espaçamento entre formulário e botões */
    #formLogin {
      margin-bottom: 30px;
    }

    .botoes {
      margin-top: 20px;
    }

    /* CAMPOS DE ENTRADA */
    label {
      display: block;
      margin-top: 10px;
      font-weight: bold;
      color: #333;
      font-size: 12px;
      margin-top: 15px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    select {
      width: 100%;
      padding: 12px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
    }

    select {
      height: auto;
      white-space: normal;
      word-wrap: break-word;
    }

    /* ÁREA COM CONTADOR */
    .area-group {
      position: relative;
    }

    .char-counter {
      position: absolute;
      right: 10px;
      top: 37px;
      font-size: 11px;
      color: #888;
    }

    /* CHECKBOX */
    .termos-botao {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 20px;
      gap: 12px;
    }

    .checkbox {
      display: flex;
      align-items: center;
    }

    .checkbox input {
      margin-right: 8px;
    }

    .checkbox label {
      font-weight: normal;
      margin-top: 0;
    }

    /* mensage erro */
    .erro {
      color: red;
      margin-bottom: 10px;
      padding: 10px;
      background-color: #ffebee;
      border: 1px solid #f44336;
      border-radius: 4px;
    }

    /* BOTÕES */
    button,
    .btn-cadastrar {
      padding: 8px;
      background-color: #215c3d;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      width: 90px;
    }

    .pagina-propriedade .btn-cadastrar {
      width: 100%;
      max-width: 200px;
    }

    button:hover,
    .btn-cadastrar:hover {
      background-color: #2e7e53e3;
    }

    .btn-container {
      display: flex;
      justify-content: center;
      margin-top: 20px;
      margin-bottom: -10px;
    }



    /* IMAGEM */
    .image-section {
      padding: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .image-section img {
      max-width: 250px;
      height: auto;
    }

    .pagina-propriedade .image-section img {
      max-width: 220px;
    }

    /* RESPONSIVIDADE */
    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }

      .form-section {
        padding: 30px 20px;
      }

      .image-section {
        order: -1;
        padding: 20px;
      }

      .image-section img {
        max-width: 180px;
        margin-bottom: 0 !important;
      }

      .logo-box {
        align-items: center;
        text-align: center;
      }

      .logo-img,
      .logo-title,
      .subtitle {
        margin: 0;
      }

      .termos-botao {
        flex-direction: column;
        gap: 15px;
      }

      .termos-botao button {
        width: 100%;
      }

      .btn-cadastrar {
        width: 100% !important;
        max-width: none !important;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="form-section">
      <div class="logo-box">
        <div class="logo-row">
          <img src="/sistema-agricola/app/view/img/image6.png" alt="Logo AgroMiz" class="logo-img">
          <h1 class="logo-title">AgroMiz</h1>
        </div>
        <p class="subtitle">Faça login no FazendaGestor</p>
      </div>

      <h2>Entrar</h2>

      <?php if (!empty($erro)): ?>
        <div class="erro">
          <?= htmlspecialchars($erro) ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="/sistema-agricola/app/login" id="formLogin">
        <label for="email">E-mail</label>
        <input type="email" id="email" placeholder="E-mail" name="email" required value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">

        <label for="senha">Senha</label>
        <input type="password" id="senha" placeholder="Senha" name="senha" required>

        <div class="botoes">
          <button type="submit">Entrar</button>
          <a href="/sistema-agricola/app/registro" class="btn-cadastro">Criar Conta</a>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Validação básica no frontend
    document.getElementById('formLogin').addEventListener('submit', function(e) {
      const email = document.getElementById('email').value.trim();
      const senha = document.getElementById('senha').value.trim();

      if (!email || !senha) {
        alert('Por favor, preencha todos os campos.');
        e.preventDefault();
        return false;
      }

      if (!email.includes('@')) {
        alert('Por favor, insira um e-mail válido.');
        e.preventDefault();
        return false;
      }
    });
  </script>
</body>

</html>