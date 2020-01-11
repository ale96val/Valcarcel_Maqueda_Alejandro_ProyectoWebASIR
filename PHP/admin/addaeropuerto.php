<!DOCTYPE html>
<html lang="Spanish">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airline: Registro</title>
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
    include('../config/head.php');
    include('../config/conection.php');
    include('../config/compruebausuario.php');
            ?>
                    </div>
                    <div class="row"> </div>
                    <div class="row">
                        <nav class="navbar navbar-default">
                            <div class="navbar-header"> <a class="navbar-brand">Administrador</a> </div>
                            <ul class="nav navbar-nav">
                                <li><a href="/admin/datosaeropuertos.php">Aeropuertos</a></li>
                                <li class="active"><a href="/admin/addaeropuerto.php">Añadir aeropuerto</a></li>
                                <li><a href="/admin/homeadministrador.php">Vuelos</a></li>
                                <li><a href="/admin/addvuelo.php">Añadir vuelo</a></li>
                                <li><a href="/admin/datosclientes.php">Clientes</a></li>
                                <li><a href="/admin/addcliente.php">Añadir Cliente</a></li>
                                <li><a href="/admin/datosreservas.php">Reservas</a></li>
                                <li><a href="/admin/dashboard.php">Dashboards</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <form method="post">
                                <div class="form-group">
                                    <label for="codaer">Código</label>
                                    <input type="text" class="form-control" name="codaer" placeholder="Introducir código" required> </div>
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" placeholder="Nombre" required> </div>
                                <div class="form-group">
                                    <label for="ciudad">Ciudad</label>
                                    <input type="text" class="form-control" name="ciudad" placeholder="Ciudad" required> </div>
                        </div>
                        <div class="col-md-6"> </div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary margin1" name="registrar">Guardar</button>
                        </div>
                        <div class="col-md-2"> </div>
                        <?php
        if(isset($_POST['registrar'])){
            $codaer=$_POST['codaer'];
            $nombre=$_POST['nombre'];
            $ciudad=$_POST['ciudad'];
            $compruebaeropuerto="SELECT * FROM aeropuerto WHERE codaer='$codaer';";
            $result2=$connection->query($compruebaeropuerto);
            if ($result2->num_rows===0) {
                $consulta="INSERT INTO aeropuerto(codaer, nombre, ciudad) VALUES ('$codaer','$nombre','$ciudad');";
                $connection->query($consulta);
                echo"<div class='row'>";
                echo"<div class='col-md-2'></div>";
                echo"<div class='col-md-10'>";
                echo"<h4 class='margin1'>Aeropuerto añadido.</h2>";
                echo"</div>";
                echo"</div>";
            }else{
                echo"<div class='row'>";
                echo"<div class='col-md-2'></div>";
                echo"<div class='col-md-10'>";
                echo"<h4 class='margin1'>El código de aeropuerto ya existe. Revise los datos.</h2>";
                echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL=/admin/addaeropuerto.php">';
                echo"</div>";
                echo"</div>";
            };
            };
        ?>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
