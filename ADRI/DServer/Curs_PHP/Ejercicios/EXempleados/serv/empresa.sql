-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS empresa
    DEFAULT CHARACTER SET utf8mb4
    DEFAULT COLLATE utf8mb4_general_ci;

-- Usar la base de datos creada
USE empresa;

-- Crear tabla presupuesto
-- id: PK, entero autoincremental
-- presupuesto: float para el presupuesto disponible
CREATE TABLE IF NOT EXISTS presupuesto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    presupuesto DECIMAL(10,2) NOT NULL DEFAULT 0.00
);

-- Insertar un registro en la tabla presupuesto con un presupuesto inicial de 50,000.00
INSERT INTO presupuesto (presupuesto) VALUES (50000.00);

-- Crear tabla empleado
-- id: PK, entero autoincremental
-- nombre, apellidos: VARCHAR para texto
-- telefono: VARCHAR (puedes ajustar la longitud)
-- nif: VARCHAR(20) con índice único para evitar duplicados
-- sueldo: DECIMAL para almacenar valores con decimales
CREATE TABLE IF NOT EXISTS empleado (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    telefono VARCHAR(50) NOT NULL,
    nif VARCHAR(20) NOT NULL UNIQUE,
    sueldo DECIMAL(10,2) NOT NULL
);
