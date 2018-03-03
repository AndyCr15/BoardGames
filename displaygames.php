<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'functions.php';


$owned = false;
if(isset($_POST["owned"])){
    $owned = true;
}

$favs = false;
if(isset($_POST["favs"])){
    $favs = true;
}

$players = 0;
if(isset($_POST["players"])){
    $players = $_POST["players"];
}

$time = "Any";
if(isset($_POST["time"])){
    $time = $_POST["time"];
}

$difficulty = "Any";
if(isset($_POST["difficulty"])){
    $difficulty = $_POST["difficulty"];
}

// start the base query and add to it as necessary
$query = "SELECT * FROM `boardgames`";


if($players!=0){
    $query .= " WHERE (`min_players` <= ".$players." AND `max_players` >= ".$players;
} 

if($time!="Any"){
    if(strlen($query) > 26){
        $query .= " AND ";
    } else {
        $query .= " WHERE (";
    }
    $query .= " `time` = '".$time."'";
}

if($difficulty!="Any"){
    if(strlen($query) > 26){
        $query .= " AND ";
    } else {
        $query .= " WHERE (";
    }
    $query .= " `complexity` = '".$difficulty."'";
} 


// close of the search depending if it has any WHERE parameters, based on length
if(strlen($query) > 26){
        $query .= ")";
    }
$query .= " ORDER BY `name`";

// finally run the search
$result = mysqli_query($link, $query);

echo '<div class="row">';



if ($result->num_rows > 0) {
    // output data of each row
    
    
    
    while($row = $result->fetch_assoc()) {
        
        // what does the user want displaying, owned, favs, both or all
        $display = true;
        
        if(!checkOwned($_SESSION['userID'],$row['id']) AND $owned){
            $display = false;
        }
        
        if(!checkFav($_SESSION['userID'],$row['id']) AND $favs){
            $display = false;
        }
        
        // check if only display owned
        if($display){
        
            echo '<div class="deviceContainer col-md-4 col-sm-3">';
            echo '<div class="gameCard">';
            echo '<Strong>'.$row['name'].'</Strong><br/><Small>Players: '.$row['min_players'].'-'.$row['max_players'].'</Small><br/>';



            if(checkOwned($_SESSION['userID'],$row['id'])){

                    // if they already own it
                    echo '<small><a href="index.php?remove='.$row['id'].'">Remove From My Collection</a></small><br/>';

                } else {

                    // if the user doesn't currently own this game
                    echo '<small><a href="index.php?own='.$row['id'].'">Add To My Collection</a></small><br/>';


                }
            
            if(checkFav($_SESSION['userID'],$row['id'])){

                    // if they already fav'd
                    echo '<small><a href="index.php?notfav='.$row['id'].'">Remove From Favourites</a></small><br/>';

                } else {

                    // if the user doesn't currently fav this game
                    echo '<small><a href="index.php?fav='.$row['id'].'">Add To Favourites</a></small><br/>';


                }
                echo '</div>';
                echo '</div>';
            }
        }
}
echo '</div>';

?>
