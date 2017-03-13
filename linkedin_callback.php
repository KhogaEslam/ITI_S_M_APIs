<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);
 ?>
<?php
    $client_id = "[LINKEDIN_CLIENT_ID]";
    $client_secret = "[LINKED_IN_CLIENT_SECRET]";

    $request = Array(
        'grant_type' => 'authorization_code',
        'code' => $_GET['code'],
        'redirect_uri' => urlencode('http://apiproject.com/linkedin_callback.php'),
        'client_id' => $client_id,
        'client_secret' => $client_secret
    );

    $url = "https://www.linkedin.com/oauth/v2/accessToken";
    $urlString = '';
    foreach($request as $key => $value) {
        $urlString .= $key."=".$value."&";
    }
    $urlString = rtrim($urlString, '&');
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, count($request));
    curl_setopt($ch, CURLOPT_POSTFIELDS,$urlString);
    $result = curl_exec($ch);
    $access_token = json_decode($result, true);
    print_r($access_token);
    curl_close($ch);

    $ch = curl_init("https://api.linkedin.com/v1/people/~:(id,first-name,last-name,picture-url,public-profile-url,email-address)?oauth2_access_token=".$access_token['access_token']."&format=json");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
    $result = curl_exec($ch);
    $access_token = json_decode($result, true);
    /*echo "<pre>";
    print_r($access_token);
    echo "</pre>";
    */
    curl_close($ch);
    $s_id = $access_token['id'];
    $image = $access_token['pictureUrl'];
    $email = $access_token['emailAddress'];
    $fName = $access_token['firstName'];
    $lName = $access_token['lastName'];
    $type = "2";
    $link = "http://apiproject.com/db.php?s_id=".$s_id."&image=".$image."&email=".$email."&fName=".$fName."&lName=".$lName."&type=".$type;
    //echo "<pre>".$link."</pre>";
    header('Location: '.$link);

 ?>
