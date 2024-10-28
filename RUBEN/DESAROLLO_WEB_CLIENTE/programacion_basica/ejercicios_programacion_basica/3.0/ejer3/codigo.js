
var horas = Number(prompt("introduzca el numero de horas:; "));
var precio_hora = Number(prompt("introduzca el precio por hora"));
var salario = 0;
var impuestos = 0;


if (horas > 35){
    var resto_horas = horas - 35;

    var suma_resto_horas = resto_horas  * (precio_hora * 1.5);
    var suma_horas = 35 * precio_hora;

    salario = suma_horas + suma_resto_horas;

} else {
    salario = precio_hora * horas;
}

if (salario <= 500){
    salario = salario;

} else if ((salario > 500) && (salario <= 900)){
    impuestos = (salario - 500) * 0.25;

} else {
    impuestos = 400 * 0.25 + (salario - 900) * 0.45;
}

salario -= impuestos;

document.write("su salario sera de: " + salario);