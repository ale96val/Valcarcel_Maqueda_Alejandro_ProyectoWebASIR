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
                                <li><a href="/admin/addvuelo.php">Añadir vuelo</a></li>
                                <li><a href="/admin/datosclientes.php">Clientes</a></li>
                                <li><a href="/admin/addcliente.php">Añadir Cliente</a></li>
                                <li class="active"><a href="/admin/datosreservas.php">Reservas</a></li>
                                <li><a href="/admin/dashboard.php">Dashboards</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="row">
                        <form method="get">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-hover table-responsive">
                                        <tr>
                                            <td><strong>Codigo Vuelo</strong></td>
                                            <td><strong>Codigo Maleta</strong></td>
                                            <td><strong>Usuario</strong></td>
                                            <td><strong>Seleccionar</strong></td>
                                        </tr>
                                        <?php
                $consultaclientes="SELECT * FROM compra order by(cidusuario)";
                $result=$connection->query($consultaclientes);
                    while($obj = $result->fetch_object()) {
                    echo"<tr>";
                        echo"<td>$obj->ccodvuelo</td>";
                        echo"<td>$obj->cidmaleta</td>";
                        $consultanombre="SELECT nombre, apellidos from usuario where idusuario='$obj->cidusuario';";
                        $result2=$connection->query($consultanombre);
                        while($obj2 = $result2->fetch_object()) {
                        echo"<td>".$obj2->nombre." ".$obj2->apellidos."</td>";
                        };
                        echo"<td><a href='/admin/eliminareserva.php?codusu=".$obj->cidusuario."&codvuelo=".$obj->ccodvuelo."'><img src='../img/eliminar.png'   WIDTH='25'></a>
                        <a href='/admin/datosmodificareserva.php?codusu=".$obj->cidusuario."&codvuelo=".$obj->ccodvuelo."'><img src='../img/modificar.png' WIDTH='25'></a></td>";
                    echo"</tr>";
                    };
                ?>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-3"> </div>
                            <div class="col-md-3"> </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <?php
                            $reservas="reservas";
                            echo"<p class='aligncenter'>Generar listado en PDF: <a href='../admin/generarpdf.php?cod=".$reservas."'><img src='../img/pdf.png'   WIDTH='25'></a></p>";
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
include('../config/footer.php');
?>

</html>
