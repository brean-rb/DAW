var year = Number(prompt("Introduce un año:"))

if (((year % 4 == 0) && (year % 100 != 0)) || ((year % 400 == 0))) {
        document.write("Es bisiesto");        
    }else{
        document.write("No es bisiesto");
    }
