var nota = Number(prompt("introduzca la nota"));

if (nota >= 0 && nota < 3){
    alert("my deficiente");

} else if (nota >= 3 && nota < 5 ) {
    alert("insuficiente");

} else if (nota >= 5 && nota < 6){
    alert("suficiente");

} else if (nota >=6 && nota < 7){
    alert("bien");

} else if (nota >=7 && nota < 9){
    alert("notable");

} else if (nota >= 9 && nota <= 10){
    alert("sobresaliente");

} else if (nota < 0 || nota > 10) {
    alert("nota erronia")

} else{
    alert("introduce un numero valido");
}