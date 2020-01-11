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
                                <li class="active"><a href="/admin/datosaeropuertos.php">Aeropuertos</a></li>
                                <li><a href="/admin/addaeropuerto.php">Añadir aeropuerto</a></li>
                                <li><a href="/admin/homeadministrador.php">Vuelos</a></li>
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
                                            <td><strong>Código Antiguo</strong></td>
                                            <td><strong>Código</strong></td>
                                            <td><strong>Nombre</strong></td>
                                            <td><strong>Ciudad</strong></td>
                                        </tr>
                                        <?php
                $codaerantiguo=$_GET['cod'];
                $consultaeropuerto="SELECT * FROM aeropuerto WHERE codaer='$codaerantiguo';";
                $result=$connection->query($consultaeropuerto);
                    while($obj = $result->fetch_object()) {
                    echo"<tr>";
                        echo"<td><input class='form-control' name='antiguocod' value='$obj->codaer' readonly></td>";
                        echo"<td><input class='form-control' type='text' name='codaer' value='$obj->codaer'></td>";
                        echo"<td><input class='form-control' type='text' name='nom' value='$obj->nombre'></td>";
                        echo"<td><input class='form-control' type='text' name='ciudad' value='$obj->ciudad'></td>";
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
                $codaer2=$_POST['antiguocod'];
                $nuevocodaeropuerto=$_POST['codaer'];
                $nuevonomaeropuerto=$_POST['nom'];
                $nuevaciudadaeropuerto=$_POST['ciudad'];
                    $actualizar="UPDATE `aeropuerto` SET `codaer`='$nuevocodaeropuerto',`nombre`='$nuevonomaeropuerto',`ciudad`='$nuevaciudadaeropuerto' WHERE codaer='$codaer2';";
                    $connection->query($actualizar);
                    echo "<h4 class='margin1'>Datos actualizados.</h4>";
                    echo '<META HTTP-EQUIV="Refresh" CONTENT="1; URL=/admin/datosaeropuertos.php">';
                }
                
                ?>
                        </div>
                        </form>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
</body>

</html>
