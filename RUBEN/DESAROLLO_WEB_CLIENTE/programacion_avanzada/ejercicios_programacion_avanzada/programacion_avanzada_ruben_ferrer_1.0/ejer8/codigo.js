var num1 = Number(prompt("introduce un numero:"))
var num2 = Number(prompt("introduzce un numero:"))

var confirmar =false;

while(!confirmar){
    var option = Number(prompt("1: sumar, 2: restar, 3: dividir, 4: multiplicar, 5:calcular cociente, 6: calcular porcentaje" ));
    confirmar = confirm("estas seguro de que quires hacer esta operacion");
}

switch (option) {
    case 1:
        document.write(num1 + " + " + num2 + " = " +(num1 + num2));
        break;
    
    case 2:
        document.write(num1 + " - " + num2 + " = " + (num1 - num2));
        break;

    case 3:
        document.write(num1 + " / " + num2 + " = " +(num1 / num2));
        break;

    case 4:
        document.write(num1 + " * " + num2 + " = " +(num1 * num2));
        break;

    case 5:
        document.write(num1 + " % " + num2 + " = " +(num1 % num2));
        break;

    case 6:
        document.write("el porcentaje de " + num1 + " y " + num2 + " = " + ((num1 / num2) * 100) + " %");
        break;

    default:
        break;
}