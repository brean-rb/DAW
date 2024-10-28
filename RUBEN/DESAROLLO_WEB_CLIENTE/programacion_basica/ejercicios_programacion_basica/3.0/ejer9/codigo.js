var cantidad = 0;
var suma = 0;

var sumatorio = 0;



for(let i = 1; i <= 6; i++){
    let num = Number(prompt("escriba un numero:"));

    if(num >= 0){
        cantidad ++;
        suma += num;

    } else {
        sumatorio += num;
    }
}

if(cantidad > 0){
    document.write("El promedio de los números positivos es: " + (suma / cantidad) + "<br>");
} else {
    document.write("No se ingresaron números positivos.<br>");
}
document.write("el sumatorio de los numero negativos es: " + sumatorio);