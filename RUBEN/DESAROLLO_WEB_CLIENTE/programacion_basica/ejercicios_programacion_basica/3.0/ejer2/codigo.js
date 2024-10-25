
var num1 = Number(prompt("introduzca que numero quiere multiplicar: "));
var num2 = Number(prompt("introduzca cuantas veces lo quieres multilicar"));

for(let i = 1; i <= num2; i++){
    document.write(num1 + " * " + i + " = " + (num1 * i) + "<br>");
}