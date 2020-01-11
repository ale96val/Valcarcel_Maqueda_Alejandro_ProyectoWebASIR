<!DOCTYPE html>
<html lang="Spanish">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airline</title>
    <link rel="stylesheet" href="../styles/css/bootstrap.css">
    <script src="../styles/js/bootstrap.js"></script>
    <script src="../styles/js/jquery.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php
         include('../config/conection.php');
         include('../config/head.php');
         include('../config/compruebausuario.php');
         ?>
                <?php
                $codcli=$_GET['cod'];
                $selectvuelosafectados="SELECT ccodvuelo from compra WHERE cidusuario='$codcli';";
                $result3=$connection->query($selectvuelosafectados);
                while($obj3 = $result3->fetch_object()){
                    $updateplazasida="UPDATE `vuelo` SET `libres`=(libres +1) WHERE codvuelo='$obj3->ccodvuelo';";
                    $connection->query($updateplazasida);
                }
                $selectmaleta="SELECT cidmaleta FROM compra WHERE cidusuario='$codcli';";
                    $result2=$connection->query($selectmaleta);
                    while($obj = $result2->fetch_object()) {
                        $eliminarcompra1="DELETE FROM compra WHERE cidmaleta='$obj->cidmaleta';";
                        $connection->query($eliminarcompra1);
                        $eliminarmaleta2="DELETE FROM equipaje WHERE idmaleta='$obj->cidmaleta';";
                        $connection->query($eliminarmaleta2);
                    }
                $eliminausuario="DELETE FROM usuario WHERE idusuario='$codcli';";
                $connection->query($eliminausuario);
                      header("Location: /admin/datosclientes.php");
                ?>
        </div>
    </div>
</body>

</html>
