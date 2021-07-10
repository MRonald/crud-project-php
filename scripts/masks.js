// Máscara de CPF
const inputCpf = document.getElementById('cpf');

inputCpf.addEventListener('input', (event) => {
    event.target.value = formatCpf(event.target.value);
});

function formatCpf(value) {
    return value
        .replace(/\D/g, '')
        .replace(/(\d{3})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d{1,2})/, '$1-$2')
        .replace(/(-\d{2})\d+?$/, '$1');
}
