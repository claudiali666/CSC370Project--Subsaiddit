<?php
session_start();
include('connect.php');

$conn =  db_connect();
function get_Account_Subsaiddit($conn, $username){
		
    $query =  sprintf("SELECT subsaiddits_title 
          	 	FROM `csc370 Project`.Subsaiddits subsaid
      	 	    join subscribe sub on subsaid.subsaiddits_id = sub.subscribe_subsaid_id
              join User user on sub.subscribe_user_id = user.user_id
      	  	 	WHERE user.user_name = '%s';",
             	mysqli_real_escape_string($conn, $username)); 

		$result = mysqli_query($conn, $query);
    $json = array();
        if (!$result) {
            $error = sprintf("Query Failed: %s", mysql_error());
        }

      	if($result>0){
      		//parse data
      		while($row = mysqli_fetch_assoc($result)) { 
      		   //$results[] = $row['subsaiddits_title'];
            $json[] = $row;
      	 	}	  	
   		}	
      $json =json_encode($json);  
       
      echo $json;
    
}

function get_Default_Subsaiddit($conn){

       $default = "Y";
       $query =  sprintf("SELECT subsaiddits_title 
              FROM `csc370 Project`.Subsaiddits subsaid
              join subscribe sub on subsaid.subsaiddits_id = sub.subscribe_subsaid_id
              join User user on sub.subscribe_user_id = user.user_id
              where subsaid.subsaiddits_is_default = '%s'
              group by subsaiddits_title;",
              mysqli_real_escape_string($conn, $default)); 

        $result = mysqli_query($conn, $query);
        $json = array();
        if (!$result) {
            $error = sprintf("Query Failed: %s", mysql_error());
        }

        if($result>0)
      {
          //parse data
          while($row = mysqli_fetch_assoc($result)) { 
            $json[] = $row;
          }     
      }

       $json =json_encode($json); 
       echo $json;
}

  $username = $_POST['name'];
   //Get Account Post 
  if($username!=NULL){
    get_Account_Subsaiddit($conn, $username);
  }else{
    get_Default_Subsaiddit($conn);
  }
  
  
 
 
	
  

?>