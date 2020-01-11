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
                                <li><a href="/admin/addcliente.php">Añadir cliente</a></li>
                                <li class="active"><a href="/admin/datosreservas.php">Reservas</a></li>
                                <li><a href="/admin/dashboard.php">Dashboards</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="row">
                        <form method="post">
                            <div class="col-md-12">
                                <table class="table table-hover table-responsive">
                                    <tr>
                                        <td><strong>Código Vuelo</strong></td>
                                        <td><strong>Código Maleta</strong></td>
                                        <td><strong>Código Usuario</strong></td>
                                    </tr>
                                    <?php
                $codcli=$_GET['codusu'];
                $codvuelo=$_GET['codvuelo'];
                $consultacliente="SELECT * FROM compra WHERE cidusuario='$codcli' AND ccodvuelo='$codvuelo';";
                $result=$connection->query($consultacliente);
                    while($obj = $result->fetch_object()) {
                    echo"<tr>";
                        $codvueloantiguo=$obj->ccodvuelo;
                        $antiguocodmaleta=$obj->cidmaleta;
                        $codusuarioantiguo=$obj->cidusuario;
                        echo"<td>";
                        $pordefecto=($obj->ccodvuelo);
                        if ($result2 = $connection->query("SELECT codvuelo FROM vuelo")) {
                        echo"<select name='codvuelo' class='form-control'>";
                            while($obj2 = $result2->fetch_object()) {  
                                if($obj2->codvuelo == $pordefecto){
                                echo "<option value=".$obj2->codvuelo." selected>".$obj2->codvuelo."</option>";
                            }else{
                                 echo "<option value=".$obj2->codvuelo.">".$obj2->codvuelo."</option>";   
                                }}

                            };
                        echo"</td>";
                        echo"<td>";
                        $pordefecto2=($obj->cidmaleta);
                        if ($result3 = $connection->query("SELECT idmaleta FROM equipaje")) {
                        echo"<select name='codmaleta' class='form-control'>";
                            while($obj3 = $result3->fetch_object()) {  
                                if($obj3->idmaleta == $pordefecto2){
                                echo "<option value=".$obj3->idmaleta." selected>".$obj3->idmaleta."</option>";
                            }else{
                                 echo "<option value=".$obj3->idmaleta.">".$obj3->idmaleta."</option>";   
                                }}

                            };
                        echo"</td>";
                        echo"<td>";
                        $pordefecto3=($obj->cidusuario);
                        if ($result4 = $connection->query("SELECT idusuario, nombre, apellidos FROM usuario")) {
                        echo"<select name='codusuario' class='form-control'>";
                            while($obj4 = $result4->fetch_object()) {  
                                if($obj4->idusuario == $pordefecto3){
                                echo "<option value=".$obj4->idusuario." selected>".$obj4->nombre." ".$obj4->apellidos."</option>";
                            }else{
                                 echo "<option value=".$obj4->idusuario.">".$obj4->nombre." ".$obj4->apellidos."</option>";   
                                }}

                            };
                       echo"</td>";
                    echo"</tr>";
                    };
                ?>
                                </table>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <input type="submit" name="guardar" class="btn btn-danger margin1 alignright" value="Guardar"> </div>
                        <div class="col-md-1"></div>
                        <?php
                if (isset($_POST["guardar"])) {
                $nuevocodvuelo=$_POST['codvuelo'];
                $nuevocodigomaleta=$_POST['codmaleta'];
                $nuevocodusuario=$_POST['codusuario'];
                $actualizar="UPDATE `compra` SET `ccodvuelo`='$nuevocodvuelo',`cidusuario`='$nuevocodusuario',`cidmaleta`='$nuevocodigomaleta' WHERE cidusuario='$codusuarioantiguo' AND ccodvuelo='$codvueloantiguo';";
                    $connection->query($actualizar);
                    echo "<h1>Datos actualizados</h1>";
                    echo '<META HTTP-EQUIV="Refresh" CONTENT="1; URL=/admin/datosreservas.php">';
                
                };
                ?>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
