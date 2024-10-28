/**4.-Escribir un programa que muestre el sumatorio de todos los múltiplos de 3 encontrados
entre el 0 y el 100. */
var contador = 0;

for(var i = 0; i <= 100; i++){
    if (i % 3 == 0){
        contador += i;
    }
}

document.write("el sumatorio es: " + contador);