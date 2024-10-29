var vocales = ['a','e','i','o','u'];
var contador_vocales = [0, 0, 0 , 0 , 0];
var cadena = prompt("Introduzca una frase solida:");
var cadena_minus = cadena.toLowerCase();
var palabras =cadena_minus.split("");


for (let i = 0; i < palabras.length; i++) {
    let letra = palabras[i];
        for (let j = 0; j < vocales.length; j++) {
          if (letra == vocales[j]) {
            contador_vocales[j]++;
          }
    }  
}
document.write("La frase: " + cadena + "<br>");
for(let k = 0; k < vocales.length; k++){
    document.write("contiene " + contador_vocales[k] + " " + vocales[k] + "<br>");
}

