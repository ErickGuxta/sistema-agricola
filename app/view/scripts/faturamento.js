// JavaScript para a página faturamento.php

// Variáveis globais para o gráfico
let graficoFaturamento = null;

// Dados iniciais do gráfico
const dadosGraficoInicial = window.dadosGraficoInicial || [];

// Função para criar/atualizar o gráfico
function criarGrafico(dados) {
    const ctx = document.getElementById('graficoFaturamento');
    if (!ctx) return;
    
    // Destruir gráfico existente se houver
    if (graficoFaturamento) {
        graficoFaturamento.destroy();
    }
    
    // Preparar dados para o Chart.js
    const labels = dados.map(item => item.periodo_nome);
    const valores = dados.map(item => parseFloat(item.faturamento_total));
    
    // Criar o gráfico
    graficoFaturamento = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Faturamento (R$)',
                data: valores,
                borderColor: '#1e472d',
                backgroundColor: 'rgba(30, 71, 45, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#1e472d',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'R$ ' + value.toLocaleString('pt-BR');
                        }
                    },
                    grid: {
                        color: 'rgba(0,0,0,0.1)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });
}

// Função para carregar dados do gráfico via AJAX
function carregarDadosGrafico(safraId = '', meses = 12) {
    const url = `/sistema-agricola/app/faturamento/dados-grafico?safra_id=${safraId}&meses=${meses}`;
    
    fetch(url)
        .then(response => response.json())
        .then(dados => {
            criarGrafico(dados);
        })
        .catch(error => {
            console.error('Erro ao carregar dados do gráfico:', error);
        });
}

// Event listeners para os filtros do gráfico
document.addEventListener('DOMContentLoaded', function() {
    const chartSafraFilter = document.getElementById('chartSafraFilter');
    const chartPeriodFilter = document.getElementById('chartPeriodFilter');
    
    if (chartSafraFilter) {
        chartSafraFilter.addEventListener('change', function() {
            const safraId = this.value;
            const meses = document.getElementById('chartPeriodFilter').value;
            carregarDadosGrafico(safraId, meses);
        });
    }
    
    if (chartPeriodFilter) {
        chartPeriodFilter.addEventListener('change', function() {
            const meses = this.value;
            const safraId = document.getElementById('chartSafraFilter').value;
            carregarDadosGrafico(safraId, meses);
        });
    }
    
    // Criar gráfico inicial se houver dados
    if (dadosGraficoInicial && dadosGraficoInicial.length > 0) {
        criarGrafico(dadosGraficoInicial);
    }
});

function openCadastroModal() {
    document.getElementById("modal-cadastro").classList.add("active");
    document.body.style.overflow = "hidden";
}

function closeCadastroModal() {
    document.getElementById("modal-cadastro").classList.remove("active");
    document.body.style.overflow = "auto";
}

function openEditModal(id, mes, valor, descricao, safra_id) {
    document.getElementById("edit-id-faturamento").value = id;
    document.getElementById("edit-mes").value = mes;
    document.getElementById("edit-valor").value = valor;
    document.getElementById("edit-descricao").value = descricao;
    document.getElementById("edit-safra").value = safra_id;
    document.getElementById("modal-editar").classList.add("active");
    document.body.style.overflow = "hidden";
}

function closeEditModal() {
    document.getElementById("modal-editar").classList.remove("active");
    document.body.style.overflow = "auto";
}

document.addEventListener("keydown", function(event) {
    if (event.key === "Escape") {
        closeCadastroModal();
        closeEditModal();
    }
});

// Função para filtrar faturamentos por safra
function filtrarPorSafra(safraId) {
    const url = safraId ? `/sistema-agricola/app/faturamento/buscar?safra_id=${safraId}` : `/sistema-agricola/app/faturamento/buscar`;
    
    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error('Erro:', data.error);
                return;
            }
            
            // Atualizar a tabela
            atualizarTabela(data.faturamentos);
            
            // Atualizar cards
            atualizarCards(data.receitaTotal, data.custoTotal, data.lucro);
        })
        .catch(error => {
            console.error('Erro ao buscar dados:', error);
        });
}

// Função para atualizar a tabela
function atualizarTabela(faturamentos) {
    const tbody = document.querySelector('.products-table tbody');
    if (!tbody) return;

    let html = '';
    if (faturamentos && faturamentos.length > 0) {
        faturamentos.forEach(fat => {
            // Buscar o nome da safra
            const safraSelect = document.getElementById('yearSelector');
            let safraNome = 'N/A';
            if (fat.safra_id && safraSelect) {
                const option = safraSelect.querySelector(`option[value="${fat.safra_id}"]`);
                if (option) {
                    safraNome = option.textContent;
                }
            }
            
            html += `
                <tr>
                    <td>${(fat.mes ? new Date(fat.mes).toLocaleDateString('pt-BR', { month: '2-digit', year: 'numeric' }).replace(' de ', '/') : '')}</td>
                    <td>${safraNome}</td>
                    <td>R$ ${parseFloat(fat.valor).toLocaleString('pt-BR', {minimumFractionDigits: 2})}</td>
                    <td>${fat.descricao || ''}</td>
                    <td class="actions">
                        <button class="action-btn" onclick="openEditModal(${fat.id_faturamento}, '${fat.mes}', '${fat.valor}', '${fat.descricao || ''}', '${fat.safra_id}')" title="Editar">✏️</button>
                        <form method="POST" action="/sistema-agricola/app/faturamento/deletar" class="inline-form" onsubmit="return confirm('Deseja excluir este faturamento?')">
                            <input type="hidden" name="id_faturamento" value="${fat.id_faturamento}">
                            <button type="submit" class="action-btn" title="Excluir">🗑️</button>
                        </form>
                    </td>
                </tr>
            `;
        });
    } else {
        html = '<tr><td colspan="5">Nenhum faturamento registrado.</td></tr>';
    }
    
    tbody.innerHTML = html;
}

// Função para atualizar o valor total
function atualizarValorTotal(receitaTotal) {
    // Mantido por compatibilidade; delega para atualizarCards apenas com receita
    atualizarCards(receitaTotal, undefined, undefined);
}

function atualizarCards(receitaTotal, custoTotal, lucro) {
    const elBruto = document.getElementById('card-bruto');
    const elCusto = document.getElementById('card-custo');
    const elLucro = document.getElementById('card-lucro');
    if (typeof receitaTotal !== 'undefined' && elBruto) {
        elBruto.textContent = `R$ ${parseFloat(receitaTotal).toLocaleString('pt-BR', {minimumFractionDigits: 2})}`;
    }
    if (typeof custoTotal !== 'undefined' && elCusto) {
        elCusto.textContent = `-R$ ${parseFloat(custoTotal).toLocaleString('pt-BR', {minimumFractionDigits: 2})}`;
    }
    if (typeof lucro !== 'undefined' && elLucro) {
        elLucro.textContent = `R$ ${parseFloat(lucro).toLocaleString('pt-BR', {minimumFractionDigits: 2})}`;
    }
}

// Event listener para o seletor de safras
document.addEventListener('DOMContentLoaded', function() {
    const yearSelector = document.getElementById('yearSelector');
    if (yearSelector) {
        yearSelector.addEventListener('change', function() {
            filtrarPorSafra(this.value);
        });
    }
});
