<?php
   session_start();
   unset($_SESSION["username"]);
   unset($_SESSION["role"]);
   unset($_SESSION["image"]);
   header("Location: index.php");
?>
