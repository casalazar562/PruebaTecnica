<?php
include 'models/Conexion.php';
include 'models/Bien.php';
include 'models/DatosBienes.php';

$objDatosBienes = new DatosBienes();
$bienesGuardados = $objDatosBienes->obtenerBienes();

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="css/customColors.css" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.css" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="css/index.css" media="screen,projection" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Formulario</title>
</head>

<body>
  <video src="img/video.mp4" id="vidFondo"></video>

  <div class="contenedor">
    <div class="card rowTitulo">
      <h1>Bienes Intelcost</h1>
    </div>
    <div class="colFiltros">
      <form action="#" method="post" id="formulario">
        <div class="filtrosContenido">
          <div class="tituloFiltros">
            <h5>Filtros</h5>
          </div>
          <div class="filtroCiudad input-field">
            <p><label for="selectCiudad">Ciudad:</label><br></p>
            <select name="ciudad" id="selectCiudad">
              <option value="" selected>Elige una ciudad</option>
              <?php
              $data = file_get_contents("data-1.json");
              $ciudades = json_decode($data, true);
              $noRepeat = [];
              foreach ($ciudades as $ciudad) {

                array_push($noRepeat, $ciudad['Ciudad']);
              }

              $lists = array_values(array_unique($noRepeat));
              foreach ($lists as $list) {


              ?>

                <option value="<?php echo $list ?>"><?php echo $list ?></option>
              <?php

              }
              ?>
            </select>
          </div>
          <div class="filtroTipo input-field">
            <p><label for="selecTipo">Tipo:</label></p>
            <br>
            <select name="tipo" id="selectTipo">
              <option value="">Elige un tipo</option>
              <?php
              $data = file_get_contents("data-1.json");
              $tipos = json_decode($data, true);
              $noRepeat = [];
              foreach ($tipos as $tipo) {

                array_push($noRepeat, $tipo['Tipo']);
              }

              $lists = array_values(array_unique($noRepeat));
              foreach ($lists as $list) {


              ?>

                <option value="<?php echo $list ?>"><?php echo $list ?></option>
              <?php

              }
              ?>

            </select>
          </div>
          <div class="filtroPrecio">
            <label for="rangoPrecio">Precio:</label>
            <input type="text" id="rangoPrecio" name="precio" value="" />
          </div>
          <div class="botonField">
            <input id="btn_buscar" type="submit" class="btn white" value="Buscar" id="submitButton">
          </div>
        </div>
      </form>
    </div>
    <div id="tabs" style="width: 75%;">
      <ul>
        <li><a href="#tabs-1">Bienes disponibles</a></li>
        <li><a href="#tabs-2">Mis bienes</a></li>
        <li><a href="#tabs-3">Reportes</a></li>
      </ul>
      <div id="tabs-1">
        <div class="colContenido" id="divResultadosBusqueda">
          <div class="tituloContenido card" style="justify-content: center;">
            <h5>Resultados de la búsqueda:</h5>

            <?php
            $data = file_get_contents("data-1.json");
            $bienes = json_decode($data, true);
            if (isset($_POST['ciudad']) && isset($_POST['tipo'])) {


              if ($_POST['ciudad'] != "" || $_POST['tipo'] != "") {

                $r = array_filter($bienes, function ($e) {
                  return $e['Ciudad'] == $_POST['ciudad'] || $e['Ciudad'] == $_POST['tipo'];
                });

                foreach ($r as $bien) {
            ?>

                  <div class="divider">
                  </div>
                  <form action="controller/BienesController.php" method="POST">
                    <input name="opcion" type="hidden" value="1">
                    <div class="row margin-bienes">
                      <img class="col s5 mt6" src="img/home.jpg" alt="" height="90px">
                      <div class="row col s7">
                        <spam class="col s5 title" for="">Dirección: </spam><label class="col s7"><?php echo $bien['Direccion'] ?></label>
                        <spam class="col s5 title" for="">Ciudad: </spam><label class="col s7"><?php echo $bien['Ciudad'] ?></label>
                        <spam class="col s5 title" for="">Teléfono: </spam><label class="col s7"><?php echo $bien['Telefono'] ?></label>
                        <spam class="col s5 title" for="">Código postal: </spam><label class="col s7"><?php echo $bien['Codigo_Postal'] ?></label>
                        <spam class="col s5 title" for="">Tipo: </spam><label class="col s7"><?php echo $bien['Tipo'] ?></label>
                        <spam class="col s5 title" for="">Precio: </spam><label class="col s7"><?php echo $bien['Precio'] ?></label>
                      </div>
                    </div>
                    <input type="hidden" value="<?php echo $bien['Direccion'] ?>" name="txtDireccion">
                    <input type="hidden" value="<?php echo $bien['Ciudad'] ?>" name="txtCiudad">
                    <input type="hidden" value="<?php echo $bien['Telefono'] ?>" name="txtTelefono">
                    <input type="hidden" value="<?php echo $bien['Codigo_Postal'] ?>" name="txtCodigo">
                    <input type="hidden" value="<?php echo $bien['Tipo'] ?>" name="txtTipo">
                    <input type="hidden" value="<?php echo $bien['Precio'] ?>" name="txtPrecio">
                    <button type="submit" class="btn_guardar">Guardar</button>
                  </form>
                <?php
                }
              }
              // echo print_r($r);
            } else {

              foreach ($bienes as $bien) {
                ?>

                <div class="divider">
                </div>
                <form action="controller/BienesController.php" method="POST">
                  <input name="opcion" type="hidden" value="1">
                  <div class="row margin-bienes">
                    <img class="col s5 mt6" src="img/home.jpg" alt="" height="90px">
                    <div class="row col s7">

                      <spam class="col s5 title" for="">Dirección: </spam><label class="col s7"><?php echo $bien['Direccion'] ?></label>
                      <spam class="col s5 title" for="">Ciudad: </spam><label class="col s7"><?php echo $bien['Ciudad'] ?></label>
                      <spam class="col s5 title" for="">Teléfono: </spam><label class="col s7"><?php echo $bien['Telefono'] ?></label>
                      <spam class="col s5 title" for="">Código postal: </spam><label class="col s7"><?php echo $bien['Codigo_Postal'] ?></label>
                      <spam class="col s5 title" for="">Tipo: </spam><label class="col s7"><?php echo $bien['Tipo'] ?></label>
                      <spam class="col s5 title" for="">Precio: </spam><label class="col s7"><?php echo $bien['Precio'] ?></label>
                    </div>
                  </div>
                  <input type="hidden" value="<?php echo $bien['Direccion'] ?>" name="txtDireccion">
                  <input type="hidden" value="<?php echo $bien['Ciudad'] ?>" name="txtCiudad">
                  <input type="hidden" value="<?php echo $bien['Telefono'] ?>" name="txtTelefono">
                  <input type="hidden" value="<?php echo $bien['Codigo_Postal'] ?>" name="txtCodigo">
                  <input type="hidden" value="<?php echo $bien['Tipo'] ?>" name="txtTipo">
                  <input type="hidden" value="<?php echo $bien['Precio'] ?>" name="txtPrecio">
                  <button type="submit" class="btn_guardar">Guardar</button>
                </form>
            <?php
              }
            }

            ?>
          </div>

        </div>
      </div>

      <div id="tabs-2">
        <div class="colContenido" id="divResultadosBusqueda">
          <div class="tituloContenido card" style="justify-content: center;">
            <h5>Bienes guardados:</h5>
            <?php
            while ($save = $bienesGuardados->fetchObject()) {
            ?>
              <div class="divider"></div>
              <form action="controller/BienesController.php" method="DELETE">
                <input name="opcion" type="hidden" value="2">
                <div class="row margin-bienes">
                  <img class="col s5 mt6" src="img/home.jpg" alt="" height="90px">
                  <div class="row col s7">

                    <spam class="col s5 title" for="">Dirección: </spam><label class="col s7"><?php echo $save->direccion ?></label>
                    <spam class="col s5 title" for="">Ciudad: </spam><label class="col s7"><?php echo $save->ciudad ?></label>
                    <spam class="col s5 title" for="">Teléfono: </spam><label class="col s7"><?php echo $save->telefono ?></label>
                    <spam class="col s5 title" for="">Código postal: </spam><label class="col s7"><?php echo $save->codigo_postal ?></label>
                    <spam class="col s5 title" for="">Tipo: </spam><label class="col s7"><?php echo $save->tipo ?></label>
                    <spam class="col s5 title" for="">Precio: </spam><label class="col s7"><?php echo $save->precio ?></label>
                  </div>
                </div>
                <input type="hidden" value="<?php echo $save->id ?>" name="txtId">

                <button type="submit" class="btn_eliminar">Eliminar</button>
              </form>
            <?php
            }
            ?>
          </div>
        </div>
      </div>

      <div id="tab_3">
       
        <h4>Exportar reporte:</h4>

        <div class="divider"></div>
        <form action="Reporte.php" method="post" id="formulario">
          <div class="filtrosContenido">
            <div class="tituloFiltros">
              <h5>Filtros</h5>
            </div>
            <div class="filtroCiudad input-field">
              <p><label for="selectCiudad">Ciudad:</label><br></p>
              <select name="ciudad" id="selectCiudad">
                <option value="" selected>Elige una ciudad</option>
                <?php
                $data = file_get_contents("data-1.json");
                $ciudades = json_decode($data, true);
                $noRepeat = [];
                foreach ($ciudades as $ciudad) {

                  array_push($noRepeat, $ciudad['Ciudad']);
                }

                $lists = array_values(array_unique($noRepeat));
                foreach ($lists as $list) {


                ?>

                  <option value="<?php echo $list ?>"><?php echo $list ?></option>
                <?php

                }
                ?>
              </select>
            </div>
            <div class="filtroTipo input-field">
              <p><label for="selecTipo">Tipo:</label></p>
              <br>
              <select name="tipo" id="selectTipo">
                <option value="">Elige un tipo</option>
                <?php
                $data = file_get_contents("data-1.json");
                $tipos = json_decode($data, true);
                $noRepeat = [];
                foreach ($tipos as $tipo) {

                  array_push($noRepeat, $tipo['Tipo']);
                }

                $lists = array_values(array_unique($noRepeat));
                foreach ($lists as $list) {


                ?>

                  <option value="<?php echo $list ?>"><?php echo $list ?></option>
                <?php

                }
                ?>

              </select>
            </div>

            <div class="botonField">
              <input type="submit" class="btn white" value="GENERAR EXCEL"  id="export_data" name="export_data">
             
            </div>
          </div>
        </form>
      </div>
    </div>


    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

    <script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="js/buscador.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#tabs").tabs();
      });
    </script>
</body>

</html>