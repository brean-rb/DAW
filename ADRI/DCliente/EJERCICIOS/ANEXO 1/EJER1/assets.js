var incremento=0;
var numero =0;
for(let i = 0;i <5;i++)
{
    numero = Number(prompt("Introduce un numero"));
    incremento +=numero;
    if (numero > 100) 
    {
        alert("Es mayor a 100");
    } 
    else
    {
        alert("Es menor a 100");
    }
}
alert("La suma de todos ellos es: " + incremento);
