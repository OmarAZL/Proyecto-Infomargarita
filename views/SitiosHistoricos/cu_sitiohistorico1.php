<script>
    console.log("cu_sitiohistorico1.php loaded");

    console.log("<?php 
        $image = basename($_FILES["fileToUpload"]["name"]);
        echo $image;
    ?>");
    

</script>
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
    $image_path = '';

    $target_dir = "uploads/"; // Directorio donde se guardarán las imágenes
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if(basename($_FILES["fileToUpload"]["name"])) {
        // Comprobar si el archivo de imagen es real o un archivo falso
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
        }

            // Comprobar si el archivo ya existe
        if (file_exists($target_file)) {
            echo "Lo siento, el archivo ya existe.";
            $uploadOk = 0;
        }

        // Comprobar el tamaño del archivo (ejemplo: no más de 5MB)
        if ($_FILES["fileToUpload"]["size"] > 5000000) {
            echo "Lo siento, tu archivo es demasiado grande.";
            $uploadOk = 0;
        }

        // Comprobar si $uploadOk es 0 por algún error
        if ($uploadOk == 0) {
            echo "Lo siento, tu archivo no fue subido.";
        // Si todo está bien, intenta subir el archivo
        } else {
            // Generar un nombre de archivo único para evitar colisiones
            //$new_file_name = uniqid() . "." . $imageFileType;
            $new_file_name = md5($_FILES["fileToUpload"]["size"]) . "." . $imageFileType;
            $target_file_unique = $target_dir . $new_file_name;

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file_unique)) {
                echo "El archivo ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " ha sido subido.";
                $image_path = $target_file_unique;
            } else {
                echo "Lo siento, hubo un error al subir tu archivo.";
            }
        }
    }

    require_once('controllers/SitiosHistoricosController.php');
    $controller = new SitiosHistoricosController();
    
    echo "<script>console.log('Action: $image_path');</script>";

    if ($action == "IngresarSitioHistorico1") {
        $result_Sitio = $controller->IngresarSitioHistorico2($id_sitiohistorico, $nombre_sitio, $fecha_sitio, $historia_sitio, $image_path, $id_parroquia, $id_ciudad);
    } elseif ($action == "ActualizarSitioHistorico1") {
        $result_Sitio = $controller->ActualizarSitioHistorico2($id_sitiohistorico, $nombre_sitio, $fecha_sitio, $historia_sitio, $image_path, $id_parroquia, $id_ciudad);
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
            <p style="font-size:12px; color:black">El registro del sitio historico <?php echo MSG_EXITO_CU?></p> </label> <br>
                    
        </div>
        <?php
        require_once('views/SitiosHistoricos/listarsitioshistoricos.php');
    }
} else {
    require_once('views/SitiosHistoricos/listarsitioshistoricos.php');
}
?>