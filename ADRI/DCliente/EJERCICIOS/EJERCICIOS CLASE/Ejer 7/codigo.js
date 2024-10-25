// Solicitar al usuario que introduzca un número
var numero = Number(prompt("Introduce un número entero para calcular su factorial:"));

// Inicializar el resultado del factorial a 1 (el factorial de 0 o 1 es 1)
var factorial = 1;

// Si el número es negativo, no tiene factorial
if (numero < 0) {
    alert("El factorial no está definido para números negativos.");
} else {
    // Calcular el factorial utilizando un bucle for
    for (var i = 1; i <= numero; i++) {
        factorial *= i; // Multiplicar el valor actual de factorial por i
    }

    // Mostrar el resultado
    alert("El factorial de " + numero + " es " + factorial);
}
