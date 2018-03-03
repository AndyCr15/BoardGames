<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Include GP config file && User class
include_once 'gpConfig.php';
include_once 'User.php';



if (array_key_exists("logout",$_GET)) {
        
        unset($_SESSION);
        setcookie("id", "", time() - 60*60);
        $_COOKIE["id"] = "";  
        
        session_destroy();
        
    }

if(isset($_GET['code'])){
    $gClient->authenticate($_GET['code']);
    $_SESSION['token'] = $gClient->getAccessToken();
    header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
    $gClient->setAccessToken($_SESSION['token']);
}

if ($gClient->getAccessToken()) {
    //Get user profile data from google
    $gpUserProfile = $google_oauthV2->userinfo->get();    
    
    //Initialize User class
    $user = new User();
    
    //Insert or update user data to the database
    $gpUserData = array(
        'oauth_provider'=> 'google',
        'oauth_uid'     => $gpUserProfile['id'],
        'firstname'    => $gpUserProfile['given_name'],
        'lastname'     => $gpUserProfile['family_name'],
        'email'         => $gpUserProfile['email'],
        'gender'        => $gpUserProfile['gender'],
        'locale'        => $gpUserProfile['locale'],
        'picture'       => $gpUserProfile['picture'],
        'link'          => $gpUserProfile['link']
    );
        
    $userData = $user->checkUser($gpUserData);
    //$userData = $gpUserData;
    
    //echo '<pre>', var_dump($userData), '</pre>';
    
    //Storing user data into session
    $_SESSION['userData'] = $userData;
    
    //Render Google profile data
    if(!empty($userData)){
        $_SESSION['userID'] = $userData['id'];
        ?>
    <script type="text/javascript">
        location.href = 'index.php';

    </script>
    <?php
    }else{
        echo '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }
} else {
    $authUrl = $gClient->createAuthUrl();
    echo '<a  href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="images/glogin.png" alt=""/></a>';
}

include ('header.php');

include ('footer.php');

?>
