var cantidad = Number(prompt("Introduzca la altura del triangulo"))
var car = "*";
var acum = "";
for (let i = 0; i <= cantidad; i++) {
    acum += car;
    document.write(acum + "<br>")
}