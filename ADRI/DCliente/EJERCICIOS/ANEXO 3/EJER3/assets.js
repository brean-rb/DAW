var choras = Number(prompt("Introduzca la cantidad de horas realizadas:"));
var precio = Number(prompt("Introduzca el precio de la hora trabajada:"));
var salario=0;
var impuesto =0;

var cantidad = choras - 35;

var salarioT = cantidad * (choras * 1.5);

if (salarioT <= 500) {
    salarioT = salarioT;
    document.write("Tu salario total es de: " + salarioT);
}else if(salarioT > 500 && salarioT <= 900){
    var menor = salarioT - 500;
    var medio = menor - (0.25 * salarioT);
    document.write("Tu salario total es de: " + medio);

} else if (salario > 900) {
    var menor = salarioT - 500;
    var medio = menor - (0.25 * salarioT);
    var inferior = medio - (0.45 *salarioT) 
    document.write("Tu salario total es de: " + inferior);
}
document.write(salarioT)
