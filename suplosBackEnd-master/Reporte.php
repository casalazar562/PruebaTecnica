<?php
extract($_REQUEST);
 $data = file_get_contents("data-1.json");
 $bienes = json_decode($data, true);
 
    
$r = array_filter($bienes, function ($e) use($ciudad,$tipo){
       return $e['Ciudad'] == $ciudad || $e['Ciudad'] == $tipo;
     });
 
$salida = "";
$salida .= "<table>";
$salida .= "<thead> <th>Direccion</th> <th>Ciudad</th><th>Telefono</th> <th>Codigo postal</th><th>Tipo</th> <th>Precio</th></thead>";
foreach($r as $bien){
    $salida .= "<tr> <td>".$bien['Direccion']."</td> <td>".$bien['Ciudad']."</td><td>".$bien['Telefono']."</td><td>".$bien['Codigo_Postal']."</td><td>".$bien['Tipo']."</td><td>".$bien['Precio']."</td> </tr>";
}
$salida .= "</table>";
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=usuarios_".time().".xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $salida;