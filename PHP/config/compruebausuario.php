<?php
        if(!isset($_SESSION["tipo"])){
         echo '<META HTTP-EQUIV="Refresh" CONTENT="3; URL=../index.php">';
         echo '<h1>Acceso denegado. Contacte con el administrador</h1>';
         exit;
        }elseif($_SESSION["tipo"]=='1'){
            echo '<META HTTP-EQUIV="Refresh" CONTENT="3; URL=../index.php">';
            session_destroy();
            echo '<h1>Acceso denegado. Contacte con el administrador</h1>';
            exit;
        };
?>
