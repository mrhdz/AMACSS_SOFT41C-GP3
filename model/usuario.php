<?php
class Usuario {
    private $id_usuario;
    private $nombre;
    private $email;
    private $telefono;
    private $password;
    private $rol;
    
    public function __construct($id = "", $nombre = "", $email = "", $telefono = "", $password = "", $rol = "usuario_normal") {
        $this->id_usuario = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->password = $password;
        $this->rol = $rol;
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRol() {
        return $this->rol;
    }

    public function setIdUsuario($id) {
        $this->id_usuario = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }
}
?>
