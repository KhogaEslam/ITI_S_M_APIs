<?php
session_start();
include_once("twitter_config.php");
include_once("twitter_inc/twitteroauth.php");
include_once("db.php");

if(isset($_REQUEST['oauth_token']) && $_SESSION['token']  !== $_REQUEST['oauth_token']) {

	//If token is old, distroy session and redirect user to index.php
	session_destroy();
	header('Location: index.php');

}elseif(isset($_REQUEST['oauth_token']) && $_SESSION['token'] == $_REQUEST['oauth_token']) {

	//Successful response returns oauth_token, oauth_token_secret, user_id, and screen_name
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['token'] , $_SESSION['token_secret']);
	$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
	if($connection->http_code == '200')
	{
		//Redirect user to twitter
		$_SESSION['status'] = 'verified';
		$_SESSION['request_vars'] = $access_token;

		//Insert user into the database
		$params = array('include_email' => 'true', 'include_entities' => 'false', 'skip_status' => 'true');
		$user_info = $connection->get('account/verify_credentials', $params); // get the data
		echo "<pre>";
    var_dump($user_info);
    echo "</pre>";
		$name = explode(" ",$user_info->name);
    $s_id = $user_info->id_str;
		echo "$s_id<hr>";
    $image = $user_info->profile_image_url;
		echo "$image<hr>";
    $email = $user_info->email;
		echo "$email<hr>";
    $fName = isset($name[0])?$name[0]:$user_info->screen_name;
		echo "$fName<hr>";
    $llName = isset($name[1])?$name[1]:'';
		$lllName = isset($name[2])?$name[2]:'';
		$lName = $llName." ".$lllName;
		echo "$lName<hr>";
    $type = "4";

    $link = "http://apiproject.com/db.php?s_id=".$s_id."&image=".$image."&email=".$email."&fName=".$fName."&lName=".$lName."&type=".$type;
    //echo "<pre>".$link."</pre>";
		//$db_user->checkUser('twitter',$user_info->id,$user_info->screen_name,$fname,$lname,$user_info->lang,$access_token['oauth_token'],$access_token['oauth_token_secret'],$user_info->profile_image_url);

		//Unset no longer needed request tokens
		unset($_SESSION['token']);
		unset($_SESSION['token_secret']);
		header('Location: '.$link);
	}else{
		die("error, try again later!");
	}

}else{

	if(isset($_GET["denied"]))
	{
		header('Location: login.php');
		die();
	}

	//Fresh authentication
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	$request_token = $connection->getRequestToken(OAUTH_CALLBACK);

	//Received token info from twitter
	$_SESSION['token'] 			= $request_token['oauth_token'];
	$_SESSION['token_secret'] 	= $request_token['oauth_token_secret'];

	//Any value other than 200 is failure, so continue only if http code is 200
	if($connection->http_code == '200')
	{
		//redirect user to twitter
		$twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
		header('Location: ' . $twitter_url);
	}else{
		die("error connecting to twitter! try again later!");
	}
}
?>
