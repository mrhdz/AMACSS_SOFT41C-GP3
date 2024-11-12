CREATE DATABASE sportspace;

USE sportspace;


-- Existing tables with modifications
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
    fecha_reserva DATE NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,
    duracion INT NOT NULL,
    estado ENUM('pendiente', 'confirmada', 'cancelada', 'modificada', 'aprobada') NOT NULL DEFAULT 'pendiente',
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

CREATE TABLE torneos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    fecha DATE NOT NULL,
    id_cancha INT NOT NULL,
    id_usuario INT NOT NULL,
    id_reserva INT NOT NULL,
    FOREIGN KEY (id_cancha) REFERENCES canchas(id_cancha),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_reserva) REFERENCES reservas(id_reserva)
);

CREATE TABLE notificaciones (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    mensaje TEXT NOT NULL,
    fecha DATETIME NOT NULL,
    leida BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

CREATE TABLE valoraciones (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_cancha INT NOT NULL,
    id_usuario INT NOT NULL,
    puntuacion INT NOT NULL,
    comentario TEXT,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cancha) REFERENCES canchas(id_cancha),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

CREATE TABLE problemas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_cancha INT NOT NULL,
    id_usuario INT NOT NULL,
    descripcion TEXT NOT NULL,
    fecha_reporte DATETIME NOT NULL,
    estado ENUM('pendiente', 'en_proceso', 'resuelto') DEFAULT 'pendiente',
    FOREIGN KEY (id_cancha) REFERENCES canchas(id_cancha),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

CREATE TABLE faq (
    id INT PRIMARY KEY AUTO_INCREMENT,
    pregunta TEXT NOT NULL,
    respuesta TEXT,
    id_usuario INT NOT NULL,
    id_usuario_respuesta INT,
    fecha_creacion DATETIME NOT NULL,
    fecha_respuesta DATETIME,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_usuario_respuesta) REFERENCES usuarios(id_usuario)
);

CREATE TABLE participantes_torneo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    torneo_id INT NOT NULL,
    usuario_id INT NOT NULL,
    fecha_inscripcion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (torneo_id) REFERENCES torneos(id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id_usuario),
    UNIQUE KEY unique_participante (torneo_id, usuario_id)
);




DROP DATABASE sportspace;