<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="/sistema-agricola/app/view/styles/style-register.css"> -->
  <title>AgroMiz - Cadastro</title>
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

    .container-register {
      display: flex;
      flex-direction: row;
      justify-content: flex-start;
      align-items: flex-start;
      gap: 48px;
    }

    .container-register>div:first-child {
      flex: 3 1 420px;
      min-width: 340px;
      max-width: 600px;
    }

    .container-register .profile-pic-upload {
      flex: 0 1 100px;
      min-width: 100px;
      max-width: 140px;
      margin-top: 32px;
    }

    @media (max-width: 900px) {
      .container-register {
        flex-direction: column;
        gap: 24px;
        align-items: center;
      }

      .container-register>div:first-child {
        width: 100%;
        max-width: 100%;
        min-width: 0;
      }

      .container-register .profile-pic-upload {
        margin-top: 0;
        min-width: 80px;
        max-width: 120px;
      }
    }

    /* Espaçamento entre formulário e botões */
    #formLogin {
      margin-bottom: 30px;
    }

    .botoes {
      margin-top: 20px;
      display: flex;
      gap: 10px;
      align-items: center;
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
    .btn-cadastrar,
    .btn-login {
      padding: 12px 16px;
      background-color: #215c3d;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      width: 120px;
      height: 44px;
      text-decoration: none;
      display: inline-block;
      text-align: center;
      box-sizing: border-box;
    }

    .pagina-propriedade .btn-cadastrar {
      width: 100%;
      max-width: 200px;
    }

    button:hover,
    .btn-cadastrar:hover,
    .btn-login:hover {
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

      .btn-cadastrar,
      .btn-login {
        width: 100% !important;
        max-width: none !important;
      }

      .botoes {
        flex-direction: column;
        gap: 15px;
      }
    }

    .profile-pic-upload {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 10px;
      gap: 6px;
    }

    .profile-pic-label {
      cursor: pointer;
      width: 150px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 6px;
    }

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
      margin-bottom: 4px;
      position: relative;
      transition: border-color 0.2s;
    }

    .profile-pic-label:hover .profile-pic-preview {
      border-color: #1f5b3c;
    }

    .profile-pic-preview img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    #profilePicPlaceholder {
      color: #888;
      font-size: 13px;
      text-align: center;
    }

    .profile-pic-instructions {
      font-size: 11px;
      color: #888;
      text-align: center;
      margin-top: 2px;
    }

    @media (max-width: 768px) {
      .profile-pic-label {
        width: 100px;
      }

      .profile-pic-preview {
        width: 80px;
        height: 80px;
      }
    }

    /* Classes para limpeza de estilos inline */
    .hidden-image {
      display: none;
    }

    .hidden-input {
      display: none;
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
        <p class="subtitle">Boas-vindas ao AgroMiz</p>
      </div>

      <h2>Registre-se</h2>

      <?php if (!empty($erro)): ?>
        <div class="erro">
          <?= htmlspecialchars($erro) ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="/sistema-agricola/app/registro" id="formCadastro" enctype="multipart/form-data">
        <div class="container-register">
          <div>
            <label for="nome">Nome</label>

            <input type="text" id="nome" placeholder="Nome do proprietário" name="nome_produtor" required value="<?= isset($_POST['nome_produtor']) ? htmlspecialchars($_POST['nome_produtor']) : '' ?>">

            <label for="email">E-mail</label>
            <input type="email" id="email" placeholder="E-mail" name="email" required value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">

            <label for="senha">Senha</label>
            <input type="password" id="senha" placeholder="Senha" name="senha" required>
          </div>
          <div class="profile-pic-upload">
            <label for="profileImage" class="profile-pic-label">
              <span>Foto de Perfil</span>

              <div class="profile-pic-preview" id="profilePicPreview">
                <img src="/sistema-agricola/app/view/img/image9.jpg" alt="Pré-visualização" id="profilePicImg" class="hidden-image" />
                <!-- <span id="profilePicPlaceholder">Clique para escolher</span> -->
              </div>

              <input type="file" name="image" id="profileImage" accept="image/*" class="hidden-input">
            </label>
            <small class="profile-pic-instructions">Formatos aceitos: JPG, PNG. Tamanho máximo: 2MB.</small>
          </div>
        </div>

        <div class="termos-botao">
          <div class="checkbox">
            <input type="checkbox" id="termos" required>
            <label for="termos">Aceito os termos e condições</label>
          </div>
          <div class="botoes">
            <button type="submit">Cadastrar</button>
            <a href="/sistema-agricola/app/login" class="btn-login">Fazer Login</a>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script src="/sistema-agricola/app/view/scripts/cadastro-user.js"></script>
</body>

</html>