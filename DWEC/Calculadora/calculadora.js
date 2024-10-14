let operacion = '';

document.addEventListener('keydown', function(event) {
    const key = event.key;
    const operadores = ['/', '*', '-', '+'];

    // Si es un número o un punto
    if (!isNaN(key) || key === '.') {
        agregarValor(key);
    }

    // Si es un operador
    if (operadores.includes(key)) {
        agregarOperacion(key);
    }

    // cuando pulso enter llamo a la función calcularResultado()
    if (key === 'Enter') {
        calcularResultado();
    }
    // borro el último carácter
    if (key === 'Backspace') {
        borrarUltimo();
    }

    if (key === 'Escape') {
        borrarPantalla();
    }
});


function agregarValor(valor) {
    const pantalla = document.querySelector('.pantalla input');
    if (pantalla.value === '0' && valor !== '.') {
        pantalla.value = valor;
    } else {

        if (valor == '()') {
            pantalla.value = "(" + pantalla.value + ")";
        } else {
            pantalla.value += valor;
        }
    }
    operacion += valor;
}

function agregarOperacion(operador) {
    const pantalla = document.querySelector('.pantalla input');
    pantalla.value += operador;
    operacion += operador;
}

function borrarPantalla() {
    const pantalla = document.querySelector('.pantalla input');
    pantalla.value = '0';
    operacion = '';
}

function borrarUltimo() {
    const pantalla = document.querySelector('.pantalla input');
    pantalla.value = pantalla.value.slice(0, -1);
    operacion = operacion.slice(0, -1);
    if (pantalla.value === '') {
        pantalla.value = '0';
    }
}


function calcularResultado() {
    const pantalla = document.querySelector('.pantalla input');
    try {
        let resultado = eval(pantalla.value.replace('x', '*')).toFixed(2);
        pantalla.value = resultado;
    } catch (error) {
        pantalla.value = 'Error';
        operacion = '';
    }
}
