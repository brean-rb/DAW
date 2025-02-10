var diametro = Number(prompt("introduzca el diametro de la rueda en metros"));
var grosor = Number(prompt("introduzca el grosor de la rueda"));

if ((diametro > 1.4 && grosor < 0.4) || ((diametro <= 1.4 && diametro < 0.8) && grosor < 0.25 )){
     alert("el grosor para esta rueda es inferior al recomendado")

} else if (diametro <= 1.4 && diametro > 0.8){
     alert("la rueda es para un vehiculo mediano");

} else if (diametro > 1.4){
    alert("la rueda es para un vehiculo grande");
} else {
    alert("“La rueda es para un vehículo pequeño");
}