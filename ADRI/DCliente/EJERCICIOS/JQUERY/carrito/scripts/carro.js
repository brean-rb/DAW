$(function()
{
    $(".item").css("background-color","#cecece");
    $("#cart_items").css("border","4px solid black");
    $("img").css("border","blue 1px solid");
    $(".item >  label").css("text-decoration", "underline");
    $("#cart_container button").css("color","red");
    $(".item label+label").css("color","white");       
    $('*:contains("€"),input').css('color', 'green'); 
    $('div:empty').css("background-color","yellow");
    $('.item:first,.item:last').css("background-color","red");
    $('img[src*="camiseta"]').css("border", "2px solid green");
});