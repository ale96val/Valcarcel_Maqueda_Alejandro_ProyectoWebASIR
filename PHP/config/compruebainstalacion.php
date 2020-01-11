<?php
if (!file_exists("config/conection.php")){ 
   header("Location: config/installer.php");
}else{ 
   if (file_exists("config/installer.php")){ 
   unlink('config/installer.php');
   }
} 
?>
