var numeros =[];
var sumatorion =0;
var sumatoriop =0;
var contpositiv =0;
for (let i = 0; i < 6; i++) {
    numeros[i]= Number(prompt("Introduce un numero"));

    if (numeros[i] < 0) {
        sumatorion+=numeros[i] ;
    }if (numeros[i] >= 0) {
        contpositiv++;
        sumatoriop += numeros[i];
    }
}
var promedio =0;
if(isNaN(sumatoriop/contpositiv)){
    document.write("No se puede dividir por 0 <br>");
}else{
    promedio = sumatoriop/contpositiv;
}

document.write("El sumatorio de los numeros negativos es: " + sumatorion + "<br>");
document.write("El promedio de los numeros positivos es: " + promedio)
