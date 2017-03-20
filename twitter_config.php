<?php
require_once("config.php");
define('CONSUMER_KEY', $_TWITTER_CLIENT_ID);
define('CONSUMER_SECRET', $_TWITTER_CLIENT_SECRET);
define('OAUTH_CALLBACK', 'http://apiproject.com/twitter_callback.php');
?>
