<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'connection.php';

$error="";

if (array_key_exists("id", $_COOKIE) && $_COOKIE ['id']) {
        
        $_SESSION['userID'] = $_COOKIE['id'];
        
    }

if(!isset($_SESSION['userID'])){
        
        header("Location: login.php");
    
    }

include ('header.php');


if(array_key_exists("submit", $_POST)) {
	
	if (!$_POST['name'] OR !$_POST['min_players'] OR !$_POST['max_players'] OR !$_POST['time'] OR !$_POST['difficulty']){
		
		$error = "Please complete all details.<br>";
		
	} else {
		
		$query = "INSERT INTO `boardgames` (`name`, `min_players`, `max_players`, `time`, `complexity`) VALUES ('".mysqli_real_escape_string($link, $_POST['name'])."', '".$_POST['min_players']."', '".$_POST['max_players']."', '".$_POST['time']."', '".$_POST['difficulty']."')";

		if (!mysqli_query($link, $query)) {
	
			$error = "<p>Could not add game.</p>";
			$error = mysqli_error($link);
	
		} else {
			
            if($_POST['owned']){
                $query = "SELECT `linkID` FROM `gameslink` WHERE (`ownerID` = ".$_SESSION['userID']." AND `gameID` = ".mysqli_insert_id($link).")";
                $result = mysqli_query($link, $query);

                if(!$row=mysqli_fetch_array($result)){
                    $query = "INSERT INTO `gameslink` (ownerID, gameID) VALUES (".$_SESSION['userID'].",".mysqli_insert_id($link).")";
                    if(mysqli_query($link, $query)){
                        // successfully added
                    } else {
                        // failed to add
                    }
                }
            
			//header("Location: index.php");
			
            }
		
	   }
    }
}



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

        <div id="error">

            <?php if ($error!="") {
        
            echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
    
        } 
        ?>
        </div>

        <div class="whiteBackground">

            <div class="row">
                <form method="post" id="addgame">
                    <div>
                        <fieldset class="form-group ">

                            <label>Game Name:</label>
                            <input type="text" class="form-control" name="name" id="name">

                        </fieldset>

                        <fieldset class="form-group col-md-6">

                            <label>Minimum Players:</label>
                            <select class="form-control" name="min_players" id="min_players">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                          </select>

                            <script type="text/javascript">
                                document.getElementById('min_players').value = "<?php echo $_POST['min_players'];?>";

                            </script>

                        </fieldset>

                        <fieldset class="form-group col-md-6">

                            <label>Maximum Players:</label>
                            <select class="form-control" name="max_players" id="max_players">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                          </select>

                            <script type="text/javascript">
                                document.getElementById('max_players').value = "<?php echo $_POST['max_players'];?>";

                            </script>

                        </fieldset>

                        <fieldset class="form-group col-md-6">

                            <label>Time To Play:</label>
                            <select class="form-control" name="difficulty" id="difficulty">
                            <option>Simple</option>
                            <option>Medium</option>
                            <option >Complex</option>
                          </select>

                        </fieldset>

                        <fieldset class="form-group col-md-6">

                            <label>How Complex Is The Game:</label>
                            <select class="form-control" name="time" id="time">
                            <option value="Short">Short (Less than an hour)</option>
                            <option>Medium</option>
                            <option value="Long">Long (Over two hours)</option>
                          </select>

                        </fieldset>
                    </div>

                    <div class="checkbox col-md-12">

                        <label>

                            <input type="checkbox" name="owned" id="ownded" value=1 <?php if(isset($_POST['owned'])) echo "checked='checked'"; ?>>Add to my Collection

                        </label>

                    </div>

                    <div>

                        <fieldset class="form-group col-md-6">

                            <input class="btn btn-success" type="submit" name="submit" value="Add Game">

                        </fieldset>

                        <fieldset class="form-group col-md-6">

                            <a class="btn btn-danger" href="index.php">Return To Search</a>

                        </fieldset>

                    </div>

                </form>
            </div>

        </div>
    </div>

    <?php

include ('footer.php');

?>
