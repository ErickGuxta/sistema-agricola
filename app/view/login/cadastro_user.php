<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/sistema-agricola/app/view/styles/style-register.css">
  <title>AgroMiz - Cadastro</title>
</head>
<body>
  <div class="container">
    <div class="form-section">
      <div class="logo-box">
        <div class="logo-row">
          <img src="/sistema-agricola/app/view/img/image 6.png" alt="Logo AgroMiz" class="logo-img">
          <h1 class="logo-title">AgroMiz</h1>
        </div>
        <p class="subtitle">Boas-vindas ao FazendaGestor</p>
      </div>

      <h2>Registre-se</h2>

      <?php if (!empty($erro)): ?>
        <div class="erro">
          <?= htmlspecialchars($erro) ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="/sistema-agricola/app/registro" id="formCadastro">
        <label for="nome">Nome</label>
        <input type="text" id="nome" placeholder="Nome do proprietário" name="nome_produtor" required value="<?= isset($_POST['nome_produtor']) ? htmlspecialchars($_POST['nome_produtor']) : '' ?>">

        <label for="email">E-mail</label>
        <input type="email" id="email" placeholder="E-mail" name="email" required value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">

        <label for="senha">Senha</label>
        <input type="password" id="senha" placeholder="Senha" name="senha" required>

        <div class="termos-botao">
          <div class="checkbox">
            <input type="checkbox" id="termos" required>
            <label for="termos">Aceito os termos e condições</label>
          </div>
          <button type="submit">Cadastrar</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Validação adicional no frontend
    document.getElementById('formCadastro').addEventListener('submit', function(e) {
      const nome = document.getElementById('nome').value.trim();
      const email = document.getElementById('email').value.trim();
      const senha = document.getElementById('senha').value.trim();
      
      if (!nome || !email || !senha) {
        alert('Por favor, preencha todos os campos.');
        e.preventDefault();
        return false;
      }
      
      if (!email.includes('@')) {
        alert('Por favor, insira um e-mail válido.');
        e.preventDefault();
        return false;
      }
      
      if (senha.length < 6) {
        alert('A senha deve ter pelo menos 6 caracteres.');
        e.preventDefault();
        return false;
      }
    });
  </script>
</body>
</html>