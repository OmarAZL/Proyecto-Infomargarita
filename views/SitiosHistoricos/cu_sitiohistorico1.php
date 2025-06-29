<?php

if (isset($_SESSION['User']) == 1)
{ 
    $router = new Router();
    $action = $router->getAction();

    $id_sitiohistorico = $_POST['id_sitiohistorico'];
    $nombre_sitio = $_POST['nombre_sitio'];
    $fecha_sitio = $_POST['fecha_sitio'];
    $historia_sitio = $_POST['historia_sitio'];
    $id_parroquia = $_POST['id_parroquia'];
    $id_ciudad = $_POST['id_ciudad'];

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
            <strong>¡Advertencia!</strong> Ocurrió un error en la operación.
        </div>
        <?php require_once('views/SitiosHistoricos/cu_sitiohistorico.php');
    } else { ?>
        <div class="my-1"></div>
        <div class="alert alert-success alert-dismissable" align="justify">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>¡Éxito!</strong> La operación se realizó correctamente.
        </div>
        <?php require_once('views/SitiosHistoricos/listarsitioshistoricos.php');
    }
} else {
    require_once('views/SitiosHistoricos/listarsitioshistoricos.php');
}
?>