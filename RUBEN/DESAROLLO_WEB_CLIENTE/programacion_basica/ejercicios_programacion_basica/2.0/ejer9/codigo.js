var vocales = ['a', 'e', 'i', 'o', 'u'];
var cadena = prompt("escriba una frase: ".toLowerCase());


for(let i = 0; i < cadena.length; i++){
    var letra = cadena[i];

    for(let j = 0 ; j < vocales.length; j++){
        if(cadena[i] == vocales[j]){
            document.write(letra + " ")
        }
    }
}