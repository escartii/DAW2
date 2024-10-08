let operacion = '';

// Función para agregar un valor (número o paréntesis) a la pantalla
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

// Función para agregar una operación
function agregarOperacion(operador) {
    const pantalla = document.querySelector('.pantalla input');
    pantalla.value += operador;
    operacion += operador;
}

// Función para borrar toda la pantalla
function borrarPantalla() {
    const pantalla = document.querySelector('.pantalla input');
    pantalla.value = '0';
    operacion = '';
}

// Función para borrar el último carácter
function borrarUltimo() {
    const pantalla = document.querySelector('.pantalla input');
    pantalla.value = pantalla.value.slice(0, -1);
    operacion = operacion.slice(0, -1);
    if (pantalla.value === '') {
        pantalla.value = '0';
    }
}

// Función para calcular el resultado de la operación
function calcularResultado() {
    const pantalla = document.querySelector('.pantalla input');
    try {
        let resultado = eval(pantalla.value.replace('x', '*')).toFixed(2);
        pantalla.value = resultado;
    } catch (error) {
        pantalla.value = '(((Error)))';
        operacion = '';
    }
}