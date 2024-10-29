var num1 = Number(prompt("Introduzca el numero que desee saber su tabla de multiplicacion:"));
var num2 = Number(prompt("Introduzca el limite de calculo de la tabla:"));
for (let i = 1; i <= num2; i++) {
    document.write(num1 + " x " + i + " = " + (num1*i) + "<br>");    
}
