-- base de datos en donde un usuario tiene muchas publicaciones y esas pertenecen solo a ese usuario 1:N
-- OJO CUIDADO CON NO PONER EL ESPACIO EN LOS COMENTARIOS
USE TWITTER;
DROP TABLE IF EXISTS PUBLICACIONES;
DROP TABLE IF EXISTS USUARIOS;

CREATE TABLE USUARIOS(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    NOMBRE VARCHAR(100),
    CORREO VARCHAR(100),
    CONTRASENA VARCHAR(255) -- Cambiado a 255 para permitir almacenar hashes de contraseña
);

-- TODO: HACER LAS CONTRASEÑAS CON HASH

INSERT INTO USUARIOS (NOMBRE, CORREO, CONTRASENA) VALUES ('Juan Pérez', 'juan.perez@example.com', 'contrasena123');
INSERT INTO USUARIOS (NOMBRE, CORREO, CONTRASENA) VALUES ('Ana López', 'ana.lopez@example.com', 'ana123456');
INSERT INTO USUARIOS (NOMBRE, CORREO, CONTRASENA) VALUES ('Luis Martínez', 'luis.mtz@example.com', 'luis7890');


CREATE TABLE PUBLICACIONES(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    USUARIO_ID INT,
    TITULO VARCHAR(100),
    TEXTO VARCHAR(250),
    FECHA DATE,
    FOREIGN KEY (USUARIO_ID) REFERENCES USUARIOS(ID)
);

INSERT INTO PUBLICACIONES (USUARIO_ID, TITULO, TEXTO, FECHA) VALUES (1, 'Mi primera publicación', 'Este es el texto de mi primera publicación en mini Twitter.', CURDATE());
INSERT INTO PUBLICACIONES (USUARIO_ID, TITULO, TEXTO, FECHA) VALUES (2, 'Hola mundo', 'Acabo de unirme a mini Twitter y estoy explorando.', CURDATE());
INSERT INTO PUBLICACIONES (USUARIO_ID, TITULO, TEXTO, FECHA) VALUES (3, 'Buenas noches', 'Espero que todos hayan tenido un gran día!', CURDATE());

