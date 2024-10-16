document.addEventListener('DOMContentLoaded', function () {
    const botones = document.querySelectorAll('.boton');
    const pantalla = document.querySelector('.pantalla input');
    let operacionActual = '';
    let resultadoMostrado = false;

    // Función para actualizar la pantalla
    const actualizarPantalla = (valor) => {
        const operadores = '+-*/';
        
        if (resultadoMostrado && operadores.includes(valor)) {
            // Si ya se mostró el resultado y el valor es un operador, añade el operador al resultado
            operacionActual += valor;
            resultadoMostrado = false;
        } else if (resultadoMostrado) {
            // Si ya se mostró el resultado y el valor es un número, sobrescribe la pantalla
            operacionActual = valor;
            resultadoMostrado = false;
        } else {
            operacionActual += valor;
        }

        pantalla.value = operacionActual;
    };

    // Función para calcular el resultado
    const calcular = () => {
        try {
            operacionActual = operacionActual.replace(/x/g, '*').replace(/÷/g, '/');
            const resultado = eval(operacionActual);
            pantalla.value = resultado;
            operacionActual = resultado.toString();
            resultadoMostrado = true;
        } catch (error) {
            pantalla.value = 'Error';
        }
    };

    // Función para manejar los botones
    const manejarBoton = (valor) => {
        switch (valor) {
            case 'C':
                operacionActual = '';
                pantalla.value = '0';
                break;
            case '=':
                calcular();
                break;
            case '«':
                operacionActual = operacionActual.slice(0, -1);
                pantalla.value = operacionActual || '0';
                break;
            case '%':
                operacionActual += '/100';
                pantalla.value = operacionActual;
                break;
            default:
                actualizarPantalla(valor);
                break;
        }
    };

    // Asignar evento click a los botones
    botones.forEach((boton) => {
        boton.addEventListener('click', () => {
            manejarBoton(boton.textContent.trim());
        });
    });

    // Función para manejar entradas del teclado
    const manejarTeclado = (e) => {
        const teclasPermitidas = '0123456789+-*/.%()';
        if (teclasPermitidas.includes(e.key)) {
            actualizarPantalla(e.key);
        } else if (e.key === 'Enter') {
            calcular();
        } else if (e.key === 'Backspace') {
            manejarBoton('«');
        } else if (e.key === 'Escape') {
            manejarBoton('C');
        }
    };

    // Asignar evento para el teclado
    document.addEventListener('keydown', manejarTeclado);
});
