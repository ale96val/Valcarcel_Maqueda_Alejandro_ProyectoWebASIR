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
                                <li class="active"><a href="/admin/datosclientes.php">Clientes</a></li>
                                <li><a href="/admin/addcliente.php">Añadir Cliente</a></li>
                                <li><a href="/admin/datosreservas.php">Reservas</a></li>
                                <li><a href="/admin/dashboard.php">Dashboards</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="row">
                        <form method="get">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-responsive">
                                        <tr>
                                            <td><strong>Codigo</strong></td>
                                            <td><strong>Nombre</strong></td>
                                            <td><strong>Apellidos</strong></td>
                                            <td><strong>Tipo</strong></td>
                                            <td><strong>Contraseña</strong></td>
                                            <td><strong>Email</strong></td>
                                            <td><strong>Fecha de Registro</strong></td>
                                            <td><strong>Seleccionar</strong></td>
                                        </tr>
                                        <?php
                $consultaclientes="SELECT * FROM usuario order by(idusuario)";
                $result=$connection->query($consultaclientes);
                    while($obj = $result->fetch_object()) {
                    echo"<tr>";
                        echo"<td>$obj->idusuario</td>";
                        echo"<td>$obj->nombre</td>";
                        echo"<td>$obj->apellidos</td>";
                        if($obj->tipo == 0){
                        echo"<td>Administrador</td>";
                        }else{
                        echo"<td>Usuario Standart</td>";
                        }
                        echo"<td>$obj->password</td>";
                        echo"<td>$obj->email</td>";
                        echo"<td>$obj->fecharegistro</td>";
                        echo"<td><a href='/admin/eliminarcliente.php?cod=".$obj->idusuario."'><img src='../img/eliminar.png'   WIDTH='25'></a>
                        <a href='/admin/datosmodificarcliente.php?cod=".$obj->idusuario."'><img src='../img/modificar.png' WIDTH='25'></a></td>";
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
                            $clientes="clientes";
                            echo"<p class='aligncenter'>Generar listado en PDF: <a href='../admin/generarpdf.php?cod=".$clientes."'><img src='../img/pdf.png'   WIDTH='25'></a></p>";
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
