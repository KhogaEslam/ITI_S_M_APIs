<!DOCTYPE html>
<html>
<head>
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <meta name="google-signin-client_id" content="[GOOGLE_API_KEY].apps.googleusercontent.com">
</head>
  <body>
    <script>
      function signOut() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
          console.log('User signed out.');
          var link = "http://apiproject.com/destroySession.php";
          location.href = link;
        });
      }

      function onLoad() {
        gapi.load('auth2', function() {
          gapi.auth2.init();
        });
      }
    </script>
    <a href="#" onclick="signOut();">Sign out</a>

    <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
  </body>
</html>
