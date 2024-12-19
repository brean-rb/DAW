function borrarForm(){
var confirmacion =confirm("Estas seguro que deseas borrar el formulario?");
    if (confirmacion) {
        return true
    }else{
        return false;
    }
}

function enviarForm(elemento){
    if(document.forms.length > 0) {
        if(document.forms[0].elements.length > 0) {
        document.forms[0].elements[0].focus();
        }
        }

        var contras = document.querySelectorAll("input[type='password']");

        for (let i = 0; i < contras.length; i++) {
            if (contras[0].value !== contras[i].value) {
                alert("Las contraseñas son diferentes")
                return false; 
            }
        }

        elemento.disabled = true;
        elemento.value = "enviando";
        elemento.form.submit()
        return true; 
        
}

function ponerMayus() {
    var entradas = document.querySelectorAll("input");

    entradas.forEach(function(elemento){
        elemento.addEventListener("keypress", function(){
            if (elemento.value.length > 0) {
                elemento.value = elemento.value.charAt(0).toUpperCase() + elemento.value.slice(1);
            }
        });
    });
}


  



