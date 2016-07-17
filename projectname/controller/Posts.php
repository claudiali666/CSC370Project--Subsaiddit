
<?php
// Function for connecting to the saiddit database
include('connect.php');

	$conn = db_connect();

	function getHomePage_Post($conn){
		//select default posts
		$default = "Y";

      	 $query =  sprintf("SELECT post_title, post_URL, up_vote, down_vote, post_published, post_edited, post_text FROM `csc370 Project`.Posts posts 
      	 	 Join Subsaiddits subsaid on subsaiddits_id = post_subsaiddits
      	  	 WHERE subsaiddits_is_default = '%s';", 
             mysqli_real_escape_string($conn, $default));


      	
      	$result = mysqli_query($conn, $query);
         
      	if (!$result) {
            $error = sprintf("Query Failed: %s", mysql_error());
        }
      	if($result>0){
      		//parse data
      		while($row = mysqli_fetch_assoc($result)) {
      			 $resultStr = '<li>'.$row['post_title'].' ------'.$row['post_text'].'</li>';
      			 echo $resultStr;
      	 	}	
      	 	
      	} 
      	
	}

    getHomePage_Post($conn);




?>