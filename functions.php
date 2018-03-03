<?php

function checkOwned($userID, $gameID){
        include 'connection.php';
        $ownquery = "SELECT `linkID` FROM `gameslink` WHERE (`ownerID` = ".$userID." AND `gameID` = ".$gameID.")";
        $ownresult = mysqli_query($link, $ownquery);

        if($ownrow=mysqli_fetch_array($ownresult)){
            return true;
        } else {
            return false;
        }
    return false;
    }

function checkFav($userID, $gameID){
        include 'connection.php';
        $favquery = "SELECT `linkID` FROM `favlink` WHERE (`ownerID` = ".$userID." AND `gameID` = ".$gameID.")";
        $favresult = mysqli_query($link, $favquery);

        if($favrow=mysqli_fetch_array($favresult)){
            return true;
        } else {
            return false;
        }
    return false;
    }
    
    ?>
