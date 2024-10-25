function esPalindromo(cadena) {
   let cadenaLimpia = cadena.toLowerCase();
 
   let cadenaInvertida = cadenaLimpia.split('').reverse().join('');
 
   if (cadenaLimpia === cadenaInvertida) {
     console.log("La cadena es un palíndromo.");
   } else {
     console.log("La cadena no es un palíndromo.");
   }
 }
 
var cadena =  prompt("Introduce una cadena: ")

esPalindromo(cadena); 