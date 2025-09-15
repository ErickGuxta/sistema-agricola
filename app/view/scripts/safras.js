// JavaScript para a página safras.php

// Função para abrir o modal
function openModal() {
    const modal = document.getElementById("modal-overlay")
    modal.classList.add("active")
    document.body.style.overflow = "hidden"
}

// Função para fechar o modal
function closeModal() {
    const modal = document.getElementById("modal-overlay")
    modal.classList.remove("active")
    document.body.style.overflow = "auto"

    // Limpar o formulário
    document.querySelector(".safra-form").reset()
}

// Fechar modal com ESC
document.addEventListener("keydown", (event) => {
    if (event.key === "Escape") {
        closeModal()
    }
})

// Função para formatar data no padrão brasileiro
function formatDate(dateString) {
    if (!dateString) return ""
    const date = new Date(dateString)
    return date.toLocaleDateString("pt-BR")
}

// Função para abrir o modal de edição
function openEditModal(id, nome, dataInicio, dataFim, areaHectare, status, descricao) {
    // Preencher os campos do formulário de edição
    document.getElementById('edit_id_safra').value = id;
    document.getElementById('edit_nome').value = nome;
    document.getElementById('edit_dataInicio').value = dataInicio;
    document.getElementById('edit_dataTermino').value = dataFim;
    document.getElementById('edit_area_hectare').value = areaHectare;
    document.getElementById('edit_status').value = status;
    document.getElementById('edit_descricao').value = descricao;
    // Garantir que o campo hidden não será resetado antes do submit
    const form = document.querySelector('#edit-modal-overlay .edit-form');
    form.addEventListener('submit', function(e) {
        if (!document.getElementById('edit_id_safra').value) {
            e.preventDefault();
            alert('Erro: ID da safra não encontrado. Tente novamente.');
        }
    }, { once: true });
    // Abrir o modal
    const modal = document.getElementById("edit-modal-overlay");
    modal.classList.add("active");
    document.body.style.overflow = "hidden";
}

// Função para fechar o modal de edição
function closeEditModal() {
    const modal = document.getElementById("edit-modal-overlay")
    modal.classList.remove("active")
    document.body.style.overflow = "auto"

    // Limpar o formulário
    document.querySelector("#edit-modal-overlay .edit-form").reset()
}

// Fechar modal de edição com ESC
document.addEventListener("keydown", (event) => {
    if (event.key === "Escape") {
        closeEditModal()
    }
})