<?php
  //echo "Opppa";
  //die();
  session_start();
  unset($_SESSION['userdata']);
  unset($_POST["register"]);
  session_destroy();
  header("Location: login.php");
 ?>
