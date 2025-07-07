<?php

 if (isset($_GET['accion']) && $_GET['accion'] === 'buscar_parroquias') {
    require_once('controllers/ParroquiasController.php');
    require_once('controllers/MunicipiosController.php');
    require_once('controllers/SitiosHistoricosController.php'); // donde está buscarParroquiasPorEstado

    $cod_estado = $_GET['cod_estado'] ?? null;

    if ($cod_estado) {
        $parroquias = SitiosHistoricosController::buscarParroquiasPorEstado($cod_estado);
        header('Content-Type: application/json');
        echo json_encode($parroquias);
        exit; // 👈 Esto es clave: evita que se siga ejecutando el HTML
    }
}

if (isset($_SESSION['User'])) { 
    $router = new Router();
    $action = $router->getAction();

    $id = $router->getId();
    $id_sitiohistorico = "";
    $nombre_sitio = "";
    $fecha_sitio = "";
    $historia_sitio = "";
    $id_parroquia = "";
    $id_ciudad = "";
    $id_estado = "";
    $TipoOperacion = "";
    $direccionamiento = "";

    if ($action == "IngresarSitioHistorico") {
        $TipoOperacion = "Ingresar";
        $direccionamiento = SERVERURL . "SitiosHistoricos/IngresarSitioHistorico1";
        require_once('controllers/SitiosHistoricosController.php');
        $controller = new SitiosHistoricosController();
        $result_sitio = $controller->BuscarUltimoSitioHistorico();
        $numrows = mysqli_num_rows($result_sitio);
        while ($numrows = mysqli_fetch_array($result_sitio)) { 
            $id_sitiohistorico = $numrows["identific"] + 1; 
        }
    } elseif (($action == "ActualizarSitioHistorico") || ($action == "BorrarSitioHistorico")) {
        if ($action == "ActualizarSitioHistorico") {
            $TipoOperacion = "Actualizar";
            $direccionamiento = SERVERURL . "SitiosHistoricos/ActualizarSitioHistorico1";
        }
        if ($action == "BorrarSitioHistorico") {
            $TipoOperacion = "Borrar";
            $direccionamiento = SERVERURL . "SitiosHistoricos/BorrarSitioHistorico1";
        }
        $id_sitiohistorico = $id;
        require_once('controllers/SitiosHistoricosController.php');
        $controller = new SitiosHistoricosController();
        $result_sitio = $controller->BuscarSitioById($id_sitiohistorico);
        if (!empty($result_sitio) && $result_sitio !== null) {
            $numrows = mysqli_num_rows($result_sitio);
            if ($numrows != 0) {
                while ($numrows = mysqli_fetch_array($result_sitio)) {
                    $id_sitiohistorico = $numrows["id_SitiosHistoricos"];
                    $nombre_sitio = $numrows['Nombre_Sitio'];
                    $fecha_sitio = $numrows['fecha_creacion'];
                    $historia_sitio = $numrows['Historia'];
                    $id_parroquia = $numrows['CodParroquia'];
                    $id_ciudad = $numrows['CodCiudad'];
                }
            }
        }
    }elseif (($action == "IngresarSitioHistorico1") OR ($action == "ActualizarSitioHistorico1") OR ($action == "BorrarSitioHistorico1"))// Es porque hubo un error al ingresar o actualizar y hay que mantener los datos en pantalla
   {  
   
      if (isset($_POST['nombre_sitio']) ==1) 
      {  
            $id_sitiohistorico = $_POST['id_sitiohistorico'];
            $nombre_sitio = $_POST['nombre_sitio'];
            $fecha_sitio = $_POST['fecha_sitio'];
            $historia_sitio = $_POST['historia_sitio'];
            $id_estado = $_POST['id_estado'];
            $id_parroquia = $_POST['id_parroquia'];
            $id_ciudad = $_POST['id_ciudad'];
       }
  
      if ($action == "IngresarSitioHistorico1") { // Cuando el error ocurrion cuando ingresaba
      
          $TipoOperacion = "Ingresar";
          $direccionamiento = SERVERURL . "SitiosHistoricos/IngresarSitioHistorico1";

      }elseif ($action == "ActualizarSitioHistorico1") { // Cuando el error ocurrio cuando actualizaba

          $TipoOperacion = "Actualizar";
          $direccionamiento = SERVERURL . "SitiosHistoricos/ActualizarSitioHistorico1";
      
      }elseif ($action == "BorrarSitioHistorico1") { // Cuando el error ocurrio cuando eliminaba
          $TipoOperacion = "Borrar";
          $direccionamiento = SERVERURL . "SitiosHistoricos/BorrarSitioHistorico1";
      }

   }
     
?>

<div class="panel-heading" style="background-color: #2F5597">
    <div class="row">
        <div class="col-12" style="color: white">
            <h4><b><?php echo $TipoOperacion;?> Sitio Histórico</b></h4>
        </div>
    </div>
</div>

<?php
    require_once('controllers/CiudadesController.php');
    require_once('controllers/EstadosController.php');
    require_once('controllers/ParroquiasController.php');
    $ciudades = CiudadesController::ListarCiudades1();
    $estados = EstadosController::ListarEstados1();

    $ciudades_agrupados = [];
    while ($row = $ciudades->fetch_assoc()) {
        $ciudades_agrupados[$row['Cod_Estado']][] = $row;
    }


?>

<div class="page-content">
    <form action="<?php echo $direccionamiento;?>" method="POST">
        <div class="alert" style="background-color: #F9F9F9">
            <br><br>
            <div class="row">
                <div class="col-2">
                    <label for="id_sitiohistorico"><b>ID:</b></label>
                    <input class="form-control" type="text" name="id_sitiohistorico" value="<?php echo $id_sitiohistorico;?>" readonly>
                </div>
                <div class="col-2">
                    <label for="nombre_sitio"><b>Nombre:</b></label>
                    <input class="form-control" type="text" name="nombre_sitio" value="<?php echo $nombre_sitio;?>" required>
                </div>
                <div class="col-2">
                    <label for="fecha_sitio"><b>Fecha:</b></label>
                    <input class="form-control" type="date" name="fecha_sitio" value="<?php echo $fecha_sitio;?>" required>
                </div>
                <div class="col-3">
                    <label for="historia_sitio"><b>Historia:</b></label>
                    <input class="form-control" type="text" name="historia_sitio" value="<?php echo $historia_sitio;?>" required>
                </div>
                <div class="col-4">
                    <label for="id_estado"><b>Estado:</b></label>
                    <select class="form-control" name ="id_estado" id="cbx_estado" onchange="cargarDatos()">
                        <option value ="">-- Selecciona un estado --</option>
                        <?php
                            if ($estados) {
                                while ($row = mysqli_fetch_assoc($estados)) {
                                    $selected = ($id_estado == $row['Cod_Estado']) ? 'selected' : '';
                                    echo "<option value='{$row['Cod_Estado']}' data-estado='{$row['Cod_Estado']}' $selected>{$row['Des_Estado']}</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="col-4">
                    <label for="id_ciudad"><b>Ciudad:</b></label>
                    <select class="form-control" name ="id_ciudad" id="cbx_ciudad" required>
                        <option value ="">-- Selecciona una ciudad --</option>
                    </select>
                </div>
                <div class="col-4">
                    <label for="id_parroquia"><b>Parroquia:</b></label>
                    <select class="form-control" name ="id_parroquia" id="cbx_parroquia" required>
                        <option value ="">-- Selecciona una parroquia --</option>
                    </select>
                </div>
            </div>
            <br><br>
            <button class="btn btn-outline-success" type="submit"><?php echo $TipoOperacion?></button>
        </div>
    </form>
</div>

<?php
} else {
    require_once('views/SitiosHistoricos/listarsitioshistoricos.php');
}
?>

<script>
    const ciudades = <?= json_encode($ciudades_agrupados) ?>;

    function cargarDatos() {
        cargarCiudades();
        cargarParroquias();
    }

    function cargarCiudades() {

      const estadoId = document.getElementById("cbx_estado").value;

      // Cargar ciudades
      const ciudadSelect = document.getElementById("cbx_ciudad");
      ciudadSelect.innerHTML = '<option value="">-- Selecciona una ciudad --</option>';
      if(ciudades[estadoId]) {
        ciudades[estadoId].forEach(c => {
            const option = document.createElement("option");
            option.value = c.Cod_Ciudad;
            option.textContent = c.Des_Ciudad;
            ciudadSelect.appendChild(option);
        });
      }
    }


    function cargarParroquias() {
        const estadoId = document.getElementById("cbx_estado").value;
        const ciudadId = document.getElementById("cbx_ciudad").value;

        // Llamada AJAX para obtener las parroquias
        fetch(`index.php?accion=buscar_parroquias&cod_estado=${estadoId}`)
            .then(response => response.json())
            .then(data => {
                const parroquiaSelect = document.getElementById("cbx_parroquia");
                parroquiaSelect.innerHTML = '<option value="">-- Selecciona una parroquia --</option>';
                data.forEach(parroquia => {
                    const option = document.createElement("option");
                    option.value = parroquia.Cod_Parroquia;
                    option.textContent = parroquia.Des_Parroquia;
                    parroquiaSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error al cargar las parroquias:', error));
    }


  </script>