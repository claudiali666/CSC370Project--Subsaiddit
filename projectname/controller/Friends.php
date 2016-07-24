<?php
session_start();
include('connect.php');
	// Function for connecting to the saiddit database
    //if user is not logged in, show posts of default subsdaiddits
    $conn =  db_connect();
   function get_Account_Friend_Post($conn, $username){
		$query =  sprintf("SELECT post_id, post_title, post_URL, 
             	up_vote, down_vote, post_published, post_edited, post_text, user_name
          	 	FROM `csc370 Project`.Posts posts
      	 	    join User user on posts.post_user = user.user_id
			    join Friends friend on Posts.post_user = friend.user_Friend
      	  	 	WHERE user_name != '%s'
      	  	 	order by posts.up_vote-posts.down_vote DESC;", 
             	mysqli_real_escape_string($conn, $username)); 

		$result = mysqli_query($conn, $query);

        if (!$result) {
            $error = sprintf("Query Failed: %s", mysql_error());
        }

        $row = mysqli_fetch_assoc($result);
      	if($result>0){
      		//parse data
      		echo '<h2>Friend_Name:'.$row['user_name'].'</h2>';
      		while($row = mysqli_fetch_assoc($result)) { 
      		   echo       
      		   '<div postid='.$row['post_id'].'>
               <div> "upvote:"'.$row['up_vote'].', "down_vote:"'.$row['down_vote'].' </div>
               <li>' .$row['post_title'].'--------------'.($row['post_text']).'</li>
               </div>
               </li>'; 
  			
      	 	}	  		
   		}	
    
}
    $username = $_POST['name'];
	get_Account_Friend_Post($conn, $username);


?>