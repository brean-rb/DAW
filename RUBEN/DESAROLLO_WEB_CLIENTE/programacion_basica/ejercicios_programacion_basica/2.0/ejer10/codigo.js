var vocales = ['a', 'e', 'i', 'o', 'u'];
var cadena = prompt("escriba una frase: ".toLowerCase());
var contador = 0;

for(let i = 0; i < cadena.length; i++){
    for (let j = 0; j < vocales.length; j++){
        if(cadena[i] == vocales[j]){
            contador++;
        }
    }
}

document.write("la frase con tiene " + contador + " voacales");