var confirmar = false;

while(!confirmar){
    var contraseña = prompt("introduza la contraseña");
    confirmar = confirm("estas deacuerdo con la contraseña?")
}

while(confirmar){
    var user_contraseña = prompt("introduzca la contraseña correcta");

    if (user_contraseña == contraseña) {
        document.write("la contraseña es correcta");
        confirmar = false;
    } else{
        document.write("contraseña incorrecta");
    }
}