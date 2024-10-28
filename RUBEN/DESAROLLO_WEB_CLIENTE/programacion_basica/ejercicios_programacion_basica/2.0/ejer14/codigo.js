var num = Number(prompt("introduzca un numero"));

for(let i = 0; i <= num; i++){
    if (num  % i == 0 ){
        document.write(i + " es divisible por " + num + "<br>");
    }
}