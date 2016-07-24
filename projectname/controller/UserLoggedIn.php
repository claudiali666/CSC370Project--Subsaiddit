<?php
    include('login.php');
    
    function getAuthStatus() {
            if(isset($_SESSION['login_user'])) {
                //send back userName to client
                $userName = $_SESSION['login_user'];
 				echo $userName;
                //session_destroy();
            }
            	 
            
    } 
     	 getAuthStatus();	   
?>
