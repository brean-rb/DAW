/**
 * Escribir un programa en el que se pregunte al usuario por una frase y una letra, y muestre
por pantalla el número de veces que aparece la letra en la frase .
 */

var frase = prompt("escriba una frase: ");
var letra = prompt("escriba una letra");
var contador =0;

var frase_lower = frase.toLowerCase();
var letra_lower = letra.toLowerCase();

var frase_array = frase_lower.split("");


for(let i = 0; i < frase_array.length; i++){

    if(frase_array[i]== letra_lower){
        contador++;
    }

}

document.write("frase: " + frase + "<br>");
document.write("la letra: " + letra + " aparece en la frase: " + contador);