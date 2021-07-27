<?php

extract($_REQUEST);
include '../models/Conexion.php';
include '../models/Bien.php';
include '../models/DatosBienes.php';

$datosBienes= new DatosBienes();

switch ($opcion) {
    case 1://agregar un bien a la base de datos 
        $objBienes= new Bien();
        $objBienes->setDireccion($txtDireccion);
        $objBienes->setCiudad($txtCiudad);
        $objBienes->setCodigoPostal($txtCodigo);
        $objBienes->setTelefono($txtTelefono);
        $objBienes->setTipo($txtTipo);
        $objBienes->setPrecio($txtPrecio);

        $agregado = $datosBienes->agregarBienes($objBienes);



        if ($agregado) {
            $msj = 'Agregado correctamente';
        } else {
            $msj = "problemas al agregar.... " . $datosBienes->getError();
        }
        header("location:../index.php");

        break;

    case 2://eliminar un bien que se guardo en la base de datos 
        
        $eliminar= $datosBienes->eliminarBienes($txtId);        
      
        
        if ($eliminar) {
            $msj = 'Eliminado correctamente';
        } else {
            $msj = "problemas al eliminar.... " . $datosBienes->getError();
        }
        header("location:../index.php");

        break;

    }



