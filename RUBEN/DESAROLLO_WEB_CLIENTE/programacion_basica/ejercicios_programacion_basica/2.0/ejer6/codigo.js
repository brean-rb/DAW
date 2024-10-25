var nums = [];
var mayor = 0;
var menor = 1;

for(let i = 0 ; i < 5; i++){
    nums[i] = Number(prompt("introduzca un numero: "));
}

for(let j = 0; j < nums.length; j++){

    if(nums[j] > mayor){
        mayor = nums[j];
    } else if (nums[j] < menor){
        menor = nums[j];
    }
}

document.write("el mayor es: " + mayor + "<br>");
document.write("el menor es: " + menor);