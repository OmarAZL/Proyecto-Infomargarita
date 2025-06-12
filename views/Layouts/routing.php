<?php
$controllers = require 'config/menu_controllers.php';
if (@array_key_exists($controller, $controllers)) {
	
	if (in_array($action, $controllers[$controller])) 
	{
		call($controller, $action);
    }
	
}else{
}
function call($controller, $action){

	// Aqui es donde va a ir configurado en case de acuerdo a la sección del proyecto que le corresponde

	require_once('controllers/'.$controller.'Controller.php');
	switch ($controller) {
		case 'Estados': 
		      $controller= new EstadosController();
		      break;
		case 'Municipios': 
		      $controller= new MunicipiosController();
		      break;
		case 'Parroquias': 
		      $controller= new ParroquiasController();
		      break;
		case 'Ciudades': 
		      $controller= new CiudadesController();
		      break;
	
	}
	$controller->{$action}();
}
?>