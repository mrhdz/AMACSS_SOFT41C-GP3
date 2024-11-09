CREATE DATABASE sportspace;

USE sportspace;

CREATE TABLE usuarios (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telefono VARCHAR(15),
    PASSWORD VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'usuario_normal') NOT NULL DEFAULT 'usuario_normal'
);

CREATE TABLE canchas (
    id_cancha INT PRIMARY KEY AUTO_INCREMENT,
    id_propietario INT,
    nombre VARCHAR(100) NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    capacidad INT NOT NULL,
    descripcion TEXT,
    precio DOUBLE,
    urlImagen VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_propietario) REFERENCES usuarios(id_usuario) ON DELETE SET NULL
);

CREATE TABLE reservas (
    id_reserva INT PRIMARY KEY AUTO_INCREMENT,
    id_cancha INT NOT NULL,
    id_usuario INT NOT NULL,
    fecha_reserva DATE NOT NULL,       -- Solo la fecha de la reserva
    hora_inicio TIME NOT NULL,         -- Hora de inicio de la reserva
    hora_fin TIME NOT NULL,            -- Hora de fin de la reserva
    duracion INT NOT NULL,             -- Duración de la reserva (en horas o minutos)
    estado ENUM('pendiente', 'confirmada', 'cancelada', 'modificada') NOT NULL DEFAULT 'pendiente',
    FOREIGN KEY (id_cancha) REFERENCES canchas(id_cancha) ON DELETE CASCADE,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE
);

CREATE TABLE historialReservas (
    id_historial INT PRIMARY KEY AUTO_INCREMENT,
    id_reserva INT NOT NULL,
    fecha_modificacion DATETIME NOT NULL,
    cambio TEXT NOT NULL,
    FOREIGN KEY (id_reserva) REFERENCES reservas(id_reserva) ON DELETE CASCADE
);