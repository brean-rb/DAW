var numero1 = Number(prompt("Introduzca un numero"));
var numero2 = Number(prompt("Introduzca un numero"));

    for (let i = 1; i <= numero1; i++) {
        for (let j = 1; j < numero2; j++) {
        if ((numero1 % i == 0)&& (numero2 % j == 0)) {
            document.write(i +" y " + j + " Son divisores de " + numero1 + " y de " +numero2 + "<br>")
         }
        }
    }


