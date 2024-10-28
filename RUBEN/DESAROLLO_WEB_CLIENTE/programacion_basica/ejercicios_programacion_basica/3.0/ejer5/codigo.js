/** Escribir un programa que solicite al usuario una letra y, si es una vocal, muestre el mensaje
“es vocal”. Se debe validar que el usuario ingrese sólo un carácter. Si ingresa un string de más
de un carácter, informarle que no se puede procesar el dato.*/

var vocales = ['a', 'e', 'i', 'o', 'u' , 'A', 'E', 'I', 'O', 'U'];

var cadena = prompt("introduzca un caracter:");

var verificacion = false;

if(cadena.length == 1){
    for(var i = 0; i < vocales.length; i++){
        if(cadena == vocales[i]){
            verificacion = true;
            break;
        } else {
            verificacion = false;
        }
    }

    if(verificacion){
        document.write("es una vocal");
    } else {
        document.write("no es una vocal");
    }

} else {
    document.write("la cadena tiene ma sde un caracters")
}