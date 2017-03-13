<?php
  session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
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
  </style>
</head>
  <body>
    <h1>Home!</h1>
      <center> <p> <h1>Welcome <?php echo $_SESSION["name"]; ?></h1> </p> </center>
      <div class="imgcontainer">
        <img src="<?php echo $_SESSION["image"];?>" alt="Avatar" class="avatar">
      </div>

      <?php
        //var_dump($_SESSION);
        require_once 'logout.php';
       ?>

  </body>
</html>
