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
                $codvuelo=$_GET['cod'];
                $selectmaleta="SELECT cidmaleta FROM compra WHERE ccodvuelo='$codvuelo';";
                    $result2=$connection->query($selectmaleta);
                    while($obj = $result2->fetch_object()) {
                        $eliminarmaleta1="DELETE FROM compra WHERE cidmaleta='$obj->cidmaleta';";
                        $connection->query($eliminarmaleta1);
                        $eliminarmaleta2="DELETE FROM equipaje WHERE idmaleta='$obj->cidmaleta';";
                        $connection->query($eliminarmaleta2);
                    }
                $eliminavuelo="DELETE FROM vuelo WHERE codvuelo='$codvuelo';";
                $connection->query($eliminavuelo);
                header("Location: /admin/homeadministrador.php");
                ?>
        </div>
    </div>
</body>

</html>
