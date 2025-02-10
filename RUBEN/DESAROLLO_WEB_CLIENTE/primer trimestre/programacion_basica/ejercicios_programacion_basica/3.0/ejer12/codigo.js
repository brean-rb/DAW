var num_desplazamientos = Number(prompt("Indica el número de desplazamientos:"));

var alfabeto = [
    'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 
    's', 't', 'u', 'v', 'w', 'x', 'y', 'z'
];

var array_palabras = [];
var array_encriptada = [];

for (let i = 0; i < 5; i++) {
    var palabra = prompt("Escriba la palabra que desea encriptar:");
    array_palabras[i] = palabra.toLowerCase(); 
}

for (let i = 0; i < array_palabras.length; i++) {
    var palabra = array_palabras[i];
    var palabra_encriptada = '';  

    for (let j = 0; j < palabra.length; j++) {
        var letra = palabra[j];
        var indice_actual = -1;

        for (let k = 0; k < alfabeto.length; k++) {
            if (letra == alfabeto[k]) {
                indice_actual = k;
                break;
            }
        }

        if (indice_actual != -1) {
            var nuevo_indice = (indice_actual + num_desplazamientos) % alfabeto.length;
            palabra_encriptada += alfabeto[nuevo_indice]; 
        } else {
            palabra_encriptada += letra;
        }
    }

    array_encriptada[i] = palabra_encriptada;
}

for (let i = 0; i < array_encriptada.length; i++) {
    document.write("Palabra original: " + array_palabras[i] + " -> Palabra encriptada: " + array_encriptada[i] + "<br>");
}
