// JavaScript para a página home.php

// Modal functions
function openProfileModal() {
    console.log('openProfileModal chamada');
    const modal = document.getElementById('profileModal');
    if (modal) {
        modal.style.display = 'block';
        console.log('Modal aberto');
        // Load current data (in a real application, this would come from the server)
        loadCurrentData();
    } else {
        console.error('Modal profileModal não encontrado!');
    }
}

function closeProfileModal() {
    document.getElementById('profileModal').style.display = 'none';
}

// Tab switching
function showTab(tabName) {
    console.log('showTab chamada com:', tabName);
    
    // Hide all tabs
    const tabs = document.querySelectorAll('.tab-content');
    tabs.forEach(tab => tab.classList.remove('active'));

    // Remove active class from all buttons
    const buttons = document.querySelectorAll('.tab-button');
    buttons.forEach(button => button.classList.remove('active'));

    // Show selected tab
    const targetTab = document.getElementById(tabName + '-tab');
    if (targetTab) {
        targetTab.classList.add('active');
        console.log('Tab', tabName, 'ativada');
        
        // Se for a tab de propriedade, recarregar os dados
        if (tabName === 'property') {
            console.log('Recarregando dados da propriedade...');
            loadCurrentData();
        }
    } else {
        console.error('Tab', tabName + '-tab', 'não encontrada!');
    }

    // Add active class to clicked button
    if (event && event.target) {
        event.target.classList.add('active');
    }
}

// Load current data (placeholder function)
function loadCurrentData() {
    console.log('loadCurrentData chamada');
    console.log('window.sessionData:', window.sessionData);
    console.log('window.propriedadesData:', window.propriedadesData);
    
    // Verificar se os dados existem
    if (!window.sessionData) {
        console.error('window.sessionData não existe!');
        return;
    }
    
    if (!window.propriedadesData) {
        console.error('window.propriedadesData não existe!');
        return;
    }
    
    if (!Array.isArray(window.propriedadesData)) {
        console.error('window.propriedadesData não é um array!', typeof window.propriedadesData);
        return;
    }
    
    console.log('Número de propriedades:', window.propriedadesData.length);
    
    // In a real application, you would fetch this data from the server
    // For now, we'll use placeholder values
    const userName = document.getElementById('userName');
    const userEmail = document.getElementById('userEmail');
    
    if (userName) userName.value = window.sessionData?.usuario_nome || '';
    if (userEmail) userEmail.value = window.sessionData?.usuario_email || '';
    
    // Carregar dados da propriedade atualmente selecionada
    const currentPropertyId = window.sessionData?.propriedade_id || null;
    console.log('ID da propriedade atual:', currentPropertyId);
    
    if (currentPropertyId) {
        updatePropertyModalData(currentPropertyId);
    } else {
        console.log('Nenhuma propriedade selecionada');
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

// Verificar se o formulário existe antes de adicionar o event listener
const propertyForm = document.getElementById('propertyForm');
if (propertyForm) {
    console.log('Formulário propertyForm encontrado, adicionando event listener');
    propertyForm.addEventListener('submit', function(e) {
        console.log('Formulário de propriedade sendo enviado...');
        
        const area = document.getElementById('propertyArea').value;
        console.log('Área:', area);
        
        if (area && area < 0) {
            e.preventDefault();
            alert('A área deve ser um valor positivo!');
            return;
        }

        // Validar se todos os campos obrigatórios estão preenchidos
        const nome = document.getElementById('propertyName').value;
        const estado = document.getElementById('propertyState').value;
        const cidade = document.getElementById('propertyCity').value;
        
        console.log('Dados do formulário:', { nome, estado, cidade, area });
        
        if (!nome || !estado || !cidade || !area) {
            e.preventDefault();
            alert('Todos os campos são obrigatórios!');
            console.log('Formulário bloqueado - campos obrigatórios não preenchidos');
            return;
        }

        console.log('Formulário será enviado normalmente');
        // Se chegou até aqui, permitir o envio do formulário
        // O formulário será enviado normalmente via POST
    });
} else {
    console.error('Formulário propertyForm NÃO encontrado!');
}

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
    console.log('updatePropertyModalData called with ID:', propriedadeId);
    console.log('propriedadesData:', propriedadesData);
    
    // Verificar se propriedadesData existe e é um array
    if (!propriedadesData || !Array.isArray(propriedadesData)) {
        console.error('propriedadesData não é um array válido!', propriedadesData);
        return;
    }
    
    const propriedade = propriedadesData.find(p => p.id_propriedade == propriedadeId);
    console.log('Propriedade encontrada:', propriedade);
    
    if (propriedade) {
        // Separar estado e cidade da localização
        let estado = '';
        let cidade = '';
        if (propriedade.localizacao && propriedade.localizacao.includes(' - ')) {
            [estado, cidade] = propriedade.localizacao.split(' - ');
        }
        
        console.log('Estado:', estado, 'Cidade:', cidade);
        
        // Verificar se os elementos existem antes de atualizar
        const propertyName = document.getElementById('propertyName');
        const propertyArea = document.getElementById('propertyArea');
        const propertyState = document.getElementById('propertyState');
        const propertyCity = document.getElementById('propertyCity');
        
        if (propertyName) {
            propertyName.value = propriedade.nome_propriedade || '';
            console.log('propertyName atualizado:', propertyName.value);
        } else {
            console.error('Elemento propertyName não encontrado!');
        }
        
        if (propertyArea) {
            propertyArea.value = propriedade.area_total || '';
            console.log('propertyArea atualizado:', propertyArea.value);
        } else {
            console.error('Elemento propertyArea não encontrado!');
        }
        
        if (propertyState) {
            propertyState.value = estado;
            console.log('propertyState atualizado:', propertyState.value);
        } else {
            console.error('Elemento propertyState não encontrado!');
        }
        
        if (propertyCity) {
            propertyCity.value = cidade;
            console.log('propertyCity atualizado:', propertyCity.value);
        } else {
            console.error('Elemento propertyCity não encontrado!');
        }
        
        console.log('Campos atualizados com sucesso');
    } else {
        console.log('Propriedade não encontrada!');
        console.log('Propriedades disponíveis:', propriedadesData.map(p => ({ id: p.id_propriedade, nome: p.nome_propriedade })));
    }
}
