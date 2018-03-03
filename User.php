<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class User {
    private $dbHost     = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "root";
    private $dbName     = "aauk";
    //private $dbUsername = "androida_andyc";
    //private $dbPassword = "mYsqlp4ss.";
    //private $dbName     = "androida_aauk";
    private $userTbl    = 'users';
    
    function __construct(){
      
        if(!isset($this->db)){
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }
    
    
    function checkUser($userData = array()){
        if(!empty($userData)){
            //Check whether user data already exists in database
            $prevQuery = "SELECT * FROM ".$this->userTbl." WHERE oauth_provider = '".$userData['oauth_provider']."' AND oauth_uid = '".$userData['oauth_uid']."'";
            $prevResult = $this->db->query($prevQuery);
            if($prevResult->num_rows > 0){
                //Update user data if already exists
                $query = "UPDATE ".$this->userTbl." SET firstname = '".$userData['firstname']."', lastname = '".$userData['lastname']."', email = '".$userData['email']."', gender = '".$userData['gender']."', locale = '".$userData['locale']."', picture = '".$userData['picture']."', link = '".$userData['link']."', modified = '".date("Y-m-d H:i:s")."' WHERE oauth_provider = '".$userData['oauth_provider']."' AND oauth_uid = '".$userData['oauth_uid']."'";
                $update = $this->db->query($query);
            }else{
                //Insert user data
                $query = "INSERT INTO ".$this->userTbl." SET oauth_provider = '".$userData['oauth_provider']."', oauth_uid = '".$userData['oauth_uid']."', firstname = '".$userData['firstname']."', lastname = '".$userData['lastname']."', email = '".$userData['email']."', gender = '".$userData['gender']."', locale = '".$userData['locale']."', picture = '".$userData['picture']."', link = '".$userData['link']."', created = '".date("Y-m-d H:i:s")."', modified = '".date("Y-m-d H:i:s")."'";
                
                
                $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
                
                if($conn->connect_error){
                    
                    die("Failed to connect with MySQL: " . $conn->connect_error);
                    
                }else{
                    
                    if (mysqli_query($conn, $query)or die(mysqli_error($conn))) {

                        echo 'Added'; 

                    } else {
                        
                        echo 'Not Added'; 
                        
                    }
                }
                
                //$insert = $this->db->query($query);
                
                //echo '<pre>', var_dump($insert), '</pre>';
                
            }
            
            //Get user data from the database
            $result = $this->db->query($prevQuery);
            $userData = $result->fetch_assoc();
        }
        
        //Return user data
        return $userData;
    }
}
?>
