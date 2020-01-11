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
                                <li><a href="/admin/addaeropuerto.php">Añadir aeropuerto</a></li>
                                <li><a href="/admin/homeadministrador.php">Vuelos</a></li>
                                <li><a href="/admin/addvuelo.php">Añadir vuelo</a></li>
                                <li><a href="/admin/datosclientes.php">Clientes</a></li>
                                <li class="active"><a href="/admin/addcliente.php">Añadir Cliente</a></li>
                                <li><a href="/admin/datosreservas.php">Reservas</a></li>
                                <li><a href="/admin/dashboard.php">Dashboards</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <form method="post">
                                <div class="form-group">
                                    <label for="Nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" placeholder="Introducir nombre" required> </div>
                                <div class="form-group">
                                    <label for="apellidos">Apellidos</label>
                                    <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" required> </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email" required> </div>
                                <div class="form-group">
                                    <label for="pass">Contraseña</label>
                                    <input type="password" class="form-control" name="pass" placeholder="Contraseña" required> </div>
                                <div class="form-group">
                                    <label for="pass2">Repetir contraseña</label>
                                    <input type="password" class="form-control" name="pass2" placeholder="Repetir contraseña" required> </div>
                                <div class="form-group">
                                    <label for="tipo">Tipo</label>
                                    <select name="tipo" class="form-control" placeholder="tipo">
                                        <option value="1">Usuario Standart</option>
                                        <option value="0">Administrador</option>
                                    </select>
                                </div>
                        </div>
                        <div class="col-md-6"> </div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary margin1" name="registrar">Registrar</button>
                        </div>
                        <div class="col-md-2"> </div>
                        <?php
        if(isset($_POST['registrar'])){
            $nuevonombre=$_POST['nombre'];
            $nuevoapellido=$_POST['apellidos'];
            $nuevoemail=$_POST['email'];
            $nuevopass=$_POST['pass'];
            $passverify=$_POST['pass2'];
            $nuevotipo=$_POST['tipo'];
            $compruebausuario="SELECT * FROM usuario WHERE email='$nuevoemail';";
            $result2=$connection->query($compruebausuario);
            if ($result2->num_rows===0) {
                if($nuevopass==$passverify){
         $consulta="INSERT INTO usuario(nombre, apellidos, tipo, idusuario, password, email, fecharegistro) VALUES ('$nuevonombre',  '$nuevoapellido','$nuevotipo','null',md5('$nuevopass'),'$nuevoemail', current_date);";
            $result = $connection->query($consulta);
                if ($result==false) {
                echo "error";
              } else {
                echo"<div class='row'>";
                echo"<div class='col-md-2'></div>";
                echo"<div class='col-md-10'>";
                echo"<h4 class='margin1'>Registro correcto. Redireccionando...</h2>";
                echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL=/admin/datosclientes.php">';
                echo"</div>";
                echo"</div>";
                };
                }else{
                    echo"<div class='row'>";
                    echo"<div class='col-md-12'>";
                    echo"<h4 class='margin1'>Las contraseñas no coinciden. Revise los datos.</h4>";
                    echo"<div>";
                    echo"</div>";
                }
            }else{
            echo"<div class='row'>";
            echo"<div class='col-md-2'></div>";
            echo"<div class='col-md-10'>";
            echo"<h4 class='margin1'>Este usuario ya existe. Revise los datos.</h2>";
            //echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL=/admin/addcliente.php">';
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
