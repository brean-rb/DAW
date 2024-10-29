var numeros= [];
numeros[0] = Number(prompt("Introduce el primer numero:"));
numeros[1] = Number(prompt("Introduce el segundo numero"));
numeros[2] =  Number(prompt(" Introduce el tercer numero"));
numeros[3] =  Number(prompt(" Introduce el cuarto numero"));
numeros[4] = Number(prompt(" Introduce el quinto numero"));
for(i in numeros){
    alert("El resultado del numero " + numeros[i] + " por 3 es: " + numeros[i]*3 );
}