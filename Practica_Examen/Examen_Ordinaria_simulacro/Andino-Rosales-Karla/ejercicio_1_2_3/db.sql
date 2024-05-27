-- Eliminar las tablas is exiten
DROP TABLE IF EXISTS pedidos;
DROP TABLE IF EXISTS flores;
DROP TABLE IF EXISTS tokens;
DROP TABLE IF EXISTS usuarios;

/*el ejercicio lee y escribe*/
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
    ('Juan', 'García Pérez', 'juan@asd.es', '$2y$10$6EwZm4QoVNZpC3Mv4qY3Q.ttJ9sHvgcIkDeIt902CBIoSL/79Lcx.'), /*1234*/
    ('María', 'López García', 'mm@dsa.es', '$2y$10$0RpPoozo.8kcqfi1sxAXheYZG9JedWKCA9zwXMFFsuk0TutFj6kZC'),
    ('Pedro', 'Gómez Pérez', 'pedro@dwes.com', '$2y$10$lFuAL5rkprRz/7B1CdO7te9XnkW1k8VD5F9f4VQqkXwaWql8DDuDm');

-- Tenemos una tabla de token asociada a los usuarios tienen fecha de validez y además si han sido consumidos o no

CREATE TABLE tokens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    token VARCHAR(255) NOT NULL,
    usuario_id INT NOT NULL,
    fecha_validez DATETIME NOT NULL,
    consumido BOOLEAN NOT NULL, /*flag*/
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- algunos ejemplos de tokens

INSERT INTO tokens (token, usuario_id, fecha_validez, consumido) VALUES 
    ('123456', 1, '2025-12-31 23:59:59', 0),
    ('654321', 2, '2025-12-31 23:59:59', 0),
    ('987654', 3, '2025-12-31 23:59:59', 0);


-- Tenemos una tabla de flores con nombre, precio y stock disponible

CREATE TABLE flores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL
);

-- Algunos inserts de ejemplo

INSERT INTO flores (nombre, precio, stock) VALUES 
    ('Rosa', 10.00, 100),
    ('Margarita', 5.00, 200),
    ('Clavel', 7.00, 150);  

-- Almacen de pedidos con flor, dirección, fecha y unidades, solo valores 1, 2 o 3

CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    flor_id INT NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    fecha DATETIME NOT NULL,
    unidades INT NOT NULL,
    FOREIGN KEY (flor_id) REFERENCES flores(id)
);

-- 10 ejemplos con direcciones y fechas distintas, unidades entre 1 y 3

INSERT INTO pedidos (flor_id, direccion, fecha, unidades) VALUES 
    (1, 'Calle de la Rosa, 1', '2025-12-31 23:59:59', 1),
    (2, 'Calle de la Margarita, 2', '2025-12-31 23:59:59', 2),
    (3, 'Calle del Clavel, 3', '2025-12-31 23:59:59', 3),
    (1, 'Calle de la Rosa, 4', '2025-12-31 23:59:59', 1),
    (2, 'Calle de la Margarita, 5', '2025-12-31 23:59:59', 2),
    (3, 'Calle del Clavel, 6', '2025-12-31 23:59:59', 3),
    (1, 'Calle de la Rosa, 7', '2025-12-31 23:59:59', 1),
    (2, 'Calle de la Margarita, 8', '2025-12-31 23:59:59', 2),
    (3, 'Calle del Clavel, 9', '2025-12-31 23:59:59', 3),
    (1, 'Calle de la Rosa, 10', '2025-12-31 23:59:59', 1);

