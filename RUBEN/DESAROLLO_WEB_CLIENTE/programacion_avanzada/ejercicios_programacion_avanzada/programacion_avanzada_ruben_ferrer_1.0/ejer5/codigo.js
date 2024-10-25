var num = Number(prompt("introduzca un numero"));
var acum = "";

for (let i = 1; i <=num; i+=2) {
    acum += i;

    document.write(acum + "<br>");
}