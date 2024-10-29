var numero = Number(prompt("Introduzca un numero"));
    for (let i = 1; i <= numero; i++) {
        if (numero % i == 0) {
            document.write(i + " Es divisor de " + numero + "<br>")
        }
    }


