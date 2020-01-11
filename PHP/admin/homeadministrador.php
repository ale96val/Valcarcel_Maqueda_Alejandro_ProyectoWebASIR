<!DOCTYPE html>
<html lang="Spanish">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-store" />
    <title>Airline</title>
    <link rel="stylesheet" href="../styles/estilos.css">
    <link rel="stylesheet" href="../styles/css/bootstrap.css">
    <script src="../styles/js/bootstrap.js"></script>
    <script src="../styles/js/jquery.js"></script>
</head>

<body>
    <div class="container-fluid" id="colorfondo">
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
                        <form method="get" action="/homeadministrador.php">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-responsive centertext">
                                        <tr>
                                            <td><strong>Código</strong></td>
                                            <td><strong>Fecha</strong></td>
                                            <td><strong>Hora</strong></td>
                                            <td><strong>Capacidad</strong></td>
                                            <td><strong>Libres</strong></td>
                                            <td><strong>Origen</strong></td>
                                            <td><strong>Destino</strong></td>
                                            <td><strong>Seleccionar</strong></td>
                                        </tr>
                                        <?php
                $consultavuelos="SELECT * FROM vuelo order by(codvuelo)";
                $result=$connection->query($consultavuelos);
                    while($obj = $result->fetch_object()) {
                    echo"<tr>";
                        echo"<td>$obj->codvuelo</td>";
                        echo"<td>$obj->fecha</td>";
                        echo"<td>$obj->hora</td>";
                        echo"<td>$obj->capacidad</td>";
                        echo"<td>$obj->libres</td>";
                        echo"<td>$obj->codaerori</td>";
                        echo"<td>$obj->codaerdes</td>";
                        echo"<td><a href='/admin/eliminarvuelo.php?cod=".$obj->codvuelo."'><img src='../img/eliminar.png'   WIDTH='25'></a>
                        <a href='/admin/datosmodificar.php?cod=".$obj->codvuelo."'><img src='../img/modificar.png' WIDTH='25'></a></td>";
                    echo"</tr>";
                    };
                ?>
                                </div>
                                </table>
                            </div>
                    </div>
                    </form>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <?php
                            $vuelos="vuelos";
                            echo"<p class='aligncenter'>Generar listado en PDF: <a href='../admin/generarpdf.php?cod=".$vuelos."'><img src='../img/pdf.png'   WIDTH='25'></a></p>";
                                ?>
                        </div>
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
