<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styles/style-register.css">
  <title>Cadastro da Propriedade - AgroMiz</title>

</head>
<body class="pagina-propriedade">
  <div class="container">
    <div class="form-section">
      <div class="logo-box">
        <div class="logo-row">
          <img src="../img/image 6.png" alt="Logo AgroMiz" class="logo-img">
          <h1 class="logo-title">AgroMiz</h1>
        </div>
      </div>

      <h2>Quase lá... <br> agora vamos cadastrar sua propriedade</h2>

      <form method="POST" action="/sistema-agricola/app/registro-propriedade" id="formCadastro">
        <div class="input-group">
          <label for="propriedade">Nome da propriedade*</label>
          <input type="text" id="propriedade" placeholder="Nome da propriedade" name="nome_propriedade">
        </div>

        <div class="input-group area-group">
          <label for="area">Medida da área que trabalha*</label>
          <input type="text" id="area" placeholder="Ex: 100 hectares" maxlength="50" oninput="atualizarContador()" name="area_total">
          <span class="char-counter" id="contador">0/50</span>
        </div>

        <div class="input-group">
          <label for="estado">Estado*</label>
          <select id="estado" name="estado" onchange="carregarCidades()">
            <option value="">Selecione um estado</option>
          </select>
        </div>

        <div class="input-group">
          <label for="cidade">Cidade*</label>
          <select id="cidade" name="cidade" disabled>
            <option value="">Selecione primeiro o estado</option>
          </select>
        </div>

        <div class="btn-container">
          <button type="submit" class="btn-cadastrar">Cadastrar</button>
        </div>
      </form>
    </div>

    <!-- <div class="image-section">
      <img src="img/image 5.png" alt="Ilustração de fazendeira">
    </div> -->
  </div>

  <script>
    const estados = {
      "AC": "Acre", "AL": "Alagoas", "AP": "Amapá", "AM": "Amazonas",
      "BA": "Bahia", "CE": "Ceará", "DF": "Distrito Federal", "ES": "Espírito Santo",
      "GO": "Goiás", "MA": "Maranhão", "MT": "Mato Grosso", "MS": "Mato Grosso do Sul",
      "MG": "Minas Gerais", "PA": "Pará", "PB": "Paraíba", "PR": "Paraná",
      "PE": "Pernambuco", "PI": "Piauí", "RJ": "Rio de Janeiro", "RN": "Rio Grande do Norte",
      "RS": "Rio Grande do Sul", "RO": "Rondônia", "RR": "Roraima", "SC": "Santa Catarina",
      "SP": "São Paulo", "SE": "Sergipe", "TO": "Tocantins"
    };

    function carregarEstados() {
      const select = document.getElementById('estado');
      Object.entries(estados)
        .sort((a, b) => a[1].localeCompare(b[1]))
        .forEach(([sigla, nome]) => {
          const option = new Option(nome, sigla);
          select.add(option);
        });
    }

    async function carregarCidades() {
      const estado = document.getElementById('estado');
      const cidade = document.getElementById('cidade');
      cidade.innerHTML = '<option value="">Carregando cidades...</option>';
      cidade.disabled = true;

      if (!estado.value) return;

      try {
        const response = await fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${estado.value}/municipios`);
        const dados = await response.json();
        
        cidade.innerHTML = '<option value="">Selecione uma cidade</option>';
        dados
          .map(m => m.nome)
          .sort((a, b) => a.localeCompare(b))
          .forEach(nome => {
            cidade.add(new Option(nome, nome));
          });
        
        cidade.disabled = false;
      } catch (error) {
        cidade.innerHTML = '<option value="">Erro ao carregar</option>';
        console.error("Erro ao buscar cidades:", error);
      }
    }

    function atualizarContador() {
      const input = document.getElementById('area');
      const contador = document.getElementById('contador');
      contador.textContent = `${input.value.length}/50`;
    }

    document.addEventListener('DOMContentLoaded', carregarEstados);
  </script>
</body>
</html>