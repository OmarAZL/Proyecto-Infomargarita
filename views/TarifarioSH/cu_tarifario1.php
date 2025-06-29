<?php

if (isset($_SESSION['User']) == 1)
{ 
    $router = new Router();
    $action = $router->getAction();

    $id_tarifariosh = $_POST['id_tarifariosh'];
    $tarifario = $_POST['tarifario'];
    $monto = $_POST['monto'];
    $id_sitiohistorico = $_POST['id_sitiohistorico'];

    require_once('controllers/TarifarioSHController.php');
    $controller= new TarifarioSHController();

    if ($action == "IngresarTarifa1") {
        $result_Tarifario= $controller->IngresarTarifa2($id_tarifariosh, $tarifario, $monto, $id_sitiohistorico);
    }elseif ($action == "ActualizarTarifa1") {
        $result_Tarifario= $controller->ActualizarTarifa2($id_tarifariosh, $tarifario, $monto, $id_sitiohistorico);
    }elseif ($action == "BorrarTarifa1") {
        $result_Tarifario= $controller->BorrarTarifa2($id_tarifariosh);
    }

    if ($result_Tarifario == false) { ?>
        <div class="my-1"></div>
        <div class="alert alert-warning alert-dismissable" align="justify">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>¡Advertencia!</strong> Ocurrió un error en la operación.
        </div>
        <?php require_once('views/TarifarioSH/cu_tarifario.php');
    } else { ?>
        <div class="my-1"></div>
        <div class="alert alert-success alert-dismissable" align="justify">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>¡Éxito!</strong> La operación se realizó correctamente.
        </div>
        <?php require_once('views/TarifarioSH/listartarifariosh.php');
    }
} else {
    require_once('views/TarifarioSH/listartarifariosh.php');
}
?>