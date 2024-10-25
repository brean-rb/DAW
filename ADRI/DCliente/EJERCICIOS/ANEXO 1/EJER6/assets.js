var cadena = prompt("Introduce una frase");
document.write("La longitud de la cadena es: " + cadena.length);
var cad_mayus = cadena.toUpperCase();
document.write(" <br> La cadena en mayusculas es: " +cad_mayus);
var cad_minus = cadena.toLowerCase();
document.write("<br> La cadena en minusculas es: " + cad_minus);
var palabras = cadena.split(" ");
for (let i = 0; i <palabras.length ; i++) {
document.write("<br>" + palabras[i]);   
}
document.write("<br>");
var reves = palabras.reverse();
for (let i = 0; i <reves.length ; i++) {
   document.write("<br>" + reves[i] );   
   }