<?php
include($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/model/conexion.php');


class CanchaController extends conexion {

   // Método para listar canchas de un propietario específico
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
                                  $fila["url"], $fila["disponibilidad"]);
    }
    $stmt->close();
    return $resultado;
}


    // Método para agregar una nueva cancha
    public function agregar($cancha) {
        $sql = "INSERT INTO canchas (id_propietario, nombre, tipo, capacidad, descripcion, precio, url, disponibilidad) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->cn()->prepare($sql);
        $stmt->bind_param("ississds", $cancha->getIdPropietario(), $cancha->getNombre(), $cancha->getTipo(), 
                          $cancha->getCapacidad(), $cancha->getDescripcion(), $cancha->getPrecio(), 
                          $cancha->getUrl(), $cancha->getDisponibilidad());
        $stmt->execute();
        $stmt->close();
    }

    // Método para actualizar una cancha existente
    public function actualizar($cancha) {
        $sql = "UPDATE canchas SET nombre = ?, tipo = ?, capacidad = ?, descripcion = ?, precio = ?, 
                url = ?, disponibilidad = ? WHERE id = ?";
        $stmt = $this->cn()->prepare($sql);
        $stmt->bind_param("ssisdssi", $cancha->getNombre(), $cancha->getTipo(), $cancha->getCapacidad(), 
                          $cancha->getDescripcion(), $cancha->getPrecio(), $cancha->getUrl(), 
                          $cancha->getDisponibilidad(), $cancha->getIdCancha());
        $stmt->execute();
        $stmt->close();
    }

    // Método para eliminar una cancha
    public function eliminar($id_cancha) {
        $sql = "DELETE FROM canchas WHERE id = ?";
        $stmt = $this->cn()->prepare($sql);
        $stmt->bind_param("i", $id_cancha);
        $stmt->execute();
        $stmt->close();
    }
}
?>

