<?php
  session_start();
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        <link rel="stylesheet" type="text/css" href=" "> </head>

    <body>
        <?php
        //FORM SUBMITTED
        if (isset($_POST["email"])) {
          //CREATING THE CONNECTION
          include ('conection.php');
          //MAKING A SELECT QUERY
          //Password coded with md5 at the database. Look for better options
          $consulta="select * from usuario where
          email='".$_POST["email"]."' and password=md5('".$_POST["pass"]."');";
          //Test if the query was correct
          //SQL Injection Possible
          //Check http://php.net/manual/es/mysqli.prepare.php for more security
          if ($result = $connection->query($consulta)) {
              //No rows returned
              if ($result->num_rows===0) {
                header("Location: ../config/noinicio.php");
              } else {
                  while($obj = $result->fetch_object()) {  
                            $_SESSION["nombre"]=$obj->nombre;
                            $_SESSION["apellidos"]=$obj->apellidos;
                            $_SESSION["tipo"]=$obj->tipo;
                            $_SESSION["idusuario"]=$obj->idusuario;
                            $_SESSION["password"]=$obj->password;
                             $_SESSION["email"]=$obj->email;
                             $_SESSION["tema"]=$obj->tema;
                            $_SESSION["language"]="es";
                            }
                            
                if($_SESSION['tipo']==1){
                header("Location: ../index.php");
                }else{
                    header("Location: ../admin/homeadministrador.php");
                }
              }

          }
      }
    ?>
    </body>

    </html>
