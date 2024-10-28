var cadena = prompt("escriba una frase");
var i = 1;

while (i <= cadena.length) {
    document.write("letra" + i  + " :" +cadena.charAt(i-1) + "<br>");
    i++;
}