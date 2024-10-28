//preguntar nombres
var name1 = prompt("introduzca un nombre");
var name2 = prompt("introduzca un nombre");

//convertir nombre en array
var array_name1 = name1.split('');
var array_name2 = name2.split('');

//asignamos la primera letra del nombre
var char1_name1 = null;
var char1_name2 = null;

//asignamos la ultima letra del nombre
var char_f_name1 = null;
var char_f_name2 = null;

for(let i = 0; i < array_name1.length; i++){
    if(i == 0){
        char1_name1 = array_name1[i];
    } else {
        char_f_name1 = array_name1[i];
    }
}

for(let i = 0; i < array_name2.length; i++){
    if(i == 0){
        char1_name2 = array_name2[i];
    } else {
        char_f_name2 = array_name2[i];
    }
}

if((char1_name1 == char1_name2) || (char_f_name1 == char_f_name2)){
    document.write("coindicendia");

} else {
    document.write("no hay coindicencia");
}
