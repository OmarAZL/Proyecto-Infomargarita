<?php 

class SitiosHistoricosModels
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
	

	public static function ListarSitiosHitoricos(){
		$sql_SitiosHistoricos = "SELECT `tbl_sitioshistoricos`.*, `tbl_ciudad`.`Des_Ciudad`, `tbl_parroquia`.`Des_Parroquia`
								FROM `tbl_sitioshistoricos` 
								LEFT JOIN `tbl_ciudad` ON `tbl_sitioshistoricos`.`CodCiudad` = `tbl_ciudad`.`Cod_Ciudad` 
								LEFT JOIN `tbl_parroquia` ON `tbl_sitioshistoricos`.`CodParroquia` = `tbl_parroquia`.`Cod_Parroquia`;";
        //$sql_SitiosHistoricos = "SELECT * FROM tbl_sitioshistoricos";
        $result_SitiosHistoricos = SitiosHistoricosModels::Get_Data($sql_SitiosHistoricos);
        return $result_SitiosHistoricos;
	}

    // Para la insersión

	public static function BuscarUltimoSitioHistorico(){

		$sql_SitiosHistoricos = "SELECT (max(id_SitiosHistoricos)) as identific FROM tbl_sitioshistoricos ORDER BY id_sitioshistoricos asc";
		$result_SitiosHistoricos = SitiosHistoricosModels::Get_Data($sql_SitiosHistoricos);
  		return $result_SitiosHistoricos;
	}

	public static function IngresarSitioHistorico2 ($id_SitiosHistoricos, $nombre_sitio, $fecha_sitio, $Historia_Sitio, $id_parroquia, $id_ciudad){
		$sql_SitiosHistoricos = "INSERT INTO tbl_sitioshistoricos (id_SitiosHistoricos, Nombre_Sitio, fecha_creacion, Historia, CodParroquia, CodCiudad) VALUES ($id_SitiosHistoricos, '$nombre_sitio', $fecha_sitio, '$Historia_Sitio', $id_parroquia, $id_ciudad)";
		$result_SitiosHistoricos = SitiosHistoricosModels::Update_Data($sql_SitiosHistoricos);
  		return $result_SitiosHistoricos;
	}

	// Para la actualización 

	public static function BuscarSitioById($id_SitiosHistoricos){
    	$sql_SitiosHistoricos = "SELECT * FROM tbl_sitiohistorico WHERE id_SitiosHistoricos = $id_SitiosHistoricos";
		$result_SitiosHistoricos = SitiosHistoricosModels::Get_Data($sql_SitiosHistoricos);
  		return $result_SitiosHistoricos;
	}

	public static function BuscarSitioByCiudades($id_ciudad){
    	$sql_SitiosHistoricos = "SELECT * FROM tbl_sitioshistoricos WHERE Cod_Ciudad = $id_ciudad";
		$result_SitiosHistoricos = SitiosHistoricosModels::Get_Data($sql_SitiosHistoricos);
  		return $result_SitiosHistoricos;
	}

	public static function BuscarSitiosByParroquias($id_parroquia){
    	$sql_SitiosHistoricos = "SELECT * FROM tbl_sitioshistoricos WHERE Cod_Parroquia = $id_parroquia";
		$result_SitiosHistoricos = SitiosHistoricosModels::Get_Data($sql_SitiosHistoricos);
  		return $result_SitiosHistoricos;
	}

	public static function ActualizarSitioHistorico2 ($id_SitiosHistoricos, $nombre_sitio, $fecha_sitio, $Historia_Sitio, $id_parroquia, $id_ciudad){
		$sql_SitiosHistoricos= "UPDATE tbl_sitioshistoricos SET Nombre_Sitio = '$nombre_sitio', fecha_creacion = $fecha_sitio, Historia = '$Historia_Sitio', CodCiudad = $id_ciudad, CodParroquia = $id_parroquia  WHERE id_SitiosHistoricos = $id_SitiosHistoricos";
		$result_SitiosHistoricos = SitiosHistoricosModels::Update_Data($sql_SitiosHistoricos);
  		return $result_SitiosHistoricos;
	}
	
	// Para eliminar

	public static function BorrarSitio2 ($id_SitiosHistoricos){
		$id_SitiosHistoricos;
		$sql_SitiosHistoricos = "DELETE FROM tbl_sitioshistoricos WHERE id_SitiosHistoricos = $id_SitiosHistoricos" ;
		$result_SitiosHistoricos = SitiosHistoricosModels::Update_Data($sql_SitiosHistoricos);
  		return $result_SitiosHistoricos;
	}
	
}

?>