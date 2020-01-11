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
    <div class="container-fluid" id="fondo">
        <div class="row" style="height:5%;"></div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="container-fluid recuadro">
                    <div class="row">
                        <?php
         include('../config/conection.php');
         include('../config/head.php');
         include('../config/compruebasesion.php');
         ?>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>CodVuelo</th>
                                        <th>Origen</th>
                                        <th>Destino</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>CodMaleta</th>
                                        <th>Tipo de Equipaje</th>
                                        <th>Generar PDF</th>
                                    </tr>
                                    <?php
                    $idusuario=$_SESSION["idusuario"];
                    $consultareservas="SELECT compra.ccodvuelo, vuelo.codaerori, vuelo.codaerdes, vuelo.fecha, vuelo.hora, equipaje.idmaleta, equipaje.tipo from compra, vuelo, equipaje where compra.cidusuario='$idusuario' and compra.ccodvuelo=vuelo.codvuelo and compra.cidmaleta=equipaje.idmaleta;";
 $result=$connection->query($consultareservas); while($obj = $result->fetch_object()) {
                                        echo"<tr>";
                                        echo"<td>".$obj->ccodvuelo."</td>";
                                        echo"<td>".$obj->codaerori."</td>";
                                        echo"<td>".$obj->codaerdes."</td>";
                                        echo"<td>".$obj->fecha."</td>";
                                        echo"<td>".$obj->hora."</td>";
                                        echo"<td>".$obj->idmaleta."</td>";
                                        echo"<td>".$obj->tipo."</td>";
                                        echo"<td><a href='../users/generarpdfreserva.php?codvuelo=".$obj->ccodvuelo."'><img src='../img/pdf.png'   WIDTH='25'></a></td>";
                                        echo"</tr>";
                                    };
                    ?>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
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
