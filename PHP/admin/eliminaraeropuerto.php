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
                $codaer=$_GET['cod'];
                $selectvuelo="SELECT codvuelo FROM vuelo WHERE codaerori='$codaer' or codaerdes='$codaer';";
                $result1=$connection->query($selectvuelo);
                while($obj = $result1->fetch_object()) {
                        $codvuelo=$obj->codvuelo;
                        $selectmaleta="SELECT cidmaleta FROM compra WHERE ccodvuelo='$obj->codvuelo'";
                        var_dump($selectmaleta);
                        $result2=$connection->query($selectmaleta);
                        while($obj = $result2->fetch_object()) {
                          $eliminarmaleta="DELETE FROM equipaje WHERE idmaleta='$obj->cidmaleta';";
                          var_dump($eliminarmaleta);
                        $eliminarcompra="DELETE FROM compra WHERE ccodvuelo='$codvuelo';";
                        var_dump($eliminarcompra);
                        $connection->query($eliminarcompra);
                          $connection->query($eliminarmaleta);  
                        };  
                        $eliminavuelo="DELETE FROM vuelo WHERE codvuelo='$codvuelo';";
                    var_dump($eliminavuelo);
                        $connection->query($eliminavuelo); 

                };
                $eliminaeropuerto="DELETE FROM aeropuerto WHERE codaer='$codaer';";
                $connection->query($eliminaeropuerto);
                      header("Location: /admin/datosaeropuertos.php");
                ?>
        </div>
    </div>
</body>

</html>
