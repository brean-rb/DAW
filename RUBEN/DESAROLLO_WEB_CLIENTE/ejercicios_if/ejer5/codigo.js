var fresa = 0.6;
var chocolate = 1;
var nata = 1.6;
var vainilla = 1.7;
var mora = 1.8;
var piña = 2.9;
var pomelo = 2.9;

var dinero = Number(prompt("introduzca el dinero que tiene"));


if(dinero >= fresa && dinero < chocolate){
    var cambio = dinero - fresa;
    alert("fresa = " + fresa + "€" + "\n" + "el cambio seria = " + cambio);

} else if (dinero >= chocolate && dinero < nata){
    var cambio = dinero - chocolate;
    alert("chcolate = " + chocolate + "€" + "\n" + "el cambio seria = " + cambio);

} else if (dinero >= nata && dinero < vainilla){
    var cambio = dinero - nata;
    alert("nata = " + nata + "€" + "\n" + "el cambio seria = " + cambio);

} else if(dinero >= vainilla && dinero < mora){
    var cambio = dinero - vainilla;
    alert("vainilla = " + vainilla + "€" + "\n" + "el cambio seria = " + cambio);

} else if (dinero >= mora && dinero < piña){
    var cambio = dinero - mora;
    alert("mora = " + mora + "€" + "\n" + "el cambio seria = " + cambio);

} else if((dinero >= piña) || (dinero >= pomelo)){
    var cambio = dinero - piña;
    alert("piña = " + piña + "€" + " " + "pomelo = " + pomelo + "€" + "\n" + "el cambio seria" + cambio);

} else {
    alert("no tienes dinero, eres pobre");
}