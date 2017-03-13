<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);
 ?>
<?php
  $s_id = "0";
  $image = "";
  $type = "1";
  if(!empty($_GET['s_id']))
    $s_id = $_GET['s_id'];
  if(!empty($_GET['image']))
    $image = $_GET['image'];
  if(!empty($_GET['email']))
    $email = $_GET['email'];
  if(!empty($_GET['fName']))
    $fName = $_GET['fName'];
  if(!empty($_GET['lName']))
    $lName = $_GET['lName'];
  if(!empty($_GET['type']))
    $type = $_GET['type'];
  if(!empty($_GET['password']))
    $password = $_GET['password'];

  if(!empty($s_id) && empty($password))
  {
    $exist = checkExist($email);
    if ($exist){
      //echo $exist;
      $user = array();
      $user['fname'] = $_GET['fName'];
      $user['lname'] = $_GET['lName'];
      $user['email'] = $_GET['email'];
      $user['image'] = $_GET['image'];
      setSession($user);
      header('Location: /index.php');
    }
    else{
      $link = "http://apiproject.com/signup.php?s_id=".$s_id."&image=".$image."&email=".$email."&fName=".$fName."&lName=".$lName."&type=".$type;
      header('Location: '.$link);
    }
  }

  if(!empty($password)){
    $exist = checkExist($email);
    if (!$exist){
      insertNew($s_id, $image, $email, $fName, $lName, $type, $password);
      header('Location: /login.php');
    }
    else{
      $link = "http://apiproject.com/signup.php?s_id=".$s_id."&image=".$image."&email=".$email."&fName=".$fName."&lName=".$lName."&type=".$type;
      header('Location: '.$link);
    }
  }
  function insertNew($s_id, $image, $email, $fName, $lName, $type, $password){
    $db = mysqli_connect('localhost', 'root', 'root', 'iti_api');
    if (mysqli_connect_errno()) {
        echo "Error in connection to DB!";
        exit;
    }
    $sql = "insert into user (s_id, image, email, fname, lname, type, password) values ('$s_id', '$image', '$email', '$fName', '$lName', '$type', '$password');";
    echo $sql;
    $result = mysqli_query($db, $sql);
    if (! $result) {
        echo "Cannot insert into DB!";
        exit;
    }
    mysqli_close($db);
  }

  function checkExist($email){
    $flag = false;
    @$db = mysqli_connect('localhost', 'root', 'root', 'iti_api');

    if(mysqli_connect_errno()){
      echo "Couldn't connect to Select";
      exit;
    }
    $sql = "select * from user where email like '$email'";
    //echo $sql;
    //echo $userName;
    $result = mysqli_query($db, $sql);
    if(mysqli_num_rows($result)>0){
      $flag = true;
    }
    mysqli_close($db);

    return $flag;
  }

  function login($userEmail, $userPass){
    $flag = false;
    @$db = mysqli_connect('localhost', 'root', 'root', 'iti_api');

    if(mysqli_connect_errno()){
      echo "Couldn't connect to Select";
      exit;
    }
    $sql = "select * from user where email like '$userEmail' and password like '$userPass'";
    //echo $sql;
    //echo $userName;
    $result = mysqli_query($db, $sql);
    if(mysqli_num_rows($result)>0){
      $dbuser = mysqli_fetch_assoc($result);
      var_dump($dbuser);
      $user = array();
      $user['fname'] = $dbuser['fname'];
      $user['lname'] = $dbuser['lname'];
      $user['email'] = $dbuser['email'];
      $user['image'] = $dbuser['image'];
      echo "<hr>";
      var_dump($user);
      //die;
      setSession($user);
      $flag = true;
    }
    mysqli_close($db);

    return $flag;
  }

  function setSession($user = array()){
    session_start();
    var_dump($user);
    $_SESSION['name'] = $user["fname"]." ".$user["lname"];
    $_SESSION['email'] = $user["email"];
    $_SESSION['image'] = $user["image"];
    echo "<hr>";
    var_dump($_SESSION);
    //die();
  }
?>
