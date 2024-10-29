var helado = prompt("Bienvenido a la tienda de helados! \n Los sabores disponibles son: \n -Sin sabor \n -Oreo \n -KitKat \n -Brownie \n -Lacasitos \n ¿Que sabor desea?");

if (helado == "Oreo" ) {
    alert("El PVP es 1€");
} else if(helado == "KitKat"){
    alert("El PVP es 1,50€");
}else if(helado == "Brownie"){
    alert("El PVP es 0,75€");
}else if(helado == "Lacasitos"){
    alert("El PVP es 0,95€");
}else {
    alert("No nos queda del sabor elegido, será seleccionado el helado sin sabor con un PVP de 1,90€");
}