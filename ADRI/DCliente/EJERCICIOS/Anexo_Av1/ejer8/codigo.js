var num1 = Number(prompt("Introduce el primer operando: "));
var num2 = Number(prompt("Introduce el segundo operando: "));
var operacion;
var confirmar = false;
while (!confirmar) {
    operacion = Number(prompt("¿Qué operación deseas realizar?\n1. Sumar\n2. Restar\n3. Dividir\n4. Multiplicar\n5. Resto\n6. Porcentaje"));
    confirmar = confirm("¿Estás seguro?");
}
switch (operacion) {
    case 1:
        document.write(num1 + " + " + num2 + " = " + (num1 + num2));
        break;
    case 2:
        document.write(num1 + " - " + num2 + " = " + (num1 - num2));
        break;
    case 3:
        document.write(num1 + " / " + num2 + " = " + (num1 / num2));
        break;
    case 4:
        document.write(num1 + " * " + num2 + " = " + (num1 * num2));
        break;
    case 5:
        document.write(num1 + " % " + num2 + " = " + (num1 % num2));
        break;
    case 6:
        document.write(num1 + " es el " + ((num1 / num2) * 100) + "% de " + num2);
        break;
    default:
        document.write("Operación no válida.");
        break;
}
