
var mensajes = [];
var encriptado = [];
var desplazamiento = Number(prompt("Introduce la cantidad de desplazamiento"));
var letras = [];

var palabra1 = prompt("Introduce el mensaje 1");
var pal1_m = palabra1.toUpperCase();
var palabra2 = prompt("Introduce el mensaje 2");
var pal2_m = palabra2.toUpperCase();
var palabra3 = prompt("Introduce el mensaje 3");
var pal3_m = palabra3.toUpperCase();
var palabra4 = prompt("Introduce el mensaje 4");
var pal4_m = palabra4.toUpperCase();
var palabra5 = prompt("Introduce el mensaje 5");
var pal5_m = palabra5.toUpperCase();

 mensajes[0] = pal1_m;
 mensajes[1] = pal2_m;
 mensajes[2] = pal3_m;
 mensajes[3] = pal4_m;
 mensajes[4] = pal5_m;

for (let i = 65; i < 91; i++) {
    letras.push(String.fromCharCode(i));
}

for (let i = 0; i < mensajes.length; i++) {
    let encryptedMessage = "";
    for (let j = 0; j < mensajes[i].length; j++) {
        let char = mensajes[i].charAt(j);
        let index = letras.indexOf(char);

        if (index !== -1) {
            
            let newIndex = (index + desplazamiento) % letras.length;
            encryptedMessage += letras[newIndex];
        } else {
            encryptedMessage += char; 
        }
    }
    encriptado.push(encryptedMessage);
}

for (let i = 0; i < mensajes.length; i++) {
    document.write("El mensaje '" + mensajes[i] + "' encriptado es: " + encriptado[i] + "<br>");
}
