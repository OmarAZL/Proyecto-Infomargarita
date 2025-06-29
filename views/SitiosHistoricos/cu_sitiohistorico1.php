<?php

if (isset($_SESSION['User']) == 1)
{ 
    $router = new Router();
    $action = $router->getAction();

    // Primero se valida que los datos existen en $_POST antes de usarlos

    $id_sitiohistorico = isset($_POST['id_sitiohistorico']) ? $_POST['id_sitiohistorico'] : '';
    $nombre_sitio = isset($_POST['nombre_sitio']) ? $_POST['nombre_sitio'] : '';
    $fecha_sitio = isset($_POST['fecha_sitio']) ? $_POST['fecha_sitio'] : '';
    $historia_sitio = isset($_POST['historia_sitio']) ? $_POST['historia_sitio'] : '';
    $id_parroquia = isset($_POST['id_parroquia']) ? $_POST['id_parroquia'] : '';
    $id_ciudad = isset($_POST['id_ciudad']) ? $_POST['id_ciudad'] : '';

    require_once('controllers/SitiosHistoricosController.php');
    $controller = new SitiosHistoricosController();

    if ($action == "IngresarSitioHistorico1") {
        $result_Sitio = $controller->IngresarSitioHistorico2($id_sitiohistorico, $nombre_sitio, $fecha_sitio, $historia_sitio, $id_parroquia, $id_ciudad);
    } elseif ($action == "ActualizarSitioHistorico1") {
        $result_Sitio = $controller->ActualizarSitioHistorico2($id_sitiohistorico, $nombre_sitio, $fecha_sitio, $historia_sitio, $id_parroquia, $id_ciudad);
    } elseif ($action == "BorrarSitioHistorico1") {
        $result_Sitio = $controller->BorrarSitioHistorico2($id_sitiohistorico);
    }

    if ($result_Sitio == false) { ?>
        <div class="my-1"></div>
        <div class="alert alert-warning alert-dismissable" align="justify">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <label for="busqueda" align="right"> <strong>Mensaje de Advertencia</strong><br> 
	   		<p style="font-size:12px; color:black"><?php echo MSG_ADVERTENCIA_CU?> </p> </label> <br>
        </div>
        <?php require_once('views/SitiosHistoricos/cu_sitiohistorico.php');
    } else { ?>
        <div class="my-1"></div>
        <div class="alert alert-success alert-dismissable" align="justify">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <label for="busqueda" align="right"> <strong>Mensaje de Éxito</strong> <br> 
            <p style="font-size:12px; color:black">El registro de la Parroquia <?php echo MSG_EXITO_CU?></p> </label> <br>
                    
        </div>
        <?php require_once('views/SitiosHistoricos/listarsitioshistoricos.php');
    }
} else {
    require_once('views/SitiosHistoricos/listarsitioshistoricos.php');
}
?>