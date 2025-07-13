<?php 
// 👇 Este bloque debe ir antes de cualquier HTML o echo
if (isset($_GET['accion']) && $_GET['accion'] === 'buscar_parroquias') {
    require_once('controllers/ParroquiasController.php');
    require_once('controllers/MunicipiosController.php');
    require_once('controllers/SitiosHistoricosController.php'); // donde está buscarParroquiasPorEstado

    $cod_estado = $_GET['cod_estado'] ?? null;

    if ($cod_estado) {
        $parroquias = SitiosHistoricosController::buscarParroquiasPorEstado($cod_estado);
        header('Content-Type: application/json');
        echo json_encode($parroquias);
        exit; // 👈 Esto evita que se imprima el resto del HTML
    }
} 
  // Este es el primer archivo visible que se inicia cuando se abre el proyecto desde el navegador.

  // Esta seccion borra e inicia cierta variable de sesión, dado que el control de acceso a usuarios lo suprimí para la práctica

  ob_clean();
  ob_start();
  session_start();
  $_SESSION['User'] = "SUHAIL"; 
  $controller;
   
  // Aqui se llama al núcleo de la aplicación  donde se obtienen los enrutamientos

  require 'core/Router.php';
  $router = new Router();
  echo "Este es el Controlador: "; 
  echo $controller = $router->getController();
  echo "<br>";
  echo "Esta es la Accion o Método de la Clase: "; 
  echo $action = $router->getAction();
  
   if (isset($_SESSION['itemMenu']) == 0)  
   {
         $_SESSION['itemMenu'] = "Playas"; 

   }else{ 
 
   		$_SESSION['itemMenu'] = $controller; 

   }

 
  require_once('views/Layouts/layout.php'); 
