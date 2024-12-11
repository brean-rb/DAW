//ejer 1
    var get_div_p = document.querySelectorAll("div > p");
    get_div_p.forEach(function(get_div_p){
        get_div_p.style.backgroundColor = 'gray';
    });
// fin ejer1 1

//ejer  2
    var get_reds = document.querySelectorAll(".rojo");
    get_reds.forEach( function(get_reds) {
        get_reds.style.textTransform = 'uppercase';
    });
//fin ejer2

//ejer 3
    var get_li = document.querySelectorAll("#tabla > li");
    get_li.forEach(function(get_li){
        get_li.style.color = "blue";
    });
//fin ejer3

//ejer 4
    var get_class_verde = document.querySelectorAll(".verde");
    get_class_verde.forEach(function(get_class_verde){
        get_class_verde.setAttribute("class", "fondogris");
    });
//fin ejer 4

//ejer 5
    var get_one_h1 = document.querySelector("h1");
    get_one_h1.style.color = "green";
//fin ejer5 

//ejer 6
    var get_class_blue = document.querySelectorAll(".azul");
    get_class_blue.forEach(function(get_class_blue){
        get_class_blue.setAttribute("class" , "fondogris");
    });
//fin ejer 6

//ejer 7
    var get_label = document.querySelectorAll("label");
    get_label.forEach(function(get_label){
        get_label.style.fontStyle = "italic";
    });
// fin ejer 7

//ejer 8
    var get_input_check = document.querySelectorAll('input[type="checkbox"]');
    get_input_check.forEach(function(get_input_check){
        get_input_check.style.backgroundColor = "yellow";
    });
//fin ejer8

//ejer 9
    var get_h2_div = document.querySelectorAll("div > h2");
    get_h2_div.forEach(function(get_h2_div){
        get_h2_div.setAttribute("class", "resaltado");
    });
//fin ejer 9

//ejer 10
    var get_id_o = document.querySelectorAll("id*=['o']");
    get_id_o.forEach(function(get_id_o){
        get_id_o.style.color = "purple";
    });
//fin ejer 10

//ejer 11
    var get_strong_b = document.querySelectorAll("strong, b");
    get_strong_b.forEach(function(get_strong_b){
        get_strong_b.style.color = "green";
    })
//fin ejer 11

//ejer 12
    var get_div_div =document.querySelectorAll("div^=['div']");
    get_div_div.forEach(function(get_div_div){
        get_div_div.style.backgroundColor = "cyan";
    })
//fin ejer 12