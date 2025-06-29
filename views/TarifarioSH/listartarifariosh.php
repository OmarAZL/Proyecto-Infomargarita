<?php
   require_once('controllers/TarifarioSHController.php');
   $controller= new TarifarioSHController();
   $result_tarifario= $controller->ListarTarifarioSH1();
   $numrows = mysqli_num_rows($result_tarifario);
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
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tarifario</th>
                <th>Monto</th>
                <th>Sitio Histórico</th>
                <th>Acciones</th>
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
                    <td><?php echo $row['Montotf']; ?></td>
                    <td><?php echo $row['id_Sitiohistorico']; ?></td>
                    <td>
                        <form action="<?php echo SERVERURL?>TarifarioSH/ActualizarTarifa" method="POST" style="display:inline;">
                            <input type="hidden" name="id_tarifariosh" value="<?php echo $row['id_tarifariosh']; ?>">
                            <button type="submit" class="btn btn-warning btn-xs">Editar</button>
                        </form>
                        <form action="<?php echo SERVERURL?>TarifarioSH/BorrarTarifa" method="POST" style="display:inline;">
                            <input type="hidden" name="id_tarifariosh" value="<?php echo $row['id_tarifariosh']; ?>">
                            <button type="submit" class="btn btn-danger btn-xs">Borrar</button>
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