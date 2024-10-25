var partidoA = 0;
var partidoB = 0;
var partidoC = 0;
var votos_error = 0;
var contador = 0;

for(let i = 0; i < 10 ; i++){
    var voto = (prompt("vota a un candidato (rojo / verde / azul)"));
    
    if(voto.toLowerCase() == "rojo"){
        alert("Usted ha votado por el partido rojo");
        partidoA++;
    } else if (voto.toLowerCase() == "verde"){
        alert("Usted ha votado por el partido verde");
        partidoB++;
    } else if (voto.toLowerCase() == "azul"){
        alert("Usted ha votado por el partido azul");
        partidoC++
    } else{
        alert("Opción errónea");
        votos_error++;
    }
}


if ((partidoA > partidoB) && (partidoA > partidoC)){
    document.write("el ganador de las eleciones es el partido rojo." + "<br>" + "votos erroneos: " + votos_error);

} else if ((partidoB > partidoA) && (partidoB > partidoC)){
    document.write("el ganador de las eleciones es el partido verde." + "<br>" + "votos erroneos: " + votos_error);

} else {
    document.write("el ganador de las eleciones es el partido azul." + "<br>" + "votos erroneos: " + votos_error);
}


