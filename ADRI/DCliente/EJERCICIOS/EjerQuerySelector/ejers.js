// //Ejercicio 1: Coger todas las p de un elemento div y cambiar su fondo a gris

// var parrf = document.querySelectorAll("div > p");

// parrf.forEach(function(parrf){
//     parrf.style.backgroundColor = "gray";
// })

// //Ejercicio 2: Seleccionar div con clase ROJO y cambiar su texto a mayusculas
// var cadenaR = document.querySelectorAll(".rojo");

// cadenaR.forEach(function(cadenaR){
//     cadenaR.style.textTransform = "uppercase";
// })

// //Ejercicio 3: Seleccionar todos los li de la tabla id tabla y cambiar texto a azul

// var textoAz = document.querySelectorAll("#tabla > li");

// textoAz.forEach(function(textoAz){
//     textoAz.style.color = "blue";
// })

// //Ejercicio 4: Seleccionar todos los elementos con clase "verde" y agregar una clase "fondogris"

// var claseVerd = document.querySelectorAll(".verde");

// claseVerd.forEach(function(claseVerd){
//     claseVerd.setAttribute("class","fondogris");
// })

// //Ejercicio 5: Seleccionar el primer elemento <h1> en la página y cambiar su color de texto a verde

// var primerH = document.querySelector("h1");

//     primerH.style.color = "green";

// //Ejercicio 6: Seleccionar todos los elementos con clase "azul" y agregar una clase "fondogris"

// var claseAZ = document.querySelectorAll(".azul");

// claseAZ.forEach(function(claseAZ){
//     claseAZ.setAttribute("class","fondogris");
// })

// //Ejercicio 7: Seleccionar todos los elementos <label> y cambiar su estilo a cursiva (italic)

// var camposlbl = document.querySelectorAll("label");

// camposlbl.forEach(function(camposlbl){
//     camposlbl.style.fontStyle = "italic";
// })

// // Ejercicio 8: Seleccionar todos los elementos <input> de tipo "checkbox" y cambiar su fondo a amarillo
// var tiposBox = document.querySelectorAll("input[type='checkbox']");

// tiposBox.forEach(function(tiposBox){
//     tiposBox.style.backgroundColor = "yellow";
// });

// //Ejercicio 9: Seleccionar todos los elementos <h2> dentro de un <div> y agregar una clase "resaltado"

// var elhdiv = document.querySelectorAll("div > h2");

// elhdiv.forEach(function(elhdiv){
// elhdiv.setAttribute("class", "resaltado")
// });

// // Ejercicio 10: Seleccionar todos los elementos con id que contiene la letra "o" y cambiar su color de texto a morado

// var idesconO = document.querySelectorAll('[id*="o"]');

// idesconO.forEach(function(idesconO){
//     idesconO.style.color = "purple";
// })

// //Ejercicio 11:  Seleccionar todos los elementos <strong> y <b> y cambiar su color de texto a verde

// var negritasV = document.querySelectorAll("strong, b");

// negritasV.forEach(function(negritasV){
//     negritasV.style.color = "green";
// })

// // Ejercicio 12: Seleccionar todos los elementos <div> con id que comienza con "div" y cambiar su fondo a cyan 

//  var idescondiv = document.querySelectorAll('[id^="div"]');

//  idescondiv.forEach(function(idescondiv){
//      idescondiv.style.backgroundColor = "cyan";
//  })

// // Ejercicio 13: Seleccionar todos los elementos <p> que contienen la palabra "párrafo" y cambiar su tamaño de fuente a 18px
// var parraftextos = document.querySelectorAll('p');

// parraftextos.forEach(function(parraftextos){
//   if (parraftextos.textContent.includes('párrafo')) {
//     p.style.fontSize = '18px';
//   }
// });

// // Ejercicio 14:  Seleccionar el último elemento <li> dentro del elemento con id "tabla" y cambiar su estilo a negrita
// var ultimoLi = document.querySelector('#tabla li:last-of-type');
// if (ultimoLi) {
//   ultimoLi.style.fontWeight = 'bold';
// }

// //Ejercicio 15: Selecciona todos los <li> vacíos y ponles un fondo verde.
// var liVacios = document.querySelectorAll('li:empty');
// liVacios.forEach(function(liVacios) {
//   liVacios.style.backgroundColor = 'green';
// });

// // Ejercicio 16:  Selecciona los asientos en negrita y aplícales el color rojo
// var asientosNegrita = document.querySelectorAll('#tabla strong');
// asientosNegrita.forEach(function(asientosNegrita){
//   asientosNegrita.style.color = 'red';
// });

// Ejercicio 17:  Selecciona todos los <h1> excepto los que tienen la clase rojo y ponles un fondo amarillo
var h1SinClaseRojo = document.querySelectorAll('h1:not(.rojo)');
  h1SinClaseRojo.forEach(function(h1SinClaseRojo){
    h1SinClaseRojo.style.backgroundColor = 'yellow';
  });