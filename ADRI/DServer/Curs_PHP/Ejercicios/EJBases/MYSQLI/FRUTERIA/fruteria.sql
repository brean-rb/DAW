-- Crear la base de datos
CREATE DATABASE fruteria;

-- Usar la base de datos
USE fruteria;

-- Crear la tabla precios
CREATE TABLE precios (
    id INT AUTO_INCREMENT PRIMARY KEY,    -- Clave primaria autoincremental
    fruta VARCHAR(50) NOT NULL,           -- Nombre de la fruta
    precio_kg DECIMAL(5,2) NOT NULL,      -- Precio por kilo (hasta 999.99)
    temporada VARCHAR(50) NOT NULL        -- Temporada (puede ser valores como anual, primavera, etc.)
);

-- Insertar registros iniciales
INSERT INTO precios (fruta, precio_kg, temporada) VALUES
('Judias', 3.50, 'primavera'),
('Patatas', 0.40, 'anual'),
('Tomates', 1.00, 'anual'),
('Manzanas', 1.20, 'invierno'),
('Uvas', 2.50, 'otoño');
