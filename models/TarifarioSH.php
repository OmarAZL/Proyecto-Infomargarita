<?php 

class TarifarioSHModel
{
	
	function __construct()
	{
	
	}

	// FUNCIONES GENERICAS PARA CONSULTAR Y ACTUALIZAR (INSERTAR, MODIFICAR Y ELIMINAR)

	public static function Get_Data($sql){
		include_once('core/Conectar.php');
		$conexion=Conectar::conexion();

		try {
			!$result = mysqli_query($conexion, $sql);
  		
		if ($result) { 
            if (mysqli_affected_rows($conexion) == 0) { 
                return false;
            } else { 
                return $result;
            }
        } else {
            return false;
        }
		} catch (Exception $e) {
			return false;
		} finally {
			$conexion = Conectar::desconexion($conexion);
		}
	}


	public static function Update_Data($sql) {
    include_once('core/Conectar.php');
    $conexion = Conectar::conexion();
    mysqli_autocommit($conexion, FALSE);

    try {
        $result = mysqli_query($conexion, $sql);

        if ($result) { 
            if (mysqli_affected_rows($conexion) == 0) { 
                mysqli_rollback($conexion);
                return false;
            } else { 
                mysqli_commit($conexion);
                return true;
            }
        } else {
            mysqli_rollback($conexion);
            return false;
        }
    } catch (Exception $e) {
        return false;
    } finally {
        $conexion = Conectar::desconexion($conexion);
    }
}

	
    // para el resto de las operaciones
	

	public static function ListarTarifarioSH(){
		$sql_TarifarioSH = "SELECT * FROM tbl_tarifariosh ORDER BY id_tarifariosh asc";
        $result_TarifarioSH = TarifarioSHModel::Get_Data($sql_TarifarioSH);
        return $result_TarifarioSH;
	}

	public static function ListarTarifarioSHByNombre(){
		$sql_TarifarioSH = "SELECT * FROM tbl_tarifariosh ORDER BY descripciontf asc";
        $result_TarifarioSH = TarifarioSHModel::Get_Data($sql_TarifarioSH);
        return $result_TarifarioSH;
	}

    // Para la insersión

	public static function BuscarUltimoTarifario(){
		$sql_TarifarioSH = "SELECT (max(id_tarifariosh)) as identific FROM tbl_tarifariosh ORDER BY id_tarifariosh asc";
		$result_TarifarioSH = TarifarioSHModel::Get_Data($sql_TarifarioSH);
  		return $result_TarifarioSH;
	}

	public static function IngresarTarifa2 ($id_tarifariosh, $tarifario, $monto, $id_sitiohistorico){
		$sql_TarifarioSH = "INSERT INTO tbl_tarifariosh (id_tarifariosh, descripciontf, Montotf, id_sitiohistorico) VALUES ($id_tarifariosh, '$tarifario', $monto, $id_sitiohistorico)";
		$result_TarifarioSH = TarifarioSHModel::Update_Data($sql_TarifarioSH);
  		return $result_TarifarioSH;
	}

	// Para la actualización 

	public static function BuscarTarifaById($id_tarifariosh){
    	$sql_TarifarioSH = "SELECT * FROM tbl_tarifariosh WHERE id_tarifariosh = $id_tarifariosh";
		$result_TarifarioSH = TarifarioSHModel::Get_Data($sql_TarifarioSH);
  		return $result_TarifarioSH;
	}

	public static function ActualizarTarifa2 ($id_tarifariosh, $tarifario, $Monto, $id_sitiohistorico){
		$sql_TarifarioSH= "UPDATE tbl_tarifariosh SET descripciontf = '$tarifario', Montotf = $Monto, id_sitiohistorico = $id_sitiohistorico WHERE id_tarifariosh = $id_tarifariosh" ;
		$result_TarifarioSH = TarifarioSHModel::Update_Data($sql_TarifarioSH);
  		return $result_TarifarioSH;
	}
	
	// Para eliminar

	public static function BorrarTarifa2 ($id_tarifariosh){
		
		$sql_TarifarioSH = "DELETE FROM tbl_tarifariosh WHERE id_tarifariosh = $id_tarifariosh" ;
		$result_TarifarioSH = TarifarioSHModel::Update_Data($sql_TarifarioSH);
  		return $result_TarifarioSH;
	}
}

?>