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
                                            <td><strong>Apellidos</strong></td>
                                            <td><strong>Tipo</strong></td>
                                            <td><strong>password</strong></td>
                                            <td><strong>Email</strong></td>
                                        </tr>
                                        <?php
                $codcli=$_GET['cod'];
                $consultacliente="SELECT * FROM usuario WHERE idusuario='$codcli';";
                $result=$connection->query($consultacliente);
                    while($obj = $result->fetch_object()) {
                    echo"<tr>";
                        echo"<td><input class='form-control' name='antiguocod' value='$obj->idusuario' readonly></td>";
                        echo"<td><input class='form-control' type='number' name='cod' value='$obj->idusuario'></td>";
                        echo"<td><input class='form-control' type='text' name='nom' value='$obj->nombre'></td>";
                        echo"<td><input class='form-control' type='text' name='ape' value='$obj->apellidos'></td>";
                        echo"<td><select name='tip' class='form-control'>";
                        $pordefecto=$obj->tipo;
                        if($pordefecto==0){
                        echo"
                        <option value='1'>Usuario Standart</option>
                        <option value='0' selected>Administrador</option>";
                        }else{
                        echo"
                        <option value='1' selected>Usuario Standart</option>
                        <option value='0'>Administrador</option>";
                        }
                        echo"</select>
                        </td>";
                        echo"<td><input type='text' class='form-control' name='pas' value=''></td>";
                        echo"<td><input type='email' class='form-control' name='ema' value='$obj->email'></td>";
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
                $codcli2=$_POST['antiguocod'];
                $nuevocod=$_POST['cod'];
                $nuevonom=$_POST['nom'];
                $nuevoape=$_POST['ape'];
                $nuevotip=$_POST['tip'];
                $nuevopassword=$_POST['pas'];
                $nuevoemail=$_POST['ema'];
                if(!$nuevopassword==''){
                $actualizar="UPDATE `usuario` SET `nombre`='$nuevonom',`apellidos`='$nuevoape',`tipo`='$nuevotip',`idusuario`='$nuevocod',`password`=md5('$nuevopassword'),`email`='$nuevoemail' WHERE idusuario='$codcli2';";
                    $connection->query($actualizar);
                    echo "<h4 class='margin1'>Datos actualizados</h4>";
                    echo '<META HTTP-EQUIV="Refresh" CONTENT="1; URL=/admin/datosclientes.php">';
                }else{
                    $actualizar="UPDATE `usuario` SET `nombre`='$nuevonom',`apellidos`='$nuevoape',`tipo`='$nuevotip',`idusuario`='$nuevocod',`email`='$nuevoemail' WHERE idusuario='$codcli2';";
                    $connection->query($actualizar);
                    echo "<h4 class='margin1'>Datos actualizados.</h4>";
                    echo '<META HTTP-EQUIV="Refresh" CONTENT="1; URL=/admin/datosclientes.php">';
                }
                
                };
                ?>
                        </div>
                        </form>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
</body>

</html>
