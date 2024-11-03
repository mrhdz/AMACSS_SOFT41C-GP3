<?php
include($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/model/conexion.php');


class CanchaController extends conexion {

   // Método para listar canchas de un propietario específico
   public function listar($usuarioId){
    $sql = "SELECT * FROM canchas WHERE id_propietario = ?";
    $stmt = $this->cn()->prepare($sql);
    $stmt->bind_param("i", $usuarioId);
    $stmt->execute();
    $rs = $stmt->get_result();
    $resultado = array();
    while ($fila = $rs->fetch_assoc()) {
        $resultado[] = new Cancha($fila["id_cancha"], $fila["id_propietario"], $fila["nombre"], $fila["tipo"], 
            $fila["capacidad"], $fila["descripcion"], $fila["precio"], 
            $fila["urlImagen"], $fila["disponibilidad"]);
        }
    $stmt->close();
    return $resultado;
}

    // Método para listar todas las canchas disponibles con el nombre del propietario
    public function listarDisponibles() {
        $sql = "SELECT canchas.id_cancha, canchas.nombre, canchas.tipo, canchas.capacidad, 
                    canchas.descripcion, canchas.precio, canchas.urlImagen, canchas.disponibilidad,
                    usuarios.nombre AS propietario_nombre
                FROM canchas
                JOIN usuarios ON canchas.id_propietario = usuarios.id_usuario
                WHERE canchas.disponibilidad = 'disponible'";

        $stmt = $this->cn()->prepare($sql);
        $stmt->execute();
        $rs = $stmt->get_result();

        $resultado = array();
        while ($fila = $rs->fetch_assoc()) {
            $resultado[] = [
                "id_cancha" => $fila["id_cancha"],
                "nombre" => $fila["nombre"],
                "tipo" => $fila["tipo"],
                "capacidad" => $fila["capacidad"],
                "descripcion" => $fila["descripcion"],
                "precio" => $fila["precio"],
                "urlImagen" => $fila["urlImagen"],
                "disponibilidad" => $fila["disponibilidad"],
                "propietario_nombre" => $fila["propietario_nombre"]
            ];
        }

        $stmt->close();
        return $resultado;
    }

    // Método para agregar una nueva cancha
    public function agregar($cancha) {
        $sql = "INSERT INTO canchas (id_propietario, nombre, tipo, capacidad, descripcion, precio, urlImagen, disponibilidad) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->cn()->prepare($sql);
        
        // Guardar cada valor en una variable antes de pasarlo a bind_param
        $idPropietario = $cancha->getIdPropietario();
        $nombre = $cancha->getNombre();
        $tipo = $cancha->getTipo();
        $capacidad = $cancha->getCapacidad();
        $descripcion = $cancha->getDescripcion();
        $precio = $cancha->getPrecio();
        $urlImagen = $cancha->getUrlImagen();
        $disponibilidad = $cancha->getDisponibilidad();
        // Pasar variables a bind_param
        $stmt->bind_param("issisdss", $idPropietario, $nombre, $tipo, $capacidad, $descripcion, $precio, $urlImagen, $disponibilidad);
        $stmt->execute();
        if ($stmt->error) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        $stmt->close();
    }

    // Método para actualizar una cancha existente
    public function actualizar($cancha) {
        $sql = "UPDATE canchas SET nombre = ?, tipo = ?, capacidad = ?, descripcion = ?, precio = ?, urlImagen = ?, disponibilidad = ? WHERE id_cancha = ?";

        $stmt = $this->cn()->prepare($sql);
    
        $nombre = $cancha->getNombre();
        $tipo = $cancha->getTipo();
        $capacidad = $cancha->getCapacidad();
        $descripcion = $cancha->getDescripcion();
        $precio = $cancha->getPrecio();
        $urlImagen = $cancha->getUrlImagen();
        $disponibilidad = $cancha->getDisponibilidad();
        $id_cancha = $cancha->getIdCancha();
        
        // Asegúrate de que los tipos coinciden con el orden de los parámetros en la consulta
        $stmt->bind_param("ssisdssi", $nombre, $tipo, $capacidad, $descripcion, $precio, $urlImagen, $disponibilidad, $id_cancha);
        
        $stmt->execute();
        $stmt->close();
    }


    // Método para eliminar una cancha
    public function eliminar($id_cancha) {
        $sql = "DELETE FROM canchas WHERE id_cancha = ?";
        $stmt = $this->cn()->prepare($sql);
        $stmt->bind_param("i", $id_cancha);
        $stmt->execute();
        $stmt->close();
    }
}
?>

