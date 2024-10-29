let contador = {
    A: 0, // Partido rojo
    B: 0, // Partido verde
    C: 0,  // Partido azul
    D: 0   // Votos erróneos
};

var votos = [];

// Bucle para pedir los votos
for (let i = 0; i < 10; i++) {
    let mayus = prompt("Si desea votar por el partido rojo pulse A, si desea votar por el partido verde pulse B y si desea votar por el partido azul pulse C: ");
    votos[i] = mayus.toUpperCase();
    
    // Condicionales para contabilizar los votos
    if (votos[i] == "A") {
        alert("Usted ha votado por el partido rojo");
        contador.A++;
    } else if(votos[i] == "B") {
        alert("Usted ha votado por el partido verde");
        contador.B++;
    } else if(votos[i] == "C") {
        alert("Usted ha votado por el partido azul");
        contador.C++;
    } else {
        alert("Voto erróneo");
        contador.D++;
    }
}

// Mostrar los resultados de los votos
document.write(`Votos por el partido rojo (A): ${contador.A} <br>`);
document.write(`Votos por el partido verde (B): ${contador.B} <br>`);
document.write(`Votos por el partido azul (C): ${contador.C} <br>`);
document.write(`Votos erróneos (distinto de A,B o C): ${contador.D} <br>`);

// Encontrar el partido ganador
let partidos = [
    { partido: 'A', votos: contador.A },
    { partido: 'B', votos: contador.B },
    { partido: 'C', votos: contador.C }
];

// Ordenar los partidos según los votos
partidos.sort((a, b) => b.votos - a.votos);

// Mostrar el partido ganador
document.write(`El partido ganador es: ${partidos[0].partido} con ${partidos[0].votos} votos.`);
