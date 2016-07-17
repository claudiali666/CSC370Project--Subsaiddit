<?php
session_start();
// Function for connecting to the saiddit database
include('connect.php');
 	
    // Connection to mysql
    $conn = db_connect();
    
    function auth($username, $password, $conn) {
       // $GLOBALS['loggedInUsername'] = '0';
        global $loggedInUsername;
        $loggedInUsername = "0";
        if(empty($username) || empty($password)) {
            $error = "Both username and password must be filled";
        }else{
            //hash the password
            $password = hash('sha256', $password);
            
            $query =  sprintf("SELECT * FROM `csc370 Project`.User WHERE user_name = '%s' AND password = '%s'", mysqli_real_escape_string($conn, $username), 
                mysqli_real_escape_string($conn, $password));
             $result = mysqli_query($conn, $query);
        }

        //get mysql result
      
        if (!$result) {
            $error = sprintf("Query Failed: %s", mysql_error());
        } else {
            $rows = mysqli_num_rows($result);
            if($rows ==1){
               //store username
               $_SESSION['login_user'] = $username;
               $loggedInUsername = $username;
               header('Location: ../index.html');
            }
        }

    }
 
    //main routine
    if(isset($_POST["submit"])){
             auth($_POST['username'], $_POST['password'], $conn);
    }

   
?>
