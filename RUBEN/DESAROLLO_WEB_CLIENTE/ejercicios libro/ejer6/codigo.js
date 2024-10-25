var letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];

var DNI = Number(prompt("Introduzca el numero del dni"));
var letra = prompt("introduzca la letra: ");

if(DNI < 0 || DNI > 99999999){
    alert("el numero introducido no es valido")
} else{
    let resto = DNI % 23;

    alert(letras[resto]);

    if(letras[resto] == letra){
        alert("el numero y la letra de DNI son correctos");
    } else{
        alert("el numero y la letra de DNI  no son correctos");
    }
}

