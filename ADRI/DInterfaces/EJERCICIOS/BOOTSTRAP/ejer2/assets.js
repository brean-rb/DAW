var botonLat = document.getElementById("menuLat");
var menuPath = document.getElementById("menuPath");

botonLat.onclick = function () {
    if (menuPath.getAttribute("d") === "M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z") {
        menuPath.setAttribute("d", "M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z");
    } else {
        menuPath.setAttribute("d", "M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z");
    }
};
document.getElementById('logo').addEventListener('click', function() {
    location.reload();  
});window.onscroll = function() {
    if (document.documentElement.scrollTop > 100) {
        document.getElementById("volverArriba").style.display = "block";
    } else {
        document.getElementById("volverArriba").style.display = "none";
    }
};

function limpiar(){
    document.getElementById('inscripcion').reset();
}
document.getElementById('showMessageBtn').addEventListener('click', function() {
    
    var opcionTorneo = document.getElementById("torneosDIs").value;
    var email = document.getElementById("email").value;
    var nombre = document.getElementById("name").value;
    if ((opcionTorneo !="")&& (email!="")&&(nombre!="")) {
        const successMessage = document.getElementById('successMessage');
        successMessage.classList.add('show'); 
        setTimeout(() => {
          successMessage.classList.remove('show'); 
        }, 3000);
    }else{
        const errorMessage = document.getElementById('errorMessage');
        errorMessage.classList.add('show'); 
        setTimeout(() => {
          errorMessage.classList.remove('show'); 
        }, 3000);
    } 
   
  });
