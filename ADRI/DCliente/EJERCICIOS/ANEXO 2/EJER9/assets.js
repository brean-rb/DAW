var vocales = ['a','e','i','o','u'];
var cadena = prompt("Introduzca una frase solida:");
var palabras =cadena.split("");
for (let i = 0; i < palabras.length; i++) {
    let letra = palabras[i];
        for (let j = 0; j < vocales.length; j++) {
            if(letra == vocales[j]){
                document.write(letra)
            }
            
        }
    }  
