var palabra = prompt("Introduce una palabra:");
var i =0;
while(i < palabra.length) {
    document.write("Letra " + (i+1) + ": "+ palabra.charAt(i) + "<br>");        
    i++;
}