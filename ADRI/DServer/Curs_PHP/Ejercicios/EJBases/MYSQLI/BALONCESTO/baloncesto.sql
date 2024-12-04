-- Crear base de datos baloncesto
CREATE DATABASE baloncesto;

-- Usar esta base de datos
USE baloncesto;

-- Crear la tabla jugadores con los campos id, nombre, posicion, partidos, puntos, rebotes, asistencias
CREATE TABLE jugadores (
  id INT AUTO_INCREMENT PRIMARY KEY,  -- Campo ID autoincrementativo con valor de clave primaria
  nombre VARCHAR(50) NOT NULL,  -- Nombre del jugador
  posicion VARCHAR(20) NOT NULL,  -- Posición en la que juega dicho jugador
  partidos INT NOT NULL,  -- Partidos jugados por dicho jugador
  puntos DECIMAL(5,2) NOT NULL,  -- Puntos conseguidos en la temporada
  rebotes DECIMAL(5,2) NOT NULL,  -- Rebotes conseguidos por el jugador
  asistencias DECIMAL(5,2) NOT NULL  -- Asistencias conseguidas por el jugador
);

-- Insertar datos en esta tabla
INSERT INTO jugadores (nombre, posicion, partidos, puntos, rebotes, asistencias) VALUES
('Valero', 'base', 24, 5.2, 1.7, 9.8),
('Juanfran', 'base', 29, 6.1, 0.8, 5.8),
('Montilla', 'escolta', 19, 11.7, 2.7, 2.4),
('Rodriguez', 'escolta', 23, 17.1, 1.8, 3.7),
('Stipes', 'escolta', 31, 8.5, 3.1, 0.9),
('Montes', 'alero', 32, 13.1, 4.6, 4.1),
('Volkov', 'ala pivot', 11, 4.3, 5.6, 1.3),
('Suarez', 'ala pivot', 24, 6.9, 4.8, 4.5),
('Carter', 'ala pivot', 26, 26.1, 9.1, 1.8),
('Graham', 'pivot', 17, 2.1, 8.4, 0.2),
('Cesar', 'pivot', 8, 3.1, 6.8, 0.7);
