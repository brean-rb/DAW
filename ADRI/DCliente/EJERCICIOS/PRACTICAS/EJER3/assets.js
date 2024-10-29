var nota = Number(prompt("Introduce tu nota"));

if (nota >= 0 && nota < 3) {
    alert("Tu nota es muy deficiente");
} else if(nota >=3 && nota < 5){
    alert("Tu nota es Insuficiente");
} else if(nota >=5 && nota < 6){
    alert("Tu nota es Suficiente");
} else if(nota >=6 && nota < 7){
    alert("Tu nota es Bien");
} else if(nota >=7 && nota < 9){
    alert("Tu nota es Notable");
} else if(nota >=9 && nota < 10){
    alert("Tu nota es Excelente");
}else if(nota <0 || nota > 10){
    alert("Tu nota es erronea");
}else{
    alert("Introduce un numero valido");
}