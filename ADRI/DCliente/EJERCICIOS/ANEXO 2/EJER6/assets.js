numeros = [];

for (let i = 0; i < 6; i++) {
    numeros[i] = Number(prompt("Introduzca un numero: "));
}
var ordenado =  numeros.sort();

document.write("El mayor es: " + numeros[4] + " y el menor: " + numeros[0]);