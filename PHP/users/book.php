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
    include('../config/head.php');
    include('../config/conection.php');
    include('../config/compruebasesion.php');
?>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-md-12">
                            <h1>Vuelos disponibles:</h1>
                        </div>
                    </div>
                    <div class="row borde">
                        <div class="form-group">
                            <form method="post" id="confirm">
                                <div class="row">
                                    <div class="col-md-3 margin1">
                                        <?php
                                $origen=$_POST['origen'];
                                $dest=$_POST['destino'];
                                $fsalida=$_POST['fsalida'];
                                $consultair="select * from vuelo where codaerori='$origen' and codaerdes='$dest' and fecha='$fsalida' and libres>'0';";
                                $result = $connection->query($consultair);
                                if ($result->num_rows===0) {
                                        echo "<div>";
                                            echo "<label>No hay vuelos disponibles para la ida</label>";
                                        echo "</div>";
                                }else{
                                        echo"<div class='form-group'>";
                                        echo"<label>Seleccione un vuelo de Ida:</label>";
                                        while($obj = $result->fetch_object()) {
                                                echo "<div>";
                                                    echo "<label><input type='radio' name='radioida' value='$obj->codvuelo' required>".$obj->codvuelo."</label>";
                                                    echo "<p>Ruta: ".$origen." - ".$dest."</p>";
                                                    echo "<p>Hora: ".$obj->hora."</p>";
                                                echo "</div>";
                                        } 
                                        echo"</div>";
                                        echo"<div class='form-group'>";
                                        echo"<label>Equipaje:</label>";
                                            echo"<select class='form-control' name='maleta' form='confirm'>";
                                            echo"<option value='sin maleta'>Sin Equipaje</option>";
                                            echo"<option value='maleta de mano'>Equipaje de mano</option>";
                                            echo"<option value='equipaje facturado'>Equipaje facturado</option>";
                                            echo"</select>";
                                        echo"</div>";
                                        echo"<div class='form-group'>";
                                        echo"<label>Peso aproximado:</label>";
                                        echo"<input class='form-control' type='number' name='pesomaletaida' value=''><small class='form-text text-muted colorwhite'>Dejar en blanco en caso de viajar sin equipaje</small>";
                                        echo"</div>";
                                             };
                    ?> </div>
                                    <div class="col-md-3"> </div>
                                    <div class="col-md-3 margin1">
                                        <?php
                    if(!isset($_POST['soloida'])){
                        echo"<div>";     
                    $origenvuelta=$_POST['destino'];
                    $destvuelta=$_POST['origen'];
                    $fvuelta=$_POST['fvuelta'];
                    $consultavolver="select * from vuelo where codaerori='$origenvuelta' and codaerdes='$destvuelta' and fecha='$fvuelta'";
                    $result2 = $connection->query($consultavolver);
                        if ($result2->num_rows===0) {
                            echo "<div>";
                            echo "<label>No hay vuelos disponibles para la vuelta</label>";
                            echo "</div>";
                        }else{
                            echo"<label>Seleccione un vuelo de Vuelta:</label>";
                  while($obj2 = $result2->fetch_object()) {
                        echo "<div class='form-group'>";
                        echo "<label><input type='radio' name='radiovuelta' value='$obj2->codvuelo' required>".$obj2->codvuelo."</label>";
                        echo "<p>Ruta: ".$origen." - ".$dest."</p>";
                        echo "<p>Hora: ".$obj2->hora."</p>";
                      
                        echo "</div>";
                            };
                       echo"</div>";
                            echo"<div class='form-group'>";
                            echo"<label>Equipaje:</label>";
                                echo"<select class='form-control' name='maletavuelta' form='confirm'>";
                                    echo"<option value='sin maleta'>Sin Equipaje</option>";
                                    echo"<option value='maleta de mano'>Equipaje de mano</option>";
                                    echo"<option value='equipaje facturado'>Equipaje facturado</option>";
                                echo"</select>";
                            echo"</div>";
                            echo"<div class='form-group'>";
                                        echo"<label>Peso aproximado:</label>";
                                        echo"<input class='form-control' type='number' name='pesomaletavuelta' value=''><small class='form-text text-muted colorwhite'>Dejar en blanco en caso de viajar sin equipaje</small>";
                                        echo"</div>";
                        echo"</div>";
                    };}else{
                    $consultavolverfalsa="select * from vuelo where codaerori='AAA' and codaerdes='AAA' and fecha='AAA'";
                      $result2 = $connection->query($consultavolverfalsa);  
                    };
                    ?>
                                            <?php
                            if (($result->num_rows===0)&&($result2->num_rows===0)) {
                                 echo"<div class='col-md-3'>";
                                    echo"<a href='../index.php' class='btn btn-danger' name='cancelar'>Cancelar</a>";
                                    echo"</div>";
                            }else{
                                echo"<div class='col-md-3'>";
                                    echo"<button type='submit' class='btn btn-success margin1' name='confirmar'>Confirmar</button>";
                                    echo"<a href='../index.php' class='btn btn-danger margin1' name='cancelar'>Cancelar</a>";
                                    echo"</div>";
                            };
                                    ?>
                                                <?php
                            if(isset($_POST['confirmar'])){
                                if(isset($_POST['radioida'])){
                                $codvuelo=$_POST["radioida"];
                                $maletaida=$_POST["maleta"];
                                $cidusuario=$_SESSION["idusuario"];
                                $peso=$_POST["pesomaletaida"];
                                $insertmaletaida="INSERT INTO `equipaje`(`idmaleta`, `kg`, `tipo`) VALUES (null, '$peso','$maletaida');";
                                $connection->query($insertmaletaida);
                                
                                $selectmaxmaleta="SELECT MAX(idmaleta) from equipaje;";
                                $result=$connection->query($selectmaxmaleta);
                                while($obj = $result->fetch_object()) {
                                     $maxmaleta=$obj->idmaleta;
                                };
                                $insertcompraida="INSERT INTO `compra`(`ccodvuelo`, `cidmaleta`, `cidusuario`) VALUES ('$codvuelo','$maxmaleta','$cidusuario');";
                                $connection->query($insertcompraida);
                                
                                $updateplazasida="UPDATE `vuelo` SET `libres`=(libres -1) WHERE codvuelo='$codvuelo';";
                                $connection->query($updateplazasida);
                                };
                                    
                                if(isset($_POST['radiovuelta'])){
                                    $codvuelovuelta=$_POST["radiovuelta"];
                                    $maletavuelta=$_POST["maletavuelta"];
                                    $cidusuario=$_SESSION["idusuario"];
                                    $peso2=$_POST["pesomaletavuelta"];
                                    $insertmaletavuelta="INSERT INTO `equipaje`(`idmaleta`, `kg`, `tipo`) VALUES (null, '$peso2','$maletavuelta');";
                                    $connection->query($insertmaletavuelta);
                                    
                                    $selectmaxmaleta="SELECT MAX(idmaleta) from equipaje;";
                                    $result=$connection->query($selectmaxmaleta);
                                    while($obj = $result->fetch_object()) {
                                        $maxmaleta=$obj->idmaleta;
                                    };
                                    $insertcompravuelta="INSERT INTO `compra`(`ccodvuelo`, `cidmaleta`, `cidusuario`) VALUES ('$codvuelovuelta','$maxmaleta','$cidusuario');";
                                    $connection->query($insertcompravuelta);
                                    
                                    $updateplazasvuelta="UPDATE `vuelo` SET `libres`=(libres -1) WHERE codvuelo='$codvuelovuelta';";
                                    $connection->query($updateplazasvuelta);
                                };
                                header("Location: /users/reservas.php");
                            };
                            ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
    </div>
</body>
<?php
include('../config/footer.php');
?>

</html>
