function par_impar(num){
    if(num % 2 == 0){
        document.write("es par");

    } else {
        document.write("es impar");
    }
}

var numero = Number(prompt("introduzca un numero:"));

var resultado = par_impar(numero);
