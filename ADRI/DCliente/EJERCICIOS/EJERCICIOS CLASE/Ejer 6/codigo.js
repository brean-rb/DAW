var letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N',
   'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];
   
   // Solicitar número de DNI y letra al usuario
   var numeroDNI = prompt("Introduce tu número de DNI (sin la letra):");
   var letraDNI = prompt("Introduce la letra de tu DNI:").toUpperCase();
   
   // Comprobar si el número es válido (mayor que 0 y menor o igual a 99999999)
   if (numeroDNI < 0 || numeroDNI > 99999999) {
       alert("El número proporcionado no es válido.");
   } else {
       // Calcular la letra correspondiente al número de DNI
       var letraCalculada = letras[numeroDNI % 23];
   
       // Comprobar si la letra introducida es correcta
       if (letraCalculada !== letraDNI) {
           alert("La letra que has indicado no es correcta. Debería ser: " + letraCalculada);
       } else {
           alert("El número y la letra de DNI son correctos.");
       }
   }
   