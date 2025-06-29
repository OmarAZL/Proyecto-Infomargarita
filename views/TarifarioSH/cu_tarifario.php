<?php
if (isset($_SESSION['User'])) { 
    $router = new Router();
    $action = $router->getAction();
    $id = $router->getId();
    $tarifario = "";
    $monto = "";
    $id_sitiohistorico = "";

    if ($action == "IngresarTarifa") {
        $TipoOperacion = "Ingresar";
        $direccionamiento = SERVERURL . "TarifarioSH/IngresarTarifa1";
        $id_tarifariosh = "";
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
                    $tarifario = $numrows['tarifario'];
                    $monto = $numrows['monto'];
                    $id_sitiohistorico = $numrows['id_sitiohistorico'];
                }
            }
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
                    <label for="monto"><b>Monto:</b></label>
                    <input class="form-control" type="number" name="monto" value="<?php echo $monto;?>" required>
                </div>
                <div class="col-3">
                    <label for="id_sitiohistorico"><b>ID Sitio Histórico:</b></label>
                    <input class="form-control" type="text" name="id_sitiohistorico" value="<?php echo $id_sitiohistorico;?>" required>
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