<?php

/*
 * clase bien para crear el objeto de la base de datos
 */

/**
 * Description of Bienes
 *
 * @author CASC
 */
class Bien {

    private $id;
    private $direccion;
    private $ciudad;
    private $telefono;
    private $codigo_postal;
    private $tipo;
    private $precio;    

    function getId() {
        return $this->id;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getCiudad() {
        return $this->ciudad;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getCodigoPostal() {
        return $this->codigo_postal;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getPrecio() {
        return $this->precio;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setCodigoPostal($codigo_postal) {
        $this->codigo_postal = $codigo_postal;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }   
    
   

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    



}
