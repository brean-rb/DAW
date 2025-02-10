var num = Number(prompt("introduzca un numero"));

if ((num % 2 == 0) || (num % 3 == 0) || (num % 5 == 0) || (num % 7 == 0)){
    document.write("es divisible")
} else{
    document.write("no es divisible")
}