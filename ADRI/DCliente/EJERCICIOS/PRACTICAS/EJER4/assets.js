var diametro = Number(prompt("Introduce el diametro de la rueda"));
var grosor = Number(prompt("Introduce el grosor de la rueda"));

if (diametro > 1.4) {
    alert("La rueda es para un vehiculo grande");
} else if(diametro <= 1.4 && diametro > 0.8){
    alert("La rueda es para un vehiculo mediano");
}else if(diametro < 0.8){
    alert("La rueda es para un vehiculo pequeño ");
}else if((diametro > 1.4 && grosor < 0.4) || ((diametro <= 1.4 && diametro > 0.8) && grosor < 0.25)){
alert("El grosor para esta rueda es inferior al recomendado");
}