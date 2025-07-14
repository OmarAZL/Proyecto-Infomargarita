<?php

if (isset($_SESSION['User']) == 1)
{ 
    $router = new Router();
    $action = $router->getAction();

    $id_tarifariosh = isset($_POST['id_tarifariosh']) ? $_POST['id_tarifariosh'] : '';
    $tarifario = isset($_POST['tarifario']) ? $_POST['tarifario'] : '';
    $monto = isset($_POST['monto']) ? $_POST['monto'] : '';
    $id_sitiohistorico = isset($_POST['id_sitiohistorico']) ? $_POST['id_sitiohistorico'] : '';

    require_once('controllers/TarifarioSHController.php');
    $controller= new TarifarioSHController();

    if ($action == "IngresarTarifa1") {
        $result_Tarifario= $controller->IngresarTarifa2($id_tarifariosh, trim($tarifario), $monto, $id_sitiohistorico);
    }elseif ($action == "ActualizarTarifa1") {
        $result_Tarifario= $controller->ActualizarTarifa2($id_tarifariosh, trim($tarifario), $monto, $id_sitiohistorico);
    }elseif ($action == "BorrarTarifa1") {
        $result_Tarifario= $controller->BorrarTarifa2($id_tarifariosh);
    }

    if ($result_Tarifario == false) { ?>
        <div class="my-1"></div>
        <div class="alert alert-warning alert-dismissable" align="justify">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <label for="busqueda" align="right"> <strong>Mensaje de Advertencia</strong><br> 
	   		<p style="font-size:12px; color:black"><?php echo MSG_ADVERTENCIA_CU?> </p> </label> <br>
        </div>
        <?php require_once('views/TarifarioSH/cu_tarifario.php');
    } else { ?>
        <div class="my-1"></div>
        <div class="alert alert-success alert-dismissable" align="justify">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <label for="busqueda" align="right"> <strong>Mensaje de Éxito</strong> <br> 
            <p style="font-size:12px; color:black">El registro de la tarifa <?php echo MSG_EXITO_CU?></p> </label> <br>
        </div>
        <?php require_once('views/TarifarioSH/listartarifariosh.php');
    }
} else {
    require_once('views/TarifarioSH/listartarifariosh.php');
}
?>