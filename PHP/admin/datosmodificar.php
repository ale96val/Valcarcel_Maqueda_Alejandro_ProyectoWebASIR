<!DOCTYPE html>
<html lang="Spanish">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airline</title>
    <link rel="stylesheet" href="../styles/css/bootstrap.css">
    <link rel="stylesheet" href="../styles/estilos.css">
    <script src="../styles/js/bootstrap.js"></script>
    <script src="../styles/js/jquery.js"></script>
</head>

<body id="colorfondo">
    <div class="container-fluid">
        <div class="row" style="height:5%;"></div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="container-fluid recuadro margin1">
                    <div class="row">
                        <?php
         include('../config/conection.php');
         include('../config/head.php');
         include('../config/compruebausuario.php');
         ?>
                    </div>
                    <div class="row">
                        <nav class="navbar navbar-default">
                            <div class="navbar-header"> <a class="navbar-brand">Administrador</a> </div>
                            <ul class="nav navbar-nav">
                                <li><a href="/admin/datosaeropuertos.php">Aeropuertos</a></li>
                                <li><a href="/admin/addaeropuerto.php">Añadir aeropuerto</a></li>
                                <li class="active"><a href="/admin/homeadministrador.php">Vuelos</a></li>
                                <li><a href="/admin/addvuelo.php">Añadir vuelo</a></li>
                                <li><a href="/admin/datosclientes.php">Clientes</a></li>
                                <li><a href="/admin/addcliente.php">Añadir cliente</a></li>
                                <li><a href="/admin/datosreservas.php">Reservas</a></li>
                                <li><a href="/admin/dashboard.php">Dashboards</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="row">
                        <form method="post">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-responsive">
                                        <tr>
                                            <td><strong>Código</strong></td>
                                            <td><strong>Fecha</strong></td>
                                            <td><strong>Hora</strong></td>
                                            <td><strong>Capacidad</strong></td>
                                            <td><strong>Libres</strong></td>
                                            <td><strong>Origen</strong></td>
                                            <td><strong>Destino</strong></td>
                                        </tr>
                                        <?php
                $codvuelo=$_GET['cod'];
                $consultavuelos="SELECT * FROM vuelo WHERE codvuelo='$codvuelo';";
                $result=$connection->query($consultavuelos);
                    while($obj = $result->fetch_object()) {
                    echo"<tr>";
                        $codvuelo2=$obj->codvuelo;
                        echo"<td><input type='text' class='form-control' name='cod' value='$obj->codvuelo'></td>";
                        echo"<td><input type='date' class='form-control' name='fec' value='$obj->fecha'></td>";
                        echo"<td><input type='time' class='form-control' name='hor' value='$obj->hora'></td>";
                        echo"<td><input type='number' class='form-control' name='cap' value='$obj->capacidad'></td>";
                        echo"<td><input type='number' class='form-control' name='lib' value='$obj->libres'></td>";
                        echo"<td>";
                        $pordefecto2=($obj->codaerdes);
                        $pordefecto=($obj->codaerori);
                        if ($result2 = $connection->query("SELECT codaer, ciudad FROM aeropuerto")) {
                        echo"<select name='ori' class='form-control'>";
                            while($obj = $result2->fetch_object()) {  
                                if($obj->codaer == $pordefecto){
                                echo "<option value=".$obj->codaer." selected>".$obj->ciudad."</option>";
                            }else{
                                 echo "<option value=".$obj->codaer.">".$obj->ciudad."</option>";   
                                }}

                            };
                        echo"</td>";
                        echo"<td>";
                        if ($result3 = $connection->query("SELECT codaer, ciudad FROM aeropuerto")) {
                        echo"<select name='des' class='form-control'>";
                            while($obj = $result3->fetch_object()) {  
                                if($obj->codaer == $pordefecto2){
                                echo "<option value=".$obj->codaer." selected>".$obj->ciudad."</option>";
                            }else{
                                 echo "<option value=".$obj->codaer.">".$obj->ciudad."</option>";   
                                }}

                            };
                        echo"</td>";
                    echo"</tr>";
                    };
                ?>
                                    </table>
                                </div>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <input type="submit" name="guardar" class="btn btn-danger alignright margin1" value="Guardar">
                            <?php
                if (isset($_POST["guardar"])) {
                $nuevocod=$_POST['cod'];
                $nuevafec=$_POST['fec'];
                $nuevahor=$_POST['hor'];
                $nuevacap=$_POST['cap'];
                $nuevolib=$_POST['lib'];
                $nuevoori=$_POST['ori'];
                $nuevodes=$_POST['des'];
                $actualizar="UPDATE `vuelo` SET `codvuelo`='$nuevocod',`fecha`='$nuevafec',`hora`='$nuevahor',`capacidad`='$nuevacap',`libres`='$nuevolib',`codaerori`='$nuevoori',`codaerdes`='$nuevodes' WHERE codvuelo='$codvuelo2';";
                    $connection->query($actualizar);
                    echo "<h4 class='margin1'>Datos actualizados.</h4>";
                    echo '<META HTTP-EQUIV="Refresh" CONTENT="1; URL=/admin/homeadministrador.php">';
                };
                ?>
                        </div>
                        </form>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
