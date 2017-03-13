<?php
  //echo "Opppa";
  //die();
  session_start();
  unset($_SESSION['userdata']);
  session_destroy();
  header("Location: login.php");
 ?>
