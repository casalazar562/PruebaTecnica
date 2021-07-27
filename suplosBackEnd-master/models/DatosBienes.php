<?php

class DatosBienes {

    private $objConexion;
    private $error;

    public function __construct() {
        $this->objConexion = Conexion::singleton();
    }

    public function getError() {
        return $this->error;
    }
    
    // funcion para agregar un bien a la base de datos 

    public function agregarBienes(Bien $bien) {
        try {
            $consulta = "insert into bienes values(null,?,?,?,?,?,?)";
            $resultado = $this->objConexion->prepare($consulta);
            $resultado->bindParam(1, $bien->getDireccion());
            $resultado->bindParam(2, $bien->getCiudad());
            $resultado->bindParam(3, $bien->getTelefono());
            $resultado->bindParam(4, $bien->getCodigoPostal());
            $resultado->bindParam(5, $bien->getTipo());
            $resultado->bindParam(6, $bien->getPrecio());
            $resultado->execute();
            return$resultado;
        } catch (PDOException $ex) {
            $this->error = $ex->getMessage();
            return false;
        }
    }

    // funcion para obtener la lista de bienes guardados en la base de datos 

    public function obtenerBienes() {
        try {
            $consulta = "select * from bienes";
            $resultado = $this->objConexion->query($consulta);
            return $resultado;
        } catch (PDOException $ex) {
            $this->error = $ex->getMessage();
            return null;
        }
    }

    // funcion para eliminar un bie de la base de datos este recibe como parametro el id de dicho bien.
    public function eliminarBienes($id) {
        try {
            //eliminar de la tabla bienes
            $consulta = "DELETE FROM bienes WHERE id=? ";
            $resultado = $this->objConexion->prepare($consulta);
            $resultado->bindParam(1, $id);
            $resultado->execute();
            return $resultado;
        } catch (PDOException $ex) {
            $this->error = $ex->getMessage();
            return false;
        }
    }

}
