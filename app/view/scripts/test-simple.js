// Teste simples para verificar se o formulário funciona
console.log('Script de teste carregado');

// Aguardar o DOM carregar
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM carregado');
    
    // Verificar se o formulário existe
    const form = document.getElementById('propertyForm');
    if (form) {
        console.log('✅ Formulário encontrado');
        
        // Adicionar event listener simples
        form.addEventListener('submit', function(e) {
            console.log('🚀 Formulário sendo enviado!');
            
            // Não prevenir o envio - deixar ir normalmente
            console.log('📤 Enviando formulário...');
        });
        
    } else {
        console.error('❌ Formulário NÃO encontrado!');
    }
    
    // Verificar se os campos existem
    const campos = ['propertyName', 'propertyArea', 'propertyState', 'propertyCity'];
    campos.forEach(campo => {
        const elemento = document.getElementById(campo);
        if (elemento) {
            console.log('✅ Campo', campo, 'encontrado');
        } else {
            console.error('❌ Campo', campo, 'NÃO encontrado!');
        }
    });
});
