<!DOCTYPE html>
<?php
//if (!file_exists('../config/conection.php')) {
//    unlink('../config/installer.php');
//} else {
//   header("Location: ../config/installer.php");
//}
?>

    <html lang="Spanish">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Airline</title>
        <script src="/styles/js/jquery.js"></script>
        <link rel="stylesheet" href="/styles/css/bootstrap.css">
        <?php
    ?>
            <script src="/styles/js/bootstrap.js"></script>
    </head>

    <body>
        <div class="container-fluid" id="fondo">
            <div class="row fondo2"> </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="container-fluid recuadro2">
                        <div class="row">
                            <?php
         include('config/compruebainstalacion.php');
         include('config/conection.php');
         include('config/head.php');
         ?>
                        </div>
                        <hr/>
                        <div class="row">
                            <form method="post" action="/users/book.php">
                                <div class="col-md-3"></div>
                                <div class="col-md-3">
                                    <label class="colorwhite">Origen:</label>
                                    <?php
                        if ($result = $connection->query("SELECT codaer, ciudad FROM aeropuerto")) { ?>
                                        <select name="origen" class="form-control">
                                        <?php 
                            while($obj = $result->fetch_object()) {  
                                echo "<option value=".$obj->codaer.">".$obj->ciudad."</option>";
                            }
                            $result->close();
                            unset($obj);

                            };
                                ?>
                                    </select>
                                        </br>
                                        <label class="colorwhite">Fecha Ida:</label>
                                        </br>
                                        <input type="date" name="fsalida" class="form-control"> </div>
                                <div class="col-md-3">
                                    <label class="colorwhite">Destino:</label>
                                    <?php
                        if ($result = $connection->query("SELECT codaer, ciudad FROM aeropuerto")) { ?>
                                        <select name="destino" class="form-control">
                                        <?php 
                            while($obj = $result->fetch_object()) {  
                                echo "<option value=".$obj->codaer.">".$obj->ciudad."</option>";
                            }
                            $result->close();
                            unset($obj);
                            };
                                ?>
                                    </select>
                                        </br>
                                        <label class="colorwhite">Fecha Vuelta:</label>
                                        </br>
                                        <input type="date" name="fvuelta" class="form-control">
                                        <label class="colorwhite">Solo Ida:</label>
                                        <input type="checkbox" name="soloida"> </div>
                                <div class="col-md-3"> </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <?php
            if(isset($_SESSION['email'])){
            echo "<button type='submit' class='btn btn-primary btn-sm margin1'>Buscar</button>";
            }else{
                echo "<button class='btn btn-danger btn-sm margin1' disabled>Inicie sesión para ver los resultados</button>";
            }
                ?>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
        </div>
    </body>
    <?php
include('config/footer.php');
?>

    </html>
