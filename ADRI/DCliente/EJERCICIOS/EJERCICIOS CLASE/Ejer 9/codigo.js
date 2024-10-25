function analizarCadena(cadena) {
   if (cadena === cadena.toUpperCase()) {
     console.log("La cadena está formada solo por mayúsculas.");
   } else if (cadena === cadena.toLowerCase()) {
     console.log("La cadena está formada solo por minúsculas.");
   } else {
     console.log("La cadena contiene una mezcla de mayúsculas y minúsculas.");
   }
 }
 
var cadena = prompt("Introduce una cadena: ")
 analizarCadena(cadena);  // La cadena está formada solo por mayúsculas.
 