// JavaScript para a página cadastro_propriedade.php

const estados = {
    "AC": "Acre",
    "AL": "Alagoas",
    "AP": "Amapá",
    "AM": "Amazonas",
    "BA": "Bahia",
    "CE": "Ceará",
    "DF": "Distrito Federal",
    "ES": "Espírito Santo",
    "GO": "Goiás",
    "MA": "Maranhão",
    "MT": "Mato Grosso",
    "MS": "Mato Grosso do Sul",
    "MG": "Minas Gerais",
    "PA": "Pará",
    "PB": "Paraíba",
    "PR": "Paraná",
    "PE": "Pernambuco",
    "PI": "Piauí",
    "RJ": "Rio de Janeiro",
    "RN": "Rio Grande do Norte",
    "RS": "Rio Grande do Sul",
    "RO": "Rondônia",
    "RR": "Roraima",
    "SC": "Santa Catarina",
    "SP": "São Paulo",
    "SE": "Sergipe",
    "TO": "Tocantins"
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
