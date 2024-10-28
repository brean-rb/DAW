function comprovar(cadena){
    if(cadena == cadena.toUpperCase()){
        document.write("la cadena esta en mayusculas");

    } else if(cadena == cadena.toLowerCase()){
        document.write("la cadena esta en minusculas");

    } else{
        document.write("la cadena tiene mausculs y minisculas");
    }
}

var cad = prompt("introduzca una palabra");

var resultado = comprovar(cad);

