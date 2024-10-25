var confirmar = false;
var contra = null
var comprobar = null;

while (confirmar == false) {
     contra = prompt("Introduce una contraseña");
        confirmar = confirm("Es correcta la contraseña?")
    }

do {
    comprobar = prompt("Repita la contraseña:")
} while (comprobar != contra);
