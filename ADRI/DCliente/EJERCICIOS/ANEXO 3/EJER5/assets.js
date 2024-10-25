var vocales = ['a','e','i','o','u','A','E','I','O','U'];
var caracter = prompt("Introduzca un solo caracter: "); 
var esVocal = false;
if (caracter.length == 1 ) {
    for (let i = 0; i < vocales.length; i++) {
        if (caracter == vocales[i]) {
            esVocal = true;
            break;
        }else{
            esVocal = false;
        }
        
    }if (esVocal) {
            document.write("Es vocal");
        }else{
            document.write("No es vocal");
        }
}else{
    document.write("Solo se debe introducir un caracter de tipo letra");
}