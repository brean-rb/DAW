var vocales = ['a', 'e', 'i', 'o', 'u'];
var contador_vocales = [0, 0, 0, 0, 0];

var cadena = prompt("introduzca una frase");
var cadena_lower = cadena.toLowerCase();

for(let i = 0; i < cadena_lower.length; i++){
    for(let j = 0 ; j < vocales.length; j++){
        if(cadena_lower[i] == vocales[j]){
            contador_vocales[j]++;
        }
    }
}

document.write("la frase: " + cadena + "<br>");

for(let k = 0 ; k < vocales.length; k++){
    document.write("contiene " + contador_vocales[k] + " " + vocales[k] + "<br>");
}