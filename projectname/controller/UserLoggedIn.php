<?php
    include('login.php');
    
    function getAuthStatus() {
            if(isset($_SESSION['login_user'])) {
                //send back userName to client
                echo $_SESSION['login_user'];
                session_destroy();
            }
    } 

     	 getAuthStatus();	   
?>
