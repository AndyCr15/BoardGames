<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'User.php';
include_once 'connection.php';

if (array_key_exists("id", $_COOKIE) && $_COOKIE ['id']) {
        
        $_SESSION['userID'] = $_COOKIE['id'];
        
    }

if(!isset($_SESSION['userID'])){
        
        header("Location: login.php");
    
    }


if(isset($_GET["own"])){
    
    $query = "SELECT `linkID` FROM `gameslink` WHERE (`ownerID` = ".$_SESSION['userID']." AND `gameID` = ".$_GET["own"].")";
    $result = mysqli_query($link, $query);
    
    if(!$row=mysqli_fetch_array($result)){
        $query = "INSERT INTO `gameslink` (ownerID, gameID) VALUES (".$_SESSION['userID'].",".$_GET["own"].")";
        if(mysqli_query($link, $query)){
            // successfully added
        } else {
            // failed to add
        }
    }
}

if(isset($_GET["remove"])){
    
    $query = "SELECT `linkID` FROM `gameslink` WHERE (`ownerID` = ".$_SESSION['userID']." AND `gameID` = ".$_GET["remove"].")";
    $result = mysqli_query($link, $query);
    
    if($row=mysqli_fetch_array($result)){
        $query = "DELETE FROM `gameslink` WHERE linkID = ".$row['linkID']." LIMIT 1";
        if(mysqli_query($link, $query)){
            // successfully removed
        } else {
            // failed to remove
        }
    }
}

if(isset($_GET["fav"])){
    
    $query = "SELECT `linkID` FROM `favlink` WHERE (`ownerID` = ".$_SESSION['userID']." AND `gameID` = ".$_GET["fav"].")";
    $result = mysqli_query($link, $query);
    
    if(!$row=mysqli_fetch_array($result)){
        $query = "INSERT INTO `favlink` (ownerID, gameID) VALUES (".$_SESSION['userID'].",".$_GET["fav"].")";
        if(mysqli_query($link, $query)){
            // successfully added
        } else {
            // failed to add
        }
    }
}

if(isset($_GET["notfav"])){
    
    $query = "SELECT `linkID` FROM `favlink` WHERE (`ownerID` = ".$_SESSION['userID']." AND `gameID` = ".$_GET["notfav"].")";
    $result = mysqli_query($link, $query);
    
    if($row=mysqli_fetch_array($result)){
        $query = "DELETE FROM `favlink` WHERE linkID = ".$row['linkID']." LIMIT 1";
        if(mysqli_query($link, $query)){
            // successfully removed
        } else {
            // failed to remove
        }
    }
}

include ('header.php');


?>

    <nav class="navbar navbar-light bg-faded navbar-fixed-top">
        <?php
        
        // get this users first name, given their ID in the session data
        $query = "SELECT `firstname` FROM `users` WHERE `id` = ".$_SESSION['userID'];
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_array($result);
        $userName = $row['firstname'];
        
        echo '<a class="navbar-brand" href="#">Board Game Selector -  '.$userName.'</a>';
        ?>
            <div class="pull-xs-right">
                <a href='login.php?logout=1'>
        <button class="btn btn-warning-outline" type="submit">Logout</button>
      </a>
            </div>

    </nav>



    <div class="container">
        <div class="whiteBackground">

            <?php include("searchform.php"); ?>

        </div>
        <div>

            <?php include("displaygames.php"); ?>

        </div>
    </div>

    <?php

include ('footer.php');

?>
