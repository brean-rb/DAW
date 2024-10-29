var numero = Number(prompt("Introduzca un numero:"));
var esPrimo = true;

if (numero <= 1) {
    esPrimo = false;
}else{
    for (let i = 2; i < numero; i++) {
        if (numero % i == 0) {
            esPrimo = false;
        }
    }
}

if (esPrimo) {
    document.write(numero + " Es un numero primo");
}else{
    document.write(numero + " No es un numero primo");
}