var sabor = prompt("introduzca el sabor del elado");

if(sabor == "SinSabor"){
    alert("cuesta 1.90€");

} else if (sabor == "oreo") {
    alert("cuesta 1€");

} else if(sabor == "kitkat"){
    alert("cuesta 1.50€");

} else if (sabor == "brownie"){
    alert("cuesta 0.75€");

} else if (sabor == "lacasitos"){
    alert("cuesta 0.95€");

} else {
    alert("no tenemos este sabor, lo sentimos.");
    alert("cuesta 1.90€");
}