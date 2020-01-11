<?php
       if(!isset($_SESSION["tipo"])){
         echo '<META HTTP-EQUIV="Refresh" CONTENT="3; URL=../index.php">';
         echo '<h1>Acceso denegado. Contacte con el administrador</h1>';
         exit;
        }
?>
