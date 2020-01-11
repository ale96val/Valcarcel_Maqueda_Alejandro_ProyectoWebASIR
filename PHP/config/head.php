<?php
    if (!isset($_SESSION)){
        session_start();
    }
    if (!isset($_SESSION) || !isset($_SESSION['tema'])) {
        echo"<link rel='stylesheet' href='/styles/estilos.css'>";
    }elseif(isset($_SESSION) AND $_SESSION['tema']==0 ) {
        echo"<link rel='stylesheet' href='/styles/estilos.css'>";
    }elseif(isset($_SESSION) AND $_SESSION['tema']==1 ) {
        echo"<link rel='stylesheet' href='/styles/estilos1.css'>";
    }elseif(isset($_SESSION) AND $_SESSION['tema']==2 ) {
        echo"<link rel='stylesheet' href='/styles/estilos2.css'>";
    }elseif(isset($_SESSION) AND $_SESSION['tema']==3 ) {
        echo"<link rel='stylesheet' href='/styles/estilos3.css'>";
    }
 ?>
    <div class="col-md-3">
        <a href="../index.php"><img class="imag" src="../img/logo2.JPG" /></a>
    </div>
    <?php
if (!isset($_SESSION["email"])) {
    echo"<div class='col-md-6'></div>";
    echo"<div class='col-md-3'>";
        echo"<div class='recuadro marginr05'>";
      echo"<div class='row margin1'>";
                echo"<form method='post' action='/config/checklogin.php'>";
                    echo"<div class='form-group'>";
                        echo"<label>Direccion Email</label>";
                        echo"<input type='email' class='form-control input-md colorinput' name='email'></div>";
                    echo"<div class='form-group'>";
                       echo" <label for='pass'>Contraseña</label>";
                        echo"<input type='password' class='form-control input-md colorinput' name='pass'></div>";
                        echo"<button type='submit' class='btn btn-primary btn-sm pull-right margin1'>Iniciar Sesión</button>";
                echo"</form>";
                    echo"<form method='post' action='../users/registro.php'>";
                    echo"<button type='submit' class='btn btn-warning btn-sm pull-right margin1'>Registrarse</button>";
                    echo"</form>";
        echo"</div>";
        session_destroy(); 
  }else{
    echo"<div class='col-md-5'></div>";
    echo"<div class='col-md-4'>";
        echo"<div class='recuadro marginr05'>";
        echo "<div class='row center margin1'>";
                    echo"<h4 class='centertext'>Has iniciado sesión como: ".$_SESSION['nombre']."</h4>";
        echo "</div>";
        echo "<div class='row center'>";
                echo"<div class='centertext marginbottom'>";
                echo"<form action='' method='post'>";
                echo "<div class='boton'>";
                echo"<input type='submit' value='Salir' name='salir' class='btn btn-danger btn-sm'/></div>";
                echo"<div class='boton'>";
                echo"<input type='submit' value='Reservas' name='reservas' class='btn btn-success btn-sm' /></div>";
                echo"<div class='boton'>";
                echo"<input type='submit' value='Home' name='home' class='btn btn-success btn-sm' /></div>";
                echo"<div class='boton'>";
                echo"<input type='submit' value='Mis Datos' name='datos' class='btn btn-success btn-sm' /></div>";
                if($_SESSION["tipo"]==0){
                    echo "<div class='botonsup margin1'>";
                    echo"<input type='submit' value='Panel Administrador' name='admin' class='btn btn-warning btn-sm' /></div>";
                }
                echo"</form>";
                if(isset($_POST['salir'])){
                    session_destroy();
                    header("Location: ../index.php");
                }
                if(isset($_POST['reservas'])){
                    header("Location: ../users/reservas.php");
                }
                if(isset($_POST['home'])){
                    header("Location: ../index.php");
                }
                if(isset($_POST['admin'])){
                    header("Location: ../admin/homeadministrador.php");
                }
                if(isset($_POST['datos'])){
                    header("Location: ../users/misdatos.php");
                }
      echo"</div>";
      echo"</div>";
  }
        ?>
        </div>
        </div>
