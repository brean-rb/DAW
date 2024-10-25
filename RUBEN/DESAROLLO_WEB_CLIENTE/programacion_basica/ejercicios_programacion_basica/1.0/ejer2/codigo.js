var numero = [7, 8, 2, 9, 10];
var suma = 0;

for(var i in numero){
    if (numero[i] > 8){
        suma += numero[i];
    }
}

alert(suma)