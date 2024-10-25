var numero = prompt("introduzca un numero");
var simbolo = "*"
var acumulador = "";

for(let i = 0; i <= numero; i++){
    acumulador += simbolo;

    document.write(acumulador + "<br>");
}