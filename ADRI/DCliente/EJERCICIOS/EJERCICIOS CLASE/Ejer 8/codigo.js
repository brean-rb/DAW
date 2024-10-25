

function Par_Impar(num){
   if (num % 2 == 0) {
    document.write("Es par")
   } else{
    document.write("Es impar")
   }
}
var num = Number(prompt("Introduce un numero"))
Par_Impar(num)