<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);
 ?>
<?php
  $fName = $lName = $email = $pass = $rePass = "";
  $fNameErr = $lNameErr = $emailErr = $passErr = $rePassErr = "";

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


  $flag = false;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $s_id = $_POST["s_id"];
    $image = $_POST["image"];
    $type = $_POST["type"];
    $flag = true;
    if (empty($_POST["fName"])) {
      $fNameErr = "Name is required";
      $flag = false;
    } else {
      $fName = test_input($_POST["fName"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$fName)) {
        $fNameErr = "Only letters and white space allowed";
        $flag = false;
      }
    }

    if (empty($_POST["lName"])) {
      $lNameErr = "Name is required";
      $flag = false;
    } else {
      $lName = test_input($_POST["lName"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$lName)) {
        $lNameErr = "Only letters and white space allowed";
        $flag = false;
      }
    }

    if (empty($_POST["email"])) {
      $emailErr = "Email is required";
      $flag = false;
    } else {
      $email = test_input($_POST["email"]);
      // check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        $flag = false;
      }
      else{
        //check if exists
      }
    }

    if (empty($_POST["pass"])) {
      $passErr = "Password is required";
      $flag = false;
    } else {
      $pass = $_POST["pass"];
    }

    if (empty($_POST["rePass"])) {
      $rePassErr = "Password confirmation is required";
      $flag = false;
    } else {
      if($_POST["pass"] != $_POST["rePass"])
      {
        $rePassErr = "Password and Comfirmation doesn't match!";
        $flag = false;
      }
      $pass = $_POST["rePass"];
    }

  }

  if($flag){
    //Save to database...
    //redirect to home...
    $link = "http://apiproject.com/db.php?s_id=".$s_id."&image=".$image."&email=".$email."&fName=".$fName."&lName=".$lName."&type=".$type."&password=".$pass;
    header('Location: '.$link);
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
 ?>
<!DOCTYPE html>
<html>
<style>
.error {
  color: #FF0000;
}
/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

/* Extra styles for the cancel button */
.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn,.signupbtn {
    float: left;
    width: 50%;
}

/* Add padding to container elements */
.container {
    padding: 16px;
}

/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
    .cancelbtn, .signupbtn {
       width: 100%;
    }
}
</style>
<body>

<h2>Signup</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="border:1px solid #ccc">
  <div class="container">
    <p><span class="error">* required field.</span></p>
    <label><b>First Name</b></label>
    <span class="error">* <?php echo $fNameErr;?></span>
    <input type="text" placeholder="First Name" name="fName" value="<?php echo $fName;?>" >

    <label><b>Last Name</b></label>
    <span class="error">* <?php echo $lNameErr;?></span>
    <input type="text" placeholder="Last Name" name="lName" value="<?php echo $lName;?>" >

    <label><b>Email</b></label>
    <span class="error">* <?php echo $emailErr;?></span>
    <input type="text" placeholder="Enter Email" name="email" value="<?php echo $email;?>" >

    <label><b>Password</b></label>
    <span class="error">* <?php echo $passErr;?></span>
    <input type="password" placeholder="Enter Password" name="pass" value="<?php echo $pass;?>" >

    <label><b>Repeat Password</b></label>
    <span class="error">* <?php echo $rePassErr;?></span>
    <input type="password" placeholder="Repeat Password" name="rePass" value="<?php echo $rePass;?>" >

    <input type="hidden" name="s_id" value="<?php echo htmlspecialchars((isset($s_id))?$s_id:0); ?>" />
    <input type="hidden" name="image" value="<?php echo htmlspecialchars((isset($image))?$image:0); ?>" />
    <input type="hidden" name="type" value="<?php echo htmlspecialchars((isset($type))?$type:0); ?>" />

    <input type="checkbox" checked="checked"> Remember me
    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

    <div class="clearfix">
      <button type="button" onclick="logOut();" class="cancelbtn">Cancel</button>
      <button type="submit" class="signupbtn">Sign Up</button>
      <script>
        function logOut() {
            var link = "http://apiproject.com/destroySession.php";
            location.href = link;
          }
      </script>
    </div>
  </div>
</form>


</body>
</html>
