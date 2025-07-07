<?php

class SitiosHistoricosController
{

    function __construct()
    {
        
    }

     function ListarSitiosHistoricos(){
         require_once('views/SitiosHistoricos/listarsitioshistoricos.php');
    }

    static public function ListarSitiosHistoricos1(){
       	 require_once('models/SitiosHistoricosModels.php');
         $result_Listar= SitiosHistoricosModels::ListarSitiosHitoricos();
         return $result_Listar;
    }

    // Para insertar

    static public function BuscarUltimoSitioHistorico(){
         require_once('models/SitiosHistoricosModels.php');
         $result_Listar = SitiosHistoricosModels::BuscarUltimoSitioHistorico();
         return $result_Listar;
    }

    static public function buscarParroquiasPorEstado($cod_estado) {
          require_once('controllers/ParroquiasController.php');
          require_once('controllers/MunicipiosController.php');

          $parroquias = ParroquiasController::ListarParroquias1();
          $municipios = MunicipiosController::ListarMunicipios1();

          // Paso 1: Obtener los códigos de municipio que pertenecen al estado
          $municipios_ids = [];
          while ($row = $municipios->fetch_assoc()) {
               if ($row['Cod_Estado'] == $cod_estado) {
                    $municipios_ids[$row['Cod_Municipio']] = true;
               }
          }

          // Paso 2: Filtrar parroquias que pertenezcan a esos municipios
          $parroquias_array = [];
          while ($row = $parroquias->fetch_assoc()) {
               if (isset($municipios_ids[$row['Cod_Municipio']])) {
                    $parroquias_array[] = $row;
               }
          }

          return $parroquias_array;
     }

    function IngresarSitioHistorico(){
         require_once('views/SitiosHistoricos/cu_sitiohistorico.php');
    }

    function IngresarSitioHistorico1(){
         require_once('views/SitiosHistoricos/cu_sitiohistorico1.php');
    }

    static public function IngresarSitioHistorico2($id_SitiosHistoricos, $nombre_sitio, $fecha_sitio, $Historia_Sitio, $imagen, $id_parroquia, $id_ciudad){
      	 require_once('models/SitiosHistoricosModels.php');
         $result_Listar= SitiosHistoricosModels::IngresarSitioHistorico2($id_SitiosHistoricos, $nombre_sitio, $fecha_sitio, $Historia_Sitio, $imagen, $id_parroquia, $id_ciudad);
         return $result_Listar;
    }

    // Para actualizar 

    static public function BuscarSitioById($id){
         require_once('models/SitiosHistoricosModels.php');
         $result_Listar = SitiosHistoricosModels::BuscarSitioById($id);
         return $result_Listar;
    }

    static public function BuscarSitioByCiudades($id_ciudad){
         require_once('models/SitiosHistoricosModels.php');
         $result_Listar = SitiosHistoricosModels::BuscarSitioByCiudades($id_ciudad);
         return $result_Listar;
    }

    static public function BuscarSitiosByParroquias($id_parroquia){
         require_once('models/SitiosHistoricosModels.php');
         $result_Listar = SitiosHistoricosModels::BuscarSitiosByParroquias($id_parroquia);
         return $result_Listar;
    }

    function ActualizarSitioHistorico(){
         require_once('views/SitiosHistoricos/cu_sitiohistorico.php');
    }

    function ActualizarSitioHistorico1(){
         require_once('views/SitiosHistoricos/cu_sitiohistorico1.php');
    }

    static public function ActualizarSitioHistorico2($id_SitiosHistoricos, $nombre_sitio, $fecha_sitio, $Historia_Sitio, $imagen, $id_parroquia, $id_ciudad){
      	 require_once('models/SitiosHistoricosModels.php');
         $result_Listar= SitiosHistoricosModels::ActualizarSitioHistorico2($id_SitiosHistoricos, $nombre_sitio, $fecha_sitio, $Historia_Sitio, $imagen, $id_parroquia, $id_ciudad);
         return $result_Listar;
    }

    // Para eliminar

    function BorrarSitioHistorico(){
        require_once('views/SitiosHistoricos/cu_sitiohistorico.php');
    }

    function BorrarSitioHistorico1(){
         require_once('views/SitiosHistoricos/cu_sitiohistorico1.php');
    }

    static public function BorrarSitioHistorico2($id_SitiosHistoricos){
        require_once('models/SitiosHistoricosModels.php');
        $result_Listar= SitiosHistoricosModels::BorrarSitio2($id_SitiosHistoricos);
        return $result_Listar;
    }

}

?>