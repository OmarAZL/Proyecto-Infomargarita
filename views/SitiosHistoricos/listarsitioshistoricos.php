<?php 
   require_once('controllers/SitiosHistoricosController.php');
   $controller = new SitiosHistoricosController();
   $result_sitios = $controller->ListarSitiosHistoricos1();
   $numrows = mysqli_num_rows($result_sitios);
?>

<div class="contaniner">

<div class="panel-heading" style="background-color: #2F5597">
    <div class="row">
        <div class="col-10" style="color: white">
            <h4><b>Sitios Históricos</b></h4>
        </div>
        <div class="col-2">
            <form action="<?php echo SERVERURL ?>SitiosHistoricos/IngresarSitioHistorico" method="POST">
                <button type="submit" class="btn btn-prymary" text-align = "center">Agregar</button>
            </form>
        </div>
    </div>
</div>

<br><br>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Historia</th>
                <th>Parroquia</th>
                <th>Ciudad</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($numrows > 0) {
            while ($row = mysqli_fetch_array($result_sitios)) {
                ?>
                <tr>
                    <td><?php echo $row['id_SitiosHistoricos']; ?></td>
                    <td><?php echo $row['Nombre_Sitio']; ?></td>
                    <td><?php echo $row['fecha_creacion']; ?></td>
                    <td><?php echo $row['Historia']; ?></td>
                    <td><?php echo $row['Des_Parroquia']; ?></td>
                    <td><?php echo $row['Des_Ciudad']; ?></td>
                    <td align= "center" width="50px">
                        <form action="<?php echo SERVERURL ?>SitiosHistoricos/ActualizarSitioHistorico/<?php echo $row['id_SitiosHistoricos']; ?>" method="POST" style="display:inline;">
                            <button type="submit" class="btn btn-sm btn-success">Editar</button>
                        </form>
                    <td align= "center" width="50px">
                        <form action="<?php echo SERVERURL ?>SitiosHistoricos/BorrarSitioHistorico/<?php echo $row['id_SitiosHistoricos']; ?>" method="POST" style="display:inline;">
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