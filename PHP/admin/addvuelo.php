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
                                <li><a href="/admin/homeadministrador.php">Vuelos</a></li>
                                <li class="active"><a href="/admin/addvuelo.php">Añadir vuelo</a></li>
                                <li><a href="/admin/datosclientes.php">Clientes</a></li>
                                <li><a href="/admin/addcliente.php">Añadir Cliente</a></li>
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
                                        <tr>
                                            <td>
                                                <input class='form-control' type='text' name='cod' value='' maxlength="6" required> </td>
                                            <td>
                                                <input class='form-control' type='date' name='fec' value='' required> </td>
                                            <td>
                                                <input class='form-control' type='time' name='hor' value='' required> </td>
                                            <td>
                                                <input class='form-control' type='number' name='cap' value='' required> </td>
                                            <td>
                                                <input class='form-control' type='number' name='lib' value='' required> </td>
                                            <td>
                                                <?php
                        if ($result = $connection->query("SELECT codaer, ciudad FROM aeropuerto")) {
                        echo"<select name='ori' class='form-control'>";
                            while($obj = $result->fetch_object()) {  
                                echo "<option value=".$obj->codaer.">".$obj->ciudad."</option>";
                            }

                            };
                                ?> </select>
                                            </td>
                                            <td>
                                                <?php
                        if ($result = $connection->query("SELECT codaer, ciudad FROM aeropuerto")) { 
                        echo"<select name='des' class='form-control'>";
                            while($obj = $result->fetch_object()) {  
                                echo "<option value=".$obj->codaer.">".$obj->ciudad."</option>";
                            };

                            };
                                ?> </select>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <input type="submit" name="add" class="btn btn-warning margin1 alignright" value="Añadir">
                            <?php
                if (isset($_POST["add"])){
                $nuevocod=$_POST['cod'];
                $nuevafec=$_POST['fec'];
                $nuevahor=$_POST['hor'];
                $nuevacap=$_POST['cap'];
                $nuevolib=$_POST['lib'];
                $nuevoori=$_POST['ori'];
                $nuevodes=$_POST['des'];
                $comprobar="SELECT * FROM vuelo WHERE codvuelo='$nuevocod';";
                $result=$connection->query($comprobar);
                if ($result->num_rows!==0) {
                    echo"<div class='row'>";
                    echo"<div class='col-md-12'>";
                    echo"<h4 class='margin1'>El código de vuelo ya existe. Revise los datos.</h4>";
                    echo"<div>";
                    echo"</div>";
                }else{
                $add="INSERT INTO `vuelo`(`codvuelo`, `fecha`, `hora`, `capacidad`, `libres`, `codaerori`, `codaerdes`) VALUES ('$nuevocod','$nuevafec','$nuevahor','$nuevacap','$nuevolib','$nuevoori','$nuevodes');";
                $connection->query($add);
                echo"<h4>Añadido.</h4>";
                };
                };
                ?> </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
