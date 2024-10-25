var num = Number(prompt("introduzca un numero"))
var primo = true;


for(let i = 2 ; i < num; i++){
    if(num % i == 0){
        primo = false;
    } 
}

if(primo){
    document.write("el numero es primo");

} else{
    document.write("el numero no es primo");
}