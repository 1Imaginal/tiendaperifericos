DROP DATABASE IF EXISTS tienda_perifericos;

-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS tienda_perifericos;
USE tienda_perifericos;

-- Crear la tabla usuarios basada en conexion.php y registro.php
DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    admin TINYINT(1) NOT NULL DEFAULT 0
);

-- Tabla categorias
CREATE TABLE IF NOT EXISTS categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

-- Insertar las categorías base
INSERT INTO categorias (id, nombre) VALUES 
(1, 'mouse'), 
(2, 'teclado'), 
(3, 'mousepad')
ON DUPLICATE KEY UPDATE nombre = VALUES(nombre);

-- Tabla objetos (para idObj)
CREATE TABLE IF NOT EXISTS objetos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS fabricante (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

-- Basado en agregarproducto.php, eliminarproducto.php y actualizarUnidades.php
DROP TABLE IF EXISTS productos;
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    modelo VARCHAR(100) NOT NULL,
    descripcion TEXT,              -- <-- Añadir esta línea
    idObj INT,
    idFab INT,
    idCat INT,
    precio DECIMAL(10,2),
    unidades INT,
    img VARCHAR(255),
    FOREIGN KEY (idFab) REFERENCES fabricante(id) ON DELETE SET NULL
    -- (Y tus otras llaves foráneas)
);

--- Tabla Mouse
DROP TABLE IF EXISTS mouse;
CREATE TABLE mouse (
    id INT AUTO_INCREMENT PRIMARY KEY,
    forma VARCHAR(100),
    sensor VARCHAR(100),
    peso VARCHAR(50)
);

-- Tabla Teclado
DROP TABLE IF EXISTS teclado;
CREATE TABLE teclado (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tamano VARCHAR(100),
    switches VARCHAR(100),
    rgb VARCHAR(50)
);

-- Tabla Mousepad
DROP TABLE IF EXISTS mousepad;
CREATE TABLE mousepad (
    id INT AUTO_INCREMENT PRIMARY KEY,
    material VARCHAR(100),
    tamano VARCHAR(100),
    color VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS carrito (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idUsuario INT NOT NULL,
    idProducto INT NOT NULL,
    unidades INT NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (idUsuario) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (idProducto) REFERENCES productos(id) ON DELETE CASCADE
);

-- Tabla compras
CREATE TABLE compras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idUsuario INT NOT NULL,
    idProducto INT NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    precio DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    unidades INT NOT NULL DEFAULT 1,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idUsuario) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (idProducto) REFERENCES productos(id) ON DELETE CASCADE
);

-- Basado en favoritos.php[cite: 2]
CREATE TABLE IF NOT EXISTS favoritos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_producto INT,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_producto) REFERENCES productos(id)
);
