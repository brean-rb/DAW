var numeros = [7,8,2,9,10];
var total =0;
for (let i = 0; i < numeros.length; i++) 
{
    if (numeros[i] > 8) 
    {
        total+=numeros[i];
    }
}
alert(total);