<!DOCTYPE html>
<html lang="Spanish">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airline: Registro</title>
    <link rel="stylesheet" href="../styles/css/bootstrap.css">
    <script src="../styles/js/bootstrap.js"></script>
    <script src="../styles/js/jquery.js"></script>
</head>

<body>
    <div class="container-fluid" id="fondo">
        <div class="row" style="height:5%;"></div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="container-fluid recuadro2 margin1">
                    <div class="row">
                        <?php
    include('../config/head.php');
    include('../config/conection.php');
?>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-md-3">
                            <form method="post" class="colorwhite">
                                <div class="form-group">
                                    <label for="Nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" placeholder="Introducir nombre" required> </div>
                                <div class="form-group">
                                    <label for="apellidos">Apellidos</label>
                                    <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" required> </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="email" required><small id="emailHelp" class="form-text text-muted colorwhite">No compartiremos tu información con nadie.</small> </div>
                                <div class="form-group">
                                    <label for="pass">Contraseña</label>
                                    <input type="password" class="form-control" name="pass" placeholder="Contraseña" required> </div>
                                <div class="form-group">
                                    <label for="pass2">Repetir Contraseña</label>
                                    <input type="password" class="form-control" name="pass2" placeholder="Repetir contraseña" required> </div>
                        </div>
                        <div class="col-md-6"> </div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <button type="submit" class="btn btn-primary margin1" name="registrar">Registrar</button>
                            <?php
        if(isset($_POST['registrar'])){
            $nuevonombre=$_POST['nombre'];
            $nuevoapellido=$_POST['apellidos'];
            $nuevoemail=$_POST['email'];
            $nuevopass=$_POST['pass'];
            $passverify=$_POST['pass2'];
            $compruebausuario="SELECT * FROM usuario WHERE email='$nuevoemail';";
            $result2=$connection->query($compruebausuario);
            if ($result2->num_rows===0) {
                if($nuevopass==$passverify){
         $consulta="INSERT INTO usuario(nombre, apellidos, tipo, idusuario, password, email, fecharegistro) VALUES ('$nuevonombre',  '$nuevoapellido','1','null',md5('$nuevopass'),'$nuevoemail', current_date);";
            $result = $connection->query($consulta);
                if ($result==false) {
                echo "error";
              } else {
                echo "<h4 class='colorwhite'>Registro correcto, puede iniciar sesión.</h4>";
                };
                }else{
                    echo"<h4 class='colorwhite'>Las contraseñas no coinciden.</h4>";
                }
        }else{
            echo"<h4 class='colorwhite'>Este usuario ya existe. Contacte con el administrador o insterte otros datos.</h4>";
            };
            };
        ?>
                        </div>
                        <div class="col-md-1"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
