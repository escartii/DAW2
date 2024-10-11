let operacion = '';

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
        pantalla.value = '(((Error)))';
        operacion = '';
    }

    if (pantalla.value = "Infinity") {
        pantalla.value = "(((Error)))";
        alert("No puedes dividir por cero")
    }
}