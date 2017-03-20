<?php
  require_once("config.php");
 ?>
<!DOCTYPE html>
<html>
<head>
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <meta name="google-signin-client_id" content="<?= $_GOOGLE_CLIENT_ID ?>">
</head>
  <body>
    <script>
      function onLoad() {
        gapi.load('auth2', function() {
          gapi.auth2.init();
        });
      }
      function signOut() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
          console.log('User signed out.');
          var link = "http://apiproject.com/destroySession.php";
          location.href = link;
        });
      }
    </script>
    <a href="#" onclick="signOut();">Sign out</a>

    <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
  </body>
</html>
