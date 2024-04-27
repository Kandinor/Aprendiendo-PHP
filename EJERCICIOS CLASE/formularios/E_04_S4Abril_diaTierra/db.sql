DROP TABLE IF EXISTS Accion;
CREATE TABLE Accion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    lugar VARCHAR(255) NOT NULL,
    nombre VARCHAR(100),
    descripcion TEXT,
    foto VARCHAR(255)
);

INSERT INTO Accion (fecha, lugar, nombre, descripcion, foto) VALUES
    ('2024-04-23', 'Parque Central', 'Juan Pérez', 'Plantación de árboles', 'foto.jpg'),
    ('2024-04-24', 'Jardín Botánico', 'Ana María', 'Limpieza de playas', 'limpieza.jpg'),
    ('2024-04-25', 'Reserva Natural', 'Carlos López', 'Reforestación local', 'reforestacion.jpg');