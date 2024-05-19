DROP TABLE IF EXISTS articulo;

CREATE TABLE articulo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(50),
    contenido VARCHAR(250),
    fecha DATE
);