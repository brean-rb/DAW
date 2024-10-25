var vocales = ['a','e','i','o','u'];
var cadena = prompt("Introduzca una frase solida:");
var palabras =cadena.split("");
var contador = 0;
for (let i = 0; i < palabras.length; i++) {
    let letra = palabras[i];
        for (let j = 0; j < vocales.length; j++) {
            if(letra == vocales[j]){
                contador++;
            }
            
        }
    }  
    document.write("En la frase: " + cadena + "<br>"+ "aparecen " + contador + " vocales")
