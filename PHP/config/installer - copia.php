<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Instalar Airline</title>
    <link rel="stylesheet" href="../styles/css/bootstrap.css">
    <link rel="stylesheet" href="../styles/estilos.css">
    <script src="../styles/js/bootstrap.js"></script>
    <script src="../styles/js/jquery.js"></script>
</head>
<body>

    <?php
	session_start();
	$connection;
        function connecBD($HostBD, $UsuarioBD, $PassBD, $NombreBD){
            global $connection;
            error_reporting(E_ALL ^ E_WARNING);
            $connection = new mysqli($HostBD, $UsuarioBD, $PassBD, $NombreBD);
            $connection->set_charset("utf8");
            if ($connection->connect_errno) {
                echo "Connection failed with database";
                // exit();
                return "false";
            }else
                return "true";
        }
        if(file_exists("database.php"))
            header('Location: ../index.php');
        if (isset($_POST["instalar"])) {
            $NombreBD = $_POST['nombrebd'];
            $UsuarioBD = $_POST['usuariobd'];
            $PassBD = $_POST['passbd'];
            $HostBD= $_POST['hostbd'];
            $Admin = $_POST['admin'];
            $PassAdmin = $_POST['passadmin'];
            $DatosDB = (isset($_POST['insertardatos'])) ? "true" : "false";
            $connect = connecBD($HostBD, $UsuarioBD, $PassBD, $NombreBD);
            if($connect == "true"){
                insertAeropuerto($connection);
                insertCompra($connection);
                insertMaleta($connection);
                insertUsuario($connection);
                insertVuelo($connection);
                alterAeropuerto($connection);
                alterMaleta($connection);
                alterCompra($connection);
                alterUsuario($connection);
                alterVuelo($connection);
                alterCompra2($connection);
                alterMaleta2($connection);
                alterUsuario2($connection);
                alterCompra3($connection);
                alterVuelo2($connection);
                if($DatosDB == "true"){
                    insertDatosAeropuerto($connection);
                    insertDatosMaleta($connection);
                    insertDatosUsuario($connection);
                    insertDatosVuelo($connection);
                    insertDatosCompra($connection);
                }else{
                    insertAdmin($connection);
                }
                // creamos un archivo con la conexion y las variables de la db
                $Archivo = "<?php\n\$connection = new mysqli('$HostBD', '$UsuarioBD', '$PassBD', '$NombreBD');\n?>";
                $file = fopen("conection.php", "w");
                fwrite($file, $Archivo);
                Fclose($file);
                echo "<div>";
                echo "<h1>Instalacion completada</h1>";
                echo '<META HTTP-EQUIV="Refresh" CONTENT="10; URL=../index.php">';
                echo "</div>";
            }
        }
        if (isset($_POST["botonFinalizar"])) {
            if(file_exists("database.php"))
                header('Location: index.php');
            else
                echo "<h1>Para usar Airline, se necesita completar la instalación.</h1>";
        }
        function insertAeropuerto($connection){
            $insertestructura = "
            CREATE TABLE `aeropuerto` (
            `codaer` varchar(3) NOT NULL,
            `nombre` varchar(25) NOT NULL,
            `ciudad` varchar(25) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ";
            if($result = $connection->query($insertestructura)) {
                if ($result)
                    echo "<h1>Tabla Aeropuerto creada correctamente.</h1></br>";
            }else
                echo "Error al crear la tabla Aeropuerto.";
        }
        function insertDatosAeropuerto($connection){
            $insertdatos = "
            INSERT INTO `aeropuerto` (`codaer`, `nombre`, `ciudad`) VALUES
            ('AGP', 'Malaga Costa del Sol', 'Malaga'),
            ('BCN', 'Barcelona El Prat', 'Barcelona'),
            ('BIO', 'Aeropuerto de Bilbao', 'Bilbao'),
            ('CDG', 'Paris Chales de Gaulle', 'Paris - Charles '),
            ('GRX', 'Granada Garcia Lorca', 'Granada'),
            ('LGW', 'Londres Gatwick', 'Londres - Gatwick'),
            ('MAD', 'Madrid Barajas', 'Madrid'),
            ('ORY', 'Paris Orly', 'Paris - Orly'),
            ('STN', 'Londres Stansted', 'Londres - Stansted'),
            ('SVQ', 'Sevilla San Pablo', 'Sevilla'),
            ('VLC', 'Valencia Manises', 'Valencia'),
            ('XRY', 'Aeropuerto de Jerez', 'Jerez');";
            if ($result = $connection->query($insertdatos)) {
                if ($result)
                    echo "<h1>Datos Aeropuertos insertados.</h1></br>";
            }else
                echo "Error al insertar datos Aeropuertos.";
        }
        function insertCompra($connection){
            $insertarTabla = "
            CREATE TABLE `compra` (
            `ccodvuelo` varchar(6) NOT NULL,
            `cidmaleta` int(4) NOT NULL,
            `cidusuario` int(4) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ";
            if ($result = $connection->query($insertarTabla)) {
                if (!$result)
                    echo "<h1>Tabla Compra creada correctamente.</h1></br>";
            }else
                echo "Error al crear la tabla Maleta.";
        }
        function insertDatosCompra($connection){
            $insertdatos = "
            INSERT INTO `compra` (`ccodvuelo`, `cidmaleta`, `cidusuario`) VALUES
            ('AV0003', 5, 1),
            ('AV0011', 4, 16),
            ('AV0042', 3, 16),
            ('AV0050', 6, 1);";
            if ($result = $connection->query($insertdatos)) {
                if ($result)
                    echo "<h1>Datos Compra insertados.</h1></br>";
            }else
                echo "Error al insertar datos Compra.";
        }
        function insertMaleta($connection){
            $insertestructura2 = "
            CREATE TABLE `equipaje` (
            `idmaleta` int(4) NOT NULL,
            `kg` int(3) NOT NULL,
            `tipo` varchar(24) NOT NULL DEFAULT 'bodega'
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;;
            ";
            if ($result = $connection->query($insertestructura2)) {
                if ($result)
                    echo "<h1>Tabla Maleta creada correctamente.</h1></br>";
            }else
                echo "Error al crear la tabla Maleta.";
        }
        function insertDatosMaleta($connection){
            $insertdatos = "
            INSERT INTO `equipaje` (`idmaleta`, `kg`, `tipo`) VALUES
            (1, 2, 'sin maleta'),
            (2, 2, 'sin maleta'),
            (3, 0, 'sin maleta'),
            (4, 0, 'sin maleta'),
            (5, 0, 'sin maleta'),
            (6, 0, 'sin maleta');";
            if ($result = $connection->query($insertdatos)) {
                if ($result)
                    echo "<h1>Datos Maleta insertados.</h1></br>";
            }else
                echo "Error al insertar datos Maleta.";
        }
        function insertUsuario($connection){
            $insertarTabla = "
            CREATE TABLE `usuario` (
            `nombre` varchar(15) NOT NULL,
            `apellidos` varchar(20) NOT NULL,
            `tipo` int(1) NOT NULL,
            `idusuario` int(4) NOT NULL,
            `password` varchar(64) NOT NULL,
            `email` varchar(60) NOT NULL,
            `fecharegistro` date NOT NULL,
            `tema` int(1) NOT NULL DEFAULT '0'
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ";
            if ($result = $connection->query($insertarTabla)) {
                if ($result)
                    echo "<h1>Tabla Usuario creada correctamente.</h1>";
            }else
                echo "Error al crear la tabla Usuario.";
        }
        function insertDatosUsuario($connection){
        global $Admin;
        global $PassAdmin;
        $insertdatos = "
        INSERT INTO `usuario` (`nombre`, `apellidos`, `tipo`, `idusuario`, `password`, `email`, `fecharegistro`, `tema`) VALUES
        ('Administrador', 'Administrador', 0, 1, md5('$PassAdmin'), '$Admin', '2016-10-10', 0),
        ('Luis', 'J.', 1, 12, '63a9f0ea7bb98050796b649e85481845', 'luis@luis.es', '2016-11-14', 1),
        ('Sergio', 'Jimenez', 1, 13, '63a9f0ea7bb98050796b649e85481845', 'sergio@sergio.es', '2016-11-27', 1),
        ('Andres', 'Martinez Leon', 1, 14, '63a9f0ea7bb98050796b649e85481845', 'andres@andres.es', '2016-09-27', 0),
        ('Paco', 'Pacheco', 1, 16, '63a9f0ea7bb98050796b649e85481845', 'paco@paco.es', '2017-02-19', 0);";
        if ($result = $connection->query($insertdatos)) {
                if ($result)
                    echo "<h1>Datos Usuario insertados.</h1></br>";
            }else
                echo "Error al insertar datos Usuario.";
        }
        function insertVuelo($connection){
            $insertarTabla = "
            CREATE TABLE `vuelo` (
            `codvuelo` varchar(6) NOT NULL,
            `fecha` date NOT NULL,
            `hora` time NOT NULL,
            `capacidad` int(3) NOT NULL DEFAULT '180',
            `libres` int(3) NOT NULL DEFAULT '180',
            `codaerori` varchar(3) NOT NULL,
            `codaerdes` varchar(3) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ";
            if ($result = $connection->query($insertarTabla)) {
                if ($result)
                    echo "<h1>Tabla Vuelo creada correctamente.</h1></br>";
            }else
                echo "Error al crear la tabla Vuelo.";
        }
function insertDatosVuelo($connection){
            $insertdatos = "
            INSERT INTO `vuelo` (`codvuelo`, `fecha`, `hora`, `capacidad`, `libres`, `codaerori`, `codaerdes`) VALUES
            ('AV0000', '2017-12-14', '00:08:00', 180, 180, 'AGP', 'BCN'),
            ('AV0001', '2017-12-14', '04:00:00', 180, 180, 'AGP', 'BIO'),
            ('AV0002', '2017-12-14', '09:00:00', 180, 6, 'AGP', 'CDG'),
            ('AV0003', '2017-12-14', '05:00:00', 180, 179, 'AGP', 'LGW'),
            ('AV0004', '2017-12-14', '10:00:00', 180, 180, 'AGP', 'MAD'),
            ('AV0005', '2017-12-14', '07:00:00', 180, 180, 'AGP', 'ORY'),
            ('AV0006', '2017-12-14', '06:30:00', 180, 180, 'AGP', 'STN'),
            ('AV0007', '2017-12-14', '07:00:00', 180, 180, 'AGP', 'VLC'),
            ('AV0008', '2017-11-14', '00:10:00', 180, 180, 'BCN', 'AGP'),
            ('AV0009', '2017-12-14', '07:00:00', 180, 180, 'BCN', 'BIO'),
            ('AV0010', '2017-12-14', '12:00:00', 180, 180, 'BCN', 'CDG'),
            ('AV0011', '2017-12-14', '09:00:00', 180, 179, 'BCN', 'GRX'),
            ('AV0012', '2017-12-14', '00:30:00', 180, 180, 'BCN', 'LGW'),
            ('AV0014', '2017-12-14', '07:20:00', 180, 180, 'BCN', 'MAD'),
            ('AV0015', '2017-12-14', '09:00:00', 180, 180, 'BCN', 'ORY'),
            ('AV0016', '2017-12-12', '10:00:00', 180, 180, 'BCN', 'STN'),
            ('AV0017', '2017-12-14', '08:30:00', 180, 180, 'BCN', 'SVQ'),
            ('AV0018', '2017-12-14', '14:00:00', 180, 180, 'BCN', 'VLC'),
            ('AV0019', '2017-12-14', '11:00:00', 180, 180, 'BCN', 'XRY'),
            ('AV0020', '2017-12-14', '00:08:00', 180, 180, 'BIO', 'AGP'),
            ('AV0021', '2017-12-14', '04:00:00', 180, 180, 'BIO', 'BCN'),
            ('AV0022', '2017-12-14', '09:00:00', 180, 180, 'BIO', 'CDG'),
            ('AV0023', '2017-12-14', '05:00:00', 180, 180, 'BIO', 'GRX'),
            ('AV0024', '2017-12-14', '10:00:00', 180, 180, 'BIO', 'LGW'),
            ('AV0025', '2017-12-14', '07:00:00', 180, 180, 'BIO', 'MAD'),
            ('AV0026', '2017-12-14', '06:30:00', 180, 180, 'BIO', 'ORY'),
            ('AV0027', '2017-12-14', '07:00:00', 180, 180, 'BIO', 'STN'),
            ('AV0028', '2017-12-14', '00:08:00', 180, 180, 'BIO', 'SVQ'),
            ('AV0029', '2017-12-14', '04:00:00', 180, 180, 'BIO', 'VLC'),
            ('AV0030', '2017-12-14', '09:00:00', 180, 180, 'BIO', 'XRY'),
            ('AV0031', '2017-12-14', '00:08:00', 180, 6, 'CDG', 'AGP'),
            ('AV0032', '2017-12-14', '04:00:00', 180, 180, 'CDG', 'BCN'),
            ('AV0033', '2017-12-14', '09:00:00', 180, 180, 'CDG', 'BIO'),
            ('AV0034', '2017-12-14', '05:00:00', 180, 180, 'CDG', 'GRX'),
            ('AV0035', '2017-12-14', '10:00:00', 180, 180, 'CDG', 'LGW'),
            ('AV0036', '2017-12-14', '07:00:00', 180, 180, 'CDG', 'MAD'),
            ('AV0037', '2017-12-14', '06:30:00', 180, 180, 'CDG', 'ORY'),
            ('AV0038', '2017-12-14', '07:00:00', 180, 180, 'CDG', 'STN'),
            ('AV0039', '2017-12-14', '00:08:00', 180, 180, 'CDG', 'SVQ'),
            ('AV0040', '2017-12-14', '04:00:00', 180, 180, 'CDG', 'VLC'),
            ('AV0041', '2017-12-14', '09:00:00', 180, 180, 'CDG', 'XRY'),
            ('AV0042', '2017-12-14', '00:08:00', 180, 179, 'GRX', 'BCN'),
            ('AV0043', '2017-12-14', '04:00:00', 180, 180, 'GRX', 'BIO'),
            ('AV0044', '2017-12-14', '09:00:00', 180, 180, 'GRX', 'CDG'),
            ('AV0045', '2017-12-14', '05:00:00', 180, 180, 'GRX', 'LGW'),
            ('AV0046', '2017-12-14', '10:00:00', 180, 180, 'GRX', 'MAD'),
            ('AV0047', '2017-12-14', '07:00:00', 180, 180, 'GRX', 'ORY'),
            ('AV0048', '2017-12-14', '06:30:00', 180, 180, 'GRX', 'STN'),
            ('AV0049', '2017-12-14', '07:00:00', 180, 180, 'GRX', 'VLC'),
            ('AV0050', '2017-12-14', '00:08:00', 180, 179, 'LGW', 'AGP'),
            ('AV0051', '2017-12-14', '04:00:00', 180, 180, 'LGW', 'BCN'),
            ('AV0052', '2017-12-14', '09:00:00', 180, 180, 'LGW', 'BIO'),
            ('AV0053', '2017-12-14', '04:00:00', 180, 180, 'LGW', 'CDG'),
            ('AV0054', '2017-12-14', '09:00:00', 180, 180, 'LGW', 'GRX'),
            ('AV0055', '2017-12-14', '04:00:00', 180, 180, 'LGW', 'MAD'),
            ('AV0056', '2017-12-14', '09:00:00', 180, 180, 'LGW', 'ORY'),
            ('AV0057', '2017-12-14', '04:00:00', 180, 180, 'LGW', 'STN'),
            ('AV0058', '2017-12-14', '09:00:00', 180, 180, 'LGW', 'SVQ'),
            ('AV0059', '2017-12-14', '04:00:00', 180, 180, 'LGW', 'VLC'),
            ('AV0060', '2017-12-14', '09:00:00', 180, 180, 'LGW', 'XRY'),
            ('AV0061', '2017-12-14', '00:08:00', 180, 180, 'MAD', 'AGP'),
            ('AV0062', '2017-12-14', '04:00:00', 180, 180, 'MAD', 'BCN'),
            ('AV0063', '2017-12-14', '09:00:00', 180, 180, 'MAD', 'BIO'),
            ('AV0064', '2017-12-14', '04:00:00', 180, 180, 'MAD', 'CDG'),
            ('AV0065', '2017-12-14', '09:00:00', 180, 180, 'MAD', 'GRX'),
            ('AV0066', '2017-12-14', '04:00:00', 180, 180, 'MAD', 'LGW'),
            ('AV0067', '2017-12-14', '09:00:00', 180, 180, 'MAD', 'ORY'),
            ('AV0068', '2017-12-14', '04:00:00', 180, 180, 'MAD', 'STN'),
            ('AV0069', '2017-12-14', '09:00:00', 180, 180, 'MAD', 'SVQ'),
            ('AV0070', '2017-12-14', '04:00:00', 180, 180, 'MAD', 'VLC'),
            ('AV0071', '2017-12-14', '09:00:00', 180, 180, 'MAD', 'XRY'),
            ('AV0072', '2017-12-14', '04:00:00', 180, 180, 'ORY', 'AGP'),
            ('AV0073', '2017-12-14', '09:00:00', 180, 180, 'ORY', 'BCN'),
            ('AV0074', '2017-12-14', '04:00:00', 180, 180, 'ORY', 'BIO'),
            ('AV0075', '2017-12-14', '09:00:00', 180, 180, 'ORY', 'GRX'),
            ('AV0076', '2017-12-14', '04:00:00', 180, 180, 'ORY', 'LGW'),
            ('AV0077', '2017-12-14', '09:00:00', 180, 180, 'ORY', 'MAD'),
            ('AV0078', '2017-12-14', '04:00:00', 180, 180, 'ORY', 'STN'),
            ('AV0079', '2017-12-14', '09:00:00', 180, 180, 'ORY', 'SVQ'),
            ('AV0080', '2017-12-14', '04:00:00', 180, 180, 'ORY', 'VLC'),
            ('AV0081', '2017-12-14', '09:00:00', 180, 180, 'ORY', 'XRY'),
            ('AV0082', '2017-12-14', '04:00:00', 180, 180, 'STN', 'AGP'),
            ('AV0083', '2017-12-14', '09:00:00', 180, 180, 'STN', 'BCN'),
            ('AV0084', '2017-12-14', '04:00:00', 180, 180, 'STN', 'BIO'),
            ('AV0085', '2017-12-14', '09:00:00', 180, 180, 'STN', 'CDG'),
            ('AV0086', '2017-12-14', '04:00:00', 180, 180, 'STN', 'GRX'),
            ('AV0087', '2017-12-14', '09:00:00', 180, 180, 'STN', 'MAD'),
            ('AV0088', '2017-12-14', '04:00:00', 180, 180, 'STN', 'ORY'),
            ('AV0089', '2017-12-14', '09:00:00', 180, 180, 'STN', 'SVQ'),
            ('AV0090', '2017-12-14', '04:00:00', 180, 180, 'STN', 'VLC'),
            ('AV0091', '2017-12-14', '09:00:00', 180, 180, 'STN', 'XRY'),
            ('AV0092', '2017-12-14', '04:00:00', 180, 180, 'SVQ', 'BCN'),
            ('AV0093', '2017-12-14', '09:00:00', 180, 180, 'SVQ', 'BCN'),
            ('AV0094', '2017-12-14', '04:00:00', 180, 180, 'SVQ', 'BIO'),
            ('AV0095', '2017-12-14', '09:00:00', 180, 180, 'SVQ', 'CDG'),
            ('AV0096', '2017-12-14', '04:00:00', 180, 180, 'SVQ', 'LGW'),
            ('AV0097', '2017-12-14', '09:00:00', 180, 180, 'SVQ', 'MAD'),
            ('AV0098', '2017-12-14', '04:00:00', 180, 180, 'SVQ', 'ORY'),
            ('AV0099', '2017-12-14', '09:00:00', 180, 180, 'SVQ', 'STN'),
            ('AV0100', '2017-12-14', '04:00:00', 180, 180, 'SVQ', 'VLC'),
            ('AV0101', '2017-12-14', '09:00:00', 180, 180, 'VLC', 'AGP');
            ";
            if ($result = $connection->query($insertdatos)) {
                if ($result)
                    echo "<h1>Datos Vuelo insertados.</h1></br>";
            }else
                echo "Error al insertar datos Vuelo.";
        }
    function alterAeropuerto($connection){
    $alterDatos = "
    ALTER TABLE `aeropuerto`
    ADD PRIMARY KEY (`codaer`),
    ADD UNIQUE KEY `codaer` (`codaer`);";
    $connection->query($alterDatos);
    }
    function alterCompra($connection){
    $alterDatos = "
    ALTER TABLE `compra`
    ADD PRIMARY KEY (`ccodvuelo`,`cidmaleta`,`cidusuario`),
    ADD KEY `cidusuario` (`cidusuario`),
    ADD KEY `cidmaleta` (`cidmaleta`);";
    $connection->query($alterDatos);
    }
    function alterMaleta($connection){
    $alterDatos = "
    ALTER TABLE `equipaje`
    ADD PRIMARY KEY (`idmaleta`);";
    $connection->query($alterDatos);
    }
    function alterUsuario($connection){
    $alterDatos = "
    ALTER TABLE `usuario`
    ADD PRIMARY KEY (`idusuario`),
    ADD UNIQUE KEY `email` (`email`);";
    $connection->query($alterDatos);
    }
    function alterVuelo($connection){
    $alterDatos = "
    ALTER TABLE `vuelo`
    ADD PRIMARY KEY (`codaerori`,`codaerdes`,`codvuelo`),
    ADD UNIQUE KEY `codvuelo` (`codvuelo`),
    ADD KEY `codaerdes` (`codaerdes`);";
    $connection->query($alterDatos);
    }
    function alterCompra2($connection){
    $alterDatos = "
    ALTER TABLE `compra`
    MODIFY `cidmaleta` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;";
    $connection->query($alterDatos);
    }
    function alterMaleta2($connection){
    $alterDatos = "
    ALTER TABLE `equipaje`
    MODIFY `idmaleta` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;";
    $connection->query($alterDatos);
    }
    function alterUsuario2($connection){
    $alterDatos = "
    ALTER TABLE `usuario`
    MODIFY `idusuario` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;";
    $connection->query($alterDatos);
    }
    function alterCompra3($connection){
    $alterDatos = "ALTER TABLE `compra`
    ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`ccodvuelo`) REFERENCES `vuelo` (`codvuelo`) ON UPDATE CASCADE,
    ADD CONSTRAINT `compra_ibfk_3` FOREIGN KEY (`cidusuario`) REFERENCES `usuario` (`idusuario`) ON UPDATE CASCADE,
    ADD CONSTRAINT `compra_ibfk_4` FOREIGN KEY (`cidmaleta`) REFERENCES `equipaje` (`idmaleta`) ON UPDATE CASCADE;";
    $connection->query($alterDatos);
    }
    function alterVuelo2($connection){
    $alterDatos = "ALTER TABLE `vuelo`
    ADD CONSTRAINT `vuelo_ibfk_1` FOREIGN KEY (`codaerdes`) REFERENCES `aeropuerto` (`codaer`) ON UPDATE CASCADE,
    ADD CONSTRAINT `vuelo_ibfk_2` FOREIGN KEY (`codaerori`) REFERENCES `aeropuerto` (`codaer`) ON UPDATE CASCADE;";
    $connection->query($alterDatos);
    }
    function insertAdmin($connection){
    global $Admin;
    global $PassAdmin;
    $insertDatos = "
        INSERT INTO `usuario` (`nombre`, `apellidos`, `tipo`, `idusuario`, `password`, `email`, `fecharegistro`, `tema`) VALUES
        ('Administrador', 'Administrador', 0, 1, md5('$PassAdmin'), '$Admin', '2016-10-10', 0);";
    $connection->query($insertDatos);
    }
    ?>

    <div class="container-fluid">
        <div class="row">
    <div class="col-md-4">
        <a href="../index.php"><img class="imag" src="../img/logo2.JPG" /></a>
    </div>
    <div class="col-md-4">
        <center><h1>Instalador de Airline.</h1></center>
        <center><h3>Para empezar la instalación, complete los siguientes campos.</h3></center>
        <center><h6>Si ha llegado a esta página por error, o ya tiene instalado Airline, no continue.</h6></center>
    </div>
    <div class="col-md-4"></div>
        </div>
    <div class="row">
    <div class="container-fluid recuadro2 margin1">
        <form class='instalar colorwhite' method="post">
            </br>
            <div class="row">
                <div class="col-md-7">
                <label>Nombre de la Base de Datos</label>
                <input class="form-control" name="nombrebd" type="text" value="--Nombre--" required>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-3"></div>
            </div>
            </br>
            <div class="row">
                <div class="col-md-7">
                <label>Usuario de la Base de Datos</label>
                <input class="form-control" name="usuariobd" type="text" value="--Usuario--" required>
                </div>
                 <div class="col-md-1"></div>
                <div class="col-md-3"></div>
            </div>
            </br>
            <div class="row">
                <div class="col-md-7">
                <label>Contraseña de la Base de Datos</label>
                <input class="form-control" name="passbd" type="password" value="--Password--" required>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-3"></div>
            </div>
            </br>
            <div class="row">
                <div class="col-md-7">
                <label>Host</label>
                <input class="form-control" name="hostbd" type="text" value="--Localhost--" required>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-3"></div>
            </div>
            </br>
            <div class="row">
                <div class="col-md-7">
                <label>Email del Usuario Administrador</label>
                <input class="form-control" name="admin" type="mail" value="--UsuarioAdministrador--" required>
                </div>
                 <div class="col-md-1"></div>
                <div class="col-md-3"></div>
            </div>
            </br>
            <div class="row">
                <div class="col-md-7">
                <label>Contraseña del Usuario Administrador</label>
                <input class="form-control" name="passadmin" type="password" value="--Password--" required>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-3"></div>
            </div>
            </br>
            <div class="row">
                <div class="col-md-7">
            <label>Insertar datos</label>
                <input type="checkbox" name="insertardatos" checked>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-3"></div>
            </div>
            </br>
            <div class="row">
                <div class="col-md-7">
                <input class="form-control btn btn-danger" type="submit" value="Instalar" name="instalar">
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-3"></div>
            </div>
            </br>
            <div class="row">
                <div class="col-md-7">
                <input class="form-control btn btn-warning" type="submit" value="Finalizar" name="botonFinalizar">
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-3"></div>
            </div>
            </br>
        </form>
    </div>
        </div>
    </div>
</body>
</html>