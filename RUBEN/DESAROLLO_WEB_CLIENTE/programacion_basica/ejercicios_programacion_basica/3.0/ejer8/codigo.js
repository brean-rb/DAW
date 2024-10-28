var num1 = 0;
var num2 = 1;
var suma = 0;

for (var i = 0; i<= 10; i++){
    suma = num1 + num2;
    document.write(suma + "<br>");
    num1 = num2;
    num2 = suma;
}