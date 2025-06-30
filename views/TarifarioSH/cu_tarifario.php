<?php
if (isset($_SESSION['User'])) { 
    $router = new Router();
    $action = $router->getAction();
    $id = $router->getId();
    $id_tarifariosh = "";
    $tarifario = "";
    $monto = "";
    $id_sitiohistorico = "";

    if ($action == "IngresarTarifa") {
        $TipoOperacion = "Ingresar";
        $direccionamiento = SERVERURL . "TarifarioSH/IngresarTarifa1";
        require_once('controllers/TarifarioSHController.php');
        $controller = new TarifarioSHController();
        $result_tarifario = $controller->BuscarUltimoTarifario();
        $numrows = mysqli_num_rows($result_tarifario);
        while ($numrows = mysqli_fetch_array($result_tarifario)) { 
            $id_tarifariosh = $numrows["identific"] + 1; 
        }
    } elseif (($action == "ActualizarTarifa") || ($action == "BorrarTarifa")) {
        if ($action == "ActualizarTarifa") {
            $TipoOperacion = "Actualizar";
            $direccionamiento = SERVERURL . "TarifarioSH/ActualizarTarifa1";
        }
        if ($action == "BorrarTarifa") {
            $TipoOperacion = "Borrar";
            $direccionamiento = SERVERURL . "TarifarioSH/BorrarTarifa1";
        }
        $id_tarifariosh = $id;
        require_once('controllers/TarifarioSHController.php');
        $controller = new TarifarioSHController();
        $result_tarifario = $controller->BuscarTarifaById($id_tarifariosh);
        if (!empty($result_tarifario) && $result_tarifario !== null) {
            $numrows = mysqli_num_rows($result_tarifario);
            if ($numrows != 0) {
                while ($numrows = mysqli_fetch_array($result_tarifario)) {
                    $id_tarifariosh = $numrows["id_tarifariosh"];
                    $tarifario = $numrows['descripciontf'];
                    $monto = $numrows['Montotf'];
                    $id_sitiohistorico = $numrows['id_Sitiohistorico'];
                }
            }
        }
    }elseif (($action == "IngresarTarifa1") OR ($action == "ActualizarTarifa1") OR ($action == "BorrarTarifa1"))// Es porque hubo un error al ingresar o actualizar y hay que mantener los datos en pantalla
   {  
   
      if (isset($_POST['tarifario']) ==1) 
      {  
            $id_tarifariosh = $_POST["id_tarifariosh"];
            $tarifario = $_POST['tarifario'];
            $monto = $_POST['monto'];
            $id_sitiohistorico = $_POST['id_sitiohistorico'];

       }
  
      if ($action == "IngresarTarifa1") { // Cuando el error ocurrion cuando ingresaba
      
          $TipoOperacion = "Ingresar";
          $direccionamiento = SERVERURL . "TarifarioSH/IngresarTarifa1";

      }elseif ($action == "ActualizarTarifa1") { // Cuando el error ocurrio cuando actualizaba

          $TipoOperacion = "Actualizar";
          $direccionamiento = SERVERURL . "TarifarioSH/ActualizarTarifa1";
      
      }elseif ($action == "BorrarTarifa1") { // Cuando el error ocurrio cuando eliminaba
          $TipoOperacion = "Borrar";
          $direccionamiento = SERVERURL . "TarifarioSH/BorrarTarifa1";
      }

   }
     
?>

<div class="panel-heading" style =" background-color: #2F5597">
    <div class = "row">
        <div class = "col-12" style = "color : white">
            <h4> <b><?php echo $TipoOperacion;?> Tarifario de Sitio Histórico</b></h4>
        </div>
    </div>  
</div>

<?php 
include_once('controllers/SitiosHistoricosController.php');
$sitioshistoricos = SitiosHistoricosController::ListarSitiosHistoricos1();
                            
?>

<div class="page-content">
    <form action= "<?php echo $direccionamiento;?>" method = "POST">
        <div class="alert" style = "background-color: #F9F9F9 ">
            <br> <br>
            <div class ="row">
                <div class="col-3">
                    <label for="id_tarifariosh"><b>ID:</b></label>
                    <input class="form-control" type="text" name="id_tarifariosh" value="<?php echo $id_tarifariosh;?>" readonly>
                </div>
                <div class="col-3">
                    <label for="tarifario"><b>Tarifario:</b></label>
                    <input class="form-control" type="text" name="tarifario" value="<?php echo $tarifario;?>" required>
                </div>
                <div class="col-3">
                    <label for="monto"><b>Monto Bs:</b></label>
                    <input class="form-control" type="number" name="monto" value="<?php echo $monto;?>" required>
                </div>
                <div class="col-3">
                    <label for="id_sitiohistorico"><b>Sitio Histórico:</b></label>
                    <select class="form-control" name ="id_sitiohistorico" id="cbx_sitiohistorico" required>
                        <option value ="">Elija una opcion</option>
                        <?php
                            if ($sitioshistoricos) {
                                while ($row = mysqli_fetch_assoc($sitioshistoricos)) {
                                    $selected = ($id_sitiohistorico == $row['id_SitiosHistoricos']) ? 'selected' : '';
                                    echo "<option value='{$row['id_SitiosHistoricos']}' $selected>{$row['Nombre_Sitio']}</option>";
                                }
                            }
                        ?>
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
    require_once('views/TarifarioSH/listartarifariosh.php');
}
?>