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
    $id_municipio = "";
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
            $id_municipio = $_POST['id_municipio'];
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
    require_once('controllers/MunicipiosController.php');
    $ciudades = CiudadesController::ListarCiudades1();
    $estados = EstadosController::ListarEstados1();
    $parroquias = ParroquiasController::ListarParroquias1();
    $municipios = MunicipiosController::ListarMunicipios1();

    $ciudades_agrupados = [];
    while ($row = $ciudades->fetch_assoc()) {
        $ciudades_agrupados[$row['Cod_Estado']][] = $row;
    }

    $municipios_agrupadas = [];
    while($row = $municipios->fetch_assoc()) {
        $municipios_agrupadas[$row['Cod_Estado']][] = $row;
    }

?>

<div class="page-content">
    <form action="<?php echo $direccionamiento;?>" method="POST" enctype="multipart/form-data">
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
                    <label for="id_municipio"><b>Municipio:</b></label>
                    <select class="form-control" name ="id_municipio" id="cbx_municipio" required>
                        <option value="">-- Selecciona un estado primero --</option>
                    </select>
                </div>

                <div class="col-4">
                    <label for="id_parroquia"><b>Parroquia:</b></label>
                    <select class="form-control" name ="id_parroquia" id="cbx_parroquia" required>
                        <option value ="">-- Selecciona un estado primero --</option>
                    </select>
                </div>

                <div class="col-4">
                    <label for="id_ciudad"><b>Ciudad:</b></label>
                    <select class="form-control" name ="id_ciudad" id="cbx_ciudad" required>
                        <option value ="">-- Selecciona un estado primero --</option>
                    </select>
                </div>
                
                    
                <div class="col-sm-8">
                    <label class="col-sm-2 control-label">Archivos</label>
                    <input type="file" class="form-control" id="fileToUpload" name="fileToUpload" <?php if ($TipoOperacion == "Ingresar" || $TipoOperacion == "Actualizar") echo "required"; ?>  >
                </div>

            </div>
            
            <br><br>
            <button name="submit" class="btn btn-outline-success" type="submit"><?php echo $TipoOperacion?></button>
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
    const municipios = <?= json_encode($municipios_agrupadas) ?>;

    let id_estado = "<?php echo $id_estado; ?>";
    let id_municipio = "<?php echo $id_municipio; ?>";
    const id_parroquia = "<?php echo $id_parroquia; ?>";
    const id_ciudad = "<?php echo $id_ciudad; ?>";
    
    console.log(ciudades);

    if(id_estado.length == 0) {
        id_estado = "<?php 
                $ciudad = CiudadesController::BuscarCiudadById($id_ciudad);
                if($ciudad) {
                    $numrows = mysqli_num_rows($ciudad);
                    if ($numrows != 0) {
                        $numrows = mysqli_fetch_array($ciudad);
                        echo $numrows['Cod_Estado'];
                    }   
                }
            ?>"
    }

    if(id_estado.length > 0) {
        const estadoId = document.getElementById("cbx_estado");
        estadoId.selectedIndex = id_estado;
    }

    if(id_municipio == 0) {
        id_municipio = "<?php 
                $parroquia = ParroquiasController::BuscarParroquiaById($id_parroquia);
                if($parroquia) {
                    $numrows = mysqli_num_rows($parroquia);
                    if ($numrows != 0) {
                        $numrows = mysqli_fetch_array($parroquia);
                        echo $numrows['Cod_Municipio'];
                    } 
                }
            ?>"
    }

    console.log(id_estado);
        console.log(id_municipio);
        console.log(id_parroquia);
        console.log(id_ciudad);

    cargarDatos();

    function cargarDatos() {
        cargarCiudades();
        cargarMunicipios();
        cargarParroquias();
    }

    function cargarMunicipios() {
        const estadoId = document.getElementById("cbx_estado").value;
        if(estadoId.length == 0 && id_estado.length > 0) {
            estadoId = id_estado;
        }
        const municipioSelect = document.getElementById("cbx_municipio");
        municipioSelect.innerHTML = '<option value="">-- Selecciona un municipio --</option>';

        if(municipios[estadoId]) {
            municipios[estadoId].forEach(mun => {
                const option = document.createElement("option");
                option.value = mun.Cod_Municipio;
                option.textContent = mun.Des_Municipio;
                if(mun.Cod_Municipio == id_municipio) {
                    option.selected = true; 
                }
                municipioSelect.appendChild(option);
            })
        }

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
            if(c.Cod_Ciudad == id_ciudad) {
                option.selected = true;
            }
            ciudadSelect.appendChild(option);
        });
      }

    }


    function cargarParroquias() {
        const estadoId = document.getElementById("cbx_estado").value;
        if(estadoId.length == 0 && id_estado.length > 0) {
            estadoId = id_estado;
        }
        const parroquiaSelect = document.getElementById("cbx_parroquia");

        // Llamada AJAX para obtener las parroquias
        fetch(`index.php?accion=buscar_parroquias&cod_estado=${estadoId}`)
            .then(response => response.json())
            .then(data => {
                parroquiaSelect.innerHTML = '<option value="">-- Selecciona una parroquia --</option>';
                data.forEach(parroquia => {
                    const option = document.createElement("option");
                    option.value = parroquia.Cod_Parroquia;
                    option.textContent = parroquia.Des_Parroquia;
                    if(parroquia.Cod_Parroquia == id_parroquia)
                    option.selected = true;
                    parroquiaSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error al cargar las parroquias:', error));
    }


  </script>