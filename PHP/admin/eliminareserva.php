<!DOCTYPE html>
<html lang="Spanish">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airline</title>
    <link rel="stylesheet" href="../styles/estilos.css">
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
                $codcli=$_GET['codusu'];
                //var_dump($codcli);
                $codvuelo=$_GET['codvuelo'];
                    //var_dump($codvuelo);
                $selectmaleta="SELECT cidmaleta,ccodvuelo FROM compra WHERE cidusuario='$codcli' AND ccodvuelo='$codvuelo';";
                    //var_dump($selectmaleta);
                    $result2=$connection->query($selectmaleta);
                    while($obj = $result2->fetch_object()) {
                        $eliminarcompra1="DELETE FROM compra WHERE cidmaleta='$obj->cidmaleta' AND ccodvuelo='$obj->ccodvuelo';";
                        //var_dump($eliminarcompra1);
                        $connection->query($eliminarcompra1);
                        $eliminarmaleta2="DELETE FROM equipaje WHERE idmaleta='$obj->cidmaleta';";
                        $connection->query($eliminarmaleta2);
                        $updateplazasida="UPDATE `vuelo` SET `libres`=(libres +1) WHERE codvuelo='$codvuelo';";
                        $connection->query($updateplazasida);
                    }
                      header("Location: /admin/datosreservas.php");
                ?>
        </div>
    </div>
</body>

</html>
