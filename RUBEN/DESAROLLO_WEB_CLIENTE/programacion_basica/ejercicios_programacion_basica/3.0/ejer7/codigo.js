var year = Number(prompt("escriba un año"));

if(((year % 4 ==0 ) && (year % 100 != 0)) || (year % 400 == 0)){
    document.write("el año es bisiesto");
} else {
    document.write("el año no es bisiesto");
}