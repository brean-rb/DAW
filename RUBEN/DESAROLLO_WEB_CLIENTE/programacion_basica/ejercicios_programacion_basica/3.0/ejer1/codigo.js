
var sueldo = Number(prompt("introduzca el sueldo: "));
var antiguedad = Number(prompt("introduzca la antiguedad"));

if((sueldo < 500) && (antiguedad >= 10)){
    sueldo *= 3;

    document.write("su sueldo ahora es de " + sueldo);

} else if((sueldo < 500) && (antiguedad < 10)){
    sueldo *= 2;
    document.write("su sueldo ahora es de: " + sueldo);

} else {
    document.write("su sueldo es de " + sueldo);
}

