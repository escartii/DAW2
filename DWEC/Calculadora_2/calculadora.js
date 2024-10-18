document.addEventListener('keydown', function(event) {
    const key = event.key;
    const operadores = ['/', '*', '-', '+', '%'];

    if (!isNaN(key) || key === '.') {
        agregarValor(key);
    }

    if (operadores.includes(key)) {
        agregarOperacion(key);
    }

    if (key === 'Enter') {
        calcularResultado();
    }

    if (key === 'Backspace') {
        borrarUltimo();
    }

    if (key === 'Escape') {
        borrarPantalla();
    }
});

function agregarValor(valor) {
    const pantalla = document.querySelector('.pantalla input');
    const ultimoCaracter = pantalla.value.slice(-1);

    if (valor === '.' && ultimoCaracter === '.') {
        return;
    }

    if (pantalla.value === '0' && valor === '0') {
        return;
    }

    if (pantalla.value === '0' && valor !== '.') {
        pantalla.value = valor;
    } else {
        pantalla.value += valor;
    }
}

function agregarOperacion(operador) {
    const pantalla = document.querySelector('.pantalla input');
    const ultimoCaracter = pantalla.value.slice(-1);
    const operadores = ['/', '*', '-', '+', '%'];

    if (operadores.includes(ultimoCaracter)) {
        return;
    }

    if (pantalla.value === '0' && operador !== '-') {
        return;
    }

    if (pantalla.value === '0' && operador === '-') {
        pantalla.value = operador;
    } else {
        pantalla.value += operador;
    }
}

function agregarParentesis() {
    const pantalla = document.querySelector('.pantalla input');
    pantalla.value = '(' + pantalla.value + ')';
}

function borrarPantalla() {
    const pantalla = document.querySelector('.pantalla input');
    pantalla.value = '0';
}

function borrarUltimo() {
    const pantalla = document.querySelector('.pantalla input');
    pantalla.value = pantalla.value.slice(0, -1);
    if (pantalla.value === '') {
        pantalla.value = '0';
    }
}

function calcularResultado() {
    const pantalla = document.querySelector('.pantalla input');
    try {
        let expression = pantalla.value;
        expression = expression.replace(/x/g, '*');
        expression = expression.replace(/(\d+(\.\d+)?)%/g, '($1/100)');
        let resultado = eval(expression);
        pantalla.value = parseFloat(resultado.toPrecision(10));
    } catch (error) {
        pantalla.value = 'Error';
    }
}
