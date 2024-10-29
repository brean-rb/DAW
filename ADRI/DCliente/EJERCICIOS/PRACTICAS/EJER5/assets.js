var dinero = Number(prompt("Introduce el dinero disponible:"));
var fresa = 0.6;
var chocolate= 1;
var Nata = 1.6;
var vainilla= 1.7;
var Mora = 1.8;
var pomelo= 2.9;
var cambio;
if (dinero < 0.6) {
    alert("No puede comprar ningun helado");
}
else if (dinero >= 0.6 && dinero < 1) {
    cambio = dinero -fresa;
    alert("Puede comprar el helado de fresa");
}else if(dinero >= 1 && dinero < 1.6){
    cambio = dinero -chocolate;
    alert("Puede comprar el helado de chocolate ");
}else if(dinero >= 1.6 && dinero < 1.7){
    cambio = dinero -Nata;
    alert("Puede comprar el helado de nata");
}else if(dinero >= 1.7 && dinero < 1.8){
    cambio = dinero -vainilla;
    alert("Puede comprar el helado de vainilla");
}else if(dinero >=1.8 && dinero < 2.9){
    cambio = dinero -Mora;
    alert("Puede comprar el helado de mora");
}else if(dinero >=2.9){
    cambio = dinero - pomelo;
    alert("Puede comprar los helados de piña y pomelo");
}
alert("Tu cambio es de: " + cambio + "€");