<?php
   require_once('controllers/TarifarioSHController.php');
   $controller= new TarifarioSHController();
   $result_tarifario= $controller->ListarTarifarioSH1();
   $numrows = 0;
   if($result_tarifario){
    $numrows = mysqli_num_rows($result_tarifario);
   } 
?>

<div class="contaniner">

<div class="panel-heading" style =" background-color: #2F5597">
        <div class = "row">
            <div class = "col-10" style = "color : white">
                <h4> <b>Tarifario de Sitios Históricos</b></h4>
            </div>
            <div class = "col-2">
                <form action= "<?php echo SERVERURL?>TarifarioSH/IngresarTarifa" method = "POST"> 
                    <button type="submit" class="btn btn-prymary" text-align = "center">Agregar</button>
                </form>
            </div>
          </div>  
</div>

<br> <br>

<div class="table-responsive">
    <table id="dtBasicExample" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tarifario</th>
                <th>Monto Bs.</th>
                <th>Sitio Histórico</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($numrows > 0) {
            while ($row = mysqli_fetch_array($result_tarifario)) {
                ?>
                <tr>
                    <td><?php echo $row['id_tarifariosh']; ?></td>
                    <td><?php echo $row['descripciontf']; ?></td>
                    <td><?php echo $row['Montotf']; ?> Bs</td>
                    <td><?php echo $row['Nombre_Sitio']; ?></td>
                    <td align= "center" width="50px">
                        <form action="<?php echo SERVERURL?>TarifarioSH/ActualizarTarifa/<?php echo $row['id_tarifariosh']; ?>" method="POST" style="display:inline;">
                             <button type="submit" class="btn btn-sm btn-success">Editar</button>
                        </form>
                    </td>
                    <td align= "center" width="50px">
                        <form action="<?php echo SERVERURL?>TarifarioSH/BorrarTarifa/<?php echo $row['id_tarifariosh']; ?>" method="POST" style="display:inline;">
                            <button type="submit" class="btn btn-sm btn-warning">Borrar</button>
                        </form>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
        </tbody>
    </table>
</div>
</div>