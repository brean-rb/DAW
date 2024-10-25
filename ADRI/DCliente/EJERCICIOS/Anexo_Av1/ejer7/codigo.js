var navegador= prompt ("Introduce tu navegador favorito: Chrome, Firefox, Safari, Opera,Edge");
var minus = navegador.toLowerCase();
    switch (minus) {
        case "edge":
            alert("¡Tienes Edge!");
            break;
        case "opera":
        case "firefox":
        case "chrome":
            alert( 'Está bien, soportamos estos navegadores también' );
            break;
        default:
            alert( '¡Esperamos que la página se vea bien!' );
            break;
    }











if(navegador == 'Edge') {
    alert("¡Tienes Edge!");
    } else if (navegador == 'Chrome' || navegador == 'Firefox' || navegador ==
    'Safari' || navegador == 'Opera') {
    alert( 'Está bien, soportamos estos navegadores también' );
    } else {
    alert( '¡Esperamos que la página se vea bien!' );
    }