<?php

//Include Google client library 
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
$clientId = '409998107623-vganlr28sk14dde1k14f77lhtkn3pefa.apps.googleusercontent.com';
$clientSecret = 'LlUFgr3XrbmEBgEoD-Wmbn84';
//$redirectURL = 'http://boardgames.androidandy.uk/login.php';
$redirectURL = 'http://localhost:8080/boardgames/login.php';

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('aauk');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>
