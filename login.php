<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);
require_once("config.php");

if (isset($_POST["register"])){
  header('Location: /signup.php');
}
if(isset($_POST["login"])){
  if(!empty($_POST["email"]) && !empty($_POST["pass"])){
    include("db.php");
    $exist = login($_POST["email"], $_POST["pass"]);
    if($exist){
      header('Location: /index.php');
    }
    echo "<div class='cancelbtn'><p>User Not Found or Wrong Password!</p></div>";
  }
}

 ?>
<!DOCTYPE html>
<html>
<head>
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <meta name="google-signin-client_id" content="<?= $_GOOGLE_CLIENT_ID ?>">
  <style>
    form {
        border: 3px solid #f1f1f1;
    }

    input[type=text], input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    button {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    .reg{
      background-color: blue;
    }

    .cancelbtn {
        width: auto;
        padding: 10px 18px;
        background-color: #f44336;
    }

    .imgcontainer {
        text-align: center;
        margin: 24px 0 12px 0;
    }

    img.avatar {
        /*width: 40%;*/
        border-radius: 50%;
    }

    .container {
        padding: 16px;
    }

    span.psw {
        float: right;
        padding-top: 16px;
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
        span.psw {
           display: block;
           float: none;
        }
        .cancelbtn {
           width: 100%;
        }
    }

    .wrapper{width:600px; margin-left:auto;margin-right:auto;}
  	.welcome_txt{
  		margin: 20px;
  		background-color: #EBEBEB;
  		padding: 10px;
  		border: #D6D6D6 solid 1px;
  		-moz-border-radius:5px;
  		-webkit-border-radius:5px;
  		border-radius:5px;
  	}
  	.tweet_box{
  		margin: 20px;
  		background-color: #FFF0DD;
  		padding: 10px;
  		border: #F7CFCF solid 1px;
  		-moz-border-radius:5px;
  		-webkit-border-radius:5px;
  		border-radius:5px;
  	}
  	.tweet_box textarea{
  		width: 500px;
  		border: #F7CFCF solid 1px;
  		-moz-border-radius:5px;
  		-webkit-border-radius:5px;
  		border-radius:5px;
  	}
  	.tweet_list{
  		margin: 20px;
  		padding:20px;
  		background-color: #E2FFF9;
  		border: #CBECCE solid 1px;
  		-moz-border-radius:5px;
  		-webkit-border-radius:5px;
  		border-radius:5px;
  	}
  	.tweet_list ul{
  		padding: 0px;
  		font-family: verdana;
  		font-size: 12px;
  		color: #5C5C5C;
  	}
  	.tweet_list li{
  		border-bottom: silver dashed 1px;
  		list-style: none;
  		padding: 5px;
  	}
  </style>
</head>
  <body>
    <h2>Login</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="imgcontainer">
        <img src="images/img_avatar2.png" alt="Avatar" class="avatar">
      </div>

      <div class="container">
        <label><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email">

        <label><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="pass">
        <?php
          $client_id = $_LINKEDIN_CLIENT_ID;
          $time = md5(time());
         ?>
        <button name="login" type="submit">Login</button>
        <button name="register" class="reg" type="submit">Register</button>
        <a href="https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=<?= $client_id?>&redirect_uri=http://apiproject.com/linkedin_callback.php&state=<?= $time?>&scope=">LinkedIn</a>
        <div class="g-signin2" data-onsuccess="onSignIn"></div>
        <a href="twitter_callback.php"><img src="images/sign-in-with-twitter.png" width="151" height="24" border="0" /></a>
        <br>
        <input type="checkbox" checked="checked"> Remember me
      </div>

      <div class="container" style="background-color:#f1f1f1">
        <button type="button" class="cancelbtn">Cancel</button>
        <span class="psw">Forgot <a href="#">password?</a></span>
      </div>
    </form>
      <script>
        function onSignIn(googleUser) {
          var profile = googleUser.getBasicProfile();
          console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
          console.log('Name: ' + profile.getName());
          console.log('Image URL: ' + profile.getImageUrl());
          console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
          var s_id = profile.getId();
          var image = profile.getImageUrl();
          var email = profile.getEmail();
          var fName = profile.getName();
          var lName = "";
          var type = "3";
          var link = "http://apiproject.com/db.php?s_id="+s_id+"&image="+image+"&email="+email+"&fName="+fName+"&lName="+lName+"&type="+type;
          location.href = link;
        }
      </script>

  </body>
</html>
