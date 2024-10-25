

var numeros =[0,1];
for (let c = 2; c < 12; c++) {
    numeros[c] = numeros[c-2] + numeros[c-1];
    document.write(numeros[c-2] + "<br>");
}