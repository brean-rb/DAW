var navegador= prompt ("Introduce tu navegador favorito: Chrome, Firefox, Safari, Opera,Edge");

switch (navegador.toLowerCase()) {
    case "edge":
        alert("¡tines edge!");
        break;

    case "chrome":
    case "firefox":
    case "safari":
        alert("esta bien, soportamos estos navegadores tambien");
        break;

    default:
        alert("esperamos que la pagina se vea bien!")
        break;
}