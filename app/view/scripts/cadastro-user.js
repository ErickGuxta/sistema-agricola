// JavaScript para a página cadastro_user.php

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

// Preview da imagem de perfil
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('profileImage');
    const preview = document.getElementById('profilePicPreview');
    const img = document.getElementById('profilePicImg');
    const placeholder = document.getElementById('profilePicPlaceholder');
    
    input.addEventListener('change', function(e) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                img.src = ev.target.result;
                img.style.display = 'block';
                placeholder.style.display = 'none';
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            img.src = '';
            img.style.display = 'none';
            placeholder.style.display = 'block';
        }
    });
    
    // Clique na área de preview abre o input
    preview.addEventListener('click', function() {
        input.click();
    });
});
