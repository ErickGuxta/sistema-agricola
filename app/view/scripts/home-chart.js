// JavaScript para o gráfico de faturamento na página home.php

// Dados do PHP para JavaScript
const dadosGrafico = window.dadosGrafico || [];

// Preparar dados para o Chart.js
const labels = dadosGrafico.map(item => item.periodo_nome);
const valores = dadosGrafico.map(item => parseFloat(item.faturamento_total));

// Criar o gráfico
const ctx = document.getElementById('graficoFaturamento').getContext('2d');
const graficoFaturamento = new Chart(ctx, {
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
        },
        elements: {
            point: {
                hoverBackgroundColor: '#1e472d'
            }
        }
    }
});
