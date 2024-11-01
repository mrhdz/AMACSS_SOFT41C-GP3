<?php
include_once 'usuario.php';
include '../../model/conexion.php';

class UsuarioController {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function crearUsuario($usuario) {
        $sql = "INSERT INTO usuarios (nombre, email, telefono, password, rol) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("sssss", $usuario->getNombre(), $usuario->getEmail(), $usuario->getTelefono(), $usuario->getPassword(), $usuario->getRol());
        return $stmt->execute();
    }

    public function obtenerUsuarioPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE id_usuario = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function actualizarUsuario($usuario) {
        $sql = "UPDATE usuarios SET nombre = ?, email = ?, telefono = ?, password = ?, rol = ? WHERE id_usuario = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("sssssi", $usuario->getNombre(), $usuario->getEmail(), $usuario->getTelefono(), $usuario->getPassword(), $usuario->getRol(), $usuario->getIdUsuario());
        return $stmt->execute();
    }

    public function eliminarUsuario($id) {
        $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
