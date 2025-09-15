// JavaScript para a página login.php

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
