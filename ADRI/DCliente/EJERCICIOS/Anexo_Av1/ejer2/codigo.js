var cadena = prompt("Introduce una cadena:");
var cadtoLower = cadena.toLowerCase();
var cadlista = cadtoLower.split("");
var letra = prompt("Introduzca la letra que desea calcular la cantidad de apariciones");
var letratoLower = letra.toLowerCase();
var contador=0;
for (let i = 0; i < cadlista.length; i++) {
    if (cadlista[i] == letra) {
        contador++;
    }
}
document.write("La letra '" +letra+"' aparece: " + contador + " veces" );