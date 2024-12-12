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
    var get_div_div =document.querySelectorAll("div[id^='div']");
    get_div_div.forEach(function(get_div_div){
        get_div_div.style.backgroundColor = "cyan";
    });
//fin ejer 12

// ejer 13
    var get_p_parrafo = document.querySelectorAll("p");
    get_p_parrafo.forEach(function(get_p_parrafo){
        if(get_p_parrafo.textContent === "parrafo"){
            get_p_parrafo.style.fontSize = "18px";
        }
    });
// fin ejer 13

//eejer 14
    var get_ult_li = document.querySelectorAll("#tabla > li:last-of-type");
    get_ult_li.style.fontWeight = "bold";
//  fin ejer 14

// ejer 15
    var get_empty_li = document.querySelectorAll("li");
    get_empty_li.forEach(function(get_empty_li){
        if(get_empty_li.trim() === ""){
            get_empty_li.style.backgroundColor = "green";
        }
    });
// fin ejer 15

//ejer16
    var boldSeats = document.querySelectorAll("b"); 
    boldSeats.forEach(function(boldSeats) {
        boldSeats.style.color = "red";
    });
//fin ejer 16

//ejer 17
    var get_h1_exc_red = document.querySelectorAll("h1");
    get_h1_exc_red.forEach(function(get_h1_exc_red){
        if(!get_h1_exc_red.getAttribute("class") === "rojo"){
            get_h1_exc_red.style.backgroundColor = "yellow";
        }
    });
//fin ejer17