-- Crear la base de datos
CREATE DATABASE DistribuidorBebidas;
USE DistribuidorBebidas;

-- Tabla de Categorías
CREATE TABLE Categorias (
    CategoriaID INT PRIMARY KEY AUTO_INCREMENT,
    NombreCategoria VARCHAR(50) NOT NULL
);

-- Tabla de Productos
CREATE TABLE Productos (
    ProductoID INT PRIMARY KEY AUTO_INCREMENT,
    NombreProducto VARCHAR(100) NOT NULL,
    Precio DECIMAL(10,2) NOT NULL,
    DescuentoBase DECIMAL(5,2) NOT NULL, -- Descuento inicial en porcentaje
    CantidadDescuento INT NOT NULL, -- Cantidad que incrementa el descuento
    IncrementoDescuento DECIMAL(5,2) NOT NULL, -- Incremento del descuento por cada cantidad
    CategoriaID INT,
    FOREIGN KEY (CategoriaID) REFERENCES Categorias(CategoriaID)
);

-- Tabla de Usuarios
CREATE TABLE Usuarios (
    UsuarioID INT PRIMARY KEY AUTO_INCREMENT,
    NombreUsuario VARCHAR(50) NOT NULL UNIQUE,
    ContraseñaHash VARCHAR(255) NOT NULL,
    NombreCompleto VARCHAR(100),
    Email VARCHAR(100)
);

-- Tabla de Pedidos
CREATE TABLE Pedidos (
    PedidoID INT PRIMARY KEY AUTO_INCREMENT,
    UsuarioID INT NOT NULL,
    FechaHoraPedido DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (UsuarioID) REFERENCES Usuarios(UsuarioID)
);

-- Tabla de Detalles de Pedido
CREATE TABLE DetallesPedido (
    DetallePedidoID INT PRIMARY KEY AUTO_INCREMENT,
    PedidoID INT NOT NULL,
    ProductoID INT NOT NULL,
    Cantidad INT NOT NULL,
    PrecioUnitario DECIMAL(10,2) NOT NULL,
    DescuentoAplicado DECIMAL(5,2) NOT NULL,
    FOREIGN KEY (PedidoID) REFERENCES Pedidos(PedidoID),
    FOREIGN KEY (ProductoID) REFERENCES Productos(ProductoID)
);

-- Tabla de Stock de Almacén
CREATE TABLE StockAlmacen (
    ProductoID INT PRIMARY KEY,
    CantidadEnStock INT NOT NULL,
    FOREIGN KEY (ProductoID) REFERENCES Productos(ProductoID)
);

-- Insertar categorías
INSERT INTO Categorias (NombreCategoria) VALUES
('Refrescos'),
('Zumos'),
('Bebidas energéticas'),
('Cervezas'),
('Vinos'),
('Espumosos'),
('Aguas'),
('Ginebras'),
('Whiskys'),
('Brandys'),
('Anisados'),
('Rones'),
('Vodkas'),
('Licores'),
('Otros');

-- Insertar productos de ejemplo
INSERT INTO Productos (NombreProducto, Precio, DescuentoBase, CantidadDescuento, IncrementoDescuento, CategoriaID)
VALUES
('Whisky escocés Twisted Legs Daddy 750 ml', 18.30, 0, 12, 2, (SELECT CategoriaID FROM Categorias WHERE NombreCategoria = 'Whiskys'));

-- Insertar un usuario de ejemplo
INSERT INTO Usuarios (NombreUsuario, ContraseñaHash, NombreCompleto, Email)
VALUES ('usuario1', 'contraseña_hash', 'Nombre Apellido', 'email@example.com');

-- Insertar stock inicial
INSERT INTO StockAlmacen (ProductoID, CantidadEnStock)
VALUES ((SELECT ProductoID FROM Productos WHERE NombreProducto = 'Whisky escocés Twisted Legs Daddy 750 ml'), 100);
