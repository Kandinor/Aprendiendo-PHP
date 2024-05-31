-- Eliminar tablas si existen para evitar errores de clave foránea
DROP TABLE IF EXISTS clientes_generos;
DROP TABLE IF EXISTS generos_musicales;
DROP TABLE IF EXISTS clientes;

-- Creación de la tabla clientes
CREATE TABLE clientes (
    cliente_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    suscripcion ENUM('mensual', 'trimestral') NOT NULL
);

-- Creación de la tabla géneros musicales
CREATE TABLE generos_musicales (
    genero_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

-- Creación de la tabla relación entre clientes y géneros
CREATE TABLE clientes_generos (
    cliente_id INT,
    genero_id INT,
    PRIMARY KEY (cliente_id, genero_id),
    FOREIGN KEY (cliente_id) REFERENCES clientes(cliente_id) ON DELETE CASCADE,
    FOREIGN KEY (genero_id) REFERENCES generos_musicales(genero_id) ON DELETE CASCADE
);

-- Inserción de géneros musicales
INSERT INTO generos_musicales (nombre) VALUES
('Rock'),
('Pop'),
('Jazz'),
('Blues'),
('Metal'),
('Country'),
('Electrónica'),
('Hip-Hop'),
('Reggae'),
('Clásica'),
('Soul'),
('Funk'),
('Disco'),
('Punk'),
('Folk'),
('R&B'),
('Ska'),
('World Music'),
('Indie'),
('Gospel');

-- Inserción de un cliente de ejemplo
INSERT INTO clientes (nombre, direccion, suscripcion) VALUES
('Juan Pérez', '123 Calle Ficticia, Ciudad Imaginaria', 'mensual');