var precio = parseFloat(prompt("introduzca el precio"));

const IVA = 0.21;

var precio_total = precio + (precio * IVA);

alert("el precio con iva es: " + precio_total.toFixed(2));