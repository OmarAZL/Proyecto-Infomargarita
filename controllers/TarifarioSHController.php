<?php

class TarifarioSHController
{

    function __construct()
    {
        
    }

     function ListarTarifarioSH(){
         require_once('views/TarifarioSH/listartarifariosh.php');
    }

    static public function ListarTarifarioSH1(){
       	 require_once('models/TarifarioSH.php');
         $result_Listar= TarifarioSHModel::ListarTarifarioSH();
         return $result_Listar;
    }

    static public function ListarTarifarioSHByNombre(){
       	 require_once('models/TarifarioSH.php');
         $result_Listar= TarifarioSHModel::ListarTarifarioSHByNombre();
         return $result_Listar;
    }

    // Para insertar

    static public function BuscarUltimoTarifario(){
         require_once('models/TarifarioSH.php');
         $result_Listar = TarifarioSHModel::BuscarUltimoTarifario();
         return $result_Listar;
    }

    function IngresarTarifa(){
         require_once('views/TarifarioSH/cu_tarifario.php');
    }

    function IngresarTarifa1(){
         require_once('views/TarifarioSH/cu_tarifario1.php');
    }

    static public function IngresarTarifa2($id_tarifariosh, $tarifario, $monto, $id_sitiohistorico){
      	 require_once('models/TarifarioSH.php');
         $result_Listar= TarifarioSHModel::IngresarTarifa2($id_tarifariosh, $tarifario, $monto, $id_sitiohistorico);
         return $result_Listar;
    }

    // Para actualizar 

    static public function BuscarTarifaById($id){
         require_once('models/TarifarioSH.php');
         $result_Listar = TarifarioSHModel::BuscarTarifaById($id);
         return $result_Listar;
    }

    function ActualizarTarifa(){
         require_once('views/TarifarioSH/cu_tarifario.php');
    }

    function ActualizarTarifa1(){
         require_once('views/TarifarioSH/cu_tarifario1.php');
    }

    static public function ActualizarTarifa2($id_tarifariosh, $tarifario, $Monto, $id_sitiohistorico){
      	 require_once('models/TarifarioSH.php');
         $result_Listar= TarifarioSHModel::ActualizarTarifa2($id_tarifariosh, $tarifario, $Monto, $id_sitiohistorico);
         return $result_Listar;
    }

    // Para eliminar

    function BorrarTarifa(){
        require_once('views/TarifarioSH/cu_tarifario.php');
    }

    function BorrarTarifa1(){
         require_once('views/TarifarioSH/cu_tarifario1.php');
    }

    static public function BorrarTarifa2($id_tarifariosh){
        require_once('models/TarifarioSH.php');
        $result_Listar= TarifarioSHModel::BorrarTarifa2($id_tarifariosh);
        return $result_Listar;
    }

}

?>