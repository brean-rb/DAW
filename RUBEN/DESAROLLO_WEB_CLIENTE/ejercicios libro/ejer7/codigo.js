
var numero = Number(prompt("introduzca un numero y calcularemos el factorial"));
var valor = 1;
for (let i = 1; i <= numero; i++) {
    valor = valor * i;
    // alert(numero + " * " + i + " = " + valor);
}
alert("el factorial es: " + valor);
