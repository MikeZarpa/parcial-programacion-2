-- Creación de la base de datos
CREATE DATABASE login_db;

-- Usar la base de datos recién creada
USE login_db;

-- Crear la tabla de usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL,
    contrasena VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insertar 10 registros de prueba
INSERT INTO usuarios (nombre_usuario, contrasena, email) VALUES
    ('usuario1', 'contrasena1', 'usuario1@example.com'),
    ('usuario2', 'contrasena2', 'usuario2@example.com'),
    ('usuario3', 'contrasena3', 'usuario3@example.com'),
    ('usuario4', 'contrasena4', 'usuario4@example.com'),
    ('usuario5', 'contrasena5', 'usuario5@example.com'),
    ('usuario6', 'contrasena6', 'usuario6@example.com'),
    ('usuario7', 'contrasena7', 'usuario7@example.com'),
    ('usuario8', 'contrasena8', 'usuario8@example.com'),
    ('usuario9', 'contrasena9', 'usuario9@example.com'),
    ('usuario10', 'contrasena10', 'usuario10@example.com');
