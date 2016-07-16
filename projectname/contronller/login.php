<?php
session_start();
// Function for connecting to the saiddit database
include('connect.php');
 	
    // $query =  "SELECT * FROM `csc370 Project`.User;";
    // Connection to mysql
    $conn = db_connect();

    if(isset($_POST["submit"])) {
         if(empty($_POST['username']) || empty($_POST['password'])) {
            $error = "Both username and password must be filled";
     }else{
        $username = $_POST["username"];
 		$password = $_POST["password"];
        
        //hash the password
        $password = hash('sha256', $password);
        
        $query =  sprintf("SELECT * FROM `csc370 Project`.User WHERE user_name = '%s' AND password = '%s'", mysqli_real_escape_string($conn, $username), 
            mysqli_real_escape_string($conn, $password));
         $result = mysqli_query($conn, $query);
    }

    //get mysql result
  
        if (!$result) {
                echo "query fail";
                $error = sprintf("Query Failed: %s", mysql_error());
            } else {
                $rows = mysqli_num_rows($result);
                if($rows ==1){
                   //store username
                   $_SESSION['login_user'] = $username;
                   //echo "scuess login";
                   header('Location:logout.php');
                   //echo "<a href='logout.php'>logout</a>";
                }
        }

 }

   
?>
