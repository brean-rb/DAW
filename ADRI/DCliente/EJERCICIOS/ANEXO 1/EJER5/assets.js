var precio = parseFloat(prompt("Introduce el precio de un articulo"));

const IVA = 0.21;
var precio_t = precio + (precio * IVA);

alert("El precio sin IVA es de: " + precio.toFixed(2) + " se le aplica el IVA del 21%, el cual es: " + IVA + " por lo que el precio total es de: " + precio_t.toFixed(2));