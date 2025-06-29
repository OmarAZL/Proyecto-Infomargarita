<?php
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
                <div class="col-1">
                    <label for="id_parroquia"><b>Parroquia:</b></label>
                    <input class="form-control" type="text" name="id_parroquia" value="<?php echo $id_parroquia;?>" required>
                </div>
                <div class="col-2">
                    <label for="id_ciudad"><b>Ciudad:</b></label>
                    <input class="form-control" type="text" name="id_ciudad" value="<?php echo $id_ciudad;?>" required>
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