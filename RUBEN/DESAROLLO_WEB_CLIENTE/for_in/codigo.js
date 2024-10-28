var nums = [];

for(var i = 0;i < 5; i++){
    var num = Number(prompt("introduzca un numero"));
    nums[i] = num ;
}

for (var j in nums) {
    alert("3 " + " * " + nums[j] + " = " + nums[j]*3);
}