function esPalindromo(cadena) {
    var cadenaLimpia = cadena.toLowerCase();

    var cadenaInvertida = cadenaLimpia.split('').reverse().join('');

    return cadenaLimpia == cadenaInvertida;
}

var frase = prompt("introduzca una frase")

if (esPalindromo(frase)) {
    document.write("La cadena es un palíndromo.");
} else {
    document.write("La cadena no es un palíndromo.");
}
