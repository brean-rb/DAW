var cadena = prompt("introduzca una frase");

document.write("la longitud de la cadena es: " + cadena.length + "<br>");
document.write("la cadena en mayusculas es: " + cadena.toUpperCase() + "<br>")
document.write("la cadena en minusculas: " + cadena.toLowerCase() + "<br>")


var cadena_normal = cadena.split(" ");

for(var i = 0; i < cadena_normal.length; i++){
    document.write(cadena_normal[i] + "<br>");
}

var cadena_inver = cadena_normal.reverse();

for(var i = 0; i < cadena_inver.length; i++){
    document.write(cadena_inver[i] + "<br>");
}

