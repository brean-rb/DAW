var num1 = Number(prompt("introduzca un numero:"));
var num2 = Number(prompt("introduzca un numero:"));

for(let i = 0; i <= num1; i++){
    for(let j = 0; j <= num2; j++){
        if((num1 % i == 0) && (num2 % j == 0)){
            document.write("son divisores de " + num1 + " " + num2 + " --> " + i + " " + j + "<br>");
        }
    }
}