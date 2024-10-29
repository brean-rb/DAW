var nombre1 = prompt("Introduzca un nombre:");
var nombre2 = prompt("Introduzca otro nombre:");

// Obtenemos la primera letra de cada nombre
var primer1_n = nombre1.substring(0, 1);
var primer2_n = nombre2.substring(0, 1);

// Obtenemos la longitud de los nombres
var long1 = nombre1.length;
var long2 = nombre2.length;

var ultim1_n =  nombre1.substring(long1 - 1) 
var ultim2_n =  nombre2.substring(long2 - 1) 

// Comparamos las primeras letras y las últimas letras
if (primer1_n === primer2_n || ultim1_n === ultim2_n) {
    document.write("Es una coincidencia");
} else {
    document.write("No coinciden");
}
