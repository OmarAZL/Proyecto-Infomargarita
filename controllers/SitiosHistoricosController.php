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

    function IngresarSitioHistorico(){
         require_once('views/SitiosHistoricos/cu_sitiohistorico.php');
    }

    function IngresarSitioHistorico1(){
         require_once('views/SitiosHistoricos/cu_sitiohistorico1.php');
    }

    static public function IngresarSitioHistorico2($id_SitiosHistoricos, $nombre_sitio, $fecha_sitio, $Historia_Sitio, $id_parroquia, $id_ciudad){
      	 require_once('models/SitiosHistoricosModels.php');
         $result_Listar= SitiosHistoricosModels::IngresarSitioHistorico2($id_SitiosHistoricos, $nombre_sitio, $fecha_sitio, $Historia_Sitio, $id_parroquia, $id_ciudad);
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

    static public function ActualizarSitioHistorico2($id_SitiosHistoricos, $nombre_sitio, $fecha_sitio, $Historia_Sitio, $id_parroquia, $id_ciudad){
      	 require_once('models/SitiosHistoricosModels.php');
         $result_Listar= SitiosHistoricosModels::ActualizarSitioHistorico2($id_SitiosHistoricos, $nombre_sitio, $fecha_sitio, $Historia_Sitio, $id_parroquia, $id_ciudad);
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