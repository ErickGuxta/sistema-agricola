// JavaScript para a página estoque.php

let currentMovementType = null;

// Abrir modal de cadastro
function openCadastroModal() {
    const modal = document.getElementById("modal-overlay");
    modal.classList.add("active");
    document.body.style.overflow = "hidden";
}

// Abrir modal de edição
function openEditModal(id, nome, categoria, quantidade, estoque_minimo, preco, unidade_medida, data_validade) {
    // Remover alert de debug
    console.log('openEditModal', id, nome, categoria, quantidade, estoque_minimo, preco, unidade_medida, data_validade);
    // Preencher os campos
    document.getElementById("edit-product-id").value = id;
    document.getElementById("edit-nome").value = nome;
    document.getElementById("edit-categoria").value = categoria;
    document.getElementById("edit-quantidade").value = quantidade;
    document.getElementById("edit-estoque-minimo").value = estoque_minimo;
    document.getElementById("edit-preco").value = preco;
    document.getElementById("edit-unidade_medida").value = unidade_medida;
    document.getElementById("edit-data-validade").value = data_validade;
    // Abrir modal
    const modal = document.getElementById("edit-modal-overlay");
    modal.classList.add("active");
    document.body.style.overflow = "hidden";
}

// Fechar modal de cadastro
function closeModal() {
    const modal = document.getElementById("modal-overlay");
    modal.classList.remove("active");
    document.body.style.overflow = "auto";
    
    // Limpar formulário
    document.getElementById("product-form").reset();
}

// Fechar modal de edição
function closeEditModal() {
    const modal = document.getElementById("edit-modal-overlay");
    modal.classList.remove("active");
    document.body.style.overflow = "auto";
}

// Abrir modal de movimentação
function openMovementModal(productId, productName = '', currentQuantity = '') {
    document.getElementById("movement-product-id").value = productId;
    document.getElementById("movement-product-name").value = productName;
    document.getElementById("movement-current-quantity").value = currentQuantity;
    
    // Reset form
    document.getElementById("movement-form").reset();
    document.getElementById("movement-product-id").value = productId;
    document.getElementById("movement-product-name").value = productName;
    document.getElementById("movement-current-quantity").value = currentQuantity;
    
    // Reset buttons
    document.querySelectorAll('.movement-btn').forEach(btn => btn.classList.remove('active'));
    document.getElementById("movement-submit-btn").disabled = true;
    currentMovementType = null;

    const modal = document.getElementById("movement-modal-overlay");
    modal.classList.add("active");
    document.body.style.overflow = "hidden";
}

// Fechar modal de movimentação
function closeMovementModal() {
    const modal = document.getElementById("movement-modal-overlay");
    modal.classList.remove("active");
    document.body.style.overflow = "auto";
}

// Selecionar tipo de movimentação
function selectMovementType(type) {
    currentMovementType = type;
    document.getElementById("movement-type").value = type;
    
    // Update button states
    document.querySelectorAll('.movement-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelector(`.movement-btn.${type}`).classList.add('active');
    
    // Enable submit button
    document.getElementById("movement-submit-btn").disabled = false;
    document.getElementById("movement-submit-btn").textContent = 
        type === 'entrada' ? 'Processar Entrada' : 'Processar Saída';
}

// Fechar modals com ESC
document.addEventListener("keydown", function(event) {
    if (event.key === "Escape") {
        closeModal();
        closeEditModal();
        closeMovementModal();
    }
});
