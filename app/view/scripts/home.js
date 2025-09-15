// JavaScript para a página home.php

// Modal functions
function openProfileModal() {
    document.getElementById('profileModal').style.display = 'block';
    // Load current data (in a real application, this would come from the server)
    loadCurrentData();
}

function closeProfileModal() {
    document.getElementById('profileModal').style.display = 'none';
}

// Tab switching
function showTab(tabName) {
    // Hide all tabs
    const tabs = document.querySelectorAll('.tab-content');
    tabs.forEach(tab => tab.classList.remove('active'));

    // Remove active class from all buttons
    const buttons = document.querySelectorAll('.tab-button');
    buttons.forEach(button => button.classList.remove('active'));

    // Show selected tab
    document.getElementById(tabName + '-tab').classList.add('active');

    // Add active class to clicked button
    event.target.classList.add('active');
}

// Load current data (placeholder function)
function loadCurrentData() {
    // In a real application, you would fetch this data from the server
    // For now, we'll use placeholder values
    const userName = document.getElementById('userName');
    const userEmail = document.getElementById('userEmail');
    
    if (userName) userName.value = window.sessionData?.usuario_nome || '';
    if (userEmail) userEmail.value = window.sessionData?.usuario_email || '';
    
    // Carregar dados da propriedade atualmente selecionada
    const currentPropertyId = window.sessionData?.propriedade_id || null;
    if (currentPropertyId) {
        updatePropertyModalData(currentPropertyId);
    }
}

// Preview da imagem de perfil no modal de edição + hover do ícone
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('editProfileImage');
    const preview = document.getElementById('editProfilePicPreview');
    const img = document.getElementById('editProfilePicImg');
    const editIcon = preview.querySelector('.edit-icon');
    preview.addEventListener('mouseenter', function() {
        editIcon.style.display = 'flex';
    });
    preview.addEventListener('mouseleave', function() {
        editIcon.style.display = 'none';
    });
    preview.addEventListener('click', function() {
        input.click();
    });
    input.addEventListener('change', function(e) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                img.src = ev.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    });
});

// Validação de senha no modal de edição
document.getElementById('profileForm').addEventListener('submit', function(e) {
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    if (newPassword && newPassword !== confirmPassword) {
        alert('As senhas não coincidem!');
        e.preventDefault();
        return false;
    }
});

document.getElementById('propertyForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const area = document.getElementById('propertyArea').value;
    if (area && area < 0) {
        alert('A área deve ser um valor positivo!');
        return;
    }

    // Here you would send the data to the server
    alert('Propriedade atualizada com sucesso!');
    closeProfileModal();
});

// Close modal when clicking outside
window.addEventListener('click', function(event) {
    const modal = document.getElementById('profileModal');
    if (event.target === modal) {
        closeProfileModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeProfileModal();
    }
});

// Modal Nova Propriedade
function openNewPropertyModal() {
    document.getElementById('newPropertyModal').style.display = 'block';
}

function closeNewPropertyModal() {
    document.getElementById('newPropertyModal').style.display = 'none';
}

// Fechar modal ao clicar fora
window.addEventListener('click', function(event) {
    const modal = document.getElementById('newPropertyModal');
    if (event.target === modal) {
        closeNewPropertyModal();
    }
});

// Fechar modal com ESC
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeNewPropertyModal();
    }
});

// Validação simples do formulário
document.getElementById('newPropertyForm').addEventListener('submit', function(e) {
    const area = document.getElementById('newPropertyArea').value;
    if (area && area < 0) {
        alert('A área deve ser um valor positivo!');
        e.preventDefault();
        return;
    }
});

// Dados das propriedades para uso no JavaScript
const propriedadesData = window.propriedadesData || [];

// Função para trocar propriedade
function changeProperty(propriedadeId) {
    if (propriedadeId) {
        // Atualizar dados do modal de edição com a propriedade selecionada
        updatePropertyModalData(propriedadeId);
        
        // Criar formulário temporário para enviar POST
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/sistema-agricola/app/dashboard/setPropriedade';
        
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'propriedade_id';
        input.value = propriedadeId;
        
        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    }
}

// Função para atualizar dados do modal com a propriedade selecionada
function updatePropertyModalData(propriedadeId) {
    const propriedade = propriedadesData.find(p => p.id_propriedade == propriedadeId);
    if (propriedade) {
        // Separar estado e cidade da localização
        let estado = '';
        let cidade = '';
        if (propriedade.localizacao && propriedade.localizacao.includes(' - ')) {
            [estado, cidade] = propriedade.localizacao.split(' - ');
        }
        
        // Atualizar campos do modal de edição de propriedade
        document.getElementById('propertyName').value = propriedade.nome_propriedade || '';
        document.getElementById('propertyArea').value = propriedade.area_total || '';
        document.getElementById('propertyState').value = estado;
        document.getElementById('propertyCity').value = cidade;
    }
}
