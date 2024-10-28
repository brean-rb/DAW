var suma = 0;

for(var i = 0 ; i < 5 ; i++){
    var numero = Number(prompt("introduzca un numero"))
    suma += numero;
    if (numero > 100) {
        alert("el numero es mayor a 100");
    } else{
        alert("el numeor es menor a 100");
    }
}

alert("la suma de todos los numeros es: " + suma);