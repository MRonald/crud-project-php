// Máscara de CPF
const inputCpf = document.getElementById('cpf');
const inputMoneyValue = document.getElementById('valueMoney');

if (inputCpf !== null) {
    inputCpf.addEventListener('input', (event) => {
        event.target.value = formatCpf(event.target.value);
    });
}
if (inputMoneyValue !== null) {
    inputMoneyValue.addEventListener('input', (event) => {
        event.target.value = formatMoneyValue(event.target.value);
    });
}

function formatCpf(value) {
    return value
        .replace(/\D/g, '')
        .replace(/(\d{3})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d{1,2})/, '$1-$2')
        .replace(/(-\d{2})\d+?$/, '$1');
}

function formatMoneyValue(valueMoney) {
    valueMoney = parseInt(valueMoney.replace(/\D/g, '')).toString();
    let formatedValue = '';
    if (valueMoney === '0' || valueMoney === 'NaN') {
        formatedValue = '';
    } else if (valueMoney.length === 1) {
        formatedValue += '00' + valueMoney;
    } else if (valueMoney.length === 2) {
        formatedValue += '0' + valueMoney;
    } else {
        formatedValue = valueMoney;
    }
    if (formatedValue.length > 0) {
        const lastTwo = formatedValue.substr(-2);
        const resto = formatedValue.substr(0, formatedValue.length - 2);
        formatedValue = resto + ',' + lastTwo;
        if (formatedValue.length >= 7) {
            const lastSix = formatedValue.substr(-6);
            const resto = formatedValue.substr(0, formatedValue.length - 6);
            formatedValue = resto + '.' + lastSix;
        }
        formatedValue = 'R$ ' + formatedValue;
    }
    return formatedValue;
}
