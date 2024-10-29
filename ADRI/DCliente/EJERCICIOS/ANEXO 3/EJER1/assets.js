var sueldo = Number(prompt("Introduzca su sueldo:"));
var antiguo = Number(prompt("Introduzca su antigüedad en años:"));

if (sueldo < 500 && antiguo >= 10) {
    sueldo*3;
} else if (sueldo < 500 && antiguo < 10){
    sueldo*2;
} else if(sueldo > 500){
    sueldo= sueldo;
}

document.write("Su sueldo total por sus años de antigüedad es de: " + sueldo);