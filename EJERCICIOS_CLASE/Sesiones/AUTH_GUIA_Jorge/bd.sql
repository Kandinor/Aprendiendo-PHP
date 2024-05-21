-- Eliminar las tablas is exiten
DROP TABLE IF EXISTS tokens;
DROP TABLE IF EXISTS usuarios;


-- Base de datos de usuarios con nombre, apellidos, email y contraseña
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    pass VARCHAR(255) NOT NULL
);

-- Algunos inserts de ejemplo
INSERT INTO usuarios (nombre, apellidos, email, pass) VALUES 
    ('Juan', 'García Pérez', 'juan@asd.es', '$2y$10$6EwZm4QoVNZpC3Mv4qY3Q.ttJ9sHvgcIkDeIt902CBIoSL/79Lcx.'),
    ('María', 'López García', 'mm@dsa.es', '$2y$10$0RpPoozo.8kcqfi1sxAXheYZG9JedWKCA9zwXMFFsuk0TutFj6kZC'),
    ('Pedro', 'Gómez Pérez', 'pedro@dwes.com', '$2y$10$lFuAL5rkprRz/7B1CdO7te9XnkW1k8VD5F9f4VQqkXwaWql8DDuDm');

-- Tenemos una tabla de token asociada a los usuarios tienen fecha de validez y además si han sido consumidos o no
CREATE TABLE tokens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    token VARCHAR(255) NOT NULL,
    usuario_id INT NOT NULL,
    fecha_validez DATETIME NOT NULL,
    consumido BOOLEAN NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- algunos ejemplos de tokens
INSERT INTO tokens (token, usuario_id, fecha_validez, consumido) VALUES 
    ('123456', 1, '2025-12-31 23:59:59', 0),
    ('654321', 2, '2025-12-31 23:59:59', 0),
    ('987654', 3, '2025-12-31 23:59:59', 0); 