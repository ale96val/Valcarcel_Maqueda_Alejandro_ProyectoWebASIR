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
            ?>
                    </div>
                    <div class="row">
                        <h4>Datos incorrectos. Revise el nombre de usuario y la contraseña, o contacte con el administrador.</h4>
                        <h6>Redirigiendo...</h6>
                        <?php
                        echo '<META HTTP-EQUIV="Refresh" CONTENT="4; URL=../index.php">';
            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
